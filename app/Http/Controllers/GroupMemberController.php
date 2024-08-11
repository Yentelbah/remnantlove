<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Group;
use App\Models\GroupLeader;
use App\Models\GroupMember;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupMemberController extends Controller
{
    public function add_member(Request $request)
    {
        $user = Auth()->user();

        // Get the selected group
        $groupId = $request->input('GroupId');
        $group = Group::findOrFail($groupId);
        $memberIds = explode(',', $request->input('members'));

        foreach ($memberIds as $memberId) {
            // Check if the member already belongs to the group
            $exists = GroupMember::where('group_id', $groupId)
                                   ->where('member_id', $memberId)
                                   ->exists();


            if (!$exists) {
                // If the member does not exist in the group, create a new record
                GroupMember::create([
                    'group_id' => $groupId,
                    'member_id' => $memberId,
                ]);
            }
        }

            //LOG
            $description = "User ". $user->id . " added member to group:  ". $group->name;
            $action = "Join";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->back()->with('success', 'Members added to the group successfully.');
    }

    public function members(Request $request, $id)
    {
        $user = Auth()->user();

        // Retrieve the group with member count
        $group = Group::where('id', $id)->withCount('members')->first();

        // Retrieve members along with their details and leader details if they are leaders
        $members = $group->members()
                         ->leftJoin('group_leaders as gl', function($join) {
                             $join->on('group_members.member_id', '=', 'gl.member_id')
                                  ->on('group_members.group_id', '=', 'gl.group_id');
                         })
                         ->leftJoin('members as m', 'group_members.member_id', '=', 'm.id')
                         ->select('group_members.*', 'm.id', 'm.name', 'm.member_number', 'gl.title', 'gl.date_appointed')
                         ->get();

        return view('group.group_member', compact('members', 'group'));
    }

    public function remove_member(Request $request)
    {
        $user = Auth()->user();

        // Get the selected group
        $groupId = $request->input('GroupId');
        $group = Group::findOrFail($groupId);
        $memberIds = explode(',', $request->input('members'));

        foreach ($memberIds as $memberId) {
            // Check if the member already belongs to the group
            $result = GroupMember::where('group_id', $groupId)->where('member_id', $memberId);
            $result->delete();

            $leader = GroupLeader::where('group_id', $groupId)->where('member_id', $memberId);
            $leader->delete();
        }

            //LOG
            $description = "User ". $user->id . " removed member from group:  ". $group->name;
            $action = "Disjoin";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->back()->with('success', 'Members added to the group successfully.');
    }

    public function add_leader(Request $request)
    {
        $user = Auth()->user();

        // Get the selected group
        $groupId = $request->input('GroupId');
        $group = Group::findOrFail($groupId);
        $memberId = $request->input('selectedId');

            $exists = GroupLeader::where('group_id', $groupId)
                                   ->where('member_id', $memberId)
                                   ->exists();


            if (!$exists) {
                // If the member does not exist in the group, create a new record
                GroupLeader::create([
                    'group_id' => $groupId,
                    'member_id' => $memberId,
                    'title' => $request->input('title'),
                    'date_appointed' => $request->input('date_appointed'),
                    'type' => $request->input('type'),
                    'church_id' => $user->church_id,
                    'church_branch_id' => $user->church_branch_id,

                ]);

                $groupMember = GroupMember::where('group_id', $groupId)
                                   ->where('member_id', $memberId)->first();
                $groupMember->status = 'Leader';
                $groupMember->save();

            }else{

                return redirect()->back()->with('error', 'Member is already a group leader.');
            }

            //LOG
            $user = Auth::user();
            $description = "User ". $user->id . " added a leader to group:  ". $group->name;
            $action = "Assign";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->back()->with('success', 'Member added as group leader successfully.');
    }

    public function revoke_leader(Request $request)
    {
        $user = Auth()->user();
        // Get the selected group
        $groupId = $request->input('GroupId');
        $group = Group::findOrFail($groupId);
        $memberId = $request->input('selectedId');

            // Check if the member already belongs to the group
            $result = GroupLeader::where('group_id', $groupId)->where('member_id', $memberId);
            $result->delete();

            $groupMember = GroupMember::where('group_id', $groupId)
                                   ->where('member_id', $memberId)->first();
                $groupMember->status = 'Member';
                $groupMember->save();

            //LOG
            $description = "User ". $user->id . " removed member as leader of group:  ". $group->name;
            $action = "Revoke";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->back()->with('success', 'Member leadership revoked.');
    }

    public function update_leader(Request $request)
    {
        $user = Auth()->user();

        // Get the selected group
        $groupId = $request->input('GroupId');
        $group = Group::findOrFail($groupId);
        $memberId = $request->input('selectedId');

            // Check if the member already belongs to the group
            $result = GroupLeader::where('group_id', $groupId)->where('member_id', $memberId)->first();
            $result->title = $request->input('title');
            $result->type = $request->input('type');
            $result->date_appointed = $request->input('date_appointed');
            $result->save();

            //LOG
            $description = "User ". $user->id . " udpated leader position in a group:  ". $group->name;
            $action = "Update";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->back()->with('success', 'Member leadership revoked.');
    }

}
