{{--<div class="mb-3">--}}
{{--    <button type="button" class="btn btn-primary" onclick="window.location.href='jobs/create';">Add job</button>--}}
{{--</div>--}}
<div>

    <div class="mb-3 table-responsive">

        <table class="table table-striped ">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th scope="col">Description</th>
                <th scope="col">Department</th>
                <th scope="col">User</th>
                <th scope="col">HSE Comments</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($observations as $observation)
                <tr>
                    <th scope="row">{{$observation -> id}}</th>
                    <td>{{date('Y-m-d',strtotime($observation->created_at))}}</td>
                    <td>{{date('Y-m-d',strtotime($observation -> updated_at))}}</td>
                    <td>{{$observation -> description}}</td>
                    <td>
                    @foreach($departments as $department)
                        {{$department->id == $observation->department_id ? $department->title : '' }}
                    @endforeach
                    </td>
                    <td>
                        @foreach($users as $user)
                            {{$user->id == $observation->user_id ? $user->login : '' }}
                        @endforeach
                    </td>

                    <td>{{$observation -> comments}}</td>
                    @foreach($statuses as $status)
                        <td>{{ $status->id == $observation->status_id ? $status->title : '' }}</td>
                    @endforeach


                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mb-3">
            {{$observations->withQueryString()->links()}}
        </div>


        {{--                        <h3>{{$observation -> observation_name}}</h3>--}}
        {{--                <div>--}}
        {{--                    <a href = "">{{$observation -> id}}: {{$observation -> description}}</a>--}}
        {{--                </div>--}}

        {{--                {{route('observation.show',$observation -> id)}}s--}}
    </div>
</div>
