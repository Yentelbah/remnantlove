<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Church;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $church = Church::first();

        $accounts = [
            ['name' => 'Cash Accounts', 'type' => 'Asset', 'church_id' => $church->id],
            ['name' => 'Bank Accounts', 'type' => 'Asset', 'church_id' => $church->id],
            ['name' => 'Mobile Money Accounts', 'type' => 'Asset', 'church_id' => $church->id],
            ['name' => 'Accounts Receivable', 'type' => 'Asset', 'church_id' => $church->id],
            ['name' => 'Loan Receivable', 'type' => 'Asset', 'church_id' => $church->id],
            ['name' => 'Prepaid Expenses', 'type' => 'Asset', 'church_id' => $church->id],
            ['name' => 'Fixed Assets', 'type' => 'Asset', 'church_id' => $church->id],
            ['name' => 'Accumulated Depreciation', 'type' => 'Asset', 'church_id' => $church->id],
            ['name' => 'Accounts Payable', 'type' => 'Liability', 'church_id' => $church->id],
            ['name' => 'Notes Payable', 'type' => 'Liability', 'church_id' => $church->id],
            ['name' => 'Accrued Liabilities', 'type' => 'Liability', 'church_id' => $church->id],
            ['name' => 'Capital', 'type' => 'Equity', 'church_id' => $church->id],
            ['name' => 'Capital Contribution', 'type' => 'Equity', 'church_id' => $church->id],
            ['name' => 'Loan Acquired', 'type' => 'Liability ', 'church_id' => $church->id],
            ['name' => 'Retained Earnings', 'type' => 'Equity', 'church_id' => $church->id],
            ['name' => 'Interest Income', 'type' => 'Revenue', 'church_id' => $church->id],
            ['name' => 'Tithes', 'type' => 'Revenue', 'church_id' => $church->id],
            ['name' => 'Donation Recieved', 'type' => 'Revenue', 'church_id' => $church->id],
            ['name' => 'Offering', 'type' => 'Revenue', 'church_id' => $church->id],
            ['name' => 'Sales Revenue', 'type' => 'Revenue', 'church_id' => $church->id],
            ['name' => 'Service Revenue', 'type' => 'Revenue', 'church_id' => $church->id],
            ['name' => 'Cost of Goods Sold', 'type' => 'Expense', 'church_id' => $church->id],
            ['name' => 'Donation Paid', 'type' => 'Expense', 'church_id' => $church->id],
            ['name' => 'Operating Expenses', 'type' => 'Expense', 'church_id' => $church->id],
            ['name' => 'Salaries and Wages', 'type' => 'Expense', 'church_id' => $church->id],
            ['name' => 'Rent Expense', 'type' => 'Expense', 'church_id' => $church->id],
            ['name' => 'Utilities Expense', 'type' => 'Expense', 'church_id' => $church->id],
            ['name' => 'Depreciation Expense', 'type' => 'Expense', 'church_id' => $church->id],
            ['name' => 'Advertising Expense', 'type' => 'Expense', 'church_id' => $church->id],
            ['name' => 'Insurance Expense', 'type' => 'Expense', 'church_id' => $church->id],
        ];

        foreach ($accounts as &$account) {
            $account['id'] = Uuid::uuid4()->toString();
        }

        Account::insert($accounts);
    }
}
