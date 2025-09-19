<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Head;
use App\Models\Member;
use App\Models\State;
use App\Models\City;
use App\Models\Logg;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use DB;
use Session;
class AuthController extends Controller
{
    public function login(Request $request)
    {

        return view("auth.login");
    }

    public function register()
    {
        return view("auth.register");
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if ($user->save()) {
            return back()->with('success', 'Registration successful! You can now log in.');
        } else {
            return back()->with('error', 'User was not registered');
        }


    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);



        $user = User::where('email', '=', $request->email)->first();
        if ($user) {

            if ($user->status == '0') {
                Session::pull('loginId');
                return back()->with('error', 'Your account is inactive');
            } else if ($user->status == '9') {
                Session::pull('loginId');
                return back()->with('error', 'Your account has been blocked/deleted');
            } else {
                if (hash::check($request->password, $user->password)) {
                    $request->session()->put('loginId', $user->id);
                    return redirect('dashboard');
                } else {
                    return back()->with('error', 'password incorrect');
                }
            }
        } else {
            return back()->with('error', 'No such user found');
        }
    }

    public function dashboard()
    {
        $data = array();
        Log::info('A request was received for processing.');

        if (Session::has('loginId')) {
            if (
                $user = User::where('id', '=', session::get('loginId'))
                    ->where('status', '1')
                    ->first()
            ) {
                $head = Head::where('status', '1')->get();
                $member = Member::where('status', '1')->get();
                $state = State::where('status', '1')->get();
                $city = City::where('status', '1')->get();
                $admin1 = User::where('id', '=', session::get('loginId'))->first();
                $headcount = $head->count();
                $membercount = $member->count();
                $statecount = $state->count();
                $citycount = $city->count();


                
               
                $topStates = DB::table('heads')
                            ->select('state', DB::raw('COUNT(*) as count'))
                            ->groupBy('state')
                            ->orderByDesc('count')
                            ->limit(5)
                            ->get()
                            ->toArray();;
                $topStateNames = DB::table('heads')
                        ->select('state', DB::raw('count(*) as total'))
                        ->groupBy('state')
                        ->orderByDesc('total')
                        ->limit(5)
                        ->pluck('state');

              
                    $headsWithAge = $head->map(function ($bday)  {
                        return [
                            'age' => Carbon::parse($bday->birthdate)->age,
                            'name' => $bday->name." ".$bday->surname,
                            'id' => $bday->id,
                            'members' => Member::where('status','1')->where('head_id', $bday->id)->count()
                        ];
                    });

                   
                    $headsWithAgeSortedByAge = $headsWithAge->sortByDesc('age')->values();

                    
                    $headsWithAgeSortedByMembers = $headsWithAge->sortByDesc('members')->values();

                    
                    $ageData = $headsWithAgeSortedByAge->pluck('age')->toArray();
                    $nameData = $headsWithAgeSortedByAge->pluck('name')->toArray();

                    $membersPerFamilyData = $headsWithAgeSortedByMembers->pluck('members')->toArray();
                    $membersPerFamilyLabels = $headsWithAgeSortedByMembers->pluck('name')->toArray();

                    
                    $states = $state->map(function ($bday)  {
                        return [
                            'cities' => City::where('status', '1')->where('state_id', $bday->id)->count(),
                            'name' => $bday->name,
                            'id' => $bday->id
                        ];
                    });
                
                
                
                $topStates2 = $states->sortByDesc('cities')->take(5)->values();
                $totalCitiesOfStates = $topStates2->pluck('cities')->toArray();
                $nameStates = $topStates2->pluck('name')->toArray();
                



                Log::debug('Admin returned to dashboard at :'.Carbon::now()->setTimezone('Asia/Kolkata'));

                return view('dashboard', compact('head', 'headcount', 'membercount', 'statecount', 'citycount', 'admin1','ageData','nameData','topStates','topStateNames','membersPerFamilyData','totalCitiesOfStates','nameStates','membersPerFamilyLabels'));
            }
        }





    }


    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('/login')->with('error', 'You have been logged out');
        }
    }

    public function adminProfile()
    {
        if (
            $user = User::where('id', '=', session::get('loginId'))
                ->where('status', '1')
                ->first()
        ) {
            $heads = Head::where('status','9')->orWhere('status','0')->orderBy('name','asc')->get();
            $heads2 = Head::where('status','1')->orderBy('name','asc')->get();
            ///head
            $headcount = Head::where('status', '1')->count();
            $inactiveheadcount = Head::where('status', '0')->count();
            $deletedheadcount = Head::where('status', '9')->count();
            $totalhead = Head::count();

            /// Member
            $membercount = Member::where('status', '1')->count();
            $inactivemembercount = Member::where('status', '0')->count();
            $deletedmembercount = Member::where('status', '9')->count();
            $totalmembercount = Member::count();

            ///State
            $statecount = State::where('status', '1')->count();
            $inactivestatecount = State::where('status', '0')->count();
            $deletedstatecount = State::where('status', '9')->count();
            $totalstatecount = State::count();

            /// City Controller
            $citycount = City::where('status', '1')->count();
            $inactivecitycount = City::where('status', '0')->count();
            $deletedcitycount = City::where('status', '9')->count();
            $totalcitycount = City::count();

            $admin1 = User::where('id', '=', session::get('loginId'))->first();

            $logs = Logg::latest()->where('user_id',$admin1->id)->take(15)->get();

            

            

            return view('admin.adminProfile', compact('user', 'headcount', 'totalhead', 'deletedheadcount', 'inactiveheadcount', 'membercount', 'inactivemembercount', 'deletedmembercount', 'totalmembercount', 'statecount', 'inactivestatecount', 'deletedstatecount', 'totalstatecount', 'citycount', 'inactivecitycount', 'deletedcitycount', 'totalcitycount', 'admin1','logs','heads','heads2'));
        }
    }

    public function activateHead(Request $request){
        $head = Head::find($request->active_member);
        $head->update(['status' => '1']);
        $head->members()->where('status', '0')->update(['status' => '1']); 

        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = 'Admin has Activated Head  (' . $head->name . ' ' . $head->surname . ')  Successfully with all members on ' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
        $log->save();
        log::debug('Admin has Updated Head  (' . $head->name . ' ' . $head->surname . ')  Successfully : ' . Carbon::now()->setTimezone('Asia/Kolkata'));

        return redirect('/dashboard/admin-profile')->with('success', 'Head activated successfully');
    }
    public function deactivateHead(Request $request){
        $head = Head::find($request->deactive_member);
        $head->update(['status' => '0']);
        $head->members()->where('status', '1')->update(['status' => '0']); 


        $admin1 = User::where('id', '=', session::get('loginId'))->first();
        $log = new Logg();
        $log->user_id = $admin1->id;
        $log->logs = 'Admin has Deactivated Head  (' . $head->name . ' ' . $head->surname . ')   with all members on ' .  Carbon::now()->setTimezone('Asia/Kolkata')->format('l, F jS, Y \a\t h:i A');
        $log->save();
        log::debug('Admin has Updated Head  (' . $head->name . ' ' . $head->surname . ')  Successfully : ' . Carbon::now()->setTimezone('Asia/Kolkata'));

        return redirect('/dashboard/admin-profile')->with('success', 'Head deactivated successfully');
    }

    
}
