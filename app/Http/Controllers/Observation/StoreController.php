<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Observation\StoreRequest;
use App\Models\hse\observations\Observation;
use App\Models\Photos;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        //return redirect()->route('welcome');
        //dd($request);
        $data = $request->validated();
        try {
            $observation = Observation::create([
                'site' => $data['site'] ?? 'SCP',
                'location' => $data['location'] ?? 'vessel',
                'department_id' => $data['department_id'],
                'user_id' => $data['user_id'],
                'description' => $data['description'],
                'further' => $data['further'] ?? '',
                'corrective' => $data['corrective'] ?? '',
            ]);

            if (isset($data['safeCheckbox'])) {
                foreach ($data['safeCheckbox'] as $key => $value) {
                    $observation->safetyBehaviours()->attach($key, ['state' => 'SAFE']);
                }
            }
            if (isset($data['riskCheckbox'])) {
                foreach ($data['riskCheckbox'] as $key => $value) {
                    $observation->safetyBehaviours()->attach($key, ['state' => 'AT RISK']);
                }
            }

            if (isset($data['unsafeCheckbox'])) {
                foreach ($data['unsafeCheckbox'] as $key => $value) {
                    $observation->unsafeConditions()->attach($key);
                }
            }

            if (isset($data['qualityCheckbox'])) {
                foreach ($data['qualityCheckbox'] as $key => $value) {
                    $observation->qualityObservations()->attach($key);
                }
            }

            if (isset($data['environmentalCheckbox'])) {
                foreach ($data['environmentalCheckbox'] as $key => $value) {
                    $observation->environmentalObservations()->attach($key);
                }
            }

            if ($request->hasFile('photos')) {
                $photos = $request->file('photos');
                foreach ($photos as $key => $value) {
                    $name = $data['user_id'] . '.' . date('YmdHis', time()) . '_' . $key + 1 . '.' . $value->getClientOriginalExtension();
                    //Storage::disk('public')->putFileAs('uploads', $photo,);
                    $path = $value->storeAs('images', $name, 'public');
                    $photo = Photos::create([
                        'url' => $path,
                    ]);
                    $observation->photos()->save($photo);
                }
            }

            session()->flash('success', 'Observation was created successfully!!!');
            return redirect()->route('observation.index');
        } catch (\Exception $message) {
            return back()->with('error', $message->getMessage());
        }

    }

}
