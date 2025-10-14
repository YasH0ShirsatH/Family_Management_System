<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Session;
use App\Mail\SupportEmail;


class SupportController extends Controller
{
    public function showForm()
    {
        $admin1 = User::where('id', '=', session::get('loginId'))->first();

        return view('support',['admin1' => $admin1]);
    }

    public function about()
    {
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $admins = User::all();
        return view('about',['admin1' => $admin1,'admins' => $admins]);
    }

    public function sendSupport(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        if(Mail::to('suppportfms@gmail.com')
            ->send(new SupportEmail($request->all(), $request->subject , $request->fromName )))
{
        return back()->with('success', 'Your message has been sent successfully!');
        }
        else{
            return back()->with('error', 'Failed to send your message. Please try again later.');
        }
    }
}
