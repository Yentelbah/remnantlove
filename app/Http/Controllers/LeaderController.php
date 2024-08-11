<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\ChurchRole;
use App\Models\Group;
use App\Models\GroupLeader;
use App\Models\GroupMember;
use App\Models\Log;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaderController extends Controller
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

            $leaders = GroupLeader::where('church_id', $user->church_id)->get();
            $memberIds = $leaders->pluck('member_id');
            $existingUsers = User::whereIn('member_id', $memberIds)->get();
            $nonExistingUsers = $leaders->whereNotIn('member_id', $existingUsers->pluck('member_id'));

            $churchRoles = ChurchRole::where('church_id', $user->church_id)->get();

        }elseif ($role === "Branch_admin") {
            $leaders = GroupLeader::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->get();
            $memberIds = $leaders->pluck('member_id');
            $existingUsers = User::whereIn('member_id', $memberIds)->get();
            $nonExistingUsers = $leaders->whereNotIn('member_id', $existingUsers->pluck('member_id'));
            $churchRoles = ChurchRole::where('church_id', $user->church_id)->whereNotIn('role_id', [1,2])->get();

        }else {

            $leaders = GroupLeader::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->get();
            $memberIds = $leaders->pluck('member_id');
            $existingUsers = User::whereIn('member_id', $memberIds)->get();
            $nonExistingUsers = $leaders->whereNotIn('member_id', $existingUsers->pluck('member_id'));
            $churchRoles = ChurchRole::where('church_id', $user->church_id)->whereNotIn('role_id', [1,2])->get();

        }

        return view ('leader.index', compact('leaders', 'nonExistingUsers', 'churchRoles'));
    }

    public function addLeader()
    {

        $user = Auth()->user();
        $groups = Group::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->get();
        return view('leader.new', compact('groups'));
    }


    public function storeLeader(Request $request)
    {
        // dd($request);
        $user = Auth()->user();

        $memberId = $request->input('member_id');
        $groupId = $request->input('group_id');

        $leader = GroupLeader::create([
            'member_id'=> $memberId,
            'group_id'=> $groupId,
            'date_appointed' => $request->input('date_appointed'),
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,

        ]);

        $groupMember = GroupMember::where('group_id', $groupId)
                           ->where('member_id', $memberId)->first();
        $groupMember->status = 'Leader';
        $groupMember->save();

            //LOG
            $description = "User ". $user->id . " add a leader: ". $leader->id ;
            $action = "Create";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('leader.index')->with('success', 'Leader has been addedd successfully.');
    }

    public function fetchGroupMembers($groupId)
    {
        $members = GroupMember::where('group_id', $groupId)
                            ->join('members', 'group_members.member_id', '=', 'members.id')
                            ->select('members.id', 'members.name')
                            ->get();
        return response()->json($members);
    }

    public function details($id)
    {
        $leader = GroupLeader::findOrFail($id);
        $member = Member::findOrFail($leader->member_id);

        // Return both leader and member details
        return response()->json([
            'leader' => $leader,
            'member' => $member
        ]);
    }

    public function edit(Request $request, $id)
    {
        $leader = GroupLeader::find($id);
        return view ('leader.edit', compact('leader'));
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


        $leader = GroupLeader::find($request->leader_id);
        $member = Member::find($leader->member_id);
        $userAccount = User::where('member_id', $member->id)->first();

        $member->name = $request->name;

        $leader->date_appointed = $request->date_appointed;
        $leader->title = $request->title;
        $leader->type = $request->type;

        if ($userAccount){
            $userAccount->name = $request->name;
            $userAccount->save();

        }

        $member->save();
        $leader->save();

            //LOG
            $action = "Update";

            $description = "User ". $user->id . " updated a leader: ". $leader->id;
            $action = "Update";


            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('leader.index')->with('success', 'Leader information updated successfully.');

    }

    public function delete(Request $request)
    {
        $user = Auth()->user();

        $id = $request->input('selectedId');
        $result = GroupLeader::findOrFail($id);
        $result->delete();

            //LOG
            $description = "User ". $user->id . " deleted a leader: ". $result->id;
            $action = "Delete";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('leader.index')->with('success', 'Leader deleted successfully.');
    }


}
