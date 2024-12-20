@extends('layouts.admin')
@section('content')

    <div class="mb-3">
        <button type="button" class="btn btn-primary" onclick="window.location.href='observations/create';">Add observation</button>
    </div>
    <div class="mb-3 table-responsive">

        <table class="table table-striped ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th scope="col">Description</th>
                <th scope="col">HSE Comments</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($observations as $observation)
                <tr>

                    <th scope="row">{{$observation -> id}} </th>
                    <td>{{date('Y-m-d',strtotime($observation->created_at))}}</td>
                    <td>{{date('Y-m-d',strtotime($observation -> updated_at))}}</td>
                    <td>{{$observation -> description}}</td>
                    <td>{{$observation -> comments}}</td>
                    @foreach($statuses as $status)
                        <td>{{ $status->id == $observation->status_id ? $status->title : '' }}</td>
                    @endforeach
                    <td><a href = "{{route('observation.show',$observation -> id)}}">Show</a></td>




                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mb-3">
            {{$observations->withQueryString()->links()}}
        </div>


    </div>


@endsection
