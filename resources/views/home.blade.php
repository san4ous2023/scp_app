@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
{{--                        <a href = "{{route('observation.index')}}" class="btn btn-sm btn-info">View Observations</a>--}}
                </div>
            </div>

        </div>
    </div>
    <div class="row g-3 m-3">  <!-- Adds spacing between cards -->
        <!-- Observation Card -->
        <div class="col-md-4 col-12">
            <a href="{{ route('observation.index') }}" class="text-decoration-none">
            <div class="card " >
                <div class="card-header text-center text-white bg-danger">
                    <h5 class="card-title">Observation</h5>
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">You can add or preview your observations</h5>
                </div>
            </div>
            </a>
        </div>

        <!-- Intervention Card -->

        <div class="col-md-4 col-12">
            <a href="" class="text-decoration-none">
                <div class="card " >
                    <div class="card-header text-center text-white bg-primary">
                        <h5 class="card-title">Intervention</h5>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">You can add or preview your Intervention</h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- Work Order Card -->
        <div class="col-md-4 col-12">
                <a href="" class="text-decoration-none">
                    <div class="card " >
                        <div class="card-header text-center text-white " style="background-color: darkorange">
                            <h5 class="card-title">Work Order</h5>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">You can report defect or do a work order</h5>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
