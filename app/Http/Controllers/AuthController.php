<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
   
    public function register(Request $request)
    {
        sleep(1);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'rol' => 'usuario',
        ]);
        
        Auth::login($user);

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        sleep(1);
        $validated = $request->validate([
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);
        
        $user = User::create([

        ]);
        
        Auth::login($user);

        return redirect()->route('home');
    }
}
