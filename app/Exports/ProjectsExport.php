<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectsExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        $result = Project::select('name', 'description', 'start_date', 'end_date', 'status')->get();
        return $result;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Start Date',
            'End Date',
            'Status'
        ];
    }
}
