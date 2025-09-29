<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use App\Models\Head;
use App\Models\Member;
use Illuminate\Validation\Rule;
use Session;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Logg;
class CityStateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = State::where('status', '1');
        $cities = City::where('status', '1');
        $admin1 = User::where('id', '=', session::get('loginId'))->first();

        return view("state-city.index", compact("states", "cities", 'admin1'));
    }
    public function cityindex(Request $request)
    {
        // build base query
        $query = City::query();
        $city_count = City::where('status', '1')->count();
        $state_count = State::where('status', '1')->count();
        $admin1 = User::where('id', '=', session::get('loginId'))->first();

        if ($request->filled('search')) {
            $q = $request->input('search');
            $query->where(function ($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                    ->orWhere('id', 'like', "{$q}")
                    ->orWhere('state_new_id', 'like', "{$q}");
            });
        }
        $query->where('status', '1');


        //  preserve query-string
        $cities = $query->latest()->paginate(10)->withQueryString();

        // for AJAX return a partial
        if ($request->ajax()) {
            return view('state-city.partials.city-list', compact('cities', 'admin1','city_count','state_count'));
        }

        // normal full page render
        return view('state-city.city', compact('cities', 'admin1','city_count','state_count'));
    }

    public function stateindex(Request $request)
    {
        $city_count = City::where('status', '1')->count();
        $state_count = State::where('status', '1')->count();
        $admin1 = User::where('id', '=', session::get('loginId'))->first();

        $query = State::query();

        if ($request->filled('search')) {
            $q = $request->input('search');
            $query->where(function ($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                    ->orWhere('id', 'like', "{$q}")
                    ->orWhere('type', 'like', "{$q}");
            });
        }
        $query->where('status', '1');

        //  preserve query-string
        $states = $query->latest()->orderBy('name', 'asc')->paginate(8)->withQueryString();

        // for AJAX return a partial
        if ($request->ajax()) {
            return view('state-city.partials.state-list', compact('states', 'city_count', 'state_count', 'admin1'));
        }

        // normal full page render
        return view('state-city.state', compact('states', 'city_count', 'state_count', 'admin1'));
    }



    public function showcity(Request $request, $id)
    {
        $admin1 = User::where('id', '=', session::get('loginId'))->first();

        $state = State::findOrFail($id);

        $city = City::where('state_id', $id)->where('status', '1')
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->paginate(10)
            ->withQueryString();

        if ($request->ajax()) {
            return view('state-city.partials.show-state-list', compact('city', 'state', 'admin1',''))->render();
        }

        return view('state-city.showcityfromstates', compact('city', 'state', 'admin1'));
    }








    public function editstate(Request $request, $id)
    {
        $state = State::where('status', '1')->find($id);
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        return view('state-city.editstate', compact('state', 'admin1'));
    }
    public function updatestate(Request $request, $id)
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


        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = 'Admin has Updated State  to (' . $state->name . ') Successfully on :' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
        $log->save();
        log::debug('State Updated to (' . $state->name . ') Successfully at :' . Carbon::now()->setTimezone('Asia/Kolkata'));

        return redirect()->route('state.index')->with('success', 'State updated successfully.');
    }

    public function deletestate($id)
    {
        $state = State::find($id);
        $state->update(['status' => '9']);
        $state->cities()->update(['status' => '9']);
        $head = Head::all();
        $heads = Head::where('state', $state->name)->get();
                    foreach ($heads as $head) {
                        $head->update(['status' => '0']);
                        $head->members()->where('status','1')->update(['status' => '0']);
                    }

        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = 'Admin Deleted State (' . $state->name . ') Successfully on :' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
        $log->save();
        log::debug('Admin Deleted State (' . $state->name . ') Successfully at :' . Carbon::now()->setTimezone('Asia/Kolkata'));

        return redirect()->route('state.index')->with('success', 'State deleted successfully, with heads and members.');
    }



    public function createCity(Request $request)
    {
        $states = State::all();
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        // prefer query param, fall back to flashed session value
        $selectedStateId = $request->query('state_id') ?? session('selected_state_id');
        return view('state-city.addcity', ['states' => $states, 'selectedStateId' => $selectedStateId, 'admin1' => $admin1]);
    }
    public function storeCity(Request $request)
    {
        $request->validate([
            'states' => 'required',
            'city' => 'required',
        ]);


        $state = State::findOrFail($request->states);


        $city = City::firstOrCreate(
            ['name' => $request->city, 'state_id' => $state->id, 'state_new_id' => 'SID'.$state->id]
        );


        if ($city->wasRecentlyCreated) {
            $admin1 = User::where('id', '=', session::get('loginId'))->first();
            $log = new Logg();
            $log->user_id = $admin1->id;
            $log->logs = 'City (' . $city->name . ') Added to (' . $state->name . ') Successfully on :' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
            $log->save();
            log::debug('City (' . $city->name . ') Added to (' . $state->name . ') Successfully on :' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A'));
            return redirect()->route('create.city', ['state_id' => $state->id])
                ->with('success', 'City added successfully.');
        }

        return redirect()->route('create.city', ['state_id' => $state->id])
            ->with('error', 'The city already exists for this state.');
    }

    public function createState(Request $request)
    {
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        return view('state-city.addstate', compact('admin1'));
    }

    public function storeState(Request $request)
    {
        $request->validate([
            'state' => 'required|string',
        ]);

        $states1 = State::firstOrCreate(
            ['name' => $request->state],
            [
                'type' => $request->type,
                'level' => $request->level,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'status' => '1'
            ]
        );

        if ($states1->wasRecentlyCreated) {
            $admin1 = User::where('id', '=', session::get('loginId'))->first();
            $log = new Logg();
            $log->user_id = $admin1->id;
            $log->logs = 'Admin Added State (' . $states1->name . ')  Successfully on :' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
            $log->save();
            log::debug('State (' . $states1->name . ') Added Successfully on :' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A'));
            return redirect()->route('create.city', ['state_id' => $states1->id])
                ->with('success', 'State added successfully.');



        }

        return redirect()->route('create.state')->with('error', 'The State already exists.');
    }



    public function createViaShowCity(Request $request, $id)
    {
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $states = State::all();
        $states1 = $id;

        return redirect()->route('create.city', ['state_id' => $states1]);

    }


    public function editcity(Request $request, $id)
    {
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $city = City::where('status', '1')->find($id);
        $states = State::where('status', '1')->get();
        return view('state-city.editcity', ['city' => $city, 'states' => $states, 'admin1' => $admin1]);
    }

    public function updatecity(Request $request, $id)
    {
        $city = City::find($id);

        $request->validate([
            'name' => [
                'required',

                Rule::unique('cities', 'name')->where(function ($query) use ($city) {
                    return $query->where('state_id', $city->state->id);
                })->ignore($city->id),
            ],
        ]);


        $city->name = $request->name;
        $city->state_id = $request->state_id;
        $city->latitude = $request->latitude;
        $city->longitude = $request->longitude;
        $city->save();

        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = 'Admin  Updated City to (' . $city->name . ') Successfully on :' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
        $log->save();
        log::debug('City Updated to (' . $city->name . ') Successfully at :' . Carbon::now()->setTimezone('Asia/Kolkata'));


        return redirect()->route('city.index')->with('success', 'City updated successfully.');
    }

    public function deletecity($id)
    {
        $city = City::find($id);
        $city->update(['status' => '9']);
        $head = Head::all();
        $heads = Head::where('city', $city->name)->get();
            foreach ($heads as $head) {
                $head->update(['status' => '0']);
                $head->members()->where('status','1')->update(['status' => '0']);
            }


        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = 'Admin Deleted City (' . $city->name . ') Successfully on :' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
        $log->save();
        log::debug('City (' . $city->name . ') Deleted Successfully at :' . Carbon::now()->setTimezone('Asia/Kolkata'));
        return redirect()->back()->with('success', 'City deleted successfully.');
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
