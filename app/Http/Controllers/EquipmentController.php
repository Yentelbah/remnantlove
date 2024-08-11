<?php

namespace App\Http\Controllers;

use App\Exports\EquipmentExport;
use App\Models\Church;
use App\Models\Equipment;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class EquipmentController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $equipments = Equipment::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();
        return view ('equipment.index', compact('equipments'));
    }

    public function create(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
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

        $input = Equipment::create($input);

            //LOG

            $description = "User ". $user->id . " created a equipment:  ". $input->id;
            $action = "Create";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->route('equipment.index')->with('success', 'Equipment created successfully.');
    }

    public function details($id)
    {
        $result = Equipment::find($id);
        return response()->json($result);
    }

    public function update (Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
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

        $id = $request->input('selectedId');
        $result = Equipment::findOrFail($id);
        $result->name = $request->name;
        $result->description = $request->description;
        $result->date_acquired = $request->date_acquired;
        $result->save();

            //LOG
            $description = "User ". $user->id . " modified a equipment: ". $result->id;
            $action = "Update";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('equipment.index')->with('success', 'Equipment updated successfully.');

    }

    public function delete(Request $request)
    {
        $user = Auth()->user();

        $id = $request->input('selectedId');
        $result = Equipment::findOrFail($id);
        $result->delete();

            //LOG
            $description = "User ". $user->id . " deleted a equipment: ". $result->id;
            $action = "Delete";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->route('equipment.index')->with('success', 'Equipment deleted successfully.');
    }

    public function export(Request $request)
    {
        $user = Auth()->user();

        //LOG

        $description = "User ". $user->id . " downloaded equipments data.";
        $action = "Download";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return Excel::download(new EquipmentExport, 'equipments.xlsx');
    }



}
