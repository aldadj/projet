<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm() {
        return view('admin.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redirection forcée vers le dashboard pour tester
            return redirect()->route('admin.dashboard');
        }
    
        // Si on arrive ici, c'est que l'auth a échoué
        return back()->withErrors([
            'email' => 'L’adresse email ou le mot de passe est incorrect.',
        ])->onlyInput('email'); 
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
