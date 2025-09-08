<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Head;
use App\Models\User;
use App\Models\Member;
use App\Models\Hobby;
use App\Models\City;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heads = Head::latest()->paginate('3');
        $totalMembers = Member::count();
        return view("admin.index", compact("heads",'totalMembers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $heads= Head::find($id);
        $members = $heads->members;
       
        return view("admin.show", ["heads"=>$heads, "members"=>$members]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $head = Head::find($id);
         $states = State::where('country_id',101)->orderBy('name','asc')->get();
        foreach ($states as $state) {
            $city = $state->cities = City::where('state_id', $state->id)->orderBy('name', 'asc')->get();
        }
        
        return view("admin.edit", ["head"=>$head,'id'=>$id,'states'=>$states,'city'=>$city]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'birthdate' => ['required','date','before:'. Carbon::now()->subYears(21)->format('Y-m-d')],
            'mobile' => 'required|digits:10',
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
        

        $user =  Head::find($id);

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
        
        // Delete existing hobbies
        $user->hobbies()->delete();
        
        // Add new hobbies
        foreach ($request->hobbies as $hobby){
            $user->hobbies()->create([
                'head_id'=> $user->id,
                'hobby_name' => $hobby,
            ]);
        }
        
        
        return redirect()->route('admin.index',['id'=>$user->id])->with('success', "Head Updated successfully.")->with('name',$user->name)->with( 'surname', $user->surname);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $head = Head::find($id);
        if($head){
            $head->delete();
            return redirect()->route('admin.index')->with('success', "Head deleted successfully.")->with('name', $head->name)->with('surname', $head->surname);
        }
    }

    public function search(Request $request){
        $heads = Head::where('name', 'like', '%' . $request->search . '%')
             ->orWhere('surname', 'like', '%' . $request->search . '%')
             ->orWhere('mobile', 'like', '%' . $request->search . '%')
             ->orWhere('city', 'like', '%' . $request->search . '%')
             ->orWhere('state', 'like', '%' . $request->search . '%')
             ->paginate(3);
        
        $searchedHeadIds = Head::where('name', 'like', '%' . $request->search . '%')
             ->orWhere('surname', 'like', '%' . $request->search . '%')
             ->orWhere('mobile', 'like', '%' . $request->search . '%')
             ->orWhere('city', 'like', '%' . $request->search . '%')
             ->orWhere('state', 'like', '%' . $request->search . '%')
             ->pluck('id');
        
        $totalMembers = Member::whereIn('head_id', $searchedHeadIds)->count();

        if($heads){
            return view('admin.index' ,['heads'=>$heads,'totalMembers'=>$totalMembers] );
        }
    }
}

    