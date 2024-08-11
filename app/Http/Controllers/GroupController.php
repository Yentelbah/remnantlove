<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\GroupsExport;
use App\Models\Church;
use App\Models\Log;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class GroupController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $members = Member::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->orderBy('name', 'desc')->get();

        // Retrieve groups with member counts
        $groups = Group::withCount('members')->where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();

        // Map over groups to add leader information
        $groups = $groups->map(function ($group) {
            $leader = DB::table('group_leaders as gl')
                        ->leftJoin('members as m', 'gl.member_id', '=', 'm.id')
                        ->where('gl.group_id', $group->id)
                        ->where('gl.type', 'main') // Adjust this condition as per your 'main' status column in group_leaders table
                        ->select('m.name as leader_name')
                        ->first();

            $group->leader_name = $leader ? $leader->leader_name : null;
            return $group;
        });

        return view('group.index', compact('groups', 'members'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();

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
        $input = Group::create($input);

            //LOG
            $description = "User ". $user->id . " created a group:  ". $input->id;
            $action = "Create";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->route('group.index')->with('success', 'Group created successfully.');
    }

    public function details($id)
    {
        $result = Group::find($id);
        return response()->json($result);
    }

    public function update (Request $request)
    {
        $user = Auth::user();

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
        $result = Group::findOrFail($id);
        $result->name = $request->name;
        $result->description = $request->description;
        $result->save();

            //LOG
            $description = "User ". $user->id . " modified a group: ". $result->id;
            $action = "Update";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('group.index')->with('success', 'Group updated successfully.');

    }

    public function delete(Request $request)
    {
        $user = Auth::user();

        $id = $request->input('selectedId');
        $result = Group::findOrFail($id);
        $result->delete();

            //LOG
            $description = "User ". $user->id . " deleted a group: ". $result->id;
            $action = "Delete";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('group.index')->with('success', 'Group deleted successfully.');
    }

    public function export(Request $request)
    {

        $user = Auth::user();

        //LOG
        $description = "User ". $user->id . " downloaded groups data.";
        $action = "Download";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return Excel::download(new GroupsExport, 'groups.xlsx');
    }


}
