@extends('layouts.admin')
@section('content')

    <div class="mb-3">
        <button type="button" class="btn btn-primary" onclick="window.location.href='observations/create';">Add observation</button>
    </div>
    <!-- Toggle Switch -->
    <div class="d-flex align-items-center mb-3">
        <label class="form-check-label me-2" for="toggleFilter">Show Filters</label>
        <input type="checkbox" class="form-check-input" id="toggleFilter">
    </div>

    <!-- Filters -->
    <div id="filterRow" class="mb-3" style="display: none;">
        <form id="filterForm" action="{{ route('admin.observation.index') }}" method="GET">
            <div class="row g-2">
                <div class="col">
                    <label for="userId" class="form-label">User ID</label>
                    <input type="text" class="form-control" id="userId" name="user_id" placeholder="Enter User ID">
                </div>
                <div class="col">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Select Status</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="col">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="startDate" name="start_date">
                </div>
                <div class="col">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="endDate" name="end_date">
                </div>
{{--                <div class="col">--}}
{{--                    <label for="updatedAt" class="form-label">Updated At</label>--}}
{{--                    <input type="date" class="form-control" id="updatedAt" name="updated_at">--}}
{{--                </div>--}}
            </div>
            <button type="submit" class="btn btn-primary mt-3">Search</button>
        </form>
    </div>
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

    <script>
        document.getElementById('toggleFilter').addEventListener('change', function () {
            const filterRow = document.getElementById('filterRow');
            if (this.checked) {
                filterRow.style.display = 'block';
            } else {
                filterRow.style.display = 'none';
            }
        });
    </script>

    <script>
        document.getElementById('filterForm').addEventListener('submit', function (e) {
            const inputs = this.querySelectorAll('input, select');
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.name = ''; // Remove the name to exclude it from the query string
                }
            });
        });
    </script>
    <style>
        #filterRow {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
@endsection
