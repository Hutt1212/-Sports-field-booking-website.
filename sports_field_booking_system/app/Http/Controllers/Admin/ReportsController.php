<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\SportsField;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        // Get date range from request or default to last 30 days
        $dateFrom = $request->get('date_from', Carbon::now()->subDays(30)->format('Y-m-d'));
        $dateTo = $request->get('date_to', Carbon::now()->format('Y-m-d'));
        
        // Convert to Carbon instances
        $startDate = Carbon::parse($dateFrom)->startOfDay();
        $endDate = Carbon::parse($dateTo)->endOfDay();
        
        // Booking Statistics
        $totalBookings = Booking::whereBetween('booking_date', [$startDate, $endDate])->count();
        $confirmedBookings = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->where('status', 'confirmed')->count();
        $pendingBookings = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->where('status', 'pending')->count();
        $cancelledBookings = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->where('status', 'cancelled')->count();
        
        // Income Reports
        $totalIncome = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->where('status', 'confirmed')
            ->sum('total_price');
        
        $cashIncome = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->where('status', 'confirmed')
            ->where('payment_method', 'cash')
            ->sum('total_price');
        
        $bkashIncome = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->where('status', 'confirmed')
            ->where('payment_method', 'bkash')
            ->sum('total_price');
        
        // Daily income for chart
        $dailyIncome = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->where('status', 'confirmed')
            ->selectRaw('DATE(booking_date) as date, SUM(total_price) as income')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        // Sport-wise booking statistics
        $sportStats = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->join('sports_fields', 'bookings.sports_field_id', '=', 'sports_fields.id')
            ->selectRaw('sports_fields.sport_type, COUNT(*) as booking_count, SUM(bookings.total_price) as total_income')
            ->groupBy('sports_fields.sport_type')
            ->orderByDesc('booking_count')
            ->get();
        
        // Most popular fields
        $popularFields = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->join('sports_fields', 'bookings.sports_field_id', '=', 'sports_fields.id')
            ->selectRaw('sports_fields.name, sports_fields.sport_type, COUNT(*) as booking_count, SUM(bookings.total_price) as total_income')
            ->groupBy('sports_fields.id', 'sports_fields.name', 'sports_fields.sport_type')
            ->orderByDesc('booking_count')
            ->limit(10)
            ->get();
        
        // Most used time slots
        $popularSlots = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->selectRaw('TIME(start_time) as slot_time, COUNT(*) as booking_count')
            ->groupBy('slot_time')
            ->orderByDesc('booking_count')
            ->limit(10)
            ->get();
        
        // Peak hours analysis
        $hourlyStats = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->selectRaw('HOUR(start_time) as hour, COUNT(*) as booking_count')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();
        
        // Payment method statistics
        $paymentStats = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->where('status', 'confirmed')
            ->selectRaw('payment_method, COUNT(*) as count, SUM(total_price) as total')
            ->groupBy('payment_method')
            ->get();
        
        // Recent bookings for quick overview
        $recentBookings = Booking::with(['user', 'sportsField'])
            ->whereBetween('booking_date', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.reports.index', compact(
            'dateFrom', 'dateTo', 'totalBookings', 'confirmedBookings', 'pendingBookings', 'cancelledBookings',
            'totalIncome', 'cashIncome', 'bkashIncome', 'dailyIncome', 'sportStats', 'popularFields',
            'popularSlots', 'hourlyStats', 'paymentStats', 'recentBookings'
        ));
    }
}