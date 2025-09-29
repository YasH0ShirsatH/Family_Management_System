<?php

namespace App\Http\Controllers;

use App\Exports\HeadsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Head;
use App\Models\User;
use Illuminate\Validation\Rule;
use Storage;
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
        $states = State::where('status','1')->get();
        $admin1 = User::where('id', '=', session::get('loginId'))->first();

        if ($request->filled('search')) {
            $q = $request->input('search');
            $query->where(function ($subQuery) use ($q) {
                $subQuery
                    ->where('name', 'like', "%{$q}%")
                    ->orWhere('surname', 'like', "%{$q}%")
                    ->orWhere('mobile', 'like', "%{$q}%")
                    ->orWhere('city', 'like', "%{$q}%")
                    ->orWhere('state', 'like', "%{$q}%");
            });
        }

        $query->whereIn('status', ['1','0']);
        $category1 = $request->category ?? 'created_at';

        if ($category1 == "name") {
            $query->orderBy('name', 'asc');
        } elseif ($category1 == "updated_at") {
            $query->orderBy('updated_at', 'desc');
        } elseif ($category1 == "updated_at_asc") {
            $query->orderBy('updated_at', 'asc');
        } elseif ($category1 == "created_at_asc") {
            $query->orderBy('created_at', 'asc');
        } elseif ($category1 == "alphabetically") {
            $query->orderBy('name', 'asc');
        }elseif ($category1 == "inactive_asc") {
            $query->where('status','0')->orderBy('updated_at', 'asc');
        }elseif ($category1 == "inactive_desc") {
            $query->where('status','0')->orderBy('updated_at', 'desc');
        }
        else {
            $query->orderBy('created_at', 'desc');
        }


        $heads = $query->paginate(10)->withQueryString();
        $totalMembers = Member::whereIn('status', ['1','0'])->count();

        if ($request->ajax()) {
            return view('admin.partials.index-search', compact('heads', 'totalMembers','states', 'admin1', 'category1'));
        }

        return view("admin.index", compact("heads", 'totalMembers', 'admin1','states', 'category1'));
    }

    public function allMembers(Request $request)
    {
        $query = Member::with('head')->whereIn('status', ['0','1'])
            ->whereHas('head', function($q) {
                $q->whereIn('status', ['0','1']);
            });
        $admin1 = User::where('id', '=', session::get('loginId'))->first();

        // Search functionality
        if ($request->filled('search')) {
            $q = $request->input('search');
            $query->where(function ($subQuery) use ($q) {
                $subQuery->where('members.name', 'like', "%{$q}%")
                    ->orWhere('members.education', 'like', "%{$q}%")
                    ->orWhere('members.marital_status', 'like', "%{$q}%")
                    ->orWhereHas('head', function($headQuery) use ($q) {
                        $headQuery->where('name', 'like', "%{$q}%")
                            ->orWhere('surname', 'like', "%{$q}%")
                            ->orWhere('city', 'like', "%{$q}%")
                            ->orWhere('state', 'like', "%{$q}%");
                    });
            });
        }

        // Sorting functionality
        $category1 = $request->category ?? 'created_at';
        if ($category1 == "name") {
            $query->orderBy('members.name', 'asc');
        } elseif ($category1 == "updated_at") {
            $query->orderBy('members.updated_at', 'desc');
        } elseif ($category1 == "updated_at_asc") {
            $query->orderBy('members.updated_at', 'asc');
        } elseif ($category1 == "created_at_asc") {
            $query->orderBy('members.created_at', 'asc');
        } elseif ($category1 == "birthdate") {
            $query->orderBy('members.birthdate', 'desc');
        } elseif ($category1 == "birthdate_asc") {
            $query->orderBy('members.birthdate', 'asc');
        } elseif ($category1 == "inactive") {
            $query->where('status','0')->orderBy('members.status', 'asc');
        } elseif ($category1 == "alphabetically") {
            $query->orderBy('members.name', 'asc');
        } else {
            $query->orderBy('members.created_at', 'desc');
        }

        $members = $query->paginate(10)->withQueryString();
        $totalMembers = Member::whereIn('status', ['1','0'])->count();

        // Return partial view for AJAX requests
        if ($request->ajax()) {
            return view('admin.partials.member-search', compact('members', 'totalMembers', 'admin1', 'category1'));
        }

        return view('admin.members', compact('members', 'admin1', 'totalMembers', 'category1'));
    }

public function viewMemberDetails($id)
    {
        $members = Member::with('head')->whereIn('status',['0','1'])
            ->whereHas('head', function($q) {
                $q->whereIn('status', ['0','1']);
            })->find($id);
        $admin1 = User::where('id', '=', session::get('loginId'))->first();

        return view("admin.member_profile", ["members" => $members, 'admin1' => $admin1]);
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

    public function print_search_pdf(Request $request)
    {
        $query = Head::query();

        if ($request->filled('search')) {
            $q = $request->input('search');
            $query->where(function ($subQuery) use ($q) {
                $subQuery
                    ->where('name', 'like', "%{$q}%")
                    ->orWhere('surname', 'like', "%{$q}%")
                    ->orWhere('mobile', 'like', "%{$q}%")
                    ->orWhere('city', 'like', "%{$q}%")
                    ->orWhere('state', 'like', "%{$q}%");
            });
        }

        $query->whereIn('status', ['1','0']);
        $category1 = $request->category ?? 'created_at';

        if ($category1 == "created_at") {
            $query->orderBy('created_at', 'desc');
        } elseif ($category1 == "updated_at") {
            $query->orderBy('updated_at', 'desc');
        } elseif ($category1 == "updated_at_asc") {
            $query->orderBy('updated_at', 'asc');
        } elseif ($category1 == "created_at_asc") {
            $query->orderBy('created_at', 'asc');
        } elseif ($category1 == "alphabetically") {
            $query->orderBy('name', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $heads = $query->get();
        $pdf = Pdf::loadView('pdf.all', compact('heads'));
        $pdf->showImageErrors = true;
        $pdf->curlAllowUnsafeSslRequests = true;
        return $pdf->download('Search_Results.pdf');
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
        return redirect()->route('admin.fullEdit', $id);
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
        log::debug('Admin has downloaded pdf of head data at ' . Carbon::now()->format('l, F jS, Y \a\t h:i A'));
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
            'hobbies' => 'required|array|min:1',
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
        $log->logs = 'Admin has Updated Head  (' . $user->name . ' ' . $user->surname . ')  Successfully on ' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
        $log->save();
        log::debug('Admin has Updated Head  (' . $user->name . ' ' . $user->surname . ')  Successfully : ' . Carbon::now()->setTimezone('Asia/Kolkata'));

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
    public function delete(Request $request,string $id)
    {
        $head = Head::find($id);
        if ($head) {

            if ($head->photo_path && file_exists(public_path('uploads/images/' . $head->photo_path))) {
                unlink(public_path('uploads/images/' . $head->photo_path));
            }


            $members = $head->members()->where('status','1')->get();
            foreach ($members as $member) {
                if ($member->photo_path && file_exists(public_path('uploads/images/' . $member->photo_path))) {
                    unlink(public_path('uploads/images/' . $member->photo_path));
                }
            }


             if ($request->ajax()) {
                         $head->update(['status' => '9']);
                         $head->members()->where('status','1')->update(['status' => '0']);
                        return response()->json([
                            'status' => 'success',
                            'message' => 'Head deleted successfully.',
                            'redirect' => route('admin.index'),
                            'name' => $head->name,
                            'surname' => $head->surname
                        ]);
                    }

            $head->update(['status' => '9']);
            $head->members()->where('status','1')->update(['status' => '0']);

            $admin1 = User::where('id', '=', session::get('loginId'))->first();
            $log = new Logg();
            $log->user_id = $admin1->id;
            $log->logs = 'Admin Has Deleted Head  (' . ucfirst($head->name) . ' ' . ucfirst($head->surname) . ') Successfully ' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
            $log->save();
            log::debug('Admin Has Deleted (' . $head->name . ' ' . $head->surname . ') Successfully on ' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A'));

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

    public function fullEdit(string $id)
    {
        $head = Head::with(['members' => function($query) {
            $query->where('status', '1');
        }, 'hobbies'])->where('status', '1')->find($id);
        $states = State::where('status','1')->get();

        $headstatus = Head::where('id', $id)->first();
        if ($headstatus->status == '0') {
            return redirect()->route('admin.index')->with('error', 'Head is inactive. Activate head to edit details via admin profile');
        }
        if (!$head) {
            return redirect()->route('admin.index')->with('error', 'Head not found');
        }


        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $states = State::where('status','1')->where('country_id', 101)->orderBy('name', 'asc')->get();
        $city = collect();

        if ($head->state) {
            $selectedState = State::where('name', $head->state)->first();
            if ($selectedState) {
                $city = City::where('status','1')->where('state_id', $selectedState->id)
                    ->orderBy('name', 'asc')
                    ->get();
            }
        }

        return view("admin.newUpdate", compact('head', 'id', 'states', 'city', 'admin1'));
    }

    public function fullUpdate(Request $request, string $id)
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
            'hobbies' => 'required|array|min:1',
            'hobbies.*' => ['required', 'distinct', 'min:1', 'string'],
            'path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update Head
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

        // Update hobbies
        $user->hobbies()->delete();
        foreach ($request->hobbies as $hobby) {
            $user->hobbies()->create([
                'head_id' => $user->id,
                'hobby_name' => $hobby,
            ]);
        }

        // Handle photo upload
        if ($request->hasFile('path')) {
            Storage::disk('public/uploads/images/')->delete($user->photo_path);
            $file = $request->file('path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/images/', $filename);
            $user->photo_path = $filename;
        }


        $user->save();

        // Handle deleted members
        if ($request->has('deleted_members')) {
            Member::whereIn('id', $request->deleted_members)->update(['status' => '0']);
        }

        // Handle existing members update
        if ($request->has('members')) {
            $members = $user->members()->where('status', '1')->orderBy('id')->get();
            foreach ($request->members as $index => $memberData) {
                $memberIndex = $index - 1;
                if (isset($members[$memberIndex])) {
                    $member = $members[$memberIndex];
                    $member->name = $memberData['name'] ?? $member->name;
                    $member->birthdate = $memberData['date'] ?? $member->birthdate;
                    $member->relation = $memberData['relation'] ?? $member->relation;
                    $member->marital_status = $memberData['marital_status'] ?? $member->marital_status;
                    $member->education = $memberData['education'] ?? $member->education;
                    $member->status = $memberData['status'] ?? $member->status;

                    if (isset($memberData['marital_status']) && $memberData['marital_status'] == 1 && isset($memberData['mariage_date'])) {
                        $member->mariage_date = $memberData['mariage_date'];
                    }

                    if (isset($memberData['photo']) && $memberData['photo']) {
                        $file = $memberData['photo'];
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $file->move('uploads/images/', $filename);
                        $member->photo_path = $filename;
                    }

                    $member->save();
                }
            }
        }

        // Handle new members
        if ($request->has('new_members')) {
            foreach ($request->new_members as $memberData) {
                $member = new Member();
                $member->head_id = $user->id;
                $member->name = $memberData['name'];
                $member->birthdate = $memberData['date'];
                $member->marital_status = $memberData['marital_status'] ?? 0;
                $member->education = $memberData['education'];
                $member->status = '1';

                if (isset($memberData['marital_status']) && $memberData['marital_status'] == 1 && isset($memberData['mariage_date'])) {
                    $member->mariage_date = $memberData['mariage_date'];
                }

                if (isset($memberData['photo']) && $memberData['photo']) {
                    $file = $memberData['photo'];
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move('uploads/images/', $filename);
                    $member->photo_path = $filename;
                }

                $member->save();
            }
        }

        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = 'Admin has Updated Head and Members (' . $user->name . ' ' . $user->surname . ') Successfully on ' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
        $log->save();

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'The head successfully modified data.',
                'redirect' => route('admin.index'),
                'name' => $user->name,
                'surname' => $user->surname
            ]);
        }

        return redirect()->route('admin.index')->with('success', 'Head updated successfully.')->with('name', $user->name)->with('surname', $user->surname);



    }







    public function deletestate($id)
    {
        $state = State::find($id);
        $state->update(['status' => '0']);

        $heads = Head::where('state', $state->name)->get();
        foreach ($heads as $head) {
            $head->update(['status' => '0']);
            $head->members()->update(['status' => '0']);
        }

        return redirect()->back()->with('success', 'State and related data deleted successfully.');
    }

    public function deletecity($id)
    {
        $city = City::find($id);
        $city->update(['status' => '0']);

        $heads = Head::where('city', $city->name)->get();
        foreach ($heads as $head) {
            $head->update(['status' => '0']);
            $head->members()->update(['status' => '0']);
        }

        return redirect()->back()->with('success', 'City and related data deleted successfully.');
    }

    public function activateMember(Request $request,string $id)
    {
        $member = Member::find($id);
        if ($member) {
            if ($request->ajax()) {
                                    $member->status = '1';
                                    $member->save();
                                    return response()->json([
                                        'status' => 'success',
                                        'message' => 'Head activated successfully.',
                                        'name' => $member->name,

                                    ]);
                                }
            return redirect()->back()->with('success', "Member activated successfully.")->with('name', $member->name);
        }
    }

    public function deactivateMember(Request $request, string $id)
    {
        $member = Member::find($id);
                if ($member) {
                    if ($request->ajax()) {
                                            $member->status = '0';
                                            $member->save();
                                            return response()->json([
                                                'status' => 'success',
                                                'message' => 'Head deactivated successfully.',
                                                'name' => $member->name,

                                            ]);
                                        }
                    return redirect()->back()->with('success', "Member deactivated successfully.")->with('name', $member->name);
                }
    }

    public function activateHeadOnView(Request $request, string $id)
    {
        $head = Head::find($id);
        if (!$head) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Head not found.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Head not found.');
        }



        if ($request->ajax()) {
        $head->status = '1';
                $head->members()->where('status','0')->update(['status' => '1']);
                $head->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Head activated successfully.',
                'name' => $head->name,
                'surname' => $head->surname
            ]);
        }

        return redirect()->back()->with('success', "head activated successfully.")->with('name', $head->name, 'surname', $head->surname);
    }

    public function deactivateHeadOnView(Request $request,string $id)
    {
     $head = Head::find($id);
     if (!$head) {
                if ($request->ajax()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Head not found.'
                    ], 404);
                }
                return redirect()->back()->with('error', 'Head not found.');
            }
        $head = Head::find($id);
        if ($head) {

            if ($request->ajax()) {
                $head->status = '0';
                            $head->members()->where('status','1')->update(['status' => '0']);
                            $head->save();
                            return response()->json([
                                'status' => 'success',
                                'message' => 'Head deactivated successfully.',
                                'name' => $head->name,
                                'surname' => $head->surname
                            ]);
                        }
                }
            return redirect()->back()->with('success', "head deactivated successfully.")->with('name', $head->name, 'surname', $head->surname);
        }



    public function updateCityState($id){
            $head = Head::where('status','0')->find($id);
            $states = State::where('status','1')->where('country_id', 101)->orderBy('name', 'asc')->get();
            $city = collect();
            $admin1 = User::where('id', '=', session::get('loginId'))->first();


            if(!$head){
                return redirect()->route('admin.index')->with('error', 'Head not found');
            }
            return view('admin.selectiveUpdate',compact('head','states','city','admin1'));
        }

    public function postCityState(Request $request,$id){
           $user = Head::find($id);
           $user->address = $request->address;
           $user->state = $request->state;
           $user->city = $request->city;
           $user->pincode = $request->pincode;
           $user->status = '1';

           $user->save();

           $user->members()->where('status','0')->update(['status' => '1']);


            return redirect()->route('admin.index')->with('success', "Head's (City/State) Updated successfully.")->with('name', $user->name)->with('surname', $user->surname);
        }

}
