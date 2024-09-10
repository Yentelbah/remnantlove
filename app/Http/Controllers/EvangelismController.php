<?php

namespace App\Http\Controllers;

use App\Models\Evangelism;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EvangelismController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $events = Evangelism::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();
        return view('evangelism.index', compact('events'));
    }

    // Store a new evangelism event
    public function store(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'date' => 'required',
        ], [
            'name.required' => 'Provide a name for the equipment',
            'description.required' => 'Provide a description for the equipment',
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

        $input = Evangelism::create($input);

        //LOG

        $description = "User ". $user->id . " created an evangelism event:  ". $input->id;
        $action = "Create";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('evangelism.index')->with('success', 'Evangelism event created successfully');
    }

    // View a specific event
    public function show($id)
    {

        $result = Evangelism::findOrFail($id);
        return response()->json($result);
    }

    // Update an evangelism event
    public function update(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'date' => 'required',
        ], [
            'name.required' => 'Provide a name for the equipment',
            'description.required' => 'Provide a description for the equipment',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $event = Evangelism::findOrFail($request->selectedId);
        $event->update($request->all());
        return redirect()->route('evangelism.index')->with('success', 'Evangelism event updated successfully');
    }

    // Delete an evangelism event
    public function destroy(Request $request)
    {
        $event = Evangelism::findOrFail($request->selectedId);
        $event->delete();
        return redirect()->route('evangelism.index')->with('success', 'Evangelism event deleted successfully');
    }
}
