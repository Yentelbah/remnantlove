<?php

namespace App\Exports;

use App\Models\Equipment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EquipmentExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        $result = Equipment::select('name', 'description', 'date_acquired', 'status','date_disposed')->get();
        return $result;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Date Acquired',
            'Status',
            'Date Disposed',
        ];
    }
}
