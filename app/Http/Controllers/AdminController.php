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
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Start with a new query builder instance
        $query = Head::query();

        // 1. Group the search filter if it exists
        if ($request->filled('search')) {
            $q = $request->input('search');
            $query->where(function ($subQuery) use ($q) {
                $subQuery->where('name', 'like', "%{$q}%")
                    ->orWhere('surname', 'like', "%{$q}%")
                    ->orWhere('mobile', 'like', "%{$q}%")
                    ->orWhere('city', 'like', "%{$q}%")
                    ->orWhere('state', 'like', "%{$q}%");
            });
        }


        $query->where('status', '1');


        if ($request->category == "created_at") {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->category == "updated_at") {
            $query->orderBy('updated_at', 'desc');
        } elseif ($request->category == "updated_at_asc") {
            $query->orderBy('updated_at', 'asc');
        } elseif ($request->category == "created_at_asc") {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('name', 'asc');
        }

        $heads = $query->paginate(3)->withQueryString();

        $totalMembers = Member::where('status','1')->count();


        if ($request->ajax()) {
            return view('admin.partials.index-search', compact('heads', 'totalMembers'));
        }


        return view("admin.index", compact("heads", 'totalMembers'));
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
        $heads = Head::find($id);
        $members = $heads->members;

        return view("admin.show", ["heads" => $heads, "members" => $members]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $head = Head::where('status','1')->find($id);

        $states = State::where('country_id', 101)->orderBy('name', 'asc')->get();

        // determine cities for the head's current state (head->state stores state name)
        $city = collect();
        if ($head && $head->state) {
            $selectedState = State::where('name', $head->state)->first();
            if ($selectedState) {
                $city = City::where('state_id', $selectedState->id)
                    ->orderBy('name', 'asc')
                    ->get();
            }
        }

        return view("admin.edit", [
            'head' => $head,
            'id' => $id,
            'states' => $states,
            'city' => $city
        ]);
    }

    public function print_pdf($id)
    {
        $heads = Head::find($id);

        ///home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/1757081895_WhatsApp Image 2025-04-02 at 11.24.38_5fb74118.jpg
        $pdf_path = $heads->photo_path;
        $pdf_actual_path = null;
        if ($pdf_path == null) {
            $pdf_actual_path = '/home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/noimage.png';
        } else {
            $pdf_actual_path = '/home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/' . $pdf_path;
        }

        $pdf = Pdf::loadView('pdf.head', compact('heads', 'pdf_actual_path'));
        $pdf->showImageErrors = true;
        $pdf->curlAllowUnsafeSslRequests = true;
        return $pdf->download($heads->name . '_head.pdf');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'birthdate' => ['required', 'date', 'before:' . Carbon::now()->subYears(21)->format('Y-m-d')],
            'mobile' => 'required|digits:10',
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


        $user = Head::find($id);

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

        // Delete existing hobbies
        $user->hobbies()->delete();

        // Add new hobbies
        foreach ($request->hobbies as $hobby) {
            $user->hobbies()->create([
                'head_id' => $user->id,
                'hobby_name' => $hobby,
            ]);
        }


        return redirect()->route('admin.index', ['id' => $user->id])->with('success', "Head Updated successfully.")->with('name', $user->name)->with('surname', $user->surname);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $head = Head::find($id);
        if ($head) {
            $head->delete();
            return redirect()->route('admin.index')->with('success', "Head deleted successfully.")->with('name', $head->name)->with('surname', $head->surname);
        }
    }
    public function delete(string $id)
    {
        $head = Head::find($id);
        if ($head) {
            $head->update(['status' => '9']);
            $head->members()->update(['status' => '9']);
            return redirect()->route('admin.index')->with('success', "Head deleted successfully.")->with('name', $head->name)->with('surname', $head->surname);
        }
    }

    // public function search(Request $request)
    // {
    //     $heads = Head::where('name', 'like', '%' . $request->search . '%')
    //         ->orWhere('surname', 'like', '%' . $request->search . '%')
    //         ->orWhere('mobile', 'like', '%' . $request->search . '%')
    //         ->orWhere('city', 'like', '%' . $request->search . '%')
    //         ->orWhere('state', 'like', '%' . $request->search . '%')
    //         ->paginate(3);

    //     $searchedHeadIds = Head::where('name', 'like', '%' . $request->search . '%')
    //         ->orWhere('surname', 'like', '%' . $request->search . '%')
    //         ->orWhere('mobile', 'like', '%' . $request->search . '%')
    //         ->orWhere('city', 'like', '%' . $request->search . '%')
    //         ->orWhere('state', 'like', '%' . $request->search . '%')
    //         ->pluck('id');

    //     $totalMembers = Member::whereIn('head_id', $searchedHeadIds)->count();

    //     if ($heads) {
    //         return view('admin.index', ['heads' => $heads, 'totalMembers' => $totalMembers]);
    //     }
    // }
}