<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function post_login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect('');
        } else {
            return back()->with('notification', 'Sai thông tin đăng nhập');
        }
    }

    public function logout_user()
    {
        $user = User::find(Auth::user()->id);

        Auth::logout();
        return redirect('');
    }
}
