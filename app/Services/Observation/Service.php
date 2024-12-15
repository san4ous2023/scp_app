<?php

namespace App\Services\Observation;


use App\Models\hse\observations\Observation;
use App\Models\Photos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Service
{
    public function store(array $data)
    {

        DB::beginTransaction();
        try {
            // Create Observation
            $observation = Observation::create([
                'site' => $data['site'] ?? 'SCP',
                'location' => $data['location'] ?? 'vessel',
                'department_id' => $data['department_id'],
                'user_id' => $data['user_id'],
                'description' => $data['description'],
                'further' => $data['further'] ?? 'NA',
                'corrective' => $data['corrective'] ?? 'NA',
            ]);


//            // Attach Relationships
//            $this->syncRelations($observation, $data);
            // Attach Relationships
            $this->attachCheckboxes($observation, $data);

            // Handle Photos
            if (!empty($data['photos']) && is_array($data['photos'])) {
                $this->savePhotos($observation, $data['photos'], $data['user_id']);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception("Failed to create observation: " . $e->getMessage());
        }

//        try {
//            $observation = Observation::create([
//                'site' => $data['site'] ?? 'SCP',
//                'location' => $data['location'] ?? 'vessel',
//                'department_id' => $data['department_id'],
//                'user_id' => $data['user_id'],
//                'description' => $data['description'],
//                'further' => $data['further'] ?? '',
//                'corrective' => $data['corrective'] ?? '',
//            ]);
//
//            if (isset($data['safeCheckbox'])) {
//                foreach ($data['safeCheckbox'] as $key => $value) {
//                    $observation->safetyBehaviours()->attach($key, ['state' => 'SAFE']);
//                }
//            }
//            if (isset($data['riskCheckbox'])) {
//                foreach ($data['riskCheckbox'] as $key => $value) {
//                    $observation->safetyBehaviours()->attach($key, ['state' => 'AT RISK']);
//                }
//            }
//
//            if (isset($data['unsafeCheckbox'])) {
//                foreach ($data['unsafeCheckbox'] as $key => $value) {
//                    $observation->unsafeConditions()->attach($key);
//                }
//            }
//
//            if (isset($data['qualityCheckbox'])) {
//                foreach ($data['qualityCheckbox'] as $key => $value) {
//                    $observation->qualityObservations()->attach($key);
//                }
//            }
//
//            if (isset($data['environmentalCheckbox'])) {
//                foreach ($data['environmentalCheckbox'] as $key => $value) {
//                    $observation->environmentalObservations()->attach($key);
//                }
//            }
//
////            if (!empty($data['photos'])) {
////                $photos = $data['photos']->file('photos');
////                foreach ($photos as $key => $value) {
////                    $name = $data['user_id'] . '.' . date('YmdHis', time()) . '_' . $key + 1 . '.' . $value->getClientOriginalExtension();
////                    //Storage::disk('public')->putFileAs('uploads', $photo,);
////                    $path = $value->storeAs('images', $name, 'public');
////                    $photo = Photos::create([
////                        'url' => $path,
////                    ]);
////                    $observation->photos()->save($photo);
////                }
////            }
//
//            if ($request->hasFile('photos')) {
//                $photos = $request->file('photos');
//                foreach ($photos as $key => $value) {
//                    $name = $data['user_id'] . '.' . date('YmdHis', time()) . '_' . $key + 1 . '.' . $value->getClientOriginalExtension();
//                    //Storage::disk('public')->putFileAs('uploads', $photo,);
//                    $path = $value->storeAs('images', $name, 'public');
//                    $photo = Photos::create([
//                        'url' => $path,
//                    ]);
//                    $observation->photos()->save($photo);
//                }
//            }
//
//
//        } catch (\Exception $message) {
//            return back()->with('error', $message->getMessage());
//        }

    }

    public function update(array $data, Observation $observation)
    {
        try {
            DB::transaction(function () use ($data, $observation) {
                $observation->update([
                    'site' => $data['site'] ?? $observation->site,
                    'location' => $data['location'] ?? $observation->location,
                    'further' => $data['further'] ?? $observation->further,
                    'corrective' => $data['corrective'] ?? $observation->corrective,
                    'comments' => $data['comments'] ?? $observation->comments,
                    'description' => $data['description'] ?? $observation->description,
                    'status_id' => $data['status_id'] ?? $observation->status_id,
                    'department_id' => $data['department_id'] ?? $observation->department_id,
                ]);

                // Sync Relationships
                $this->syncBehaviours($observation, $data);

// Sync Relationships
        //        $this->syncRelations($observation, $data);
//        $observation->safetyBehaviours()->detach();
//
//        if (isset($data['safeCheckbox'])) {
//            foreach ($data['safeCheckbox'] as $key => $value) {
//                $observation->safetyBehaviours()->attach($key, ['state' => 'SAFE']);
//            }
//        }
//        if (isset($data['riskCheckbox'])) {
//            foreach ($data['riskCheckbox'] as $key => $value) {
//                $observation->safetyBehaviours()->attach($key, ['state' => 'AT RISK']);
//            }
//        }
//
//        if (isset($data['unsafeCheckbox'])) {
//            $observation->unsafeConditions()->detach();
//            foreach ($data['unsafeCheckbox'] as $key => $value) {
//                $observation->unsafeConditions()->attach($key);
//            }
//        }
//
//        if (isset($data['qualityCheckbox'])) {
//            $observation->qualityObservations()->detach();
//            foreach ($data['qualityCheckbox'] as $key => $value) {
//                $observation->qualityObservations()->attach($key);
//            }
//        }
//
//        if (isset($data['environmentalCheckbox'])) {
//            $observation->environmentalObservations()->detach();
//            foreach ($data['environmentalCheckbox'] as $key => $value) {
//                $observation->environmentalObservations()->attach($key);
//            }
//        }
                       // Safety Behaviours
//            $this->syncBehaviours($observation, $data);
//
            // Sync Relationships
            $this->syncRelation($observation, 'unsafeConditions', $data['unsafeCheckbox'] ?? []);
            $this->syncRelation($observation, 'qualityObservations', $data['qualityCheckbox'] ?? []);
            $this->syncRelation($observation, 'environmentalObservations', $data['environmentalCheckbox'] ?? []);


                // Other Relationships
                //$this->syncRelation($observation, 'unsafeConditions', $data['unsafeCheckbox'] ?? []);
                // $this->syncRelation($observation, 'qualityObservations', $data['qualityCheckbox'] ?? []);
                // $this->syncRelation($observation, 'environmentalObservations', $data['environmentalCheckbox'] ?? []);

                // Handle Photos
                if (!empty($data['photos']) && is_array($data['photos'])) {
                    $this->savePhotos($observation, $data['photos'], $data['user_id']);
                }
                //return $observation->fresh();

            });
        } catch (\Exception $e) {
            \Log::error('Transaction failed', ['message' => $e->getMessage(), 'trace' => $e->getTrace()]);
            throw $e;
        }

    }
    private function syncRelations(Observation $observation, array $data): void
    {
        $this->syncRelation($observation, 'safetyBehaviours', $data['safeCheckbox'] ?? [], 'state', 'SAFE');
        $this->syncRelation($observation, 'safetyBehaviours', $data['riskCheckbox'] ?? [], 'state', 'AT RISK');
        $this->syncRelation($observation, 'unsafeConditions', $data['unsafeCheckbox'] ?? []);
        $this->syncRelation($observation, 'qualityObservations', $data['qualityCheckbox'] ?? []);
        $this->syncRelation($observation, 'environmentalObservations', $data['environmentalCheckbox'] ?? []);
    }

    private function syncRelation(Observation $observation, string $relation, array $values, string $extraField = null, string $extraValue = null)
    {
        $formattedValues = [];
        foreach ($values as $key => $value) {
            $formattedValues[$key] = $extraField ? [$extraField => $extraValue] : [];
        }
        $observation->$relation()->sync($formattedValues);
    }

    private function syncBehaviours($observation, $data)
    {
        $observation->safetyBehaviours()->detach();

        // Attach new behaviours
        $behaviours = [];
        if (isset($data['safeCheckbox']) && is_array($data['safeCheckbox'])) {
            foreach ($data['safeCheckbox'] as $key => $value) {
                $behaviours[$key] = ['state' => 'SAFE'];
            }
        }
        if (isset($data['riskCheckbox']) && is_array($data['riskCheckbox'])) {
            foreach ($data['riskCheckbox'] as $key => $value) {
                $behaviours[$key] = ['state' => 'AT RISK'];
            }
        }
        $observation->safetyBehaviours()->attach($behaviours);
    }

//    private function syncRelation($observation, $relation, $ids)
//    {
//        $observation->$relation()->sync($ids);
//    }


    private function attachCheckboxes(Observation $observation, array $data)
    {
        // Safety Behaviours
        if (isset($data['safeCheckbox']) && is_array($data['safeCheckbox'])) {
            foreach ($data['safeCheckbox'] as $key => $value) {
                $observation->safetyBehaviours()->attach($key, ['state' => 'SAFE']);
            }
        }

        if (isset($data['riskCheckbox']) && is_array($data['riskCheckbox'])) {
            foreach ($data['riskCheckbox'] as $key => $value) {
                $observation->safetyBehaviours()->attach($key, ['state' => 'AT RISK']);
            }
        }

        // Unsafe Conditions
        if (isset($data['unsafeCheckbox']) && is_array($data['unsafeCheckbox'])) {
            foreach ($data['unsafeCheckbox'] as $key => $value) {
                $observation->unsafeConditions()->attach($key);
            }
        }

        // Quality Observations
        if (isset($data['qualityCheckbox']) && is_array($data['qualityCheckbox'])) {
            foreach ($data['qualityCheckbox'] as $key => $value) {
                $observation->qualityObservations()->attach($key);
            }
        }

        // Environmental Observations
        if (isset($data['environmentalCheckbox']) && is_array($data['environmentalCheckbox'])) {
            foreach ($data['environmentalCheckbox'] as $key => $value) {
                $observation->environmentalObservations()->attach($key);
            }
        }
    }
//    private function savePhotos(Observation $observation, array $photos, int $userId)
//    {
//        $photoRecords = [];
//        foreach ($photos as $key => $photo) {
//            $filename = sprintf('%d.%s_%d.%s', $userId, date('YmdHis'), $key + 1, $photo->getClientOriginalExtension());
//            $path = $photo->storeAs('images', $filename, 'public');
//
//            $photoRecords[] = ['url' => $path];
//        }
//
//        // Bulk insert photos and attach them
//        $photoModels = Photos::insert($photoRecords);
//        $observation->photos()->saveMany($photoModels);
//        // Bulk save photos
//        //$observation->photos()->saveMany($photoRecords);
//    }

    private function savePhotos(Observation $observation, array $photos, int $userId)
    {
        $photoModels = []; // Array to hold Photo model instances

        foreach ($photos as $key => $photo) {
            if ($photo instanceof \Illuminate\Http\UploadedFile) {
                $filename = sprintf('%d.%s_%d.%s', $userId, date('YmdHis'), $key + 1, $photo->getClientOriginalExtension());
                $path = $photo->storeAs('images', $filename, 'public');

                // Create Photo model instance
                $photoModels[] = new Photos(['url' => $path]);
            }
        }

        if (!empty($photoModels)) {
            // Attach all photos to the observation in bulk
            $observation->photos()->saveMany($photoModels);
        }
    }


    /**
     * Delete specific photos linked to an observation.
     */
    public function deletePhotos(array $photoIds): void
    {
        DB::transaction(function () use ($photoIds) {
            $photos = Photos::whereIn('id', $photoIds)->get();
            foreach ($photos as $photo) {
                Storage::delete($photo->url); // Delete from storage
                $photo->delete(); // Delete from database
            }
        });
    }
//    private function savePhotos(Observation $observation, array $photos, int $userId)
//    {
//        foreach ($photos as $key => $photo) {
//            $filename = sprintf('%d.%s_%d.%s', $userId, date('YmdHis'), $key + 1, $photo->getClientOriginalExtension());
//            $path = $photo->storeAs('images', $filename, 'public');
//
//            $photoRecord = Photos::create(['url' => $path]);
//            $observation->photos()->save($photoRecord);
//        }
//    }
}
