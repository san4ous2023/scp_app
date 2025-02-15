<?php

namespace App\Http\Controllers\Observation;

use App\Exports\ObservationsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends BaseController
{
    public function __invoke()
    {
        try {
            return Excel::download(new ObservationsExport, 'observations.xlsx');
        } catch (\Exception $e) {
            \Log::error('Failed to export observation', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTrace()
            ]);
            return redirect()->back()->with('error', $e->getMessage());
        }
        //return redirect()->route('observation.index');


    }
}
