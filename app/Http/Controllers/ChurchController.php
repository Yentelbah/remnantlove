<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Employee;
use App\Models\Log;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChurchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function churchIndex()
    {
        $user = Auth()->user();

        $church = Church::find($user->church_id);
        return view('church.index', compact('church'));

    }

    public function getDetails($churchId)
    {
        $church = Church::find($churchId);
        return response()->json($church);
    }

    public function churchUpdate(Request $request)
    {
        $user= Auth()->user();
        $church = Church::find($user->church_id);

        $this->validate($request, [
            'name' => 'required|max:100',
            'phone' => 'required',
            'city' => 'required',
        ], [
            'name.required' => 'Please enter the name of the church.',
            'name.max' => 'You have entered too many characters',
            'phone.required' => 'Please enter church phone',
            'city.required' => 'Please enter church location',

        ]);

        $church->update($request->all());
        $church->save();

        //LOG
        $description = "User ". $user->id . " updated the church details.";
        $action = "Update";

        $log = Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->back()->with('success', 'Church updated successfully.');
    }

    public function uploadLogo(Request $request)
    {
        $user= Auth()->user();

        $this->validate($request, [
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $church = Church::findOrFail($user->church_id);

        // Delete the old logo if it exists
        if ($church->logo) {
            Storage::delete('public/' . $church->logo);
        }

        // Upload the new logo
        if ($request->hasFile('logo')) {

            $churchFolderPath = "companies/{$church->churchId}/logo";
            $imagePath = $request->file('logo')->store("public/{$churchFolderPath}");
            $church->logo = str_replace('public/', '', $imagePath);
            $church->save();
        }


        //LOG
        $description = "User ". $user->id . " uploaded church logo.";
        $action = "Update";

        $log = Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);


        return redirect()->back()->with('success', 'Logo uploaded successfully');
    }

}
