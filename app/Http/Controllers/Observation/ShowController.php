<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Models\hse\observations\Observation;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Observation $observation)
    {
        $status = $observation->status()->get();
        $unsafeConditions = $observation->unsafeConditions()->get();
        $qualityObservations = $observation->qualityObservations()->get();
        $environmentalObservations = $observation->environmentalObservations()->get();
        $safeBehaviours = $observation->safetyBehaviours()->where($column='state',$value='SAFE')->get();
        $riskBehaviours = $observation->safetyBehaviours()->where($column='state',$value='AT RISK')->get();
        $photos = $observation -> photos()->get();
        //$riskBehaviours = $observation->safetyBehaviours()->withPivot('AT RISK')->get();
        //dd($photos[0]->url);

// $post = Post::findOrFail($id);
        return view('observation.show',
            compact('observation',
                'unsafeConditions',
                'qualityObservations',
                'environmentalObservations',
                'safeBehaviours',
                'riskBehaviours',
                'status',
                'photos'
            ));
    }
}
