<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\JournalEntry;
use Illuminate\Http\Request;

class FinanceTransactionsController extends Controller
{
    public function transactions()
    {
        $user = Auth()->user();

        $transactions = JournalEntry::where('is_deleted', false)
            ->where('church_id', $user->church_id)
            ->where('church_branch_id', $user->church_branch_id)
            ->orderBy('created_at', 'desc')->get();

        return view ('finance.transactions', compact('transactions'));
    }
}
