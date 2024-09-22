<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Church;
use App\Models\Employee;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function accountIndex(Request $request)
    {
        $user = Auth::user();
        $accounts = Account::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->orderBy('name', 'asc')->get();
        return view('accounts.index', compact('accounts'));
    }

    public function accountStore(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'type' => 'required',
            'name' => 'required',
        ], [
            'type.required' => 'Please enter the type of the account.',
            'name.required' => 'Please enter account amount',

        ]);

        $account = Account::create([
            'name' => $request->name,
            'type' => $request->type,
            'church_id' => $church->id,
        ]);

            //LOG
            $description = "User ". $user->id . " added an account for ".$account->name;
            $action = "Create";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $church->id,
                'action' => $action,
                'description' => $description,
            ]);

        $anchor = $request->input('pane') ?? 'accounts';
        return redirect()->route('preference.index', '#'.$anchor)->with('success', 'Account created successfully.');
    }

    public function getDetails($accountId)
    {
        $account = Account::find($accountId);
        return response()->json($account);
    }

    public function accountUpdate(Request $request)
    {
        $user = Auth::user();
        $church =Church::first();

        $this->validate($request, [
            'type' => 'required',
            'name' => 'required',
        ], [
            'type.required' => 'Please enter the type of the account.',
            'name.required' => 'Please enter account amount',
        ]);

        $account_id = $request->input('selectedAccountId');
        $account= Account::find($account_id);
        $account->update($request->all());

            //LOG
            $description = "User ". $user->id . " modified ".$account->name;
            $action = "Update";

            $log = Log::create([
                'church_id' => $church->id,
                'user_id' => $user->id,
                'action' => $action,
                'description' => $description,
            ]);


        $anchor = $request->input('pane') ?? 'accounts';
        return redirect()->route('preference.index', '#'.$anchor)->with('success', 'Account updated successfully.');
    }

    public function accountDelete(Request $request)
    {
        $user = Auth::user();
        $church =Church::first();

        $account_id = $request->input('selectedAccountId');
        $account= Account::find($account_id);
        $account->save();

        $description = "User ". $user->id . " deleted " .$account->name;
        $action = "Delete";

        $log = Log::create([
            'church_id' => $church->id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);

        $anchor = $request->input('pane') ?? 'accounts';
        return redirect()->route('preference.index', '#'.$anchor)->with('success', 'Account deleted successfully.');

    }

    public function accountRestore(Request $request)
    {
        $user = Auth::user();
        $church =Church::first();

        $account_id = $request->input('selectedPay_accountId');
        $account= Account::find($account_id);
        $account->is_deleted = false;
        $account->save();

        $description = "User ". $user->id . " restored  " .$account->name;
        $action = "Restore";

        $log = Log::create([
            'church_id' => $church->id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);

        $anchor = $request->input('pane') ?? 'accounts';
        return redirect()->route('preference.index', '#'.$anchor)->with('success', 'Account retored successfully.');
    }

}
