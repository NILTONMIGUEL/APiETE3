<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   public function loginView(){

        return view('login');
   }
   public function login(Request $request){

        $user = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($user)){
            $request->session()->regenerate();

            return redirect()->route('dashboard.retornarQtdComidas');
        }
        return back()->withErrors([
            'email' => 'E-mail ou senha inválidos.',
        ])->onlyInput('email');
   }
}
