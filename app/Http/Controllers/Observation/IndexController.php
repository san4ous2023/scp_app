<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Models\hse\observations\Observation;
use App\Models\hse\observations\SafetyBehaviours;
use App\Models\hse\observations\UnsafeConditions;
use App\Models\Status;

class IndexController extends Controller
{
    public function __invoke(){


try{
    $user = auth()->user();
    if( $user !== null){

        $statuses= Status::all();
        $observations = Observation::where('user_id',$user->id)->paginate(15);
        //session()->flash('success', 'Observation 121created successfully');
        return view('observation.index',compact('observations','statuses'));
    }
    else return redirect()->route('home');


} catch (\Exception $message){
    return redirect()->route('home');
}
        //$user = auth()->user();
       // dd($user);



    }
}
