<?php

namespace App\Http\Controllers\Observation;


use App\Http\Requests\Observation\UpdateRequest;
use App\Models\hse\observations\Observation;

use Illuminate\Support\Facades\DB;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Observation $observation)
    {
        // DB::transaction(function () use ($request, $observation) {
        $data = $request->validated();
        try {
            $this->service->update($data, $observation);
            return redirect()->route('observation.show', $observation)->with('success', 'Observation Update successfully.');;
        } catch (\Exception $e) {
            \Log::error('Failed to update observation', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTrace()
            ]);
        }
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }

    }
