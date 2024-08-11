<?php

namespace App\Http\Controllers;

use App\Exports\FacilityExport;
use App\Models\Church;
use App\Models\Facility;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class FacilityController extends Controller
{
    public function index()
    {
        $user = Auth()->user();
        $facilities = Facility::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();
        return view ('facility.index', compact('facilities'));
    }

    public function create(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'Provide a name for the facility',
            'description.required' => 'Provide a description for the facility',
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
        $input = Facility::create($input);

            //LOG
            $description = "User ". $user->id . " created a facility:  ". $input->id;
            $action = "Create";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->route('facility.index')->with('success', 'Facility created successfully.');
    }

    public function details($id)
    {
        $result = Facility::find($id);
        return response()->json($result);
    }

    public function update (Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'Provide a name for the facility',
            'description.required' => 'Provide a description for the facility',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $id = $request->input('selectedId');
        $result = Facility::findOrFail($id);
        $result->name = $request->name;
        $result->description = $request->description;
        $result->date_acquired = $request->date_acquired;
        $result->save();

            //LOG
            $description = "User ". $user->id . " modified a facility: ". $result->id;
            $action = "Update";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('facility.index')->with('success', 'Facility updated successfully.');

    }

    public function delete(Request $request)
    {
        $user = Auth()->user();

        $id = $request->input('selectedId');
        $result = Facility::findOrFail($id);
        $result->delete();

            //LOG
            $description = "User ". $user->id . " deleted a facility: ". $result->id;
            $action = "Delete";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('facility.index')->with('success', 'Facility deleted successfully.');
    }

    public function export(Request $request)
    {

        $user = Auth()->user();

        //LOG
        $description = "User ". $user->id . " downloaded facilities data.";
        $action = "Download";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return Excel::download(new FacilityExport, 'facilities.xlsx');
    }


}
