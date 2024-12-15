@extends('layouts.main')
@section('content')

    <div class="mb-3">
        <button type="button" class="btn btn-primary" onclick="window.location.href='observations/create';">Add observation</button>
    </div>

    @include('includes.elements.filter')
    <!-- Table -->
    <div class="mb-3 table-responsive">
        <table class="table table-striped ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th scope="col">Description</th>
                <th scope="col">HSE Comments</th>
                <th scope="col">Department</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($observations as $observation)
            <tr>

                <td >{{$observation -> id}} </td>
                <td>{{date('Y-m-d',strtotime($observation -> created_at))}}</td>
                <td>{{date('Y-m-d',strtotime($observation -> updated_at))}}</td>
                <td>{{$observation -> description}}</td>
                <td>{{$observation -> comments}}</td>
                <td>{{$observation -> department-> title ?? 'None'}}</td>
                <td>{{ $observation->status->title ?? 'Unknown'}}</td>
{{--                @foreach($statuses as $status)--}}
{{--                    <td>{{ $status->id == $observation->status_id ? $status->title : '' }}</td>--}}
{{--                @endforeach--}}
                    <td><a href = "{{route('observation.show',$observation -> id)}}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('observation.edit', $observation) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('observation.destroy', $observation) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>




            </tr>
            @empty
                <tr>
                    <td colspan="7">No records found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mb-3">
            {{$observations->withQueryString()->links()}}
        </div>

    </div>


@endsection
