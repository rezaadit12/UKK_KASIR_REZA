<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('module.auth.login');
    }

    public function loginStore(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password'=> 'required|min:4',
        ]);

        if(Auth::attempt($credentials)){
            return redirect('/')->with('success','Login Berhasil');
        }
        
        return back()->with('error','Email atau Password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','Logout berhasil');
    }
}
