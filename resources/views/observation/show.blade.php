@extends('layouts.main')
@section('content')
    <div class="container mt-3">
        <div class="mb-3">
            <button type="button" class="btn btn-primary"
                    onclick="window.location.href='{{route('observation.index')}}';">Back
            </button>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <div ><strong>Observation #{{$observation -> id}}</strong></div>
            </div>
            <div class="card-body">
                <div class="row mb-3 ">
                    <div class="col-sm-auto"><strong>Site / Location:</strong></div>
                    <div class="col-sm-auto">{{$observation -> site}} / {{$observation -> location}}</div>
                </div>

                <div class="row mb-3 ">
                    <div class="col-sm-auto"><strong>User:</strong></div>
                    <div class="col-sm-auto">{{$user}}</div>
                </div>
                <div class="row mb-3 ">
                    <div class="col-sm-auto"><strong>Department:</strong></div>
                    <div class="col-sm-auto">{{$department}}</div>
                </div>
                <div class="row mb-3 ">
                    <div class="col-sm-auto"><strong>Description:</strong></div>
                    <div class="col-sm-auto">{{$observation -> description}}</div>
                </div>

                <div class="row mb-3 ">
                    <div class="col-sm-auto"><strong>Status:</strong></div>
                    <div class="col-sm-auto">{{$status -> first()->title}}</div>
                </div>

                <div class="row mb-3 ">
                    <div class="col-sm-auto"><strong>Created:</strong></div>
                    <div class="col-sm-auto">{{date('d M Y H:i',strtotime($observation->created_at))}}</div>
                </div>
                <div class="row mb-3 ">
                    <div class="col-sm-auto"><strong>Updated:</strong></div>
                    <div class="col-sm-auto">{{date('d M Y H:i',strtotime($observation -> updated_at))}}</div>
                </div>
            </div>



        </div>




        <div class="row mb-3 ">

            @if(isset($safeBehaviours[0]) || isset($riskBehaviours[0]))
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-header">
                            Safety Behaviours
                        </div>
                        <ul class="list-group list-group-flush">
                            @if($safeBehaviours)
                                @foreach($safeBehaviours as $safeBehaviour)
                                    <li class="list-group-item">SAFE: {{$safeBehaviour->title}}</li>
                                @endforeach
                            @endif
                            @if($riskBehaviours)
                                @foreach($riskBehaviours as $riskBehaviour)
                                    <li class="list-group-item">AT RISK: {{$riskBehaviour->title}}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            @endif



            @if(isset($unsafeConditions[0]))
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-header">
                            Unsafe conditions
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($unsafeConditions as $unsafeCondition)
                                <li class="list-group-item">{{$unsafeCondition->title}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif



            @if(isset($qualityObservations[0]))
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-header">
                            Quality Observations
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($qualityObservations as $qualityObservation)
                                <li class="list-group-item">{{$qualityObservation->title}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif



            @if(isset($environmentalObservations[0]))
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-header">
                            Environmental Observations
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($environmentalObservations as $environmentalObservation)
                                <li class="list-group-item">{{$environmentalObservation->title}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        <div class="row mb-3 ">
            @if($observation->corrective != '')
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-header">
                            Corrective/Immediate Action Taken
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$observation->corrective}}</li>
                        </ul>
                    </div>
                </div>
            @endif

            @if($observation->further != '')
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-header">
                            Further Action required
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$observation->further}}</li>
                        </ul>
                    </div>
                </div>
            @endif

            @if($observation->comments != null)
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-header">
                            HSE Comments
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$observation->comments}}</li>
                        </ul>
                    </div>
                </div>
            @endif

            @if(!empty($observation->photos))
                <div class="row">

                    @foreach($observation->photos as $photo)
                        <div class="col-md-4 mb-3">
                            <div class="card" style="width: 18rem; border-radius: 10px;">
                                <img src="{{ asset('storage/' . $photo->url) }}" alt="Photo"
                                     style=" border-radius: 10px;">
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>


        {{--        <span>Details for job ID {{$job -> id}}</span><br>--}}
        {{--        <span>Name: {{$job -> job_name}}</span><br>--}}
        {{--        <span>Description: {{$job -> description}}</span><br>--}}
        {{--        <span>Status: {{$job -> status}}</span>--}}
        {{--    </div>--}}

        {{--    <div>--}}
        {{--        <a href="{{route('job.edit', $job -> id)}}">Edit</a>--}}
        {{--    </div>--}}

        {{--    <div>--}}
        {{--        <form action="{{route('job.destroy', $job -> id)}}" method ="post">--}}
        {{--            @csrf--}}
        {{--            @method('delete')--}}
        {{--            <input type="submit" value="Delete">--}}
        {{--        </form>--}}

        {{--    </div>--}}

        {{--    <div>--}}
        {{--        <a href="{{route('job.index')}}">Back</a>--}}
        {{--    </div>--}}
    </div>
@endsection
