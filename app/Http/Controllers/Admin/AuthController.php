<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController
{
    /**
     * ログイン画面
     */
    public function index(): View
    {
        return view('admin.auth.index');
    }

    /**
     * ログイン
     */
    public function authenticate(AdminLoginRequest $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            $res = route('admin.top');

            return redirect()->intended($res);
        }

        return redirect()->route('admin.index')->withErrors([
            'auth' => 'ログインに失敗しました。入力されたログイン情報が間違っています。',
        ]);
    }

    /**
     * ログアウト
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        $request->session()->regenerate();

        return redirect()->route('admin.index');
    }
}
