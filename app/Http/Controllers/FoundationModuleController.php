<?php

namespace App\Http\Controllers;

use App\Models\FoundationModule;
use App\Models\FoundationSchool;
use App\Models\FoundationSchoolModule;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FoundationModuleController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $modules = FoundationModule::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->orderby('module_name')->get();
        return view('foundation-modules.index', compact('modules'));
    }

    // Show form to create a new module
    public function create()
    {
        return view('foundation-modules.create');
    }

    // Store a new module
    public function store(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'module_name' => 'required',
            'description' => 'nullable|string',
        ], [
            'module_name.required' => 'Provide a module name',
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

        $input = FoundationModule::create($input);

        $students = FoundationSchool::where('church_id', $user->church_id)
        ->where('church_branch_id', $user->church_branch_id)
        ->whereNotIn('progress_status', ['Graduated', 'Dropped'])
        ->get();

        foreach($students as $student)
        {
            FoundationSchoolModule::create([
                'foundation_school_id' => $student->id,     // Student ID or Convert ID
                'module_id' => $input->id,                  // Module ID
                'progress_status' => 'Not Started',         // Initial status can be 'not_started'
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id
            ]);
        }

        //LOG
        $description = "User ". $user->id . " created a new module:  ". $input->id;
        $action = "Create";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('foundation-modules.index')->with('success', 'Module created successfully');
    }

    // View details of a specific module
    public function show($id)
    {
        $result = FoundationModule::findOrFail($id);
        return response()->json($result);

    }

    // Update a module
    public function update(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'module_name' => 'required',
            'description' => 'nullable|string',
        ], [
            'module_name.required' => 'Provide a model name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $module = FoundationModule::findOrFail($request->selectedId);
        $module->update($request->all());

        //LOG

        $description = "User ". $user->id . " updated an module:  ". $module->id;
        $action = "Update";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('foundation-modules.index')->with('success', 'Module updated successfully');
    }

    // Delete a module
    public function destroy(Request $request)
    {
        $user = Auth()->user();

        $module = FoundationModule::findOrFail($request->selectedId);
        $module->delete();

                //LOG

                $description = "User ". $user->id . " deleted a module:  ". $module->id;
                $action = "Delete";

                $log = Log::create([
                    'user_id' => $user->id,
                    'church_id' => $user->church_id,
                    'church_branch_id' => $user->church_branch_id,
                    'action' => $action,
                    'description' => $description,
                ]);

        return redirect()->route('foundation-modules.index')->with('success', 'Module deleted successfully');
    }
}
