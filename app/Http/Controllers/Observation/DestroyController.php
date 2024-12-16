<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Models\hse\observations\Observation;
use App\Models\Photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestroyController extends BaseController
{
    public function __invoke(Observation $observation)
    {

        try {
            $this->service->deleteObservation($observation);

            return redirect()
                ->route('observation.index')
                ->with('success', 'Observation and its associated photos deleted successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to delete observation. Please try again.');
        }
        //dd($observation->photos());
        //$this->service->deleteObservation($observation);
        //session()->flash('success', 'Observation was deleted successfully.');
        //return redirect()->route('observation.index');

    }

}
