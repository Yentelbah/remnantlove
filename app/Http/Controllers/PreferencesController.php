<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Church;
use App\Models\ChurchRole;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreferencesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth()->user();
        $role = $user->churchRole->role->name;

        $SystemAdmin = [2];

        $church = Church::where('id', $user->church_id)->first();
        $settings = Setting::where('church_id', $user->church_id)->first();
        $defaultRoles = Role::whereNotIn('id', [1,2])->orderBy('name', 'asc')->get();
        $churchRoles = ChurchRole::where('church_id', $user->church_id)->get();
        return view('preference.index', compact('settings', 'role',  'defaultRoles', 'church', 'churchRoles'));
    }

    public function settings()
    {
        $user = Auth()->user();
        $settings = Setting::where('church_id', $user->church_id)->first();
        return view('preference.settings', compact('settings'));
    }

    public function updateNotification(Request $request)
    {
        $user = Auth()->user();

        // Get the checkbox value (true if checked, false if unchecked)
        $notification = $request->notification;
        $settings = Setting::where('church_id',  $user->church_id)->first();

        if (is_null($settings)) {
            $settings = Setting::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
            ]);
        }

        if($notification == 'true'){
            $settings->pay_notification = true;
            $settings->save();

        }else{
            $settings->pay_notification = false;
            $settings->save();

        }

        return redirect()->route('settings.index')->with('success', 'Payment SMS notification settings updated successfully.');
    }

    public function sms_notification(Request $request)
    {
        $user = Auth()->user();

        // Get the checkbox value (true if checked, false if unchecked)
        $notification = $request->notification;
        $settings = Setting::where('church_id',  $user->church_id)->first();

        if (is_null($settings)) {
            $settings = Setting::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
            ]);
        }


        if($notification == 'true'){
            $settings->sms_notification = true;
            $settings->save();

        }else{
            $settings->sms_notification = false;
            $settings->save();

        }

        return redirect()->route('settings.index')->with('success', 'SMS notification settings updated successfully.');
    }


}
