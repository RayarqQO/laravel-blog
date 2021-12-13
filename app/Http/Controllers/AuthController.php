<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('pages.register');
    }

    public function registration(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));

        return redirect('/login');
    }

    public function showLoginForm()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
           'email' => 'required|email',
           'password' => 'required'
        ]);

        if(Auth::attempt([
           'email' => $request->get('email'),
           'password' => $request->get('password')
        ])) {
            return redirect('/');
        }

        return redirect()->back()->with('status', 'Invalid login or password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
