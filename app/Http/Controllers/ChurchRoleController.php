<?php

namespace App\Http\Controllers;

use App\Models\ChurchRole;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChurchRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function roleStore(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'name' => 'required',
            'role_id' => 'required|exists:roles,id'
        ], [
            'description.required' => 'Please enter the description of the role.',
            'name.required' => 'Please enter role amount',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }


        $role = ChurchRole::create([
            'name' => $request->name,
            'description' => $request->description,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'role_id' =>$request->role_id
        ]);

        //LOG
            $description = "User ". $user->id . " added a role ".$role->name;
            $action = "Create";

            $log = Log::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'user_id' => $user->id,
                'action' => $action,
                'description' => $description,
            ]);

        $anchor = $request->input('pane') ?? 'roles';
        return redirect()->route('preference.index', '#'.$anchor)->with('success', 'Role created successfully.');
    }

    public function getDetails($roleId)
    {
        $role = ChurchRole::find($roleId);
        return response()->json($role);
    }

    public function roleUpdate(Request $request)
    {
        $user = Auth()->user();

        $this->validate($request, [
            'description' => 'required',
            'name' => 'required',
            'role_id' => 'required|exists:roles,id'
        ], [
            'description.required' => 'Please enter the description of the role.',
            'name.required' => 'Please enter role amount',

        ]);


        $role_id = $request->input('selectedRoleId');
        $role= ChurchRole::find($role_id);
        $role->update($request->all());

            //LOG
            $description = "User ". $user->id . " modified ".$role->name;
            $action = "Update";

            $log = Log::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'user_id' => $user->id,
                'action' => $action,
                'description' => $description,
            ]);


        $anchor = $request->input('pane') ?? 'roles';
        return redirect()->route('preference.index', '#'.$anchor)->with('success', 'Role updated successfully.');
    }

    public function roleDelete(Request $request)
    {
        $user = Auth()->user();

        $role_id = $request->input('selectedRoleId');
        $role= ChurchRole::find($role_id);
        $role->delete();

        $description = "User ". $user->id . " deleted " .$role->name;
        $action = "Delete";

        $log = Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);

        $anchor = $request->input('pane') ?? 'roles';
        return redirect()->route('preference.index', '#'.$anchor)->with('success', 'Role deleted successfully.');

    }


}
