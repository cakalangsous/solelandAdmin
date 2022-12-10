<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSettings;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $data['site_settings'] = SiteSettings::all();
        return view('admin.login', $data);
    }

    public function login(Request $request)
    {
        $credential = $request->validate(['email' => 'required|email', 'password' => 'required']);

        $remember = $request->remember=='on'?true:false;

        if (!Auth::attempt($credential, $remember)) {
            $request->flashOnly(['email']);

            return back()->withErrors([
                'login' => 'The provided credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));

    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(RouteServiceProvider::HOME);
    }
}
