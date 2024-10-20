<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\ChurchRole;
use App\Models\Log;
use App\Models\Member;
use App\Models\Pastor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PastorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth()->user();
        $role = $user->churchRole->role->name;

        if ($role === "Church_admin") {

            $pastors = Pastor::where('church_id', $user->church_id)->get();
            $memberIds = $pastors->pluck('member_id');
            $existingUsers = User::whereIn('member_id', $memberIds)->where('is_deleted', false)->get();
            $nonExistingUsers = $pastors->whereNotIn('member_id', $existingUsers->pluck('member_id'));

            $churchRoles = ChurchRole::where('church_id', $user->church_id)->get();



        }elseif ($role === "Branch_admin") {
            $pastors = Pastor::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->get();
            $memberIds = $pastors->pluck('member_id');
            $existingUsers = User::whereIn('member_id', $memberIds)->where('is_deleted', false)->get();
            $churchRoles = ChurchRole::where('church_id', $user->church_id)->whereNotIn('role_id', [1,2])->get();


        }else {

            $pastors = Pastor::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->get();
            $memberIds = $pastors->pluck('member_id');
            $existingUsers = User::whereIn('member_id', $memberIds)->where('is_deleted', false)->get();
            $churchRoles = ChurchRole::where('church_id', $user->church_id)->whereNotIn('role_id', [1,2])->get();


        }

        return view ('pastor.index', compact('pastors',  'nonExistingUsers', 'churchRoles'));

    }


    public function addPastor()
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

        return view('pastor.new', compact('members'));
    }


    public function storePastor(Request $request)
    {
        $user = Auth()->user();

        $rules = [];
        $messages = [
            'name.required' => 'Please enter the name of the client.',
            'name.max' => 'You have entered too many characters.',
            'phone.required' => 'Please enter client phone.',
            'member_type.required' => 'Please select the type of membership.'
        ];

        if ($request->member_type == 'new_member') {
            $rules = [
                'name' => 'required|max:100',
                'phone' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'member_type' => 'required|in:new_member',

            ];

        } else {
            $rules = [
                'member_id'=>'required',
                'member_type' => 'required|in:existing_member',
            ];
        }


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Check your inputs.');
        }

        if ($request->member_type == 'new_member') {

        $member = Member::create([
            'name' => $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'gender'=> $request->gender,
            'address'=> $request->address,
            'location'=> $request->location,
            'dob'=> $request->dob,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,

        ]);


        }else{
            $member= Member::find($request->member_id);
        }

        $pastor = Pastor::create([
            'member_id'=> $member->id,
            'education_background'=> $request->education_background,
            'ministry_training'=> $request->ministry_training,
            'ordination_date'=> $request->ordination_date,
            'church_roles'=> $request->church_roles,
            'publications'=> $request->publications,
            'family_details'=> $request->family_details,
            'health_status'=> $request->health_status,
            'hobbies_interests'=> $request->hobbies_interests,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,

        ]);

            //LOG
            $description = "User ". $user->id . " created a member: ". $pastor->id ;
            $action = "Create";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('pastor.index')->with('success', 'Pastor has been addedd successfully.');
    }

    public function details($id)
    {
        $pastor = Pastor::findOrFail($id);
        $member = Member::findOrFail($pastor->member_id);

        // Return both pastor and member details
        return response()->json([
            'pastor' => $pastor,
            'member' => $member
        ]);
    }

    public function delete(Request $request)
    {
        $user = Auth()->user();

        $id = $request->input('selectedId');
        $result = Pastor::findOrFail($id);
        $result->delete();

            //LOG
            $description = "User ". $user->id . " deleted a pastor: ". $result->id;
            $action = "Delete";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('pastor.index')->with('success', 'Pastor deleted successfully.');
    }

    public function edit(Request $request, $id)
    {
        $pastor = Pastor::find($id);
        return view ('pastor.edit', compact('pastor'));
    }


    public function update (Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Name is required',
            'gender.required' => 'State the gender',
            'dob.required' => 'Date of birth is required',
            'phone.required' => 'Provide a phone number',
        ]);

        $pastor = Pastor::find($request->pastor_id);
        $member = Member::find($pastor->member_id);
        $userAccount = User::where('member_id', $member->id)->first();

        $member->name = $request->name;
        $member->gender = $request->gender;
        $member->dob = $request->dob;
        $member->phone = $request->phone;
        $member->address = $request->address;
        $member->location = $request->location;
        $member->email = $request->email;

        $pastor->education_background = $request->education_background;
        $pastor->ministry_training = $request->ministry_training;
        $pastor->ordination_date = $request->ordination_date;
        $pastor->church_roles = $request->church_roles;
        $pastor->publications = $request->publications;
        $pastor->family_details = $request->family_details;
        $pastor->health_status = $request->health_status;
        $pastor->hobbies_interests = $request->hobbies_interests;

        if ($userAccount){
            $userAccount->email = $request->email;
            $userAccount->phone = $request->phone;
            $userAccount->name = $request->name;
            $userAccount->save();

        }

        $member->save();
        $pastor->save();

            //LOG
            $action = "Update";

            $description = "User ". $user->id . " updated a pastor: ". $pastor->id;
            $action = "Update";


            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('pastor.index')->with('success', 'Pastor information updated successfully.');

    }
}
