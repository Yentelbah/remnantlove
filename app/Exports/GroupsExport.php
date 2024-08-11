<?php

namespace App\Exports;

use App\Models\Group;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GroupsExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        $groups = Group::select('name', 'description', 'created_at')->get();
        return $groups;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Date Created',
        ];
    }
}
