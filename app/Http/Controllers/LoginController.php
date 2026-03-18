<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\Category;

class LoginController extends Controller
{
    public function showLoginForm() {
        $categories = Category::all();
        return view('auth.login', compact('categories'));
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redirection forcée vers le dashboard pour tester
            return redirect()->intended(route('home')); // Redirige vers la page demandée avant login (ex: contact) ou home
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

    // --- INSCRIPTION ---

    public function showRegisterForm()
    {
        $categories = Category::all();
        return view('auth.register', compact('categories'));
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    // --- GOOGLE AUTH ---

    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        try {

            /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
            $driver = Socialite::driver('google');
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Création du compte si inexistant
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(16)) // Mot de passe aléatoire
                ]);
            } else {
                // Mise à jour du google_id si le compte existait déjà par email
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
            }

            Auth::login($user);
            return redirect()->intended(route('home'));

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Erreur de connexion avec Google.']);
        }
    }
}
