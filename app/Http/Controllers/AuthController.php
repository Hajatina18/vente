<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function check_login(Request $request)
    {
        $user = $request->only('username', 'password');
        if(Auth::attempt($user)){
            $userLogged = Auth::user();
            if($userLogged->is_admin == 1){
                return redirect()->intended('admin');
            }
            return redirect()->intended('/');
        }
        return redirect('login')->with('error', 'Adresse mail ou mot de passe incorrect');
    }
}
