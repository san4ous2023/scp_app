@extends('layouts.main')
@section('content')
    <div>
        <div class="mb-3">
            <button type="button" class="btn btn-primary"
                    onclick="window.location.href='{{route('observation.index')}}';">Back
            </button>
        </div>
        <form action="{{route('observation.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="mb-3 col-md-auto">
                    <label for="location" class="form-label">Observation location</label>
                    <input type="text" name="location" class="form-control" id="location" value="{{old('location')}}"
                           placeholder="Location on the vessel">
                    @error('location')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-3 col-md-auto">
                    <label for="site" class="form-label">Observation site</label>
                    <input type="text" name="site" class="form-control" id="site" value="{{old('site')}}"
                           placeholder="Site">
                    @error('site')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-auto">
                    <label for="userLogin" class="form-label">Name of Observer</label>
                    <input type="text" name="user_id" hidden class="form-control" id="user_id" value="{{$user->id}}">
                    <input type="text" disabled class="form-control" id="userLogin" value="{{$user->login}}">
                </div>

                <div class="mb-3 col-md-auto">
                    <label for="departmentTitle" class="form-label">User department</label>
                    <input type="text" name="department_id" hidden class="form-control" id="department_id"
                           value="{{$user->department->id}}">
                    <input type="text" disabled class="form-control" id="departmentTitle"
                           value="{{$user->department->title}}"
                           placeholder="User department">
                </div>
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

            {{--Observation Description INPUT--}}
            <div class="mb-3">
                <label for="description" class="form-label">Observation Description</label>
                <textarea type="text" name="description" class="form-control" id="description"
                          placeholder="Description">{{old('description')}}</textarea>
                @error('description')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>


            <div class="row">

                {{--SAFETY BEHAVIOURS LIST CONTAINER--}}
                <div class="col-auto me-3 mt-2 mb-2 rounded-2" id="behavioursContainer">
                    <div class="mb-3 mt-2">
                        <div class="form-check form-switch">
                            <label for="behavioursSwitch" class="form-check-label">Critical Safety Behaviors</label>
                            <input class="form-check-input" role="switch" type="checkbox" id="behavioursSwitch"
                                   onchange="openList('safetyBehaviours','behavioursSwitch','behavioursContainer')">
                        </div>
                    </div>

                    <div class="mb-3" id="safetyBehaviours" hidden>

                        <div class="row mx-1 row-cols-md-auto " style="padding-top: 16px;">
                            <div class=" col-1" style="transform: rotate(270deg); font-size:10px; max-width: 16px">
                                SAFE
                            </div>
                            <div class=" col-1" style="transform: rotate(270deg); font-size:10px;max-width: 16px">
                                AT RISK
                            </div>
                        </div>
                        @foreach($safetyBehaviours as $behaviour)
                            <div class="row gx-3 p-2  align-items-center">
                                <div class="form-check col-1">
                                    <input class="form-check-input" type="checkbox"
                                           name="safeCheckbox[{{$behaviour->id}}]">
                                </div>
                                <div class="form-check col-1">
                                    <input class="form-check-input" type="checkbox"
                                           name="riskCheckbox[{{$behaviour->id}}]">
                                </div>
                                <div class="col text-wrap">{{$behaviour->title}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{--END SAFETY BEHAVIOURS LIST CONTAINER--}}

                {{--UNSAFE LIST CONTAINER--}}
                <div class="col-auto me-3 mt-2 mb-2 rounded-2 " id="unsafeContainer">
                    <div class="mb-3 mt-2">
                        <div class="form-check form-switch">
                            <label for="unsafeSwitch" class="form-check-label">Unsafe Conditions</label>
                            <input class="form-check-input" role="switch" type="checkbox" id="unsafeSwitch"
                                   onchange="openList('unsafeConditions','unsafeSwitch','unsafeContainer')">
                        </div>
                    </div>
                    <div class="mb-3" id="unsafeConditions" hidden>
                        <div class=" col-1 " style=" font-size:10px;max-width: 16px">
                            AT RISK
                        </div>
                        @foreach($unsafeConditions as $unsafe)
                            <div class="row gx-3 p-2  align-items-center">
                                <div class="form-check col-1">
                                    <input class="form-check-input" type="checkbox"
                                           name="unsafeCheckbox[{{$unsafe->id}}]">
                                </div>
                                <div class="col text-wrap">{{$unsafe->title}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{--END UNSAFE LIST CONTAINER--}}

                {{--QUALITY OBSERVATION LIST CONTAINER--}}
                <div class="col-auto me-3 mt-2 mb-2 rounded-2 " id="qualityContainer">
                    <div class="mb-3 mt-2">
                        <div class="form-check form-switch">
                            <label for="qualitySwitch" class="form-check-label">Quality Observation</label>
                            <input class="form-check-input" role="switch" type="checkbox" id="qualitySwitch"
                                   onchange="openList('qualityConditions','qualitySwitch','qualityContainer')">
                        </div>
                    </div>
                    <div class="mb-3" id="qualityConditions" hidden>
                        <div class=" col-1 " style=" font-size:10px;max-width: 16px">
                            AT RISK
                        </div>
                        @foreach($qualityObservations as $quality)
                            <div class="row gx-3 p-2  align-items-center">
                                <div class="form-check col-1">
                                    <input class="form-check-input" type="checkbox"
                                           name="qualityCheckbox[{{$quality->id}}]">
                                </div>
                                <div class="col text-wrap">{{$quality->title}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{--QUALITY OBSERVATION LIST CONTAINER--}}

                {{--ENVIRONMENTAL OBSERVATION LIST CONTAINER--}}
                <div class="col-auto me-3 mt-2 mb-2 rounded-2 " id="environmentalContainer">
                    <div class="mb-3 mt-2">
                        <div class="form-check form-switch">
                            <label for="environmentalSwitch" class="form-check-label">Quality Observation</label>
                            <input class="form-check-input" role="switch" type="checkbox" id="environmentalSwitch"
                                   onchange="openList('environmentalConditions','environmentalSwitch','environmentalContainer')">
                        </div>
                    </div>
                    <div class="mb-3" id="environmentalConditions" hidden>
                        <div class=" col-1 " style=" font-size:10px;max-width: 16px">
                            AT RISK
                        </div>
                        @foreach($environmentalObservations as $environmental)
                            <div class="row gx-3 p-2  align-items-center">
                                <div class="form-check col-1">
                                    <input class="form-check-input" type="checkbox"
                                           name="environmentalCheckbox[{{$environmental->id}}]">
                                </div>
                                <div class="col text-wrap">{{$environmental->title}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{--ENVIRONMENTAL OBSERVATION LIST CONTAINER--}}


            </div>

            <div class="row">
                {{--FURTHER ACTION INPUT--}}
                <div class="mb-3 col-md-auto">
                    <div class="form-check form-switch">
                        <label for="furtherSwitch" class="form-check-label">Further Action Required</label>
                        <input class="form-check-input" role="switch" type="checkbox" id="furtherSwitch"
                               onchange="openList('furtherTextarea','furtherSwitch')">
                    </div>
                    <div id="furtherTextarea" hidden>
                    <textarea type="text" name="further" class="form-control" id="further"
                              placeholder="Further Action Required">{{old('further')}}</textarea>
                        @error('further')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>


                {{--CORRECTIVE ACTION INPUT--}}
                <div class="mb-3 col-md-auto">
                    <div class="form-check form-switch">
                        <label for="correctiveSwitch" class="form-check-label">Corrective/Immediate Action Taken</label>
                        <input class="form-check-input" role="switch" type="checkbox" id="correctiveSwitch"
                               onchange="openList('correctiveTextarea','correctiveSwitch')">
                    </div>
                    <div id="correctiveTextarea" hidden>
                    <textarea type="text" name="corrective" class="form-control" id="corrective"
                              placeholder="Corrective/Immediate Action Description">{{old('corrective')}}</textarea>
                        @error('corrective')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <span id="test"></span>
                <label for="photosInput" class="form-label">You can submit photo along with observation</label>
                <input type="file" class="form-control" id="photosInput" name="photos[]" multiple>
                @error('photos.*') <span class="text-danger">{{ $message }}</span> @enderror
                <!-- Preview Container -->
                <div id="previewContainer" class="row mt-3">

                </div>

                {{--TODO implement multiple photo uploads with preview--}}
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

    <script>
        function openList($listName, $switchName, $containerName) {
            if (!document.getElementById($switchName).checked) {
                document.getElementById($listName).hidden = true;
                if ($containerName != null) {
                    document.getElementById($containerName).classList.remove('bg-body-secondary');
                }
            } else {
                document.getElementById($listName).hidden = false;
                if ($containerName != null) {
                    document.getElementById($containerName).classList.add('bg-body-secondary');
                }
            }

        }

        // function runTest(){
        //     var fileName = document.getElementById("photosInput").files;
        //     var files ='';
        //          for (var i =0; i<fileName.length;i++){
        //         files = files + '_' + fileName[i].name;
        //     }
        //     document.getElementById("test").innerHTML = files;
        // }
        //     .split("\\").pop()
    </script>
    <script>
        document.getElementById('photosInput').addEventListener('change', function (event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('previewContainer');

            // Clear any existing previews
            previewContainer.innerHTML = '';

            // Loop through selected files and create preview elements
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) { // Ensure it's an image
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        // Create a Bootstrap-styled card for each image
                        const col = document.createElement('div');
                        col.className = 'col-md-3 mb-3'; // Adjust grid size as needed

                        const card = document.createElement('div');
                        card.className = 'card';

                        const img = document.createElement('img');
                        img.src = e.target.result; // Set the image source
                        img.alt = 'Photo Preview';
                        img.className = 'card-img-top img-fluid'; // Bootstrap styling for responsive images

                        const cardBody = document.createElement('div');
                        cardBody.className = 'card-body p-2 text-center';
                        cardBody.innerText = file.name; // Display the file name

                        card.appendChild(img);
                        card.appendChild(cardBody);
                        col.appendChild(card);
                        previewContainer.appendChild(col);
                    };
                    reader.readAsDataURL(file); // Read the image file
                }
            });
        });
    </script>
    {{--    <script>--}}
    {{--        function closeAlert($alertName){--}}
    {{--            document.getElementById($alertName).hidden = true;--}}
    {{--        }--}}
    {{--    </script>--}}
@endsection

{{--document.getElementById("unsafeCheckbox").checked--}}
