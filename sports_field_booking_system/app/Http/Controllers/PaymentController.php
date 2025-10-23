<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Hiển thị trang thanh toán cho booking
     */
    public function show($bookingId)
    {
        $booking = Booking::with(['sportsField', 'user'])
            ->where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('payment.show', compact('booking'));
    }

    /**
     * Xử lý thanh toán
     */
    public function process(Request $request, $bookingId)
    {
        $booking = Booking::where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validator = Validator::make($request->all(), [
            'payment_method' => 'required|in:cash,bank_transfer,credit_card,momo',
            'bank_name' => 'required_if:payment_method,bank_transfer|nullable|string|max:255',
            'bank_account' => 'required_if:payment_method,bank_transfer|nullable|string|max:255',
            'transaction_id' => 'nullable|string|max:255',
            'payment_notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        // Cập nhật thông tin thanh toán
        $booking->update([
            'payment_method' => $validated['payment_method'],
            'bank_name' => $validated['bank_name'] ?? null,
            'bank_account' => $validated['bank_account'] ?? null,
            'transaction_id' => $validated['transaction_id'] ?? null,
            'payment_notes' => $validated['payment_notes'] ?? null,
            'payment_status' => $this->determinePaymentStatus($validated['payment_method']),
        ]);

        // Tạo thông báo
        Auth::user()->notifications()->create([
            'type' => 'payment_updated',
            'title' => 'Cập nhật thông tin thanh toán',
            'message' => "Thông tin thanh toán cho đặt sân {$booking->sportsField->name} đã được cập nhật.",
            'data' => ['booking_id' => $booking->id]
        ]);

        return redirect()->route('booking.my-bookings')
            ->with('success', 'Thông tin thanh toán đã được cập nhật thành công!');
    }

    /**
     * Xác nhận thanh toán (cho admin)
     */
    public function confirm(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        $validator = Validator::make($request->all(), [
            'payment_status' => 'required|in:pending,paid,refunded',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $booking->update([
            'payment_status' => $request->payment_status,
            'payment_notes' => $request->admin_notes ? 
                ($booking->payment_notes ? $booking->payment_notes . "\n[Admin]: " . $request->admin_notes : "[Admin]: " . $request->admin_notes) : 
                $booking->payment_notes,
        ]);

        // Thông báo cho user
        $booking->user->notifications()->create([
            'type' => 'payment_confirmed',
            'title' => 'Xác nhận thanh toán',
            'message' => "Thanh toán cho đặt sân {$booking->sportsField->name} đã được xác nhận.",
            'data' => ['booking_id' => $booking->id]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Trạng thái thanh toán đã được cập nhật!'
        ]);
    }

    /**
     * Xác định trạng thái thanh toán dựa trên phương thức
     */
    private function determinePaymentStatus($paymentMethod)
    {
        switch ($paymentMethod) {
            case 'credit_card':
            case 'momo':
                return 'paid';
            case 'bank_transfer':
            case 'cash':
            default:
                return 'pending';
        }
    }

    /**
     * Lấy thông tin thanh toán cho API
     */
    public function getPaymentInfo($bookingId)
    {
        $booking = Booking::with(['sportsField', 'user'])
            ->where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $booking->id,
                'field_name' => $booking->sportsField->name,
                'total_price' => $booking->total_price,
                'payment_method' => $booking->payment_method,
                'payment_status' => $booking->payment_status,
                'bank_name' => $booking->bank_name,
                'bank_account' => $booking->bank_account,
                'transaction_id' => $booking->transaction_id,
                'payment_notes' => $booking->payment_notes,
                'created_at' => $booking->created_at->format('d/m/Y H:i'),
            ]
        ]);
    }
}
