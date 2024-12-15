<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Models\hse\observations\Observation;
use Illuminate\Http\Request;

class ShowController extends BaseController
{
    public function __invoke(Observation $observation)
    {
        //dd($observation);
        //$observation = $observation->load();
        $status = $observation->status()->get();
        $unsafeConditions = $observation->unsafeConditions()->get();
        $qualityObservations = $observation->qualityObservations()->get();
        $environmentalObservations = $observation->environmentalObservations()->get();
        $safeBehaviours = $observation->safetyBehaviours()->where($column='state',$value='SAFE')->get();
        $riskBehaviours = $observation->safetyBehaviours()->where($column='state',$value='AT RISK')->get();
        $photos = $observation -> photos()->get();
        $user = $observation -> user->login;
        $department = $observation -> department->title;
        //$riskBehaviours = $observation->safetyBehaviours()->withPivot('AT RISK')->get();
        //dd($photos[0]->url);

// $post = Post::findOrFail($id);
        //\Log::info('Rendering observation.show with observation:', $observation->toArray());
        return view('observation.show',
            compact('observation',
                'unsafeConditions',
                'qualityObservations',
                'environmentalObservations',
                'safeBehaviours',
                'riskBehaviours',
                'status',
                'photos',
                'user',
                'department'
            ));
    }
}
