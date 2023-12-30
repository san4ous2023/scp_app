<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Models\Observation;
use App\Models\Status;

class IndexController extends Controller
{
    public function __invoke(){


        $user = auth()->user();
        $statuses= Status::all();
        $observations = Observation::where('user_id',$user->id)->paginate(5);

        return view('observation.index',compact('observations','statuses'));
    }
}
