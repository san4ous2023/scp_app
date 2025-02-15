<?php

namespace App\Exports;

use App\Models\hse\observations\Observation;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ObservationsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Observation::select('id', 'description', 'status_id', 'created_at')->get();

    }

    public function headings(): array
    {
        return ["ID", "Description", "Status", "Created At"];
    }
}

