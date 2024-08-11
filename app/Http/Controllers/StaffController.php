<?php

namespace App\Http\Controllers;

use App\Models\ChurchRole;
use App\Models\Log;
use App\Models\Member;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $role = $user->churchRole->role->name;

        if ($role === "Church_admin") {

            $staff = Staff::where('church_id', $user->church_id)->get();
            $memberIds = $staff->pluck('member_id');
            $existingUsers = User::whereIn('member_id', $memberIds)->get();
            $nonExistingUsers = $staff->whereNotIn('member_id', $existingUsers->pluck('member_id'));
            $churchRoles = ChurchRole::where('church_id', $user->church_id)->get();

        }elseif ($role === "Branch_admin") {
            $staff = Staff::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->get();
            $memberIds = $staff->pluck('member_id');
            $existingUsers = User::whereIn('member_id', $memberIds)->get();
            $nonExistingUsers = $staff->whereNotIn('member_id', $existingUsers->pluck('member_id'));
            $churchRoles = ChurchRole::where('church_id', $user->church_id)->whereNotIn('role_id', [1,2])->get();

        }else {

            $staff = Staff::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->get();
            $memberIds = $staff->pluck('member_id');
            $existingUsers = User::whereIn('member_id', $memberIds)->get();
            $nonExistingUsers = $staff->whereNotIn('member_id', $existingUsers->pluck('member_id'));
            $churchRoles = ChurchRole::where('church_id', $user->church_id)->whereNotIn('role_id', [1,2])->get();

        }

        return view('staff.index', compact('staff', 'nonExistingUsers', 'churchRoles'));
    }

    public function create()
    {
        $user = Auth()->user();

        $role = $user->churchRole->role->name;

        if ($role === "Church_admin") {

            $members = Member::where('church_id', $user->church_id)->get();


        }elseif ($role === "Branch_admin") {
            $members = Member::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->get();

        }else {

            $members = Member::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->get();

        }
        return view('staff.new', compact('members'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'member_id' => 'required|exists:members,id',
            'position' => 'required|string|max:255',
            'date_appointed' =>'required'
        ], [
            'position.required' => 'Enter staff position',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }


        $staff = Staff::create([
            'member_id' => $request->member_id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'position' => $request->position,
            'education_background' => $request->education_background,
            'health_status' => $request->health_status,
            'hobbies_interests' => $request->hobbies_interests,
            'date_appointed' => $request->date_appointed,
        ]);

            //LOG
            $description = "User ". $user->id . " added a member of staff:  ". $staff->id;
            $action = "Create";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('staff.index')->with('success', 'Staff member added successfully.');
    }

    public function details($id)
    {
        $staff = Staff::findOrFail($id);
        $member = Member::findOrFail($staff->member_id);

        // Return both leader and member details
        return response()->json([
            'staff' => $staff,
            'member' => $member
        ]);
    }

    public function update (Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'position' => 'required|string|max:255',
            'date_appointed' =>'required'

        ], [
            'name.required' => 'Name is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }


        $staff = Staff::find($request->selectedId);
        $member = Member::find($staff->member_id);
        $userAccount = User::where('member_id', $member->id)->first();

        $member->name = $request->name;

        $staff->date_appointed = $request->date_appointed;
        $staff->education_background = $request->education_background;
        $staff->position = $request->position;
        $staff->health_status = $request->health_status;
        $staff->hobbies_interests = $request->hobbies_interests;

        if ($userAccount){
            $userAccount->name = $request->name;
            $userAccount->save();

        }

        $member->save();
        $staff->save();

            //LOG
            $action = "Update";

            $description = "User ". $user->id . " updated a staff: ". $staff->id;
            $action = "Update";


            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('staff.index')->with('success', 'Staff information updated successfully.');

    }

    public function delete(Request $request)
    {
        $user = Auth()->user();

        $id = $request->input('selectedId');
        $result = Staff::findOrFail($id);
        $result->delete();

            //LOG
            $description = "User ". $user->id . " deleted a staff: ". $result->id;
            $action = "Delete";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
    }



}
