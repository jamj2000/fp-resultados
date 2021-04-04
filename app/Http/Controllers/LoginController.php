<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller 
{

    public function show()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // validate
        $request->validate ([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

         
        $recuerdame   = ($request->has('recuerdame')) ? true : false;
        $credenciales = $request->only('email', 'password');

        // attempt to do the login
        if (Auth::attempt($credenciales, $recuerdame)) { 
            $request->session()->regenerate();

            // return redirect()->intended('/inicio');
            return redirect('/inicio');
        }
        else {        
            // validation not successful, send back to form 
            return redirect('/login');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();    
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        return redirect('/login'); 
    }

}
