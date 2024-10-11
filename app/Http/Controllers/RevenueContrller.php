<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\JournalEntry;
use App\Models\LedgerEntry;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RevenueContrller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function revenueIndex(Request $request)
    {
        $user = Auth()->user();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($user->church_role == 3)
        {
            $journalEntry = JournalEntry::where('is_deleted', false)
            ->where('church_id', $user->church_id)
            ->where('church_branch_id', $user->church_branch_id)
            ->where('type', 'revenue')
            ->with('ledgerEntries')
            ->orderBy('created_at', 'desc')->get();

            // Apply filters if provided
            if ($startDate && $endDate) {
                $journalEntry->whereBetween('date', [$startDate, $endDate]);
            }

        }else{

            $journalEntry = JournalEntry::with('ledgerEntries')->where('is_deleted', false)
            ->where('church_id', $user->church_id)
            ->where('church_branch_id', $user->church_branch_id)
            ->where('type', 'revenue')
            ->orderBy('created_at', 'desc')->get();


            // Apply filters if provided
            if ($startDate && $endDate) {
                $journalEntry->whereBetween('payment_date', [$startDate, $endDate]);
            }

        }

        $expenseAccounts = Account::where('church_id', $user->church_id)
            ->where('church_branch_id', $user->church_branch_id)
            ->where('type', 'Expense')
            ->select('id', 'name', 'type')
            ->get();

        $assetAccounts = Account::where('church_id', $user->church_id)
                ->where('church_branch_id', $user->church_branch_id)
                ->where('type', 'Asset')
                ->select('id', 'name', 'type')
                ->get();

        $revenueAccounts = Account::where('church_id', $user->church_id)
                ->where('church_branch_id', $user->church_branch_id)
                ->where('type', 'Revenue')
                ->select('id', 'name', 'type')
                ->get();

        $equityAccounts = Account::where('church_id', $user->church_id)
                ->where('church_branch_id', $user->church_branch_id)
                ->where('type', 'Equity')
                ->select('id', 'name', 'type')
                ->get();

        $liabilityAccounts = Account::where('church_id', $user->church_id)
                ->where('church_branch_id', $user->church_branch_id)
                ->where('type', 'Liability')
                ->select('id', 'name', 'type')
                ->get();


        return view('finance.revenue.index', compact('journalEntry', 'startDate', 'endDate','expenseAccounts', 'assetAccounts','revenueAccounts', 'equityAccounts', 'liabilityAccounts'));
    }

    public function revenueStore(Request $request)
    {

        $user = Auth()->user();

        // dd($request);
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'entry_date' => 'required',
            'description' => 'required',
        ], [
            'amount.required' => 'State the expense amount',
            'entry_date.required' => 'State the expense date',
            'description.required' => 'Description is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Check your inputs.');
        }

        $amount = $request->amount;
        $debit_account = $request->account_id;
        $credit_account = $request->rec_account_id;

        $entry_date = $request->entry_date;
        $description = $request->description;

        //JOURNAL ENTRY

        DB::transaction(function() use ($user, $amount, $debit_account, $credit_account, $entry_date, $description, $request) {

            $journalEntry = JournalEntry::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'entry_date' => $entry_date,
                'description' => $description,
                'amount' => $amount,
                'is_deleted' => false,
                'is_approved' => false,
                'type' => 'revenue',
                'user_id' => auth()->id(),
            ]);

            // Debit accuonts
            LedgerEntry::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'journal_entry_id' => $journalEntry->id,
                'account_id' => $debit_account,
                'debit' => $amount,
                'credit' => 0,
                'is_deleted' => false,
                'is_approved' => false,
                'user_id' => auth()->id(),
            ]);

            // Credit cccount
            LedgerEntry::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'journal_entry_id' => $journalEntry->id,
                'account_id' => $credit_account,
                'debit' => 0,
                'credit' => $amount,
                'is_deleted' => false,
                'is_approved' => false,
                'user_id' => auth()->id(),
            ]);

            $description = "User ". $user->id . " recored a transaction. Journal entry: ". $journalEntry->id;
            $action = "Contra Entry";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        });


        return redirect()->route('revenue.index')->with('success', 'Revenue recorded successfully.');
    }

    public function getDetails($id)
    {

        $account = JournalEntry::with('ledgerEntries')->find($id);
        return response()->json($account);
    }

    public function financeShowDetails(Request $request, $journalID)
    {
        $user = Auth::user();

        $journalEntry = JournalEntry::with('ledgerEntries')
        ->find($journalID);

        // Check if no finances were found
        if ($journalEntry == null) {
            return back()->with('error', 'No matching records found.');
        }

        // Calculate total debit and credit balances
        $totalDebit = $journalEntry->ledgerEntries->sum('debit');
        $totalCredit = $journalEntry->ledgerEntries->sum('credit');

        $expenseAccounts = Account::where('church_id', $user->church_id)
                ->where('church_branch_id', $user->church_branch_id)
                ->where('type', 'Expense')
                ->select('id', 'name', 'type')
                ->get();

        $assetAccounts = Account::where('church_id', $user->church_id)
                ->where('church_branch_id', $user->church_branch_id)
                ->where('type', 'Asset')
                ->select('id', 'name', 'type')
                ->get();

        $revenueAccounts = Account::where('church_id', $user->church_id)
                ->where('church_branch_id', $user->church_branch_id)
                ->where('type', 'Revenue')
                ->select('id', 'name', 'type')
                ->get();

        $equityAccounts = Account::where('church_id', $user->church_id)
                ->where('church_branch_id', $user->church_branch_id)
                ->where('type', 'Equity')
                ->select('id', 'name', 'type')
                ->get();

        $liabilityAccounts = Account::where('church_id', $user->church_id)
                ->where('church_branch_id', $user->church_branch_id)
                ->where('type', 'Liability')
                ->select('id', 'name', 'type')
                ->get();

        return view('finance.revenue.journal_details', compact('journalEntry', 'expenseAccounts', 'assetAccounts','revenueAccounts', 'equityAccounts', 'liabilityAccounts'));
    }

    public function revenueUpdate (Request $request)
    {
        $user = Auth()->user();
        // dd($request);
        $validator = Validator::make($request->all(), [
            'entry_date' => 'required|date',
            'rec_account_id' => 'required|exists:accounts,id', // Debit account
            'account_id' => 'required|exists:accounts,id',      // Credit account
            'reference' => 'nullable|string',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation error.');
        }

        // Find the existing journal entry
        $journalEntry = JournalEntry::with('ledgerEntries')->find($request->selectedExpenseId);

        if (!$journalEntry) {
            return redirect()->back()->with('error', 'Journal Entry not found.');
        }

        $newAmount = $request->input('amount');
        $currentDebitEntry = $journalEntry->ledgerEntries->where('debit', '>', 0)->first();
        $currentCreditEntry = $journalEntry->ledgerEntries->where('credit', '>', 0)->first();

        // Update the journal entry fields
        $journalEntry->entry_date = $request->input('entry_date');
        $journalEntry->reference = $request->input('reference');
        $journalEntry->description = $request->input('description');
        $journalEntry->amount = $request->input('amount');
        $journalEntry->save();

        // Update debit entry (Expense Account)
        if ($currentDebitEntry) {
            // If the amount has changed, update the debit value and account
            $currentDebitEntry->account_id = $request->input('account_id');
            $currentDebitEntry->debit = $newAmount;  // Update with the new amount
            $currentDebitEntry->save();
        }

        // Update credit entry (Paid Through Account)
        if ($currentCreditEntry) {
            // If the amount has changed, update the credit value and account
            $currentCreditEntry->account_id = $request->input('rec_account_id');
            $currentCreditEntry->credit = $newAmount;  // Update with the new amount
            $currentCreditEntry->save();
        }

        return redirect()->back()->with('success', 'Expense updated successfully.');

    }


}
