<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventsExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        $result = Event::select('title', 'description', 'start_datetime', 'end_datetime')->get();
        return $result;
    }

    public function headings(): array
    {
        return [
            'Title',
            'Description',
            'Start Date',
            'End Date',
        ];
    }
}
