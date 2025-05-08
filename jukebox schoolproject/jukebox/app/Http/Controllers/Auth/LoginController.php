<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Toon het login formulier.
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Verwerk een inlogverzoek.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('songs.index'))
                ->with('success', 'Je bent succesvol ingelogd.');
        }

        return back()->withErrors([
            'email' => 'De opgegeven gegevens komen niet overeen met onze administratie.',
        ])->onlyInput('email');
    }

    /**
     * Log de gebruiker uit.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('songs.index')
            ->with('success', 'Je bent succesvol uitgelogd.');
    }
}
