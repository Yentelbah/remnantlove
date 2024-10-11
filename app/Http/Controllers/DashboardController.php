<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Attendance;
use App\Models\Church;
use App\Models\Event;
use App\Models\LedgerEntry;
use App\Models\Member;
use App\Models\Project;
use App\Models\Staff;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function displayDashboard()
    {
        $user = Auth::user();

        if ($user && $user->churchRole) {
            $roleName = $user->churchRole->role->name;

            if ($user->hasAnyRole(1)) {
                return $this->adminDashboard(); //System_admin
            } elseif ($user->hasAnyRole(2)) {
                return $this->adminDashboard(); //Church_admin
            } elseif ($user->hasAnyRole(3)) {
                return $this->adminDashboard(); //Branch_admin
            } elseif ($user->hasAnyRole(4)) {
                return $this->adminDashboard(); //Accountant
            } elseif ($user->hasAnyRole(6)) {
                return $this->adminDashboard(); //Cashier
            } elseif ($user->hasAnyRole(5)) {
                return $this->leaderDashboard(); //Leader
            } elseif ($user->hasAnyRole(7)) {
                return $this->userDashboard(); //User
            }
        }
        elseif($user && $user->email=='faithflow@yensoftgh.com' && $user->phone=='0545055050')
        {
            return $this->superDashboard();
        }

        abort(403, 'Unauthorized - You do not have the appropriate role');
    }

    private function superDashboard()
    {
        $user = Auth()->user();
        $greeting = $this->greetings();

        $projects = $this->projects();
        $organisations = Church::orderBy('created_at', 'desc')->get()->take(5);

        return view('dashboard.super', compact('greeting','organisations', 'projects'))->with('success', 'Welcome to FaithFlow');
    }

    private function adminDashboard()
    {
        $user = Auth()->user();
        $role = $user->churchRole->role->name;;

        $events = $this->events();
        $projects = $this->projects();
        $greeting = $this->greetings();
        $statistics = $this->attendance();
        $financeStats = $this->financeStats();
        $totalExpenses = $this->expenseStat();
        $totalRevenue = $this->revenueStat();
        $birthdayCelebrants = $this->getMembersWithBirthdays();

        $excludedMemberIds = DB::table('pastors')
        ->pluck('member_id')
        ->merge(DB::table('group_leaders')->pluck('member_id'))
        ->merge(DB::table('staff')->pluck('member_id'));

        if ($role === "Church_admin") {
            // dd($excludedMemberIds);

            $memberCount = Member::where('church_id', $user->church_id)->count();
            $memberCountGender = Member::where('church_id', $user->church_id)
            ->select(
                'gender',
                DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) >= 18 THEN 1 ELSE 0 END) as count_18_and_above'),
                DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) < 18 THEN 1 ELSE 0 END) as count_below_18')
            )
            ->groupBy('gender')
            ->get();


            $pastorCount = DB::table('pastors')->where('church_id', $user->church_id)->distinct('member_id')->count('member_id');
            $leaderCount = DB::table('group_leaders')->where('church_id', $user->church_id)->distinct('member_id')->count('member_id');
            $staffCount = Staff::where('church_id', $user->church_id)->distinct('member_id')->count('member_id');
            $visitors = Visitor::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->orderBy('created_at', 'desc')->get()->take(5);


        }elseif ($role === "Branch_admin") {

            $memberCount = Member::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->count();
            $memberCountGender = Member::where('church_id', $user->church_id)
            ->where('church_branch_id', $user->church_branch_id)
            ->select(
                'gender',
                DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) >= 18 THEN 1 ELSE 0 END) as count_18_and_above'),
                DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) < 18 THEN 1 ELSE 0 END) as count_below_18')
            )
            ->groupBy('gender')
            ->get();

            $pastorCount = DB::table('pastors')->where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->distinct('member_id')->count('member_id');
            $leaderCount = DB::table('group_leaders')->where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->distinct('member_id')->count('member_id');
            $staffCount = DB::table('staff')->where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->distinct('member_id')->count('member_id');
            $visitors = Visitor::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->orderBy('created_at', 'desc')->get()->take(5);


        }else {

            $memberCount = Member::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->count();
            $memberCountGender = Member::where('church_id', $user->church_id)
            ->where('church_branch_id', $user->church_branch_id)
            ->select(
                'gender',
                DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) >= 18 THEN 1 ELSE 0 END) as count_18_and_above'),
                DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) < 18 THEN 1 ELSE 0 END) as count_below_18')
            )
            ->groupBy('gender')
            ->get();
            $pastorCount = DB::table('pastors')->where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->distinct('member_id')->count('member_id');
            $leaderCount = DB::table('group_leaders')->where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->distinct('member_id')->count('member_id');
            $staffCount = DB::table('staff')->where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->distinct('member_id')->count('member_id');
            $visitors = Visitor::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->orderBy('created_at', 'desc')->get()->take(5);

        }


        //Finance statistics
        $financeData = $this->getFinanceData();

        return view('dashboard.admin', compact('role', 'events', 'projects', 'memberCount', 'pastorCount', 'leaderCount', 'staffCount', 'statistics', 'visitors', 'greeting', 'financeStats', 'totalExpenses', 'totalRevenue','memberCountGender', 'birthdayCelebrants'))->with([
            'months' => json_encode($financeData['months']),
            'revenue' => json_encode($financeData['revenue']),
            'expense' => json_encode($financeData['expense']),
            'success' => 'Welcome to FaithFlow',
        ]);
    }

    private function greetings()
    {
        $currentHour = date('H');

        if ($currentHour < 12) {
            $greeting = "Good morning";
            $scripture = "Delight in the Lord, and he will give you the desires of your heart. - Psalm 37:4";

        } elseif ($currentHour < 18) {
            $greeting = "Good afternoon";
            $scripture = "It is better to trust in the Lord than to put confidence in man. - Psalm 118:8";

        } else {
            $greeting = "Good evening";
            $scripture = "When you are afriad, put your trust in God. - Psalm 56:3";

        }

        return [$greeting, $scripture];
    }

    private function attendance()
    {

        $categories = ['Sunday', 'All Night', 'Special', 'Other'];
        $statistics = [];
        $chartData = [];

        foreach ($categories as $category) {
            $lastAttendance = Attendance::getLastAttendanceByCategory($category);
            $previousAttendance = $lastAttendance ? Attendance::getPreviousAttendanceByCategory($category, $lastAttendance->created_at) : null;

            if ($lastAttendance && $previousAttendance) {
                $change = $lastAttendance->total_attendance - $previousAttendance->total_attendance;
                $percentageChange = ($change / $previousAttendance->total_attendance) * 100;
            } else {
                $percentageChange = null;
            }

            $totalAttendance = Attendance::getTotalAttendanceByCategory($category);

            // Fetch the last five attendance records
            $lastFiveAttendances = Attendance::getLastFiveAttendancesByCategory($category);
            $chartData[$category] = [
                'dates' => $lastFiveAttendances->pluck('created_at')->map(function ($date) {
                    return $date->format('Y-m-d');
                })->toArray(),
                'attendances' => $lastFiveAttendances->pluck('total_attendance')->toArray()
            ];

            $statistics[$category] = [
                'last_attendance' => $lastAttendance ? $lastAttendance->total_attendance : 0,
                'percentage_change' => $percentageChange,
                'total_attendance' => $totalAttendance,
            ];
        }
        return $statistics;
    }

    //Chart
    private function getFinanceData()
    {
        $user = Auth()->user();

        $currentYear = Carbon::now()->year;

        // Retrieve monthly revenue and expense totals
        $financeData = DB::table('ledger_entries')
            ->join('accounts', 'ledger_entries.account_id', '=', 'accounts.id')
            ->select(
                DB::raw('MONTH(ledger_entries.created_at) as month'),
                DB::raw('SUM(CASE WHEN accounts.type = "Revenue" THEN ledger_entries.credit - ledger_entries.debit ELSE 0 END) as revenue'),
                DB::raw('SUM(CASE WHEN accounts.type = "Expense" THEN ledger_entries.debit - ledger_entries.credit ELSE 0 END) as expense')
            )
            ->where('ledger_entries.church_id', $user->church_id)
            ->where('ledger_entries.church_branch_id', $user->church_branch_id)
            ->whereYear('ledger_entries.created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(ledger_entries.created_at)'))
            ->orderBy(DB::raw('MONTH(ledger_entries.created_at)'))
            ->get();

        $monthlyData = [
            'months' => [],
            'revenue' => [],
            'expense' => [],
        ];

        foreach ($financeData as $data) {
            $monthlyData['months'][] = Carbon::create()->month($data->month)->format('M');
            $monthlyData['revenue'][] = $data->revenue;
            $monthlyData['expense'][] = $data->expense;
        }

        return $monthlyData;
    }

    //Stats
    private function financeStats()
    {

        $user = Auth()->user();
        $churchId = $user->church_id; // Assuming the church_id is available from the authenticated user

        $groups = [
            'Tithes & Offering' => ['Tithes', 'Offering'],
            'Donations' => ['Donation Received'],
            'Others' => ['Interest Income', 'Sales Revenue', 'Service Revenue']
        ];

        $balances = [];

        foreach ($groups as $groupName => $accountNames) {
            $accountIds = Account::where('church_id', $churchId)
                                ->whereIn('name', $accountNames)
                                ->where('church_id', $user->church_id)
                                ->where('church_branch_id', $user->church_branch_id)
                                ->pluck('id');

            $balance = LedgerEntry::where('church_id', $churchId)
                        ->where('church_id', $user->church_id)
                        ->where('church_branch_id', $user->church_branch_id)
                        ->whereIn('account_id', $accountIds)
                        ->selectRaw('SUM(debit) as total_debit, SUM(credit) as total_credit')
                        ->first();

            $balances[$groupName] = $balance->total_debit - $balance->total_credit;
        }

        return $balances;
    }

    //Expenses
    private function expenseStat()
    {
        $user = Auth()->user();

        $churchId = Auth::user()->church_id; // Assuming the church_id is available from the authenticated user
        $currentYear = now()->year;

        $expenseAccounts = Account::where('type', 'expense')->pluck('name');
        // dd($expenseAccounts);


        $expenseAccountIds = Account::where('church_id', $churchId)
                                    ->where('church_id', $user->church_id)
                                    ->where('church_branch_id', $user->church_branch_id)
                                    ->whereIn('name', $expenseAccounts)
                                    ->pluck('id');

        $totalExpenses = LedgerEntry::where('church_id', $churchId)
                                    ->where('church_id', $user->church_id)
                                    ->where('church_branch_id', $user->church_branch_id)
                                    ->whereIn('account_id', $expenseAccountIds)
                                    ->whereYear('created_at', $currentYear)
                                    ->selectRaw('SUM(debit) as total_debit, SUM(credit) as total_credit')
                                    ->first();

        $totalExpensesAmount = ($totalExpenses->total_debit ?? 0) - ($totalExpenses->total_credit ?? 0);

        return $totalExpensesAmount;
    }

    private function revenueStat()
    {
        $user = Auth()->user();

        $churchId = $user->church_id; // Assuming the church_id is available from the authenticated user
        $currentYear = now()->year;

        $revenueAccounts = Account::where('type', 'revenue')->pluck('name');

        $revenueAccountIds = Account::where('church_id', $churchId)
                                    ->whereIn('name', $revenueAccounts)
                                    ->where('church_id', $user->church_id)
                                    ->where('church_branch_id', $user->church_branch_id)
                                    ->pluck('id');

        $totalRevenue = LedgerEntry::where('church_id', $churchId)
                                    ->whereIn('account_id', $revenueAccountIds)
                                    ->where('church_id', $user->church_id)
                                    ->where('church_branch_id', $user->church_branch_id)
                                    ->whereYear('created_at', $currentYear)
                                    ->selectRaw('SUM(debit) as total_debit, SUM(credit) as total_credit')
                                    ->first();

        $totalRevenueAmount = ($totalRevenue->total_debit ?? 0) - ($totalRevenue->total_credit ?? 0);

        return $totalRevenueAmount;
    }

    private function leaderDashboard()
    {
        $user = Auth()->user();
        $role = $user->churchRole->role->name;;

        $events = $this->events();
        $projects = $this->projects();
        $greeting = $this->greetings();

        //Finance statistics
        $financeData = $this->getFinanceData();

        return view('dashboard.leader', compact('role', 'events', 'projects',  'greeting', ))->with([
            'success' => 'Welcome to FaithFlow',
        ]);
    }

    private function userDashboard()
    {
        return view('dashboard.user');
    }

    private function events()
    {
        $events = Event::all();
        return $events;
    }

    private function projects()
    {
        $projects = Project::all();
        return $projects;
    }

    private function getMembersWithBirthdays()
    {
        $currentMonth = Carbon::now()->month;

        // Query members whose birthdays are in the current month
        $members = Member::whereMonth('dob', $currentMonth)
            ->orderByRaw("DATE_FORMAT(dob, '%m-%d')") // Order by the nearest birthday (day of the month)
            ->get();

        return $members;
    }
}
