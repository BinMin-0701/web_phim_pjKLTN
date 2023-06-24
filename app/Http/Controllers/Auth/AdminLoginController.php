<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admincp.login');
    }

    public function post_login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];

        $remember = $request->remember;


        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('home');
        } else {
            return back()->with('notification', 'Sai thông tin đăng nhập');
        }
    }
}
