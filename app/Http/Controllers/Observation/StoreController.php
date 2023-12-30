<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Observation\StoreRequest;
use App\Models\Observation;
use Illuminate\Http\Request;

class StoreController extends Controller
{
//StoreRequest $request
    public function __invoke(StoreRequest $request){
        //return redirect()->route('welcome');
        //dd($request);
        $data = $request->validated();
        //$user = $data['user_id'];
        $data['status_id'] = 1;
        //$department = $data['department_id'];
        //unset($data['user_id']);
        //unset($data['status_id']);
        //unset($data['department_id']);
        $data['site'] = 'SCP';

        //dd($data);
        $observation = Observation::create($data);
        //$observation->user_id()->attach($user);
        //$observation->status_id()->attach($status);
        //$observation->department_id()->attach($department);
        return redirect()->route('observation.index');
    }

}
