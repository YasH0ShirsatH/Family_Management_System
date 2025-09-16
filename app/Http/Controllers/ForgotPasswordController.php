<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Password_reset;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Logg;
class ForgotPasswordController extends Controller
{
    public function forgotPassword() {
        return view('auth.forgot-password');
    }
    public function forgotPasswordPost(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(64);
        $forgot_pass = new Password_reset();
        $forgot_pass->email = $request->email;
        $forgot_pass->token = $token;
        $forgot_pass->created_at = now();
        $forgot_pass->save();

        Mail::send('mail.forgot-password',['token'=>$token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
    
        return back()->with('success', 'A password reset link has been sent to your email address.');
    }


    public function resetPassword($token){
        return view('auth.reset-password',compact('token')); 
    }

    public function resetPasswordPost(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
            'cpassword' => 'required|same:password',
        ]);

        $updatePassword = Password_reset::where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();
        
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }
        

        User::where('email', $request->email)->update(['password' => bcrypt($request->password)]);
        Password_reset::where(['email'=> $request->email])->delete();


        $admin1 = User::where('email', '=', $request->email)->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = $request->email.' =>  password changed Successfully';
        log::debug($request->email.' =>  password changed Successfully');



        return redirect('/login')->with('success', 'Your password has been changed!');
    }
}
