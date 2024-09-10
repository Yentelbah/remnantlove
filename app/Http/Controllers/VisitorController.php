<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Log;
use App\Models\Member;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VisitorController extends Controller
{
    public function index()
    {
        $user = Auth()->user();
        $visitors = Visitor::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->orderBy('date_visited', 'desc')->get();
        return view('visitors.index', compact('visitors'));
    }

    public function create()
    {
        return view('visitors.create');
    }

    public function store(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'date_visited' => 'required|date',
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

        $input = Visitor::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'date_visited' => $request->date_visited,
            'location' => $request->location,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
    ]);

            //LOG
            $description = "User ". $user->id . " added a visitor information:  ". $input->id;
            $action = "Create";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->route('visitors.index')->with('success', 'Visitor record created successfully.');
    }

    public function convertToMember($id)
    {
        $user = Auth()->user();

        $visitor = Visitor::findOrFail($id);

        $member = Member::create([
            'church_id' => $visitor->church_id, // Assuming you have a way to get church_id
            'church_branch_id' => $visitor->church_branch_id, // Assuming you have a way to get church_id
            'member_number' => null, // You can generate or leave it null
            'name' => $visitor->name,
            'gender' => null, // This should be collected from user input
            'dob' => null, // This should be collected from user input
            'marital_status' => null, // This should be collected from user input
            'email' => null, // This should be collected from user input
            'phone' => $visitor->phone,
            'address' => null, // This should be collected from user input
            'location' => $visitor->location,
            'photo' => null, // This should be collected from user input
            'is_deleted' => false,
        ]);

        $visitor->delete();

            //LOG
            $description = "User ". $user->id . " converted a visitor to member:  ". $member->id;
            $action = "Create";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->back()->with('success', 'Visitor converted to member successfully.');
    }
}
