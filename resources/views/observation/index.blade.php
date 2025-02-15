@extends('layouts.main')
@section('content')

    <div class="mb-3">
        <button type="button" class="btn btn-primary" onclick="window.location.href='observations/create';">
            Add observation
        </button>
        <a href="{{ route('observations.export') }}" class="btn btn-success">Export all observation</a>
    </div>
    @include('includes.elements.filter')
    <div class="mb-3 table-responsive">

        <table class="table table-striped ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Created</th>
                <th scope="col" class="d-none d-md-table-cell">Updated</th>
                <th scope="col">Description</th>
                <th scope="col" class="d-none d-md-table-cell">HSE Comments</th>
                <th scope="col" class="d-none d-md-table-cell">Department</th>
                <th scope="col" class="d-none d-sm-table-cell">Status</th>
                <th scope="col" >Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($observations as $observation)
                <tr>
                    <td >{{$observation -> id}} </td>
                    <td>{{date('Y-m-d',strtotime($observation -> created_at))}}</td>
                    <td class="d-none d-md-table-cell">{{date('Y-m-d',strtotime($observation -> updated_at))}}</td>
                    <td>{{$observation -> description}}</td>
                    <td class="d-none d-md-table-cell">{{$observation -> comments}}</td>
                    <td class="d-none d-md-table-cell">{{$observation -> department-> title ?? 'None'}}</td>
                    <td class="d-none d-sm-table-cell">{{ $observation->status->title ?? 'Unknown'}}</td>

                    <td><a href = "{{route('observation.show',$observation -> id)}}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('observation.edit', $observation) }}" class="btn btn-sm btn-warning">Edit</a>
                        @can('view', auth()->user())
                            <form action="{{ route('observation.destroy', $observation) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @endcan

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mb-3">
            {{$observations->withQueryString()->links()}}
        </div>
    </div>


@endsection
