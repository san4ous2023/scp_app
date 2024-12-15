<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\hse\observations\EnvironmentalObservation;
use App\Models\hse\observations\Observation;
use App\Models\hse\observations\QualityObservations;
use App\Models\hse\observations\SafetyBehaviours;
use App\Models\hse\observations\UnsafeConditions;
use App\Models\Status;
use Illuminate\Http\Request;

class EditController extends BaseController
{
    public function __invoke(Observation $observation)
    {
        $departments = Department::all();
        $unsafeConditions = UnsafeConditions::all();
        $linkedUnsafeConditions = $observation->unsafeConditions()->get();
        //$safetyBehaviours = SafetyBehaviours::all();
        $qualityObservations = QualityObservations::all();
        $linkedQualityObservations = $observation->qualityObservations()->get();
        $environmentalObservations = EnvironmentalObservation::all();
        $linkedEnvironmentalObservations = $observation->environmentalObservations()->get();
        $statuses = Status::all();
        //$status = $observation->status()->get();

        //dd($linkedUnsafeConditions);


        //$safetyBehaviours = $observation->safetyBehaviours()->withPivot('state')->get();
        $safetyBehaviours = SafetyBehaviours::all();
        $linkedBehaviours = $observation->safetyBehaviours()->withPivot('state')->get();
        //$safeBehaviours = $observation->safetyBehaviours()->wherePivot('state', 'SAFE')->get();
        //$riskBehaviours = $observation->safetyBehaviours()->wherePivot('state', 'AT RISK')->get();

        //$safeBehaviours = $observation->safetyBehaviours()->where($column='state',$value='SAFE')->pluck('safety_behaviours_id')->toArray();
        //$riskBehaviours = $observation->safetyBehaviours()->where($column='state',$value='AT RISK')->pluck('safety_behaviours_id')->toArray();
        $photos = $observation -> photos()->get();
        $user = $observation -> user()->first(); // Fetches the user as a model
        //dd($photos);
// $post = Post::findOrFail($id);
         return view('admin.observation.edit',
             compact(
                 'observation',
                 'departments',
                 //'safeBehaviours',
                 'linkedBehaviours',
                 //'riskBehaviours',
                 'safetyBehaviours',
                 'unsafeConditions',
                 'linkedUnsafeConditions',
                 'linkedQualityObservations',
                 'linkedEnvironmentalObservations',
                 'qualityObservations',
                 'environmentalObservations',
                 'statuses',
                 'photos',
                 'user',
             ));
    }
}
