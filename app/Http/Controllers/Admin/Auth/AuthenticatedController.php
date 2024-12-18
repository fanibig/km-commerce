<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AdminLoginRequest;

class AuthenticatedController extends Controller
{
    public function showLoginForm()
    {
        $pageTitle = 'Admin Login';
        return view('admin/auth/login', compact('pageTitle'));
    }

    public function loginPost(AdminLoginRequest $request): RedirectResponse
    {
        $login = $request->login_or_email;
        $password = $request->password;
        try {
            $request->authenticate($login, $password);
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard', absolute: false));
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        // $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}