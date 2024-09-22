<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Church;
use App\Models\JournalEntry;
use App\Models\LedgerEntry;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function financeIndex()
    {
        $user = Auth()->user();

        // Account names
        $accountNames = [ 'Cash Accounts', 'Bank Accounts', 'Mobile Money Accounts' ];

        $accountBalances = [];

        foreach ($accountNames as $accountName)
        {
            // Find the account
            $account = Account::where('church_id', $user->church_id)
            ->where('church_branch_id', $user->church_branch_id)
            ->where('name', $accountName)
            ->first();

            if ($account) {
                // Get ledger entries associated with the account
                $ledgerEntries = LedgerEntry::where('church_id', $user->church_id)
                ->where('church_branch_id', $user->church_branch_id)
                ->where('account_id', $account->id)
                ->get();
                // dd($account, $ledgerEntries);

                // Calculate the balance
                $balance = $ledgerEntries->sum('debit') - $ledgerEntries->sum('credit');

                // pass each balance
                $accountBalances[$accountName] = $balance;

            } else {
                // Handle the case when the account is not found
                $accountBalances[$accountName] = 'Account not found';        }
        }

        $transactions = JournalEntry::where('is_deleted', false)
            ->where('church_id', $user->church_id)
            ->where('church_branch_id', $user->church_branch_id)
            ->orderBy('created_at', 'desc')->get();

        $accountsCount = Account::where('church_id', $user->church_id)
            ->where('church_branch_id', $user->church_branch_id)
            ->count();

            $accountTypes = ['Asset', 'Liability', 'Equity', 'Revenue', 'Expense'];

            // Fetch accounts grouped by type
            $accounts = Account::where('church_id', $user->church_id)
                                ->where('church_branch_id', $user->church_branch_id)
                                ->select('id', 'name', 'type')
                                ->get()
                                ->groupBy('type');

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



        return view ('finance.index', compact('transactions', 'accountBalances','accountsCount', 'accountTypes', 'accounts', 'expenseAccounts', 'assetAccounts','revenueAccounts'));
    }

    public function Entry(Request $request)
    {
        $user = Auth()->user();

        $accountTypes = ['Asset', 'Liability', 'Equity', 'Revenue', 'Expense'];

        // Fetch accounts grouped by type
        $accounts = Account::where('church_id', $user->church_id)
                            ->where('church_branch_id', $user->church_branch_id)
                            ->select('id', 'name', 'type')
                            ->get()
                            ->groupBy('type');

        return view('finance.recordTransaction', compact('accountTypes', 'accounts'));
    }



    public function Transactions(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'entry_date' => 'required|date',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Check your inputs.');
        }

        // Find relevant accounts
        $amount = $request->amount;
        $debit_account = $request->account_id;
        $credit_account = $request->rec_account_id;

        $entry_date = $request->entry_date;
        $description = $request->description;

        //JOURNAL ENTRY

        DB::transaction(function() use ($user, $amount, $debit_account, $credit_account, $entry_date, $description) {

            $journalEntry = JournalEntry::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'entry_date' => $entry_date,
                'description' => $description,
                'amount' => $amount,
                'is_deleted' => false,
                'is_approved' => false,
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

        return redirect()->route('finance.index')->with('success', 'Financial transaction recorded successfully.');

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
        return view('finance.journal_details', compact('journalEntry'));
    }


    public function financeDelete(Request $request)
    {

        // dd($request);
        $journalEntry= JournalEntry::find($request->journalID);

        $journalEntry->delete();


         //LOG
         $user = Auth()->user();

         $description = "User ". $user->id . " deleted a journal entry " .$journalEntry->id;
         $action = "Delete";

         $log = Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Journal Entry deleted successfully.');
    }
}
