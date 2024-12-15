<?php

namespace App\Http\Controllers\Admin\Observation;

use App\Http\Controllers\Controller;
use App\Http\Filters\ObservationFilter;
use App\Http\Requests\Observation\FilterRequest;
use App\Models\hse\observations\Observation;
use App\Models\Status;


class IndexController extends Controller
{
    public function __invoke(FilterRequest $request)
    {
        $user = auth()->user();
        if( $user !== null){
           // $statuses = Status::all();
            $data = $request ->validated();
            $filter = app()->make(ObservationFilter::class,['queryParams'=>array_filter($data)]);
            //$observations = Observation::where('user_id',$user->id)->paginate(15);
            $observations = Observation::filter($filter)->paginate(15);
               //session()->flash('success', 'Observation 121created successfully');
        return view('admin.observation.index', compact('observations'));
        } else echo('No user found');
//        try {
//            $user = auth()->user();
//            if ($user !== null) {
//
//                $statuses = Status::all();
//                $observations = Observation::all()->paginate(15);
//                //session()->flash('success', 'Observation 121created successfully');
//                return view('admin.observation.index', compact('observations', 'statuses'));
//            } else return redirect()->route('home');
//
//
//        } catch (\Exception $message) {
//            return redirect()->route('home');
//        }
//        //$user = auth()->user();
//        // dd($user);


    }
}
