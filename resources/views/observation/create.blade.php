@extends('layouts.main')
@section('content')
    <div>
        <form action="{{route('observation.store')}}" method="post">
            @csrf

            <div class="mb-3">
                <label for="location" class="form-label">Observation location</label>
                <input type="text" name="location" class="form-control" id="location" value="{{old('location')}}"
                       placeholder="Observation location">

                @error('location')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="departmentTitle" class="form-label">User department</label>
                <input type="text" name="department_id" hidden class="form-control" id="department_id" value="{{$user->department->id}}">
                <input type="text" disabled class="form-control" id="departmentTitle" value="{{$user->department->title}}"
                       placeholder="user department">

            </div>

            <div class="mb-3">
                <label for="userLogin" class="form-label">Name of Observer</label>
                <input type="text" name="user_id" hidden class="form-control" id="user_id" value="{{$user->id}}">
                <input type="text" disabled class="form-control" id="userLogin" value="{{$user->login}}">

            </div>

{{--            <div class="mb-3">--}}
{{--                <label for="StatusSelector" class="form-label">Department</label>--}}
{{--                <select class="form-select" name="department_id" id="departmentSelector" aria-label="Department">--}}
{{--                    <option selected>None</option>--}}
{{--                    @foreach($departments as $department)--}}
{{--                        <option--}}
{{--                            {{old('department_id') == $department->id ? ' selected' : ''}}--}}
{{--                            value="{{$department->id}}">{{$department->title}}</option>--}}
{{--                    @endforeach--}}

{{--                </select>--}}
{{--            </div>--}}

            <div class="mb-3">
                <label for="description" class="form-label">Job Description</label>
                <textarea type="text" name="description" class="form-control" id="description"
                          placeholder="Job Description" wire:model="description">{{old('description')}}</textarea>
                @error('description')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="further" class="form-label">Further Action Required</label>
                <textarea type="text" name="further" class="form-control" id="further"
                          placeholder="Description" wire:model="further">{{old('further')}}</textarea>
                @error('further')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="corrective" class="form-label">Corrective/Immediate Action Taken</label>
                <textarea type="text" name="corrective" class="form-control" id="corrective"
                          placeholder="Description" wire:model="corrective">{{old('corrective')}}</textarea>
                @error('corrective')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>



{{--            <div class="mb-3">--}}
{{--                <select class="form-select" multiple size="3" id="users" name="users[]" aria-label="Users">--}}
{{--                    @foreach($users as $user)--}}
{{--                        <option value="{{$user->id}}">{{$user->name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
