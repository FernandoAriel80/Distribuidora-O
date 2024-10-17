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
            'role' => 'cliente',
        ]);
        
        Auth::login($user);
        return redirect()->route('home.index');
    }

    public function login(Request $request)
    {
        sleep(1);
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if(Auth::attempt($validated, $request->remember)){
            $request->session()->regenerate();
            return redirect()->route('home.index');
        }
     
        return back()->withErrors([
            'email' => 'Los datos no coinciden.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.index');
    }
}
