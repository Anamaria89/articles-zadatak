<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    
    
    public function login(){
        
        
        if(request()->isMethod('post')){
            // validacija forme
            request()->validate([
                'name' => 'required|string',
                'email' => 'required|string|email',
                'password' => 'required'
            ]);
            // proba logovanja
            if(Auth::attempt([
                'name' => request('name'),
                'email' => request('email'),
                'password' => request('password'),
                
            ])){
                // TRUE - redirect na welcome ili tamo gde je hteo da ode ranije
                return redirect()->intended( route('index') );
            }else{ 
                // FALSE - redirect back sa greskom da je los email ili lozinka
                return redirect( route('login') )
                        ->withErrors(['email' => trans('auth.failed')])
                        ->withInput(['email' => request('email')]);
            }
        }

        
        return view('users.login');
    }
    
    public function logout(){
        // uradi logout
        Auth::logout();
        
        // nakon toga uradi redirect tamo gde zeli vlasnik portala
        return redirect()->route('login')->withErrors(['message' => 'Thank you, come again!!!']);
    }
}
