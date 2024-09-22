<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Convert;
use App\Models\FoundationSchool;
use App\Models\GroupMember;
use App\Models\Log;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageUploadController extends Controller
{
    public function uploadLogo(Request $request)
    {
        $user = Auth()->user();
        $church = Church::findOrFail($user->church_id);

        $validator = Validator::make($request->all(), [
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image type and size
        ],[
            'photo.image' => 'File type must be jpeg, png, jpg, gif',
            'photo.max' => 'File must not exceed 2 MBs',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please check your inputs.');
        }

        // Delete the old photo if it exists
        if ($church->logo) {
            Storage::delete('public/' . $church->logo);
        }

        // Upload the new photo
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store("public/churches/{$church->churchID}/logo");
            $cleanedPath = str_replace('public/', '', $path);
            $church->logo = $cleanedPath;
            $church->save();  // Save changes to the member's photo
        }

        // Log the action
        $description = "User " . $user->id . " uploaded church logo.";
        $action = "Upload";

        Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);


        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }

    public function member(Request $request)
    {
        $user = Auth()->user();
        $church = Church::findOrFail($user->church_id);

        $validator = Validator::make($request->all(), [
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image type and size
        ],[
            'photo.image' => 'File type must be jpeg, png, jpg, gif',
            'photo.max' => 'File must not exceed 2 MBs',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please check your inputs.');
        }

        $member = Member::findOrFail($request->member_id);

        // Delete the old photo if it exists
        if ($member->photo) {
            Storage::delete('public/' . $member->photo);
        }

        // Upload the new photo
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store("public/churches/{$church->churchID}/profile_pics");
            $cleanedPath = str_replace('public/', '', $path);
            $member->photo = $cleanedPath;
            $member->save();  // Save changes to the member's photo
        }

        // Log the action
        $description = "User " . $user->id . " uploaded member photo.";
        $action = "Upload";

        Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);

        // Additional member details
        $groups = GroupMember::where('member_id', $request->member_id)->count();
        $groupDetails = GroupMember::with('group')->where('member_id', $request->member_id)->get();

        return view('member.member_details', compact('member', 'groups', 'groupDetails'))
            ->with('success', 'Image uploaded successfully.');
    }

    public function foundation_school(Request $request)
    {
        $user = Auth()->user();
        $church = Church::findOrFail($user->church_id);

        $validator = Validator::make($request->all(), [
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image type and size
        ],[
            'photo.image' => 'File type must be jpeg, png, jpg, gif',
            'photo.max' => 'File must not exceed 2 MBs',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please check your inputs.');
        }

        $student = FoundationSchool::find($request->member_id);
        $convert = Convert::find($student->convert_id);
        $member = Member::findOrFail($convert->member_id);

        // Delete the old photo if it exists
        if ($member->photo) {
            Storage::delete('public/' . $member->photo);
        }

        // Upload the new photo
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store("public/churches/{$church->churchID}/profile_pics");
            $cleanedPath = str_replace('public/', '', $path);
            $member->photo = $cleanedPath;
            $member->save();  // Save changes to the member's photo
        }

        // Log the action
        $description = "User " . $user->id . " uploaded member photo.";
        $action = "Upload";

        Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('foundation-school.index')->with('success', 'Image uploaded successfully.');

    }

    public function user(Request $request)
    {
        $user = Auth()->user();
        $church = Church::findOrFail($user->church_id);

        $validator = Validator::make($request->all(), [
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image type and size
        ],[
            'photo.image' => 'File type must be jpeg, png, jpg, gif',
            'photo.max' => 'File must not exceed 2 MBs',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please check your inputs.');
        }

        $user = User::find($user->id);

        // Delete the old photo if it exists
        if ($user->profile_photo_path) {
            Storage::delete('public/' . $user->profile_photo_path);
        }

        // Upload the new photo
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store("public/churches/{$church->churchID}/profile_pics");
            $cleanedPath = str_replace('public/', '', $path);
            $user->profile_photo_path = $cleanedPath;
            $user->save();  // Save changes to the member's photo
        }

        // Log the action
        $description = "User " . $user->id . " uploaded user photo.";
        $action = "Upload";

        Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);


        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }


}
