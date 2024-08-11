<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Church;
use App\Models\ChurchBranch;
use App\Models\Log;
use App\Models\Member;
use App\Models\Pastor;
use App\Models\User;
use Illuminate\Http\Request;

class ChurchBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth()->user();

        $branches = ChurchBranch::with('pastor.member')->where('church_id', $user->church_id)->get();
        $pastors = Pastor::where('church_id', $user->church_id)->get();

        return view('church_branches.index', compact('branches','pastors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth()->user();

        $pastors = Pastor::where('church_id', $user->church_id)->get();
        return view('church_branches.create', compact('pastors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth()->user();

        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable',
        ]);

        $pastor = Pastor::find($request->pastor_id);
        $member = Member::find($pastor->member_id);
        $user = User::where('member_id', $member->id)->first();

        $input = $request->all();
        $input['church_id'] = $user->church_id;
        $input['pastor_id'] = $request->pastor_id;

        $branch = ChurchBranch::create($input);

        $pastor->church_branch_id = $branch->id;
        $pastor->save();

        $member->church_branch_id = $branch->id;
        $member->save();

        $user->church_branch_id = $branch->id;
        $user->save();

        $accounts = [
            ['name' => 'Cash Accounts', 'type' => 'Asset', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Bank Accounts', 'type' => 'Asset', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Mobile Money Accounts', 'type' => 'Asset', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Accounts Receivable', 'type' => 'Asset', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Loan Receivable', 'type' => 'Asset', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Prepaid Expenses', 'type' => 'Asset', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Fixed Assets', 'type' => 'Asset', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Accumulated Depreciation', 'type' => 'Asset', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Accounts Payable', 'type' => 'Liability', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Notes Payable', 'type' => 'Liability', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Accrued Liabilities', 'type' => 'Liability', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Capital', 'type' => 'Equity', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Capital Contribution', 'type' => 'Equity', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Loan Acquired', 'type' => 'Liability ', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Retained Earnings', 'type' => 'Equity', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Interest Income', 'type' => 'Revenue', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Tithes', 'type' => 'Revenue', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Donation Received', 'type' => 'Revenue', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Offering', 'type' => 'Revenue', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Sales Revenue', 'type' => 'Revenue', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Service Revenue', 'type' => 'Revenue', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Cost of Goods Sold', 'type' => 'Expense', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Donation Paid', 'type' => 'Expense', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Operating Expenses', 'type' => 'Expense', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Salaries and Wages', 'type' => 'Expense', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Rent Expense', 'type' => 'Expense', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Utilities Expense', 'type' => 'Expense', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Depreciation Expense', 'type' => 'Expense', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Advertising Expense', 'type' => 'Expense', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
            ['name' => 'Insurance Expense', 'type' => 'Expense', 'church_id' => $user->church_id, 'church_branch_id' => $branch->id,],
        ];

        foreach ($accounts as &$account) {
            Account::create($account);
        }



                //LOG
                $description = "User ". $user->id . " created a church branch.";
                $action = "Create";

                $log = Log::create([
                    'church_id' => $user->church_id,
                    'church_branch_id' => $user->church_branch_id,
                    'user_id' => $user->id,
                    'action' => $action,
                    'description' => $description,
                ]);

        return redirect()->route('branch.index')->with('success', 'Branch created successfully.');

    }

    public function getDetails($id)
    {
        $church = ChurchBranch::find($id);
        return response()->json($church);
    }

    public function update (Request $request)
    {
        $user = Auth()->user();

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

        $branch = ChurchBranch::find($request->selectedId);
        $input = $request->all();

        $pastor = Pastor::find($request->pastor_id);
        $member = Member::find($pastor->member_id);
        $user = User::where('member_id', $member->id)->first();

        $branch->update($input);

        $pastor->church_branch_id = $branch->id;
        $pastor->save();

        $member->church_branch_id = $branch->id;
        $member->save();

        $user->church_branch_id = $branch->id;
        $user->save();



        //LOG

        $description = "User ". $user->id . " updated branch details.";
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

    public function delete(Request $request)
    {
        $user = Auth()->user();

        $id = $request->input('selectedId');
        $result = ChurchBranch::findOrFail($id);
        $result->delete();

            //LOG
            $description = "User ". $user->id . " deleted a event: ". $result->id ;
            $action = "Delete";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('branch.index')->with('success', 'Branch deleted successfully.');
    }
}
