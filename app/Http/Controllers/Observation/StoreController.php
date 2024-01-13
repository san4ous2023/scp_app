<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Observation\StoreRequest;
use App\Models\hse\observations\Observation;
use App\Models\Photos;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
//StoreRequest $request
    public function __invoke(StoreRequest $request)
    {
        //return redirect()->route('welcome');
        //dd($request);
        $data = $request->validated();

        $observation = Observation::create([
            'site' => $data['site'] ?? 'SCP',
            'location' => $data['location'] ?? 'vessel',
            'department_id' => $data['department_id'],
            'user_id' => $data['user_id'],
            'description' => $data['description'],
            'further' => $data['further'] ?? 'NA',
            'corrective' => $data['corrective'] ?? 'NA',
        ]);
        //$unsafeCheckboxArray = $data['unsafeCheckbox'];
        //unset($data['unsafeCheckbox']);
        //$user = $data['user_id'];
        // $data['status_id'] = 1;
        //$department = $data['department_id'];
        //unset($data['photos']);
        //unset($data['status_id']);
        //unset($data['department_id']);
        //if (!$data['site']) $data['site'] = 'SCP';
        //if (!$data['location']) $data['location'] = 'vessel';
        //dd($data);

        //$observation = Observation::create($data);

        if ($data['safeCheckbox']) {
            foreach ($data['safeCheckbox'] as $key => $value) {
                $observation->safetyBehaviours()->attach($key, ['state' => 'SAFE']);
            }
        }
        if ($data['safeCheckbox']) {
            foreach ($data['riskCheckbox'] as $key => $value) {
                $observation->safetyBehaviours()->attach($key, ['state' => 'AT RISK']);
            }
        }

        if ($data['unsafeCheckbox']) {
            foreach ($data['unsafeCheckbox'] as $key => $value) {
                $observation->unsafeConditions()->attach($key);
            }
        }

        if ($data['qualityCheckbox']) {
            foreach ($data['qualityCheckbox'] as $key => $value) {
                $observation->qualityObservations()->attach($key);
            }
        }

        if ($data['environmentalCheckbox']) {
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


//dd('saved');
//        if(!is_null($this->photos)) {
//            foreach ($this->photos as $photo) {
//                $extension = $photo->getClientOriginalExtension();
//                $name = $this->user->id . '_' . date('YmdHis', time()) . '_' . $i . '.' . $extension;
//                $path = $photo->storeAs('images', $name, 'public');
//
//                $photos1 = Photos::create([
//                    'url' => $path,
//                ]);
//                $observation->photos()->save($photos1);
//
//                $i++;
//            }
//        }


        //dd($data);


//        foreach (array_keys(array_filter($unsafeCheckboxArray)) as $unsafeCondition) {
//            $observation->unsafeConditions()->attach($unsafeCondition);
//        }
        //$observation->user_id()->attach($user);
        //$observation->status_id()->attach($status);
        //$observation->department_id()->attach($department);
        return redirect()->route('observation.index');
    }

}
