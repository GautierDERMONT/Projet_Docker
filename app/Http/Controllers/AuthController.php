<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Afficher le formulaire de connexion
    public function loginFormulaire()
    {
        return view('login');
    }

    // Gérer la connexion
    public function login(Request $request)
    {
        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/');  // Redirection explicite après une connexion réussie
        }

        return back()->withErrors(['login' => 'Les identifiants sont incorrects.']);
    }

    // Gérer la déconnexion
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
