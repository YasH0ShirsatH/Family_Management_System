<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
        return view("auth.login");
    }

    public function register(){
        return view("auth.register");
    }

    public function registerUser(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if($user->save()){
            return back()->with('success', 'Registration successful! You can now log in.');
        }
        else{
            return back()->with('error','User was not registered');
        }

        
    }
}
