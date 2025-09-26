<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Head;
use App\Models\Member;
use App\Models\Hobby;
use App\Models\User;
use App\Models\Logg;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MembersExport;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
    public function familySection($id)
    {
        $user = Head::find($id);
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        if (!$user) {
            return redirect('/')->with('error', 'Head not found.');
        }
        $members = $user->members;
        return view('member.create', ['id' => $id, 'members' => $members, 'users' => $user, 'admin1' => $admin1]);
    }

    public function print_member_all_pdf()
    {
        $members = Member::where('status', '1')->get();

        ///home/dev83/Desktop/Assignment-Family_Management_System/Family_Management_System/public/uploads/images/1757081895_WhatsApp Image 2025-04-02 at 11.24.38_5fb74118.jpg
        $pdf = Pdf::loadView('pdf.member_all', compact('members'));
        $pdf->showImageErrors = true;
        $pdf->curlAllowUnsafeSslRequests = true;
        log::channel('adminlog')->debug('All Members PDF Printed at : ' . Carbon::now()->setTimezone('Asia/Kolkata'));
        return $pdf->download('All_Family\'s_members.pdf');
    }



    public function addMember(Request $request, $id)
    {

        $request->validate(
            [
                'name' => 'required',
                'birthdate' => 'required|date',
                'marital_status' => 'required',
                'mariage_date' => 'required_if:marital_status,1',
                'relation' => 'required',
                'photo_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
            ,
            [
                'mariage_date.required_if' => 'The marriage date field is required when marital status is married.',
            ]
        );
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
            'relation' =>   $request->relation,
            'mariage_date' => $request->marital_status == 1 ? $request->mariage_date : null,
            'education' => $request->education,
            'photo_path' => $filename,
        ]);
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = 'Admin Added User (' . $user->name . ' ' . $user->surname . '\'s)  Member (' . $request->name . ') To the Database Successfully on ' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
        $log->save();


        log::channel('adminlog')->debug('Admin Added  User (' . $user->name . ' ' . $user->surname . '\'s)  Member (' . $request->name . ') To the Database Successfully');
        return redirect()->route('admin-member.show', $familyid)->with('success', 'Member added successfully.');



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $head = Head::find($id);
        $id = $head->id;
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $members = $head->members()->where('status', '1')->paginate(4);
        return view("member.index", data: compact("members", 'id', 'admin1','head'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $member = Member::whereIn('status', ['1','0'])->find($id);
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        return view('member.edit', compact('member', 'admin1'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
        $member = Member::find($id);
        $parentId = $member->head->id;

        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = 'Admin Updated Member (' . $member->name . ') Successfully of Family : ' . $member->head->name . ' ' . $member->head->surname . " on " .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
        $log->save();
        log::channel('adminlog')->debug('Admin Updated Member (' . $member->name . ') Successfully of Family : ' . $member->head->name . ' ' . $member->head->surname . " at : " . Carbon::now()->setTimezone('Asia/Kolkata'));

        if (!$member) {
            return back()->with('error', 'member not found.');
        }




            $member->name = $request->name;
            $member->birthdate = $request->birthdate;
            $member->relation = $request->relation;
            $member->marital_status = $request->marital_status;
            $member->mariage_date = $request->marital_status == 1 ? $request->mariage_date : null;
            $member->education = $request->education;

            if ($request->photo_path != null) {
                $file = $request->file('photo_path');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('/uploads/images/'), $filename);
                $member->photo_path = $filename;
                $member->save();
                return redirect()->route('admin-member.show', $parentId)->with('success', 'The member successfully modified data and their image..')->with('name', $member->name)->with('surname', $member->surname);
            }

            if($request->boolean('remove_image') == 1)
            {
                $member->photo_path = null;
                $member->save();
                return redirect()->route('admin-member.show', $parentId)->with('success', 'The member successfully modified data and removed image..')->with('name', $member->name)->with('surname', $member->surname);
            }

            $member->save();





        return redirect()->route('admin-member.show', $parentId)->with('success', 'Member updated successfully.')->with('name', $member->name)->with('surname', $member->surname);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::find($id);
        $parentId = $member->head->id;
        $member->delete();

        return redirect()->route('admin-member.show', $parentId)->with('success', 'Member deleted successfully.')->with('name', $member->name)->with('surname', $member->surname);
    }
    public function delete(string $id)
    {
        $member = Member::find($id);
        $parentId = $member->head->id;

        // Delete member image
        if ($member->photo_path && file_exists(public_path('uploads/images/' . $member->photo_path))) {
            unlink(public_path('uploads/images/' . $member->photo_path));
        }

        $member->update(['status' => '9']);

        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = 'Admin Deleted Member (' . $member->name . ')  Successfully of Family : ' . $member->head->name . ' ' . $member->head->surname . " on " .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
        $log->save();

        log::channel('adminlog')->debug('Admin Deleted Member (' . $member->name . ')  Successfully of Family : ' . $member->head->name . ' ' . $member->head->surname . " at : " . Carbon::now()->setTimezone('Asia/Kolkata'));
        return redirect()->route('admin-member.show', $parentId)->with('success', 'Member updated successfully.')->with('name', $member->name)->with('surname', $member->surname);
    }

    public function export()
    {
        log::debug('Members data(in excel) Exported Successfully at : ' . Carbon::now()->setTimezone('Asia/Kolkata'));
        return Excel::download(new MembersExport, 'members.xlsx');
    }

    public function activate($id)
    {
        $member = Member::find($id);
        $parentId = $member->head->id;
        $member->update(['status' => '1']);
        
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = 'Admin Activated Member (' . $member->name . ') Successfully of Family : ' . $member->head->name . ' ' . $member->head->surname . " on " .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
        $log->save();
        
        return redirect()->route('admin-member.show', $parentId)->with('success', 'Member activated successfully.');
    }

    public function deactivate($id)
    {
        $member = Member::find($id);
        $parentId = $member->head->id;
        $member->update(['status' => '0']);
        
        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = 'Admin Deactivated Member (' . $member->name . ') Successfully of Family : ' . $member->head->name . ' ' . $member->head->surname . " on " .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
        $log->save();
        
        return redirect()->route('admin-member.show', $parentId)->with('success', 'Member deactivated successfully.');
    }

}
