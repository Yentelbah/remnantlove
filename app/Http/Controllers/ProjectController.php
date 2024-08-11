<?php

namespace App\Http\Controllers;

use App\Exports\ProjectsExport;
use App\Models\Log;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ProjectController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $projects = Project::all();
        return view ('project.index', compact('projects'));
    }

    public function create(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'Provide a name for the project',
            'description.required' => 'Describe the project',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $input = $request->all();
        $input ['church_id'] = $user->church_id;
        $input ['church_branch_id'] = $user->church_branch_id;
        $input = Project::create($input);

            //LOG
            $description = "User ". $user->id . " created a project:  ". $input->id;
            $action = "Create";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->route('project.index')->with('success', 'Project created successfully.');
    }

    public function details($id)
    {
        $result = Project::find($id);
        return response()->json($result);
    }

    public function update (Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'Provide a name for the project',
            'description.required' => 'Describe the project',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $id = $request->input('selectedId');
        $result = Project::findOrFail($id);
        $result->name = $request->name;
        $result->description = $request->description;
        $result->start_date = $request->start_date;
        $result->end_date = $request->end_date;
        $result->save();

            //LOG
            $description = "User ". $user->id . " modified a project: ". $result->id;
            $action = "Update";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                    'action' => $action,
                'description' => $description,
            ]);

        return redirect()->route('project.index')->with('success', 'Project updated successfully.');

    }

    public function delete(Request $request)
    {
        $user = Auth()->user();

        $id = $request->input('selectedId');
        $result = Project::findOrFail($id);
        $result->delete();

            //LOG
            $description = "User ". $user->id . " deleted a project: ". $result->id;
            $action = "Delete";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                    'action' => $action,
                'description' => $description,
            ]);

        return redirect()->route('project.index')->with('success', 'Project deleted successfully.');
    }

}
