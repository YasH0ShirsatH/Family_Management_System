<?php

namespace App\Http\Controllers;
use App\Models\Head;
use Illuminate\Http\Request;

class HeadController extends Controller
{
    public function post_data(Request $request){
        // $user = new Head();

        // $user->name = $request->name;
        // $user->surname = $request->surname; 
        // $user->birthdate = $request->birthdate;
        // $user->mobile = $request->mobile;
        // $user->address = $request->address;
        // $user->state = $request->state;
        // $user->city = $request->city;
        // $user->pincode = $request->pincode;
        // $user->marital_status = $request->marital_status;
        // $user->hobbies = $request->hobbies;
        
        $path = $request->file('path')->store('public');
        return $path;

        
    }
}
