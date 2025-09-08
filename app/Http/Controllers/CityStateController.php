<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use Illuminate\Validation\Rule;
class CityStateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = State::all();
        $cities = City::all();

        return view("state-city.index", compact("states","cities"));
    }
    public function cityindex(Request $request)
    {
        $search = $request->input('search');
            $cities = City::where('name', 'like', "%{$search}%")
                ->orWhere('id', 'like', '%' . $request->search . '%')
                ->orWhere('state_id', 'like', '%' . $request->search . '%')
                ->latest()
                ->paginate(perPage: 10);
        // Handle AJAX search requests
        if ( $request->ajax()) {
            return view("state-city.city", compact("cities"))->render();
        }
        
        // Handle standard GET requests and pagination
        if ($request->isMethod('get')) {
            // Handle search functionality for standard GET requests
            $query = City::query();

            if ($request->filled('search')) {
                $search = $request->input('search');
                $query->where('name', 'like', "%{$search}%");
            }

            $cities = $query->latest()->paginate(10)->withQueryString();

            return view("state-city.city", compact("cities"));
        }
    }

    public function stateindex(Request $request)
    {
        $city_count = City::all()->count();
        $state_count = State::all()->count();
        if ($request->has('search') && $request->isMethod('post')) {
            $states = State::where('name', 'LIKE', '%' . $request->search . '%') 
                    ->orWhere('type', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('level', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('id', 'LIKE', '%' . $request->search . '%')
                    ->latest()
                    ->paginate(8);
            return view("state-city.state", compact("states",'city_count','state_count'));
        } else if($request->isMethod('get')) {
            $states = State::latest()->paginate(8);
        return view("state-city.state", compact("states","city_count",'state_count'));
        }
    }

    public function editstate(Request $request,$id)
    {
        $state = State::find($id);
        return view('state-city.editstate', compact('state'));
    }
    public function updatestate(Request $request,$id)
    {
        $state = State::find($id);
        $request->validate([
            'name' => [
                'required',
                Rule::unique('states', 'name')->ignore($state->id),
            ],
            
        ]);

        
        $state->name = $request->name;
        $state->type = $request->type;
        $state->level = $request->level;
        $state->latitude = $request->latitude;
        $state->longitude = $request->longitude;
        $state->save();
        return redirect()->route('state.index')->with('success', 'State updated successfully.');
    }

    public function deletestate($id)
    {
        $state = State::find($id);
        $state->delete();
        return redirect()->route('state.index')->with('success', 'State deleted successfully.');
    }

    

    public function createCity(Request $request){
        $states  = State::all();
        // prefer query param, fall back to flashed session value
        $selectedStateId = $request->query('state_id') ?? session('selected_state_id');
        return view('state-city.addcity', ['states' => $states, 'selectedStateId' => $selectedStateId]);
    }

    public function storeCity(Request $request){
        $request->validate([
        'states' => 'required',
        'city' => 'required',
    ]);

    // Find the state
    $state = State::find($request->states);

    
    $city = $state->cities()->firstOrCreate(
        ['name' => $request->city], 
        ['state_id' => $state->state_id]  
    );
    
    if ($city->wasRecentlyCreated) {
        return redirect()->route('create.city')->with('success', 'City added successfully.');
    }

    return redirect()->route('create.city')->with('error', 'The city already exists for this state.');
    }

    public function createState(Request $request){
        
        return view('state-city.addstate');
    }

    public function storeState(Request $request)
    {
        $request->validate([
            'state' => 'required|string',
        ]);

        $states1 = State::firstOrCreate(['name' => $request->state]);

        if ($states1->wasRecentlyCreated) {
            // send the new state's id as query param and also flash to session
            return redirect()->route('create.city', ['state_id' => $states1->id])
                             ->with('success', 'State added successfully.')
                             ->with('selected_state_id', $states1->id);
        }

        return redirect()->route('create.state')->with('error', 'The State already exists.');
    }

    public function showcity(Request $request, $id)
{
    if ($request->isMethod('get')) {
        $city = City::where('state_id', $id)->paginate(20);
        $state = State::find($id);
        return view('state-city.showcityfromstates', ['city' => $city, 'state' => $state]);
    } else if ($request->isMethod('post')) {
        $state = State::find($id);

        $city = City::where('state_id', $id)
            ->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('id', 'LIKE', '%' . $request->search . '%');
            })
            ->paginate(20);

        return view('state-city.showcityfromstates', ['city' => $city, 'state' => $state]);
    }
}


    public function editcity(Request $request, $id)
    {
        $city = City::find($id);
        $states = State::all();
        return view('state-city.editcity', ['city'=>$city, 'states'=>$states]);
    }

    public function updatecity(Request $request,$id)
    {
        $city = City::find($id);
        $request->validate([
            'name' => [
                'required',
                Rule::unique('cities', 'name')->ignore($city->id),
            ],
        ]);

        
        $city->name = $request->name;
        $city->state_id = $request->state_id;
        $city->latitude = $request->latitude;
        $city->longitude = $request->longitude;
        $city->save();
        return redirect()->route('state.index')->with('success', 'City updated successfully.');
    }

    public function deletecity($id)
    {
        $city = City::find($id);
        $city->delete();
        return redirect()->route('city.index')->with('success', 'City deleted successfully.');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}