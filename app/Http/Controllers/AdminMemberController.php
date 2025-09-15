<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Head;
use App\Models\Member;
use App\Models\Hobby;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MembersExport;

use Session;

class AdminMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function familySection($id){
        $user = Head::find($id);
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        if (!$user) {
            return redirect('/')->with('error', 'Head not found.');
        }
        $members = $user->members;
        return view('member.create',['id'=>$id,'members'=>$members,'users'=>$user,'admin1'=>$admin1]);
    }

    public function print_member_all_pdf()
    {
        $members = Member::where('status','1')->get();

        ///home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/1757081895_WhatsApp Image 2025-04-02 at 11.24.38_5fb74118.jpg
        $pdf = Pdf::loadView('pdf.member_all', compact('members'));
        $pdf->showImageErrors = true;
        $pdf->curlAllowUnsafeSslRequests = true;
        return $pdf->download('All_Family\'s_members.pdf');
    }



    public function addMember(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'birthdate' => 'required|date',
            'marital_status' => 'required',
            'mariage_date' => 'required_if:marital_status,1',
            'photo_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]
        ,[
            'mariage_date.required_if' => 'The marriage date field is required when marital status is married.',
        ]);
        $user = Head::find($id);
        
        $familyid = $user->id;
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

        return redirect()->route('admin-member.show',$familyid)->with('success', 'Member added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $head = Head::find($id);
        $id = $head->id;
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $members = $head->members()->where('status','1')->paginate(4);
        return view("member.index", data: compact("members",'id','admin1'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $member = Member::where('status','1')->find($id);
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        return view('member.edit',compact('member','admin1'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'birthdate' => 'required|date',
            'marital_status' => 'required',
            'mariage_date' => 'required_if:marital_status,1',
            'photo_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]
        ,[
            'mariage_date.required_if' => 'The marriage date field is required when marital status is married.',
        ]);
        $member = Member::find($id);
        $parentId = $member->head->id;
        if (!$member) {
            return back()->with('error', 'member not found.');
        }

        $filename = null;
        if ($request->hasFile('photo_path')) {
            $file = $request->file('photo_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('/uploads/images/'), $filename);
        }

        $member->update([
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'marital_status' => $request->marital_status,
            'mariage_date' => $request->marital_status == 1 ? $request->mariage_date : null,
            'education' => $request->education,
            'photo_path' => $filename,
        ]);

        return redirect()->route('admin-member.show',$parentId)->with('success', 'Member updated successfully.')->with('name',$member->name)->with('surname',$member->surname);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::find($id);
        $parentId = $member->head->id;
        $member->delete();

        return redirect()->route('admin-member.show',$parentId)->with('success', 'Member deleted successfully.')->with('name',$member->name)->with('surname',$member->surname);
    }
    public function delete(string $id)
    {
        $member = Member::find($id);
        $parentId = $member->head->id;
        $member->update(['status' => '9']);

        return redirect()->route('admin-member.show',$parentId)->with('success', 'Member deleted successfully.')->with('name',$member->name)->with('surname',$member->surname);
    }

    public function export() 
    {
        return Excel::download(new MembersExport, 'members.xlsx');
    }

    
}
