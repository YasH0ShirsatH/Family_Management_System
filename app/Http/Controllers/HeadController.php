<?php

namespace App\Http\Controllers;
use App\Models\Head;
use App\Models\Member;
use App\Models\Hobby;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class HeadController extends Controller
{
    public function headview()
    {
        
            $states = State::where('country_id', 101)->orderBy('name', 'asc')->get();
            foreach ($states as $state) {
                $city = City::where('state_id', $state->id)->orderBy('name', 'asc')->get();
            }
            return view('head', compact('states', 'city'));
         
    }

    public function dashboard()
    {
        $head = Head::where('status','1')->get();
        $member = Member::where('status','1')->get();

        $user = User::where('status','1')->get();
        $headcount = $head->count();
        $membercount = $member->count();

        $usercount = $user->count();
        return view('userDashboard', ['headcount' => $headcount, 'membercount' => $membercount, 'usercount' => $usercount]);
    }


    public function post_data(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required',
                'surname' => 'required',
                'birthdate' => ['required', 'date', 'before:' . Carbon::now()->subYears(21)->format('Y-m-d')],
                'mobile' => 'required|digits:10|unique:heads,mobile',
                'address' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required|digits:6',
                'marital_status' => 'required',
                'mariage_date' => 'required_if:marital_status,1',
                'hobbies' => 'required|array|min:1',
                'hobbies.*' => ['required', 'distinct', 'min:1', 'string'],
                'path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
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

            if ($request->input('marital_status') == 1) {
                $user->mariage_date = $request->mariage_date;
            }
            $file = $request->file('path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/images/', $filename);
            $user->photo_path = $filename;

            $user->save();
            foreach ($request->hobbies as $hobby) {
                $user->hobbies()->create([
                    'head_id' => $user->id,
                    'hobby_name' => $hobby,
                ]);
            }
            $submission_key = 'head_submitted_' . $user->id ;
            session([ $submission_key=> true]);
            Log::debug('User Added Head To the Database Successfully');
            return redirect()->route('familySection', ['id' => $user->id])->with('success', 'Head added successfully.');
        }
        catch (\Exception $e) {
            Log::debug('User Couldn\'t Add Head Section');
            $request->validate([
                'name' => 'required',
                'surname' => 'required',
                'birthdate' => ['required', 'date', 'before:' . Carbon::now()->subYears(21)->format('Y-m-d')],
                'mobile' => 'required|digits:10|unique:heads,mobile',
                'address' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required|digits:6',
                'marital_status' => 'required',
                'mariage_date' => 'required_if:marital_status,1',
                'hobbies' => 'required|min:1',
                'hobbies.*' => ['required', 'distinct', 'min:1', 'string'],
                'path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'birthdate.before' => 'You must be at least 21 years old to register.',
                'hobbies.required' => 'Please add at least one hobby.',
                'hobbies.*.required' => 'Each hobby field is required.',
                'hobbies.*.distinct' => 'Duplicate hobbies are not allowed.',
                'hobbies.*.min' => 'Each hobby must be at least 1 character long.',
                'hobbies.*.string' => 'Each hobby must be a valid string.',
            ]);
            

            return redirect()->back();
        }


    }

    public function familySection($id)
    {
        $user = Head::find($id);
        if (!$user) {
            return redirect('/')->with('error', 'Head not found.');
        }
        $members = $user->members;
        return view('familySection', ['id' => $id, 'members' => $members, 'users' => $user]);
    }



    public function addMember(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'birthdate' => 'required|date',
                'marital_status' => 'required',
                'mariage_date' => 'required_if:marital_status,1',
                'photo_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
            ,
            [
                'mariage_date.required_if' => 'The marriage date field is required when marital status is married.',
            ]
        );
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


    public function getCities($stateId)
    {
        $state = State::where('name', $stateId)->first();
        if ($state) {
            $cities = City::where('state_id', $state->id)->get();
            return response()->json($cities);

        }

        return response()->json([]);
    }

    public function logoutMember(Request $request, $id)
    {
        // Clear all session data
        $submission_key = 'head_submitted_' . $id;
        $head = $request->session()->get($submission_key);
        if ($head) {
            session()->forget($submission_key);
        }
        // Redirect to the homepage or login page
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}