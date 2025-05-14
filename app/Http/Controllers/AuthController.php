<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    /**
     * ログイン画面を表示する
     * 
     */
    public function index(Request $request)
    {
        return view('auth.index');
    }

    /**
     * ログインする
     * 
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('user')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('posts');
        }

        return redirect()->back()->withErrors([
            'auth' => 'ログインに失敗しました。入力されたログイン情報が間違っています。',
        ]);
    }

    /**
     * アプリケーションからユーザーをログアウト
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('user')->logout();
        $request->session()->regenerate();

        return redirect()->route('login');
    }
}
