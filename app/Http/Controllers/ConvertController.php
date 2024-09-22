<?php

namespace App\Http\Controllers;

use App\Models\Convert;
use App\Models\FoundationModule;
use App\Models\FoundationSchool;
use App\Models\FoundationSchoolModule;
use App\Models\Log;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConvertController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $converts = Convert::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->where('status', '!=', 'Joined')->get();
        return view('converts.index', compact('converts'));
    }

    // Show form to create a new convert
    public function create()
    {
        return view('converts.create');
    }

    // Store a new convert
    public function store(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
            'location' => 'required|string|max:255',
        ], [
            'name.required' => 'Provide a name of the visitor',
            'phone.required' => 'Enter the phone number of the visitor',
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

        $input = Convert::create($input);
        //LOG

        $description = "User ". $user->id . " added a new convert:  ". $input->id;
        $action = "Create";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('converts.index')->with('success', 'Convert created successfully');
    }

    // View a specific convert
    public function show($id)
    {

        $result = Convert::findOrFail($id);
        return response()->json($result);

    }

    public function status(Request $request)
    {
        // dd($request);
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ], [
            'status.required' => 'Select a status for the covert',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        if ($request->status ==='Joined')
        {
            $convert = Convert::findOrFail($request->selectedId);

            $member['name'] = $convert->name;
            $member['gender']= $convert->gender;
            $member['phone']= $convert->phone;
            $member['email']= $convert->email;
            $member['location']= $convert->location;
            $member['church_id'] = $user->church_id;
            $member['church_branch_id'] = $user->church_branch_id;

            $member = Member::create($member);
            $convert->member_id = $member->id;
            $convert->status = $request->status;
            $convert->update($request->all());

            $student['convert_id'] = $convert->id;
            $student['enrollment_date'] = $convert->updated_at;
            $student['gender']= $convert->gender;
            $student['church_id'] = $user->church_id;
            $student['church_branch_id'] = $user->church_branch_id;

            $student = FoundationSchool::create($student);

            $modules = FoundationModule::where('church_id', $user->church_id)
            ->where('church_branch_id', $user->church_branch_id)
            ->get();

            // Loop through each module and create a record for the student
            foreach ($modules as $module) {
                FoundationSchoolModule::create([
                    'foundation_school_id' => $student->id, // Student ID or Convert ID
                    'module_id' => $module->id,             // Module ID
                    'progress_status' => 'Not Started',              // Initial status can be 'not_started'
                    'church_id' => $user->church_id,
                    'church_branch_id' => $user->church_branch_id
                ]);

            }

            return redirect()->route('converts.index')->with('success', 'Convert has been enrolled onto the Foundation School successfully');

        }
        else
        {
            $convert = Convert::findOrFail($request->selectedId);

            $convert->update($request->all());

            return redirect()->route('converts.index')->with('success', 'Convert status updated successfully');

        }


    }


    // Show form to edit a convert
    public function edit($id)
    {
        $convert = Convert::findOrFail($id);
        return view('converts.edit', compact('convert'));
    }

    // Update a convert
    public function update(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
            'location' => 'required|string|max:255',
        ], [
            'name.required' => 'Provide a name of the visitor',
            'phone.required' => 'Enter the phone number of the visitor',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $convert = Convert::findOrFail($request->selectedId);
        $convert->update($request->all());

        //LOG

        $description = "User ". $user->id . " updated ionformation of a new convert:  ". $convert->id;
        $action = "Update";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('converts.index')->with('success', 'Convert updated successfully');
    }

    // Delete a convert
    public function destroy(Request $request)
    {
        $user = Auth()->user();

        $convert = Convert::findOrFail($request->selectedId);
        $convert->delete();


        //LOG

        $description = "User ". $user->id . " deleted ionformation of a new convert:  ". $convert->id;
        $action = "Delete";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('converts.index')->with('success', 'Convert deleted successfully');
    }
}
