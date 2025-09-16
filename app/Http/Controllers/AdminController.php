<?php

namespace App\Http\Controllers;

use App\Exports\HeadsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Head;
use App\Models\User;
use Illuminate\Validation\Rule;

use App\Models\Member;
use App\Models\Category;
use App\Models\Hobby;
use App\Models\City;
use App\Models\Logg;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Session;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Head::query();
        $admin1 = User::where('id', '=', session::get('loginId'))->first();

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
        $category1 = $request->category ?? 'name';

        if ($category1 == "created_at") {
            $query->orderBy('created_at', 'desc');
        } elseif ($category1 == "updated_at") {
            $query->orderBy('updated_at', 'desc');
        } elseif ($category1 == "updated_at_asc") {
            $query->orderBy('updated_at', 'asc');
        } elseif ($category1 == "created_at_asc") {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('name', 'asc');
        }

        $heads = $query->paginate(10)->withQueryString();
        $totalMembers = Member::where('status', '1')->count();

        if ($request->ajax()) {
            return view('admin.partials.index-search', compact('heads', 'totalMembers', 'admin1', 'category1'));
        }

        return view("admin.index", compact("heads", 'totalMembers', 'admin1', 'category1'));
    }

    public function print_all_pdf()
    {
        $heads = Head::where('status', '1')->get();

        ///home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/1757081895_WhatsApp Image 2025-04-02 at 11.24.38_5fb74118.jpg


        $pdf = Pdf::loadView('pdf.all', compact('heads'));
        $pdf->showImageErrors = true;
        $pdf->curlAllowUnsafeSslRequests = true;
        return $pdf->download('All_Family\'s_family.pdf');
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
        $admin1 = User::where('id', '=', session::get('loginId'))->first();


        return view("admin.show", ["heads" => $heads, "members" => $members, 'admin1' => $admin1]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $head = Head::where('status', '1')->find($id);
        $admin1 = User::where('id', '=', session::get('loginId'))->first();

        $states = State::where('country_id', 101)->orderBy('name', 'asc')->get();


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
            'city' => $city,
            'admin1' => $admin1
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
            $pdf_actual_path = '/home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/';
        }
        $pdf_actual_path = null;
        if ($pdf_path == null) {
            $pdf_actual_path = '/home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/noimage.png';
        } else {
            $pdf_actual_path = '/home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/' . $pdf_path;
        }

        $pdf = Pdf::loadView('pdf.head', compact('heads', 'pdf_actual_path'));
        $pdf->showImageErrors = true;
        $pdf->curlAllowUnsafeSslRequests = true;
        log::debug('Admin has downloaded pdf of head data at ' . Carbon::now());
        return $pdf->download($heads->name . '\'s_family.pdf');
    }

    /**
     * Update the specified resource in storage.
     */

    public function export()
    {
        log::debug('Admin has downloaded excel of head data at :' . Carbon::now());
        return Excel::download(new HeadsImport, 'heads.xlsx');
    }

    public function update(Request $request, string $id)
    {
        $user = Head::find($id);

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'birthdate' => ['required', 'date', 'before:' . Carbon::now()->subYears(21)->format('Y-m-d')],



            'mobile' => [
                'required',
                'digits:10',
                Rule::unique('heads', 'mobile')->ignore($user->id),
            ],

            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|digits:6',
            'marital_status' => 'required',
            'mariage_date' => 'required_if:marital_status,1',
            'hobbies' => 'required|min:1',
            'hobbies.*' => ['required', 'distinct', 'min:1', 'string'],
            'path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'birthdate.before' => 'You must be at least 21 years old to register.',
            'hobbies.required' => 'Please add at least one hobby.',
            'hobbies.*.required' => 'Each hobby field is required.',
            'hobbies.*.distinct' => 'Duplicate hobbies are not allowed.',
            'hobbies.*.min' => 'Each hobby must be at least 1 character long.',
            'hobbies.*.string' => 'Each hobby must be a valid string.',
            'path.image' => 'The uploaded file must be an image.',
            'path.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'path.max' => 'The image may not be greater than 2 MB.',

        ]);




        $admin1 = User::where('id', '=', session::get('loginId'))->first();

        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = 'Admin has Updated Head  (' . $user->name . ' ' . $user->surname . ')  Successfully : ' . Carbon::now();
        $log->save();
        log::debug('Admin has Updated Head  (' . $user->name . ' ' . $user->surname . ')  Successfully : ' . Carbon::now());

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

        $user->hobbies()->delete();


        foreach ($request->hobbies as $hobby) {
            $user->hobbies()->create([
                'head_id' => $user->id,
                'hobby_name' => $hobby,
            ]);
        }



        if ($request->path != null) {
            $file = $request->file('path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/images/', $filename);
            $user->photo_path = $filename;
            $user->save();
            return redirect()->route('admin.index', ['id' => $user->id])->with('success', "Head Updated With Image successfully.")->with('name', $user->name)->with('surname', $user->surname);
        }
        $user->save();






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

            $admin1 = User::where('id', '=', session::get('loginId'))->first();
            $log = new Logg();
            $log->user_id = $admin1->id;
            $log->logs = 'Admin Has Deleted (' . $head->name . ' ' . $head->surname . ') Successfully : ' . Carbon::now();
            $log->save();
            log::debug('Admin Has Deleted (' . $head->name . ' ' . $head->surname . ') Successfully : ' . Carbon::now());


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