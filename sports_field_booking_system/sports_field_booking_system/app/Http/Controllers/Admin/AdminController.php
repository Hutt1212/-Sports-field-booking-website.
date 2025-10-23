<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SportsField;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        //
    }

    public function dashboard()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access. Admin privileges required.');
        }

        $totalFields = SportsField::count();
        $totalBookings = Booking::count();
        $totalUsers = User::where('role', 'user')->count();
        $recentBookings = Booking::with(['user', 'sportsField'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalFields',
            'totalBookings', 
            'totalUsers',
            'recentBookings'
        ));
    }
}
