{{--<div>--}}

{{--    <div class="form-check form-switch">--}}
{{--        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:click="getDep" wire:model.live="checkboxState">--}}
{{--        <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>--}}
{{--    </div>--}}

{{--    <select class="form-select" aria-label="Default select example" {{$checkboxState == false ? 'hidden' : ''}}>--}}

{{--        @foreach($departments as $department)--}}
{{--            <option value="{{$department->id}}">{{$department->title}}</option>--}}
{{--        @endforeach--}}


{{--    </select>--}}
{{--    <textarea class="my-3"type="text" wire:model="content">{{ $content }}</textarea>--}}

{{--</div>--}}

<div>
    <form wire:submit="createObservation" method="post">
        {{--        @csrf--}}
        {{--Time selection input to be implemented in future --}}
        <div class="mb-3">
            <label for="location" class="form-label">Observation location</label>
            <input type="text" name="location" class="form-control" id="location" value="{{old('location')}}"
                   placeholder="Location" wire:model="location">

            @error('location')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="site" class="form-label">Observation site</label>
            <input type="text" name="site" class="form-control" id="site" value="{{old('site')}}"
                   placeholder="Site" wire:model="site">

            @error('site')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="userLogin" class="form-label">Name of Observer</label>
            <input type="text" name="user_id" hidden class="form-control" id="user_id" value="{{$user->id}}">
            <input type="text" disabled class="form-control" id="userLogin" value="{{$user->login}}">
        </div>

        <div class="mb-3">
            <label for="departmentTitle" class="form-label">User department</label>
            <input type="text" name="department_id" hidden class="form-control" id="department_id"
                   value="{{$user->department->id}}">
            <input type="text" disabled class="form-control" id="departmentTitle" value="{{$user->department->title}}"
                   placeholder="user department">
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
            <label for="description" class="form-label">Observation Description</label>
            <textarea type="text" name="description" class="form-control" id="description"
                      placeholder="Description" wire:model="description">{{old('description')}}</textarea>
            @error('description')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="row">
            <div class="col-auto me-3 mt-2 mb-2 {{$behavioursSwitch == false ? '' : 'bg-secondary-subtle rounded-2'}}">
                <div class="mb-3 mt-2">
                    <div class="form-check form-switch">
                        <label for="behavioursSwitch" class="form-check-label">Critical Safety Behaviors</label>
                        <input class="form-check-input" role="switch" type="checkbox" id="behavioursSwitch"
                               wire:model.live="behavioursSwitch">
                    </div>
                </div>

                <div class="mb-3" {{$behavioursSwitch == false ? 'hidden' : ''}}>
                    <div class="row mx-1 row-cols-md-auto " style="padding-top: 16px;">
                        <div class=" col-1" style="transform: rotate(270deg); font-size:10px; max-width: 16px">
                            SAFE
                        </div>
                        <div class=" col-1" style="transform: rotate(270deg); font-size:10px;max-width: 16px">
                            AT RISK
                        </div>
                    </div>
                    @foreach($safetyBehaviours as $behaviours)
                        <div class="row gx-3 p-2  align-items-center">
                            <div class="form-check col-1">
                                <input class="form-check-input" type="checkbox"
                                       wire:change="pressSafeCheckbox({{$behaviours->id}})"
                                       wire:model.live="safeCheckbox.{{$behaviours->id}}">
                            </div>
                            <div class="form-check col-1">
                                <input class="form-check-input" type="checkbox"

                                       wire:change="pressRiskCheckbox({{$behaviours->id}})"
                                       wire:model.live="riskCheckbox.{{$behaviours->id}}">
                            </div>
                            <div class="col text-wrap">{{$behaviours->title}}</div>

                        </div>

                    @endforeach
                </div>
            </div>

<livewire:items.safety-list :listItems="$unsafeConditions"
                            :listItemsCheckbox="$unsafeCheckbox"
                            title="Unsafe Conditions" />
{{--            @livewire('items.safety-list',[--}}
{{--            'listItems'=>'{{$unsafeConditions}}',--}}
{{--            'title'=>'Unsafe Conditions'--}}
{{--            ])--}}


{{--            <div class="col-auto me-3 mt-2 mb-2 {{$unsafeSwitch == false ? '' : 'bg-body-secondary rounded-2'}}">--}}
{{--                <div class="mb-3 mt-2">--}}
{{--                    <div class="form-check form-switch">--}}
{{--                        <label for="unsafeSwitch" class="form-check-label">Unsafe Conditions</label>--}}
{{--                        <input class="form-check-input" role="switch" type="checkbox" id="unsafeSwitch"--}}
{{--                               wire:model.live="unsafeSwitch">--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="mb-3" {{$unsafeSwitch == false ? 'hidden' : ''}}>--}}

{{--                    <div class=" col-1 " style=" font-size:10px;max-width: 16px">--}}
{{--                        AT RISK--}}
{{--                    </div>--}}

{{--                    @foreach($unsafeConditions as $unsafe)--}}
{{--                        <div class="row gx-3 p-2  align-items-center">--}}
{{--                            <div class="form-check col-1">--}}
{{--                                <input class="form-check-input" type="checkbox"--}}
{{--                                       wire:model.live="unsafeCheckbox.{{$unsafe->id}}">--}}
{{--                            </div>--}}
{{--                            <div class="col text-wrap">{{$unsafe->title}}</div>--}}
{{--                        </div>--}}

{{--                    @endforeach--}}
{{--                </div>--}}

{{--            </div>--}}
            {{--            {{$qualitySwitch == false ? '' : 'bg-secondary-subtle rounded-2'}}--}}
            <div class="col-auto me-3 mt-2 mb-2 ">
                <div class="mb-3 mt-2">
                    <div class="form-check form-switch">
                        <label for="qualitySwitch" class="form-check-label">Quality Observation</label>
                        <input class="form-check-input" role="switch" type="checkbox" id="qualitySwitch"
                               wire:model.live="qualitySwitch">
                    </div>
                </div>

                <div class="mb-3" {{$qualitySwitch == false ? 'hidden' : ''}}>

                    <div class=" col-1 " style=" font-size:10px;max-width: 16px">
                        AT RISK
                    </div>

                    @foreach($qualityObservations as $quality)
                        <div class="row gx-3 p-2  align-items-center">
                            <div class="form-check col-1">
                                <input class="form-check-input" type="checkbox"
                                       wire:model.live="qualityCheckbox.{{$quality->id}}">
                            </div>
                            <div class="col text-wrap">{{$quality->title}}</div>
                        </div>

                    @endforeach
                </div>

            </div>
            {{--            {{$environmentalSwitch == false ? '' : 'bg-secondary-subtle rounded-2'}}--}}
            <div class="col-auto me-3 mt-2 mb-2 ">
                <div class="mb-3 mt-2">
                    <div class="form-check form-switch">
                        <label for="environmentalSwitch" class="form-check-label">Environmental Observation</label>
                        <input class="form-check-input" role="switch" type="checkbox" id="environmentalSwitch"
                               wire:model.live="environmentalSwitch">
                    </div>
                </div>

                <div class="mb-3" {{$environmentalSwitch == false ? 'hidden' : ''}}>

                    <div class=" col-1 " style=" font-size:10px;max-width: 16px">
                        AT RISK
                    </div>

                    @foreach($environmentalObservations as $environmental)
                        <div class="row gx-3 p-2  align-items-center">
                            <div class="form-check col-1">
                                <input class="form-check-input" type="checkbox"
                                       wire:model.live="environmentalCheckbox.{{$environmental->id}}">
                            </div>
                            <div class="col text-wrap">{{$environmental->title}}</div>
                        </div>

                    @endforeach
                </div>

            </div>

        </div>


        <div class="mb-3">
            <div class="form-check form-switch">
                <label for="furtherSwitch" class="form-check-label">Further Action Required </label>
                <input class="form-check-input" role="switch" type="checkbox" id="furtherSwitch"
                       wire:model.live="furtherSwitch">
            </div>

            <textarea type="text" name="further" class="form-control" id="further"
                      {{$furtherSwitch == false ? 'hidden' : ''}}
                      placeholder="Further Action Description" wire:model="further">{{old('further')}}</textarea>

        </div>

        <div class="mb-3">

            <div class="form-check form-switch">
                <label for="correctiveSwitch" class="form-check-label">Corrective/Immediate Action Taken</label>
                <input class="form-check-input" role="switch" type="checkbox" id="correctiveSwitch"
                       wire:model.live="correctiveSwitch">
            </div>
            <textarea type="text" name="corrective" class="form-control" id="corrective"
                      {{$correctiveSwitch == false ? 'hidden' : ''}}
                      placeholder="Corrective/Immediate Action Description"
                      wire:model="corrective">{{old('corrective')}}</textarea>

        </div>

        <div class="mb-3">
            <label for="photosInput" class="form-label">You can submit photo along with observation</label>
            @if ($photos)
                <div class="mb-3">
                @foreach($photos as $photo)
                    <img src="{{ $photo->temporaryUrl() }} "  alt="some image" class="rounded-2 w-25">
                @endforeach
                </div>
            @endif

            <input type="file" id="photosInput" class="form-control" wire:model="photos" multiple>

            @error('photos.*') <span class="error">{{ $message }}</span> @enderror

{{--            <button type="submit">Save photo</button>--}}
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

