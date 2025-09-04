<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Head;
use App\Models\Member;
use App\Models\Hobby;


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
        $head = Head::find($id);
        $members = $head->members()->get();
        return view("member.index", compact("members"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $member = Member::find($id);
        return view('member.edit',compact('member'));
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
}
