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
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
class HeadController extends Controller
{
    //Add Constructor here
    public function headview()
    {

        $states = State::where('status', '1')->where('country_id', 101)->orderBy('name', 'asc')->get();
        foreach ($states as $state) {
            $city = City::where('status','1')->where('state_id', $state->id)->orderBy('name', 'asc')->get();
        }
        return view('head', compact('states', 'city'));

    }

    public function dashboard()
    {
        $head = Head::where('status', '1')->get();
        $member = Member::where('status', '1')->get();

        $user = User::where('status', '1')->get();
        $headcount = $head->count();
        $membercount = $member->count();

        $usercount = $user->count();
        return view('userDashboard', ['headcount' => $headcount, 'membercount' => $membercount, 'usercount' => $usercount]);
    }


    public function post_data(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'birthdate' => ['required', 'date', 'before:' . Carbon::now()->setTimezone('Asia/Kolkata')->subYears(21)->format('Y-m-d')],
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
        $submission_key = 'head_submitted_' . $user->id;
        session([$submission_key => true]);
        Log::debug('User Added Head (' . $request->name . ' ' . $request->surname . ') To the Database Successfully on : ' . Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A'));
        return redirect()->route('familySection', ['id' => $user->id])->with('success', 'Head added successfully.');



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
                'relation' => 'required',
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
            'relation' => $request->relation,
            'mariage_date' => $request->marital_status == 1 ? $request->mariage_date : null,
            'education' => $request->education,
            'photo_path' => $filename,
        ]);
        log::debug('User (' . $user->name . ' ' . $user->surname . ') Added Member (' . $request->name . ') To the Database Successfully on :' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A'));
        return back()->with('success', 'Member added successfully.');
    }


    public function getCities($stateId)
    {
        $state = State::where('name', $stateId)->first();
        if ($state) {
            $cities = City::where('state_id', $state->id)->where('status', '1')->get();
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
        $user2 = Head::find($id);
        // Redirect to the homepage or login page
        log::debug('User (' . $user2->name . ' ' . $user2->surname . ') Logged Out Successfully on : ' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A'));
        return redirect('/')->with('success', 'You\'ve successfully added the head and members of the heads family..');
    }

    public function familyRegistration()
    {
        $states = State::where('status', '1')->where('country_id', 101)->orderBy('name', 'asc')->get();
        return view('family-registration', compact('states'));
    }

    public function storeWithFamily(Request $request)
    {
    try{
    DB::beginTransaction();


        $request->validate([
            'head_name' => 'required|min:3',
            'head_surname' => 'required|min:3',
            'head_birthdate' => ['required', 'date', 'before:' . Carbon::now()->subYears(21)->format('Y-m-d')],
            'head_mobile' => 'required|digits:10|unique:heads,mobile',
            'head_address' => 'required',
            'head_state' => 'required',
            'head_city' => 'required',
            'head_pincode' => 'required|digits:6',
            'head_marital_status' => 'required',
            'head_mariage_date' => 'required_if:head_marital_status,1',
            'head_hobbies' => 'required|array|min:1',
            'head_hobbies.*' => ['required', 'distinct', 'min:1', 'string'],
            'head_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'members.*.name' => 'required|string',
            'members.*.birthdate' => 'required|date',
            'members.*.marital_status' => 'required',
            'members.*.relation' => 'required',
            'members.*.mariage_date' => 'required_if:members.*.marital_status,1',
            'members.*.photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'head_birthdate.before' => 'Head must be at least 21 years old.',
            'head_hobbies.required' => 'Please add at least one hobby.',
            'head_hobbies.*.required' => 'Each hobby field is required.',
            'head_hobbies.*.distinct' => 'Duplicate hobbies are not allowed.',
        ]);

        // Create Head
        $head = new Head();
        $head->name = $request->head_name;
        $head->surname = $request->head_surname;
        $head->birthdate = $request->head_birthdate;
        $head->mobile = $request->head_mobile;
        $head->address = $request->head_address;
        $head->state = $request->head_state;
        $head->city = $request->head_city;
        $head->pincode = $request->head_pincode;
        $head->marital_status = $request->head_marital_status;
        $head->full_name = $request->head_name . ' ' . $request->head_surname;

        if ($request->head_marital_status == 1) {
            $head->mariage_date = $request->head_mariage_date;
        }

        // Handle head photo
        if ($request->hasFile('head_photo')) {
            $file = $request->file('head_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/images/', $filename);
            $head->photo_path = $filename;
        }

        $head->save();

        // Create hobbies
        foreach ($request->head_hobbies as $hobby) {
            $head->hobbies()->create([
                'head_id' => $head->id,
                'hobby_name' => $hobby,
            ]);
        }

        // Create members if any
        if ($request->has('members')) {
            foreach ($request->members as $memberData) {
                $filename = null;
                if (isset($memberData['photo']) && $memberData['photo']) {
                    $file = $memberData['photo'];
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move('uploads/images/', $filename);
                }

                $head->members()->create([
                    'name' => $memberData['name'],
                    'birthdate' => $memberData['birthdate'],
                    'marital_status' => $memberData['marital_status'],
                    'relation' => $memberData['relation'],
                    'mariage_date' => $memberData['marital_status'] == 1 ? $memberData['mariage_date'] : null,
                    'education' => $memberData['education'] ?? null,
                    'photo_path' => $filename ?? null,
                ]);
            }
        }
        DB::commit();

        Log::debug('Complete family registered: Head (' . $request->head_name . ' ' . $request->head_surname . ') with ' . count($request->members ?? []) . ' members on: ' . Carbon::now()->setTimezone('Asia/Kolkata'));

        return redirect('/')->with('success', 'Complete family registered successfully! Head: ' . $request->head_name . ' ' . $request->head_surname);
        } catch (ValidationException $e) {
              DB::rollBack();
              $firstError = collect($e->errors())->flatten()->first();
              Log::error('Error during family registration: ' . $firstError);
              return back()->with('error', $firstError);
          }

    }

}
