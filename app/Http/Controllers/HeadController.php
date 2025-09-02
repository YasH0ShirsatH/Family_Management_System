<?php

namespace App\Http\Controllers;
use App\Models\Head;
use App\Models\Member;
use Illuminate\Http\Request;

class HeadController extends Controller
{
    public function post_data(Request $request){
        
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'birthdate' => 'required|date',
            'mobile' => 'required|digits:10|unique:heads,mobile',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|digits:6',
            'marital_status' => 'required',
            'mariage_date' => 'required_if:marital_status,1',
            'hobbies' => 'required',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        

        


        $user = new Head();

        $user->name = $request->name;
        $user->surname = $request->surname; 
        $user->birthdate = $request->birthdate;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->pincode = $request->pincode;
        $user->marital_status = $request->marital_status;
        $user->hobbies = $request->hobbies;
        if($request->input('marital_status') == 1){
               $user->mariage_date = $request->mariage_date;
        }
        $file = $request->file('path');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move('uploads/images/', $filename);
        $user->photo_path = $filename;

        $user->save();
        return redirect()->route('familySection',['id'=>$user->id])->with('success', 'Head added successfully.');

        
    }

    public function familySection($id){
        $user = Head::find($id);
        $members = $user->members;
        return view('familySection',['id'=>$id,'members'=>$members,'users'=>$user]);
    }



    public function addMember(Request $request,$id){
        
        $request->validate([
            'name' => 'required',
            'birthdate' => 'required|date',

            'marital_status' => 'required',
            'mariage_date' => 'required_if:marital_status,1',
            'photo_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = Head::find($id);
        if (!$user) {
            return back()->with('error', 'Head not found.');
        }

        $file = $request->file('photo_path');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('/uploads/images/'), $filename);
        
        $user->members()->create([
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'marital_status' => $request->marital_status,
            'mariage_date' => $request->marital_status == 1 ? $request->mariage_date : null,
            'education' => $request->education,
            'photo_path' => $filename,
        ]);
        
        return back()->with('success', 'Member added successfully.');
}
}
