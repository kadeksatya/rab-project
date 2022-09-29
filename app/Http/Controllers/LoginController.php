<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showFormLogin()
    {
        if(Auth::check()){
            return redirect()->back();
        }

        return view('login', [
            'page_name' => 'Login'
        ]);
    }


    public function login(Request $request)
    {

            $forms = $request->only(['username','password']);

            if(Auth::attempt($forms)){
                $request->session()->regenerate();
                return redirect()->route('dashboard.index')->with('message','Login sukses!');
            }

            return redirect()->back()->withErrors('Username atau password salah !');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
