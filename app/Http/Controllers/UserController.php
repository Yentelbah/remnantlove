<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\ChurchRole;
use App\Models\CreditsAccount;
use App\Models\CreditsTransaction;
use App\Models\Log;
use App\Models\Member;
use App\Models\User;
use App\Notifications\accountCreationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userIndex()
    {

        $user = Auth()->user();
        $role = $user->churchRole->role->name;

        if ($role === "Church_admin") {

           $users = User::where('church_id', $user->church_id)->whereNotIn('status', ['Inactive'])->get();
           $roles = ChurchRole::where('church_id', $user->church_id)->get();


        }elseif ($role === "Branch_admin") {
           $users = User::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->whereNotIn('status', ['Inactive'])->get();
           $roles = ChurchRole::where('church_id', $user->church_id)->whereNotIn('role_id', [1,2])->get();


        }else {

           $users = User::where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->whereNotIn('status', ['Inactive'])->get();
           $roles = ChurchRole::where('church_id', $user->church_id)->whereNotIn('role_id', [1,2])->get();

        }

        return view ('users.index', compact('users', 'roles'));

    }

    public function getDetails($userId)
    {
        $user = User::find($userId);
        return response()->json($user);
    }

    public function userUpdate(Request $request)
    {
        $user = Auth()->user();

        $this->validate($request, [
            'name' => 'required|max:100',
            'role' => 'required'
        ], [
            'name.required' => 'Please enter the name of the user.',
            'name.max' => 'You have entered too many characters',
            'role.required' => 'Please select a role',
        ]);

        $user_id = $request->input('selectedUserId');
        $userAccount = User::find($user_id);

        if($user->id == $user_id){
            return redirect()->back()->with('error', 'Your role cannot be changed.');
        }

        if ($userAccount) {
            $userAccount->update([
                'church_role_id' => $request->role,
            ]);


            $description = "User ". $user->id . " changed the role of user ".$userAccount->id;
            $action = "Update";

            $log = Log::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'user_id' => $user->id,
                'action' => $action,
                'description' => $description,
            ]);

            return redirect()->route('user.index')->with('success', 'User role changed successfully.');

        } else {

            return redirect()->route('user.index', )->with('error', 'User not found.');
        }
    }

    public function userStore(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'role' => 'required'
        ], [
            'name.required' => 'Please enter the name of the user.',
            'name.max' => 'You have entered too many characters',
            'role.required' => 'Please select a role',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $member = Member::find($request->member_id);
        $oldAccount = User::where('member_id', $request->member_id)->first();

        // dd($oldAccount);

        if($oldAccount == null)
        {
            $password = $this->generateRandomString();

            $userAccount = User::create([
                'name' => $request['name'],
                'email' => $member->email,
                'password' => Hash::make($password),
                'phone' => $member->phone,
                'church_role_id' => $request->role,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'member_id' =>$member->id,
            ]);

            $phone = $userAccount->phone;
            $message = 'Welcome to Faithflow ' . $userAccount->name . '!. An account has been created for you. You account details are: Email: ' . $userAccount->email . ' Password: ' . $password . '. Visit: www.faithflow.yensoftgh.com. Thank you.';
                        //Log
                        $description = "User ". $user->id . " created a user account ". $userAccount->id;
                        $action = "Account creation";

        }else{
            $oldAccount->is_deleted = false;
            $oldAccount->status = 'active';
            $oldAccount->save();

            $phone = $oldAccount->phone;
            $message = 'Welcome Back ' . $oldAccount->name . '!. Your account has been restored. You details are: Email: ' . $oldAccount->email . ' Update or use your old password. Visit: www.faithflow.yensoftgh.com Thank you.';

                        //Log
                        $description = "User ". $user->id . " updated a user account ". $oldAccount->id;
                        $action = "Account restoration";

        }

        $creditsUsed = 2;

        $account = CreditsAccount::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->first();
        $new_balance = $account->balance - $creditsUsed;
        $account->balance = $new_balance;
        $account->save();

        $uniqueNumber = $this->uniqueNumber();

        CreditsTransaction::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'number_of_credits' =>$creditsUsed,
            'type' => "Decrease",
            'uniqueId' => $uniqueNumber
        ]);

        $schdule=false;
        $delivery = null;
        $senderID = $account->senderID;

        try {
            // Assuming ReminderNotification has a method to send SMS directly
            (new accountCreationNotification($phone, $senderID, $message, $schdule, $delivery))->sendSMS();

        } catch (\Exception $e) {
            // Handle notification sending failure
            return redirect()->back()->with('error', 'Failed to send notification: ' . $e->getMessage());
        }

            //Log

            $log = Log::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'user_id' => $user->id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->route('user.index')->with('success', 'User role created successfully.');

    }

    private function uniqueNumber()
    {
        $year = date('y');
        $month = date('m');
        $randomNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $newExeId = $year . $month . $randomNumber;
        $newNumber = $newExeId;
        return $newNumber;
    }

    private function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    public function userAccountBlock(Request $request)
    {
        $user = Auth()->user();


        $account= User::find($request->selectedUserId);

        if($user->id == $account->id){
            return redirect()->back()->with('error', 'You cannot block your account.');
        }

        $account->status = 'Blocked';
        $account->save();

         //LOG
         $description = "User ". $user->id . " blocked the access of user " .$account->id;
         $action = "Block";

         $log = Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
         ]);

        return redirect()->route('user.index')->with('success', 'User account access blocked successfully.');
    }

    public function userAccountRestore(Request $request)
    {
        $user = Auth()->user();

        $account= User::find($request->selectedUserId);
        $account->status = 'Active';
        $account->save();

         //LOG
         $description = "User ". $user->id . " restored the access of user " .$account->id;
         $action = "Block";

         $log = Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
         ]);

        return redirect()->route('user.index')->with('success', 'User account access restored successfully.');
    }

    public function userDelete(Request $request)
    {
        $user = Auth()->user();

        $user_id = $request->input('selectedUserId');

        if($user->id == $user_id){
            return redirect()->back()->with('error', 'Delete acction cannot be completed.');
        }

        $account= User::find($user_id);
        $account->is_deleted = true;
        $account->status = 'Inactive';
        $account->save();

         //LOG
        $description = "User ". $user->id . " deleted user " .$user_id;
        $action = "Delete";

        $log = Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');

    }

    public function Logs(Request $request)
    {
        $user = Auth::user();
        $role = $user->churchRole->name;;

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $logs = Log::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();

        $totalLogs = $logs->count();

        return view('users.logs', compact('totalLogs', 'logs'));
    }

    // public function userRestore(Request $request)
    // {
    //     $user = Auth()->user();

    //     $user_id = $request->input('selectedUserId');
    //     $account= User::find($user_id);
    //     $account->is_deleted = false;
    //     $account->status = 'Blocked';
    //     $account->save();

    //      //LOG
    //     $description = "User ". $user->id . " restored a user " .$user_id;
    //     $action = "Restore";

    //     $log = Log::create([
    //         'church_id' => $user->church_id,
    //         'church_branch_id' => $user->church_branch_id,
    //         'user_id' => $user->id,
    //         'action' => $action,
    //         'description' => $description,
    //     ]);

    //     return redirect()->back()->with('success', 'User account restored successfully.');

    // }

    // public function userProfile(Request $request)
    // {
    //     $user = Auth::user();
    //     $userDetails = User::find($user->id);
    //     $employee = Employee::where('user_id', $user->id)->first();
    //     return view ('profile.profile', compact('userDetails','employee'));
    // }

    public function uploadProfileImg(Request $request)
    {
        $user = Auth()->user();

        $this->validate($request, [
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image type and size
        ]);

        $user = Auth::user();
        $profile = User::find($user->id);
        $church = Church::findOrFail($user->church_id);

        // Delete the old profile pic if it exists
        if ($profile->profile_pic) {
            Storage::delete('public/' . $profile->profile_pic);
        }

        // Upload the new logo
        if ($request->hasFile('logo')) {

            $churchFolderPath = "churches/{$church->churchID}/profile_pics";
            $imagePath = $request->file('logo')->store("public/{$churchFolderPath}");
            $profile->profile_pic = str_replace('public/', '', $imagePath);
            $profile->save();
        }

        //LOG
        $description = "User ". $user->id . " uploaded a profile image.";
        $action = "Upload";

        $log = Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->back()->with('success', 'Profile image uploaded successfully');
    }

}
