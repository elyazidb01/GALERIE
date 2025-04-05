<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $valid_user = $request->validate([
            'name' => 'required|string|max:60',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|string|min:6'
        ]);

        User::create(
            [
                'name' => $valid_user['name'],
                'email' => $valid_user['email'],
                'password' => bcrypt($valid_user['password'])
            ]
        );
        return redirect()->route('auth.login');
    }

    public function login()
    {
        return view('users.login');
    }
    public function verifLogin(Request $request)
    {
        // Validation des données
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        

        // Authentification
        if (Auth::attempt($request->only('email', 'password'))) {
            // Récupération de l'utilisateur authentifié
            $user = Auth::user();
            // Stocker les informations dans la session
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'authentification' => true,
                'login_time' => now(), // Heure actuelle
                'browser' => $request->header('User-Agent'), // Navigateur utilisé
                'ip_address' => $request->ip(), // Adresse IP
            ]);

            // Redirection après succès
            return redirect()->route('photos.create');
        } else {
            // Gestion des échecs d'authentification
            session(['authentification' => false]);

            // Redirection avec message d'erreur
            return redirect()->route('auth.login')->withErrors([
                'error_login' => 'Login ou mot de passe incorrect.',
            ]);
        }
    }
    //----------------------logout----------------------
    public function logout(Request $request)
    {
        // Supprimer les variables spécifiques de la session
        $request->session()->forget(['user_id', 'user_name', 'authentification', 'login_time', 'browser', 'ip_address']);

        // Supprimer toutes les données de la session si nécessaire
        $request->session()->invalidate();

        // Déconnecter l'utilisateur avec Auth
        Auth::logout();

        // Rediriger vers la page de connexion
        return redirect()->route('auth.login')->with('logout_message', 'Vous êtes déconnecté avec succès.');

    }
}
