<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\hse\observations\EnvironmentalObservation;
use App\Models\hse\observations\QualityObservations;
use App\Models\hse\observations\SafetyBehaviours;
use App\Models\hse\observations\UnsafeConditions;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke()
    {

        //$unsafeCheckbox = [];
        $photos=[];
        $unsafeConditions = UnsafeConditions::all();
        $safetyBehaviours = SafetyBehaviours::all();
        $qualityObservations = QualityObservations::all();
        $environmentalObservations = EnvironmentalObservation::all();
        $departments = Department::all();
//$statuses = Status::all();
        $guestUser = User::first();
        $user = auth()->user() ?? $guestUser;

        foreach ($unsafeConditions as $unsafeCondition) {
            $unsafeCheckbox = array_fill_keys($unsafeCondition->pluck('id')->toArray(), false);

        }
        //session()->flash('success', 'Observation 11created successfully');
        return view('observation.create', compact(
            'departments',
            'user',
            'unsafeConditions',
            'safetyBehaviours',
            'qualityObservations',
            'environmentalObservations',
            'photos'
        ));
    }
}
