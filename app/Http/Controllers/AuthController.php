<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Head;
use App\Models\Member;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Hash;
use Session;
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

    public function loginUser(Request $request){
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

          

            $user = User::where('email','=',$request->email)->first();
            if($user){
        
                if(hash::check($request->password,$user->password) )
                {
                    $request->session()->put('loginId',$user->id);
                    return redirect('dashboard');
                }
                else{
                    return back()->with('error','password incorrect');
                }
            }
            else{
                return back()->with('error','No such user found');
            }
    }

    public function dashboard(){
        $data = array();
        if(Session::has('loginId')){
            $user = User::where('id','=',session::get('loginId'))->first();
            $head = Head::all();
            $member = Member::all();
            $headcount = $head->count();
            $membercount = $member->count();
        }

        return view('dashboard',compact('user','headcount','membercount'));
    }

    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('/login')->with('error','You have been logged out');
        }
    }
}
