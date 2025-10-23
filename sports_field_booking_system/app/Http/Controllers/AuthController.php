<?php

namespace App\Http\Controllers;

use App\User\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Hiển thị form đăng nhập.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Xử lý yêu cầu đăng nhập.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // TỐI ƯU: Thêm điều kiện 'role' trực tiếp vào credentials.
        // Điều này sẽ kiểm tra email, password VÀ role trong cùng một câu lệnh.
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === Role::Admin) { 
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended(route('welcome'));
        }
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác hoặc bạn không có quyền truy cập.',
        ])->onlyInput('email');
    }

    /**
     * Hiển thị form đăng ký.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Xử lý yêu cầu đăng ký.
     */
    public function register(Request $request)
    {
        // SỬA LỖ HỔNG BẢO MẬT: Bỏ 'role' khỏi validation.
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            // SỬA LỖ HỔNG BẢO MẬT: Mặc định gán role là 'user'.
            'role' => Role::User,
        ]);

        Auth::login($user);

        // Sau khi đăng ký, luôn chuyển hướng đến dashboard của user.
        return redirect()->route('welcome');
    }

    /**
     * Xử lý yêu cầu đăng xuất.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
