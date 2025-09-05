<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;

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
    public function cityindex()
    {
        
        $cities = City::orderBy('name','asc')->paginate(20);

        return view("state-city.city", compact("cities"));
    }
    public function stateindex()
    {
        $states = State::orderBy('name','asc')->paginate(20);

        return view("state-city.state", compact("states"));
    }

    public function createCity(Request $request){
        $states  = State::all();
        return view('state-city.addcity',['states'=>$states]);
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
        'state' => 'required|string', // 
    ]);
    
    
    $state = State::firstOrCreate(['name' => $request->state]);
    
    
    if ($state->wasRecentlyCreated) {
        return redirect()->route('create.state')->with('success', 'State added successfully.');
    }
    
    
    return redirect()->route('create.state')->with('error', 'The State already exists.');
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