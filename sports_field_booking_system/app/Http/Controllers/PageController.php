<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SportsField; // Import model SportsField

class PageController extends Controller
{
    /**
     * Display the welcome page with featured sports fields.
     */
    public function welcome()
    {
        // 2. Lấy 3 sân nổi bật (hoặc số lượng bạn muốn) đang hoạt động
        $courts = SportsField::where('status', 'active')
            ->latest() // Sắp xếp theo sân mới nhất
            ->take(3)  // Lấy 3 sân
            ->get();

        // 3. Truyền biến $courts sang view 'welcome'
        return view('welcome', compact('courts'));
    }
}
