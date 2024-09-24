<?php

namespace App\Actions\Fortify;

use App\Models\Account;
use App\Models\Church;
use App\Models\ChurchBranch;
use App\Models\ChurchRole;
use App\Models\CreditsAccount;
use App\Models\Member;
use App\Models\SenderID;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Ramsey\Uuid\Uuid;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'church' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $church = Church::create([
            'name' => $input['church'],
            'phone' => $input['phone'],
            'churchID' => $this->generateChurchID(),
        ]);

        $branch = ChurchBranch::create([
            'name' => 'Main',
            'church_id' => $church->id,
            'name' => $input['church'],
            'phone' => $input['phone'],
            'Status' => 'main',
        ]);

        $church_role = ChurchRole::create([
            'church_id' => $church->id,
            'name' =>'Church Administrator',
            'role_id' => 2,
        ]);

        $churchFolderPath = storage_path("app/public/churches/{$church->churchID}");
        if (!file_exists($churchFolderPath)) {
            mkdir($churchFolderPath, 0777, true);
            mkdir("$churchFolderPath/logo", 0777, true);
            mkdir("$churchFolderPath/branch", 0777, true);
            mkdir("$churchFolderPath/profile_pics", 0777, true);
            mkdir("$churchFolderPath/uploads", 0777, true);
        }

        $creditsAccount = CreditsAccount::create([
            'church_id' => $church->id,
            'church_branch_id' => $branch->id,
            'balance' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $senderID = SenderID::create([
            'church_id' => $church->id,
            'church_branch_id' => $branch->id,
            'name' => 'FaithFlow',
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        $accounts = [
            ['name' => 'Cash Accounts', 'type' => 'Asset', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Bank Accounts', 'type' => 'Asset', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Mobile Money Accounts', 'type' => 'Asset', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Accounts Receivable', 'type' => 'Asset', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Loan Receivable', 'type' => 'Asset', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Prepaid Expenses', 'type' => 'Asset', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Fixed Assets', 'type' => 'Asset', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Accumulated Depreciation', 'type' => 'Asset', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Accounts Payable', 'type' => 'Liability', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Notes Payable', 'type' => 'Liability', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Accrued Liabilities', 'type' => 'Liability', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Capital', 'type' => 'Equity', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Capital Contribution', 'type' => 'Equity', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Loan Acquired', 'type' => 'Liability ', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Retained Earnings', 'type' => 'Equity', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Interest Income', 'type' => 'Revenue', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Tithes', 'type' => 'Revenue', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Donation Received', 'type' => 'Revenue', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Offering', 'type' => 'Revenue', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Sales Revenue', 'type' => 'Revenue', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Service Revenue', 'type' => 'Revenue', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Cost of Goods Sold', 'type' => 'Expense', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Donation Paid', 'type' => 'Expense', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Operating Expenses', 'type' => 'Expense', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Salaries and Wages', 'type' => 'Expense', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Rent Expense', 'type' => 'Expense', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Utilities Expense', 'type' => 'Expense', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Depreciation Expense', 'type' => 'Expense', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Advertising Expense', 'type' => 'Expense', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
            ['name' => 'Insurance Expense', 'type' => 'Expense', 'church_id' => $church->id, 'church_branch_id' => $branch->id,],
        ];

        foreach ($accounts as &$account) {
            Account::create($account);
        }


        $settings = Setting::create([
            'church_id' => $church->id,
            'church_branch_id' => $branch->id,
            'created_at' => now(),
            'updated_at' => now(),

        ]);


        $member = Member::create([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'church_id' => $church->id,
            'church_branch_id' => $branch->id,
        ]);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone' => $input['phone'],
            'church_role_id' =>$church_role->id,
            'church_id' => $church->id,
            'church_branch_id' => $branch->id,
            'member_id' =>$member->id,
        ]);

        $staff = Staff::create([
            'member_id' => $member->id,
            'church_id' => $church->id,
            'church_branch_id' => $branch->id,
            'position'=>'Church Administrator'
        ]);

        return $user;
    }

    protected function passwordRules()
    {
        return ['required', 'string', 'min:8', 'confirmed'];
    }

    private function generateChurchID()
    {
        $year = date('y');
        $month = date('m');
        $randomNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $churchId = $year . $month . $randomNumber;

        return $churchId;
    }

}
