<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Toon het registratieformulier.
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * Verwerk een registratieverzoek.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => false, // Standaard is een nieuwe gebruiker geen admin
        ]);

        Auth::login($user);

        return redirect()->route('songs.index')
            ->with('success', 'Account is succesvol aangemaakt.');
    }
}
