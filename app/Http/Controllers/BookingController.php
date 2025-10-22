<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PricingSetting;
use App\Models\SportsField;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator; // Thêm Validator

class BookingController extends Controller
{
    public function create()
    {
        $sportsFields = SportsField::all();
        return view('booking.create', [
            'sportsFields' => $sportsFields
        ]);
    }

    public function search()
    {
        return view('booking.search');
    }

    public function searchFields(Request $request)
    {
        $query = SportsField::query()->where('status', 'active');

        if ($request->filled('sport')) {
            $query->where('sport_type', $request->sport);
        }
        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }
        if ($request->filled('surface') && $request->surface !== 'all') {
            $query->where('surface', $request->surface);
        }

        if (Auth::check()) {
            $query->withExists(['favoritedBy as is_favorited' => function ($query) {
                $query->where('user_id', Auth::id());
            }]);
        }

        $fields = $query->get()->unique(function ($item) {
            return $item->name . '-' . $item->sport_type . '-' . $item->location . '-' . $item->size . '-' . $item->surface;
        })->values();

        return response()->json(['success' => true, 'fields' => $fields]);
    }

    public function showField($id)
    {
        $field = SportsField::findOrFail($id);
        $isFavorited = Auth::check() ? auth()->user()->favorites()->where('sports_field_id', $id)->exists() : false;
        return view('booking.field-details', compact('field', 'isFavorited'));
    }

    public function checkAvailability(Request $request, $fieldId)
    {
        $request->validate(['date' => 'required|date']);
        $field = SportsField::findOrFail($fieldId);
        $date = Carbon::parse($request->input('date'))->format('Y-m-d');
        $allSlots = $field->generateTimeSlots();

        $bookedSlots = Booking::where('sports_field_id', $fieldId)
            ->where('booking_date', $date)
            ->where('status', '!=', 'cancelled')
            ->pluck('start_time')
            ->map(fn($time) => Carbon::parse($time)->format('H:i'))
            ->flip();

        $settings = PricingSetting::first();
        $peakStart = $settings ? Carbon::parse($settings->peak_start_time) : Carbon::createFromTime(18, 0);
        $surcharge = $settings ? (int) $settings->peak_surcharge : 2000;

        foreach ($allSlots as &$slot) {
            $slotStart = $slot['start_time'];
            $slot['available'] = !isset($bookedSlots[$slotStart]);
            $isPeak = Carbon::createFromFormat('H:i', $slotStart)->gte($peakStart);
            $slot['peak'] = $isPeak;
            $slot['price'] = (int) $field->price_per_90min + ($isPeak ? $surcharge : 0);
        }

        return response()->json(['success' => true, 'slots' => $allSlots]);
    }

    public function book(Request $request, $fieldId)
    {
        // Thêm kiểm tra đăng nhập để trả về lỗi JSON thay vì redirect
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần phải đăng nhập để đặt sân.'
            ], 401);
        }

        // Đổi tên 'date' thành 'booking_date' để khớp với payload từ frontend
        $validator = Validator::make($request->all(), [
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'price' => 'required|integer|min:0',
            'payment_method' => 'required|in:cash,bkash',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Dữ liệu không hợp lệ.', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $field = SportsField::findOrFail($fieldId);

        try {
            $booking = DB::transaction(function () use ($validated, $field) {
                $alreadyBooked = Booking::where('sports_field_id', $field->id)
                    ->where('booking_date', $validated['booking_date'])
                    ->where('start_time', $validated['start_time'])
                    ->where('status', '!=', 'cancelled')
                    ->lockForUpdate()
                    ->exists();

                if ($alreadyBooked) {
                    throw new \Exception('Khung giờ này vừa có người khác đặt. Vui lòng chọn khung giờ khác.', 409);
                }

                $newBooking = Booking::create([
                    'user_id' => Auth::id(),
                    'sports_field_id' => $field->id,
                    'booking_date' => $validated['booking_date'],
                    'start_time' => $validated['start_time'],
                    'end_time' => $validated['end_time'],
                    'total_price' => $validated['price'],
                    'status' => 'confirmed',
                    'payment_method' => $validated['payment_method'],
                    'payment_status' => $validated['payment_method'] === 'cash' ? 'pending' : 'paid',
                ]);

                Auth::user()->notifications()->create([
                    'type' => 'booking_created',
                    'title' => 'Xác nhận đặt sân thành công',
                    'message' => "Bạn đã đặt thành công sân {$field->name} vào ngày " . Carbon::parse($validated['booking_date'])->format('d/m/Y') . ".",
                    'data' => ['booking_id' => $newBooking->id]
                ]);

                return $newBooking;
            });

            return response()->json(['success' => true, 'booking_id' => $booking->id]);
        } catch (\Exception $e) {
            Log::error('Booking failed: ' . $e->getMessage());
            $code = is_int($e->getCode()) && $e->getCode() !== 0 ? $e->getCode() : 500;
            return response()->json(['success' => false, 'message' => $e->getMessage()], $code);
        }
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền hủy lịch đặt này.');
        }

        if (Carbon::parse($booking->booking_date . ' ' . $booking->start_time)->isBefore(now()->addHours(24))) {
            return response()->json(['success' => false, 'message' => 'Không thể hủy lịch đặt trước giờ bắt đầu ít hơn 24 tiếng.'], 422);
        }

        $booking->update(['status' => 'cancelled']);

        // ✅ SỬA LỖI TẠI ĐÂY: Sử dụng mối quan hệ $booking->user thay vì helper auth()
        // Điều này đảm bảo thông báo được gửi đến đúng người dùng sở hữu booking.
        $booking->user->notifications()->create([
            'type' => 'booking_cancelled',
            'title' => 'Lịch đặt đã được hủy',
            'message' => "Lịch đặt sân {$booking->sportsField->name} vào ngày " . Carbon::parse($booking->booking_date)->format('d/m/Y') . " của bạn đã được hủy.",
            'data' => ['field_id' => $booking->sports_field_id]
        ]);

        return response()->json(['success' => true, 'message' => 'Đã hủy lịch đặt thành công.']);
    }

    public function myBookings(Request $request)
    {
        // ✅ LƯU Ý QUAN TRỌNG:
        // Phương thức này phải được bảo vệ bởi middleware 'auth' trong file routes/web.php.
        // Nếu không, các dòng auth()->user()->... sẽ gây ra lỗi nghiêm trọng.
        $user = Auth::user();

        $query = $user->bookings()->with('sportsField');

        if ($request->filled('sport')) {
            $query->whereHas('sportsField', fn($q) => $q->where('sport_type', $request->sport));
        }
        if ($request->filled('field')) {
            $query->whereHas('sportsField', fn($q) => $q->where('name', 'like', '%' . $request->field . '%'));
        }
        if ($request->filled('date_from')) {
            $query->where('booking_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('booking_date', '<=', $request->date_to);
        }

        $bookings = $query->latest('booking_date')->latest('start_time')->paginate(10)->withQueryString();

        $unreadNotifications = $user->notifications()->where('is_read', false)->count();
        $sports = SportsField::distinct()->pluck('sport_type')->sort();

        return view('booking.my-bookings', compact('bookings', 'unreadNotifications', 'sports'));
    }
}
