<?php

namespace App\Http\Controllers;

use App\Models\Convert;
use App\Models\FoundationSchool;
use App\Models\Log;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConvertController extends Controller
{
    public function index()
    {
        $converts = Convert::all();
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

            $member['name'] = $convert->church_id;
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
        }
        else
        {
            $convert = Convert::findOrFail($request->selectedId);

            $convert->update($request->all());
        }


        return redirect()->route('converts.index')->with('success', 'Convert status updated successfully');
    }


    // Show form to edit a convert
    public function edit($id)
    {
        $convert = Convert::findOrFail($id);
        return view('converts.edit', compact('convert'));
    }

    // Update a convert
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'contact_info' => 'required',
        ]);

        $convert = Convert::findOrFail($id);
        $convert->update($request->all());
        return redirect()->route('converts.index')->with('success', 'Convert updated successfully');
    }

    // Delete a convert
    public function destroy($id)
    {
        $convert = Convert::findOrFail($id);
        $convert->delete();
        return redirect()->route('converts.index')->with('success', 'Convert deleted successfully');
    }
}
