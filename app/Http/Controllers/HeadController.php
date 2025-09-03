<?php

namespace App\Http\Controllers;
use App\Models\Head;
use App\Models\Member;
use App\Models\Hobby;
use Illuminate\Http\Request;
use Carbon\Carbon;
class HeadController extends Controller
{
    public function post_data(Request $request){
        
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'birthdate' => ['required','date','before:'. Carbon::now()->subYears(21)->format('Y-m-d')],
            'mobile' => 'required|digits:10|unique:heads,mobile',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|digits:6',
            'marital_status' => 'required',
            'mariage_date' => 'required_if:marital_status,1',
            'hobbies' => 'required|min:1',
            'hobbies.*' => ['required','distinct','min:1','string'],
            'path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'birthdate.before' => 'You must be at least 21 years old to register.',
            'hobbies.required' => 'Please add at least one hobby.',
            'hobbies.*.required' => 'Each hobby field is required.',
            'hobbies.*.distinct' => 'Duplicate hobbies are not allowed.',
            'hobbies.*.min' => 'Each hobby must be at least 1 character long.',
            'hobbies.*.string' => 'Each hobby must be a valid string.',
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

        if($request->input('marital_status') == 1){
               $user->mariage_date = $request->mariage_date;
        }
        $file = $request->file('path');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move('uploads/images/', $filename);
        $user->photo_path = $filename;

        $user->save();
        foreach ($request->hobbies as $hobby){
            $user->hobbies()->create([
                'head_id'=> $user->id,
                'hobby_name' => $hobby,
            ]);
        }
        
        session(['head_submitted_' . $user->id => true]);
        return redirect()->route('familySection',['id'=>$user->id])->with('success', 'Head added successfully.');

        
    }

    public function familySection($id){
        $user = Head::find($id);
        if (!$user) {
            return redirect('/')->with('error', 'Head not found.');
        }
        $members = $user->members;
        return view('familySection',['id'=>$id,'members'=>$members,'users'=>$user]);
    }



    public function addMember(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'birthdate' => 'required|date',
            'marital_status' => 'required',
            'mariage_date' => 'required_if:marital_status,1',
            'photo_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = Head::find($id);
        if (!$user) {
            return back()->with('error', 'Head not found.');
        }

        $filename = null;
        if ($request->hasFile('photo_path')) {
            $file = $request->file('photo_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/uploads/images/'), $filename);
        }

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


    public function logoutMember(Request $request, $id){
        // Clear all session data
        $user = $request->session()->get('head_submitted_' . $id);
        if($user){
            session()->flush();
        }
        // Redirect to the homepage or login page
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}