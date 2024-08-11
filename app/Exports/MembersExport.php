<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        $groups = Member::select('member_number','name', 'gender', 'dob', 'phone', 'email','address','created_at')->get();
        return $groups;
    }

    public function headings(): array
    {
        return [
            'Member Number',
            'Name',
            'Gender',
            'Birth Date',
            'Phone',
            'Email',
            'Address',
            'Created at',
        ];
    }
}
