<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use App\Models\SportsField;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // 12 tháng trong năm (Jan, Feb, ...)
        $months = [];
        for ($m = 1; $m <= 12; $m++) {
            $months[] = Carbon::create()->month($m)->format('M');
        }

        // Doanh thu theo tháng (sum total_price)
        $revenueRows = DB::table('bookings')
            ->selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        //  Số lượng booking theo tháng
        $bookingRows = DB::table('bookings')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        //  Người dùng mới trong năm (theo tháng)
        $newUserRows = DB::table('users')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Người dùng quay lại (đặt sân > 1 lần)
        $returningUsers = DB::table('bookings')
            ->select('user_id')
            ->groupBy('user_id')
            ->havingRaw('COUNT(*) > 1')
            ->get()
            ->count();

        // Người dùng mới trong tháng hiện tại
        $newUsersThisMonth = DB::table('users')
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

        // Loại sân được thuê nhiều nhất
        $fieldTypeRows = DB::table('sports_fields')
            ->join('bookings', 'sports_fields.id', '=', 'bookings.sports_field_id')
            ->selectRaw('sports_fields.type as type, COUNT(bookings.id) as cnt')
            ->groupBy('sports_fields.type')
            ->orderByDesc('cnt')
            ->pluck('cnt', 'type')
            ->toArray();

        // Đảm bảo có đủ 12 tháng (nếu tháng nào không có dữ liệu thì = 0)
        $revenueValues = [];
        $bookingValues = [];
        $newUserValues = [];
        foreach (range(1, 12) as $i) {
            $revenueValues[] = isset($revenueRows[$i]) ? (float)$revenueRows[$i] : 0;
            $bookingValues[] = isset($bookingRows[$i]) ? (int)$bookingRows[$i] : 0;
            $newUserValues[] = isset($newUserRows[$i]) ? (int)$newUserRows[$i] : 0;
        }

        // Dữ liệu biểu đồ tổng hợp
        $chartData = [
            'revenue' => [
                'months' => $months,
                'values' => $revenueValues,
            ],
            'bookings' => [
                'months' => $months,
                'values' => $bookingValues,
            ],
            'users' => [
                'newThisMonth' => $newUsersThisMonth,
                'returning' => $returningUsers,
                'monthlyNew' => $newUserValues,
            ],
            'fieldTypes' => [
                'labels' => array_keys($fieldTypeRows),
                'values' => array_values($fieldTypeRows),
            ],
        ];

        // Số liệu tổng quan
        $totalUsers = User::count();
        $totalFields = SportsField::count();
        $totalBookings = Booking::count();

        //  Danh sách đặt sân gần nhất
        $recentBookings = Booking::with(['user', 'sportsField'])
            ->latest()
            ->take(5)
            ->get();

        // Truyền toàn bộ dữ liệu sang view
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalFields',
            'totalBookings',
            'recentBookings',
            'chartData'
        ));
    }
}
