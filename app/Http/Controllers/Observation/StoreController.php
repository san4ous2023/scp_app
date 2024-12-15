<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Observation\StoreRequest;
use App\Models\hse\observations\Observation;
use App\Models\Photos;
use Illuminate\Support\Facades\Storage;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {

        $data = $request->validated();
        try {
            $this->service->store($data);
            session()->flash('success', 'Observation was created successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to update observation', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTrace()
            ]);
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('observation.index');


    }

}
