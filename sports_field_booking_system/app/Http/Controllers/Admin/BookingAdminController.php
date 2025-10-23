<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingAdminController extends Controller

{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'sportsField'])->orderBy('created_at', 'desc');
        
        // Apply filters
        if ($request->filled('user')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%');
            });
        }
        
        if ($request->filled('sport')) {
            $query->whereHas('sportsField', function($q) use ($request) {
                $q->where('sport_type', $request->sport);
            });
        }
        
        if ($request->filled('field')) {
            $query->whereHas('sportsField', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->field . '%');
            });
        }
        
        if ($request->filled('date_from')) {
            $query->where('booking_date', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->where('booking_date', '<=', $request->date_to);
        }
        
        $bookings = $query->paginate(15)->withQueryString();
        
        // Get sports for filter dropdown
        $sports = \App\Models\SportsField::distinct()->pluck('sport_type')->sort();
        
        return view('admin.bookings.index', compact('bookings', 'sports'));
    }

    public function destroy(Booking $booking)
    {
        $field = $booking->sportsField;
        $user = $booking->user;
        $booking->delete();

        // Create notification for admin cancellation
        \App\Models\Notification::create([
            'user_id' => $user->id,
            'type' => 'booking_cancelled',
            'title' => 'Booking Cancelled by Admin',
            'message' => "Your booking for {$field->name} on " . \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') . " has been cancelled by an administrator.",
            'data' => ['field_id' => $field->id, 'cancelled_by_admin' => true]
        ]);

        return redirect()->route('admin.bookings.index')->with('status', 'Booking deleted.');
    }
}

