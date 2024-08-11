<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Church;
use App\Models\ChurchBranch;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('reports.index');
    }

    public function balanceSheet(Request $request)
    {
        $user = Auth()->user();
        $church = Church::where('id', $user->church_id)->first();
        $branch = ChurchBranch::where('id', $user->church_branch_id)->first();

        $period = $request->input('date');

        $assets = Account::withSum('ledgerEntries as total_debit', 'debit')
                        ->withSum('ledgerEntries as total_credit', 'credit')
                        ->where('type', 'Asset')
                        ->where('church_id', $church->id)
                        ->where('church_branch_id', $branch->id)
                        ->get();

        $liabilities = Account::withSum('ledgerEntries as total_debit', 'debit')
                             ->withSum('ledgerEntries as total_credit', 'credit')
                             ->where('type', 'Liability')
                             ->where('church_id', $church->id)
                             ->where('church_branch_id', $branch->id)
                            ->get();

        $equity = Account::withSum('ledgerEntries as total_debit', 'debit')
                        ->withSum('ledgerEntries as total_credit', 'credit')
                        ->where('type', 'Equity')
                        ->where('church_id', $church->id)
                        ->where('church_branch_id', $branch->id)
                        ->get();

        return view('reports.balance_sheet.report', compact('assets', 'liabilities', 'equity' ,'period', 'church', 'branch'));
    }

    Public function profitAndLoss(Request $request)
    {
        $user = Auth::user();
        $church = Church::where('id', $user->church_id)->first();
        $branch = ChurchBranch::where('id', $user->church_branch_id)->first();
        $period = $request->input('date');

        $revenues = Account::withSum('ledgerEntries as total_credit', 'credit')
                          ->withSum('ledgerEntries as total_debit', 'debit')
                          ->where('type', 'Revenue')
                          ->where('church_id', $church->id)
                          ->where('church_branch_id', $branch->id)
                            ->get();

        $expenses = Account::withSum('ledgerEntries as total_credit', 'credit')
                          ->withSum('ledgerEntries as total_debit', 'debit')
                          ->where('type', 'Expense')
                          ->where('church_id', $church->id)
                          ->where('church_branch_id', $branch->id)
                            ->get();

        $totalRevenue = $revenues->sum(function($account) {
            return $account->total_credit - $account->total_debit;
        });

        $totalExpenses = $expenses->sum(function($account) {
            return $account->total_debit - $account->total_credit;
        });

        $netIncome = $totalRevenue - $totalExpenses;

        return view('reports.profit&loss.report', compact('revenues', 'expenses', 'totalRevenue', 'totalExpenses', 'netIncome', 'period', 'church', 'branch'));
    }

    public function trialBalance(Request $request)
    {
        $user = Auth()->user();
        $church = Church::where('id', $user->church_id)->first();
        $branch = ChurchBranch::where('id', $user->church_branch_id)->first();
        $period = $request->input('date');

        // Retrieve all accounts and their debit and credit balances
        $accounts = Account::withSum('ledgerEntries as total_debit', 'debit')
                        ->withSum('ledgerEntries as total_credit', 'credit')
                        ->where('church_id', $church->id)
                        ->where('church_branch_id', $branch->id)
                        ->get();

        // Calculate total debits and credits
        $totalDebits = $accounts->sum('total_debit');
        $totalCredits = $accounts->sum('total_credit');

        // Pass data to view
        return view('reports.trial_balance.report', compact('accounts', 'totalDebits', 'totalCredits', 'period', 'church', 'branch'));
    }


    public function Logs(Request $request)
    {
        $user = Auth::user();
        // $role = $user->role->name;
        $role = $user->churchRole->name;;

        $church = Church::where('id', $user->church_id)->first();
        $branch = ChurchBranch::where('id', $user->church_branch_id)->first();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $logs = Log::where('church_id', $church->id)->where('church_branch_id', $branch->id)->whereBetween('created_at', [$startDate, date('Y-m-d', strtotime($endDate . '+1 day'))])
        ->get();

        $totalLogs = $logs->count();

        $users = User::where('church_id', $church->id)
            ->where('church_branch_id', $branch->id)
            ->whereIn('id', $logs->pluck('user_id'))->get();

        $logsByUser = $logs->groupBy('user_id')->map(function ($user) {
            return $user->count();
        });

        return view('reports.logs.report', compact('totalLogs', 'logs', 'logsByUser', 'startDate', 'endDate', 'users','church','branch'));
    }

}
