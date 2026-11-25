<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('login.login');
    }
    public function showRegisterForm(){
        return view('login.register');
    }
    public function register (Request $request){
        $request->validate([
            'tenkh' => 'required|string|max:255',
            'diachi' => 'nullable|string|max:255',
            'sdt' => 'nullable|string|max:10',
            'email' => 'required|email|unique:khach_hangs,email',
            'password' => 'required|min:6|confirmed',
        ],[
            'email.unique' => 'Email này đã được đăng ký.',
        ]);

        try{
            KhachHang::create([
            'tenkh' => $request->tenkh,
            'diachi' => $request->diachi,
            'sdt' => $request->sdt,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect()->route('openlogin')->with('success', 'Đăng ký tài khoản thành công! Vui lòng đăng nhập.');

        } catch (\Exception $e) {

            return back()->withInput()->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình đăng ký. Vui lòng thử lại.']);
        }

    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');


       if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();
            $role = strtolower(trim($user->chucvunv));

            if ($role === 'receptionist') {
                return redirect()->route('letan.checkup');
            } elseif ($role === 'owner') {
                return redirect()->route('owner.dashboard');
            } else {
                return redirect()->route('admin.employee.index');
            }
        }
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('user.index');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ]);
    }
    public function logout(Request $request ){
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('openlogin')->with('success', 'Đã đăng xuất thành công.');
    }

}