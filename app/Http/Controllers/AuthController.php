<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function register(Request $request)
    {
        sleep(1);

        $filds = $request->validate([
            'name' =>['required', 'max:255'],
            'email' => ['required', 'email','max:255','unique:user'],
            'password' => ['required', 'conformed']
        ]);

        //register

        $user = User::create($filds);
        
        Auth::login($user);
        
        return redirect()->route('home');
    }

}
