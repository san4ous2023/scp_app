<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Http\Filters\ObservationFilter;
use App\Http\Requests\Observation\FilterRequest;
use App\Models\hse\observations\Observation;
use App\Models\hse\observations\SafetyBehaviours;
use App\Models\hse\observations\UnsafeConditions;
use App\Models\Status;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request){


try{
   //$user = auth()->user();
    $user = auth()->user();
    $data = $request ->validated();
    if( $user !== null){
        $filter = app()->make(ObservationFilter::class,['queryParams'=>array_filter($data)]);
        if($user->role && $user->role->title === 'admin'){



            //$observations = Observation::where('user_id',$user->id)->paginate(15);
            $observations = Observation::filter($filter)->paginate(15);
            //$observations = Observation::paginate(15);

        }
        else {
            $observations = Observation::where('user_id',$user->id)->filter($filter)->paginate(15);
        }

        //$statuses= Status::all();

        //session()->flash('success', 'Observation 121created successfully');
        return view('observation.index',compact('observations',));
    }
    // If the user is not authenticated
    return redirect()->route('login')->with('error', 'Please login to view observations.');



} catch (\Exception $message){
    return redirect()->route('home');
}
        //$user = auth()->user();
       // dd($user);



    }
}
