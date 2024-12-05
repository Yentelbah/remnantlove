<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\Log;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{

    public function index()
    {
        $user = Auth()->user();

        $members = Member::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->orderBy('name', 'asc')->get();

        // Retrieve familys with member counts
        $family = Family::withCount('members')->where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->orderBy('name', 'asc')->get();

        return view('family.index', compact('family', 'members'));
    }

    public function create(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $input = $request->all();
        $input['church_id'] = $user->church_id;
        $input['church_branch_id'] = $user->church_branch_id;
        $input = Family::create($input);

            //LOG
            $description = "User ". $user->id . " created a family:  ". $input->id;
            $action = "Create";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->route('family.index')->with('success', 'Family created successfully.');
    }

    public function details($id)
    {
        $result = Family::find($id);
        return response()->json($result);
    }

    public function update (Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $id = $request->input('selectedId');
        $result = Family::findOrFail($id);
        $result->name = $request->name;
        $result->description = $request->description;
        $result->save();

            //LOG
            $description = "User ". $user->id . " modified a family: ". $result->id;
            $action = "Update";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('family.index')->with('success', 'Family updated successfully.');

    }

    public function delete(Request $request)
    {
        $user = Auth()->user();

        $id = $request->input('selectedId');
        $result = Family::findOrFail($id);
        $result->delete();

            //LOG
            $description = "User ". $user->id . " deleted a family: ". $result->id;
            $action = "Delete";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('family.index')->with('success', 'Family deleted successfully.');
    }

    public function add_member(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'member_ids.*' => 'exists:members,id',
            'relations.*' => 'in:Spouse,Child,Parent,Sibling,Other',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Some inputs are missing or invalid.');
        }

        $familyId = $request->input('FamilyId');
        $family = Family::findOrFail($familyId);

        // Decode JSON strings to arrays
        $memberIds = json_decode($request->input('member_ids'), true);
        $relations = json_decode($request->input('relations'), true);

        // Check if decoding was successful
        if (!is_array($memberIds) || !is_array($relations)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid data format received.');
        }

        // Process the selected members and their relations
        foreach ($memberIds as $index => $memberId) {
            $relation = $relations[$index];

            // Check if the member already belongs to the family
            $exists = FamilyMember::where('family_id', $familyId)
                                  ->where('member_id', $memberId)
                                  ->exists();

            if (!$exists) {
                // If the member does not exist in the family, create a new record
                FamilyMember::create([
                    'family_id' => $familyId,
                    'member_id' => $memberId,
                    'relation' => $relation,
                ]);
            }
        }

        // Log the action
        $description = "User ". $user->id . " added members to family:  ". $family->name;
        $action = "Family Relation";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('family.index')->with('success', 'Members added to the family successfully.');
    }

    public function familyList(Request $request, $id)
    {
        $user = Auth()->user();

        $thisFamily = Family::find($id);

        $familyMembers = $thisFamily->members()
            ->leftJoin('members as m', 'family_members.member_id', '=', 'm.id')
            ->select('family_members.*', 'm.id', 'm.name', 'm.member_number')
            ->get();



        // Extract member IDs from family members
        $familyMemberIds = $familyMembers->pluck('member_id')->toArray();

        $belongToOtherFamily = FamilyMember::whereNotIn('id', $familyMemberIds)->get();

        $otherWithFamilies = $belongToOtherFamily->pluck('member_id')->toArray();
        // Exclude these IDs from all members
        $members = Member::where('church_id', $user->church_id)
            ->whereNotIn('id', $familyMemberIds)
            ->whereNotIn('id', $otherWithFamilies)
            ->orderBy('name', 'asc')
            ->get();

        return view('family.family_member_list', compact('members', 'thisFamily', 'familyMembers'));
    }

    public function members(Request $request, $id)
    {
        $user = Auth()->user();
        $thisFamily = Family::find($id);

        $familyMembers = $thisFamily->members()
            ->leftJoin('members as m', 'family_members.member_id', '=', 'm.id')
            ->select('family_members.*', 'm.id', 'm.name', 'm.member_number')
            ->get();

        return view('family.family_member', compact('familyMembers', 'thisFamily'));
    }

    public function remove_member(Request $request)
    {
        $user = Auth()->user();

        // Get the selected family
        $familyId = $request->input('familyID');
        $family = Family::findOrFail($familyId);
        $memberIds = explode(',', $request->input('members'));

        foreach ($memberIds as $memberId) {
            // Check if the member already belongs to the family
            $result = FamilyMember::where('family_id', $familyId)->where('member_id', $memberId);
            $result->delete();
        }

            //LOG
            $description = "User ". $user->id . " removed member from family:  ". $family->name;
            $action = "Disjoin";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->back()->with('success', 'Members remove from the family successfully.');
    }

    public function update_member_relation(Request $request)
    {
        $user = Auth()->user();

        // Get the selected family
        $familyId = $request->input('familyId');
        $family = Family::find($familyId);
        $result = FamilyMember::where('family_id', $familyId)->where('member_id', $request->member_id)->first();
        $result->relation = $request->relation;
        $result->save();

            //LOG
            $description = "User ". $user->id . " updated the member relation in a family:  ". $family->name;
            $action = "Change family relationship";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->back()->with('success', 'Member relationship in family updated successfully.');
    }

    public function relation_details($id)
    {
        $result = Member::find($id);
        $family = FamilyMember::where('member_id', $result->id)->first();

        $memberName = $result->name;
        $memberId = $result->id;
        $relation = $family->relation;

        return response()->json([
            'memberName' => $memberName,
            'memberId' => $memberId,
            'relation' => $relation,
        ]);
    }

}
