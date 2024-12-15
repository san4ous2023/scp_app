@extends('layouts.main')
@section('content')
    <div>
        <div class="mb-3">
            <a href="{{url()->previous() ?? route('observation.index') }}" class="btn btn-primary">Back</a>
        </div>
        <form action="{{route('observation.update',$observation->id)}}" method="post" enctype="multipart/form-data"
              novalidate>
            @csrf
            @method('patch')
            {{--            <fieldset>--}}
            {{--                <legend>Observation Details</legend>--}}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
            <div class="row">

                {{--Observation LOCATION--}}
                <div class="mb-3 col-md-auto">
                    <label for="location" class="form-label">Observation location</label>
                    <input type="text"
                           name="location"
                           class="form-control"
                           id="location"
                           value="{{ $observation -> location }}"
                           placeholder="Location on the vessel">
                    @error('location')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                {{--Observation SITE--}}
                <div class="mb-3 col-md-auto">
                    <label for="site" class="form-label">Observation site</label>
                    <input type="text"
                           name="site"
                           class="form-control"
                           id="site"
                           value="{{$observation -> site}}"
                           placeholder="Site">
                    @error('site')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            {{--USER LOGIN--}}
            <div class="row">
                <div class="mb-3 col-md-auto">
                    <label for="userLogin" class="form-label">Name of Observer</label>
                    <input type="text" name="user_id" hidden class="form-control" id="user_id"
                           value="{{$user->id}}">
                    <input type="text" disabled class="form-control" id="userLogin" value="{{$user->login}}">
                </div>

                {{--USER DEPARTMENT--}}
                <div class="mb-3 col-md-auto">
                    <label for="departmentTitle" class="form-label">User department</label>
                    <input type="text" name="department_id" hidden class="form-control" id="department_id"
                           value="{{$user->department->id}}">
                    <input type="text" disabled class="form-control" id="departmentTitle"
                           value="{{$user->department->title}}"
                           placeholder="User department">
                </div>
                {{--ASSIGN DEPARTMENT--}}
                <div class="mb-3 col-md-auto">
                    <label for="departmentTitle" class="form-label">Assigned to department</label>
                    {{--                    <input type="text" name="department_id" hidden class="form-control" id="department_id"--}}
                    {{--                           value="{{$user->department->id}}">--}}
                    <select class="form-select" name="department_id" id="departmentSelector"
                            aria-label="Department">

                        @foreach($departments as $department)
                            <option {{ $department->id == $observation->department_id ? ' selected' : '' }}
                                    value="{{$department->id}}">{{$department->title}}</option>
                        @endforeach

                    </select>
                </div>

                {{--STATUS of OBSERVATION--}}
                <div class="mb-3 col-md-auto">
                    <label for="departmentTitle" class="form-label">Observation status</label>
                    {{--                    <input type="text" name="department_id" hidden class="form-control" id="department_id"--}}
                    {{--                           value="{{$user->department->id}}">--}}
                    <select class="form-select" name="status_id" id="statusSelector" aria-label="status">

                        @foreach($statuses as $status)
                            <option {{ $status->id == $observation->status_id ? ' selected' : '' }}
                                    value="{{$status->id}}">{{$status->title}}</option>
                        @endforeach

                    </select>
                </div>

            </div>

            {{--Observation Description INPUT--}}
            <div class="mb-3">
                <label for="description" class="form-label">Observation Description</label>
                <textarea type="text" name="description" class="form-control" id="description"
                          placeholder="Description">{{$observation-> description}}</textarea>
                @error('description')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            {{--HSE Comments--}}
            <div class="mb-3">
                <label for="comments" class="form-label">HSE Comments</label>
                <textarea type="text" name="comments" class="form-control" id="comments"
                          placeholder="HSE can add comments">{{$observation-> comments}}</textarea>
                @error('hse_comments')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            {{--            </fieldset>--}}
            <div class="row">

                {{--SAFETY BEHAVIOURS LIST CONTAINER--}}
                <div class="col-auto me-3 mt-2 mb-2 rounded-2" id="behavioursContainer">
                    <div class="mb-3 mt-2">
                        <div class="form-check form-switch">
                            <label for="behavioursSwitch" class="form-check-label">
                                @if(isset($linkedBehaviours) && $linkedBehaviours->isNotEmpty())
                                    <mark>Critical Safety Behaviors</mark>
                                @else
                                    Critical Safety Behaviors
                                @endif
                            </label>
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
                            @php
                                $linkedBehaviour = $linkedBehaviours->firstWhere('id', $behaviour->id);
                                $state = $linkedBehaviour ? $linkedBehaviour->pivot->state : null;
                            @endphp
                            <div class="row gx-3 p-2 align-items-center">
                                <div class="form-check col-1">
                                    <input class="form-check-input" type="checkbox"
                                           name="safeCheckbox[{{ $behaviour->id }}]"
                                        {{ $state === 'SAFE' ? 'checked' : '' }}>
                                </div>
                                <div class="form-check col-1">
                                    <input class="form-check-input" type="checkbox"
                                           name="riskCheckbox[{{ $behaviour->id }}]"
                                        {{ $state === 'AT RISK' ? 'checked' : '' }}>
                                </div>
                                <div class="col text-wrap">{{ $behaviour->title }}</div>
                            </div>
                            {{--                            <div class="row gx-3 p-2  align-items-center">--}}
                            {{--                                <div class="form-check col-1">--}}
                            {{--                                    <input class="form-check-input" type="checkbox"--}}
                            {{--                                           name="safeCheckbox[{{$behaviour->id}}]"--}}
                            {{--                                        {{ in_array($behaviour->id, $safetyBehaviours) ? 'checked' : '' }}>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="form-check col-1">--}}
                            {{--                                    <input class="form-check-input" type="checkbox"--}}
                            {{--                                           name="riskCheckbox[{{$behaviour->id}}]">--}}
                            {{--                                </div>--}}
                            {{--                                <div class="col text-wrap">{{$behaviour->title}}</div--}}
                            {{--                                    {{ in_array($behaviour->id, $riskBehaviours) ? 'checked' : '' }}>--}}
                            {{--                            </div>--}}
                        @endforeach
                    </div>
                </div>
                {{--END SAFETY BEHAVIOURS LIST CONTAINER--}}

                {{--UNSAFE LIST CONTAINER--}}
                <div class="col-auto me-3 mt-2 mb-2 rounded-2 " id="unsafeContainer">
                    <div class="mb-3 mt-2">
                        <div class="form-check form-switch">
                            <label for="unsafeSwitch" class="form-check-label">
                                @if(isset($linkedUnsafeConditions) && $linkedUnsafeConditions->isNotEmpty())
                                    <mark>Unsafe Conditions</mark>
                                @else
                                    Unsafe Conditions
                                @endif
                            </label>
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
                                           name="unsafeCheckbox[{{$unsafe->id}}]"
                                        {{ isset($linkedUnsafeConditions) && $linkedUnsafeConditions->firstWhere('id', $unsafe->id) ? 'checked' : '' }}>
                                    {{--                                           {{ $unsafe->id == $linkedUnsafeConditions->id ? 'checked' : ''}}>--}}
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
                            <label for="qualitySwitch" class="form-check-label">
                                @if(isset($linkedQualityObservations) && $linkedQualityObservations->isNotEmpty())
                                    <mark>Quality Observation</mark>
                                @else
                                    Quality Observation
                                @endif
                            </label>
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

                                    <input type="checkbox"
                                           name="qualityCheckbox[{{ $quality->id }}]"
                                        {{ isset($linkedQualityObservations) && $linkedQualityObservations->firstWhere('id', $quality->id) ? 'checked' : '' }}>

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
                            <label for="environmentalSwitch" class="form-check-label">
                                @if(isset($linkedEnvironmentalObservations) && $linkedEnvironmentalObservations->isNotEmpty())
                                    <mark>Environmental Observation</mark>
                                @else
                                    Environmental Observation
                                @endif
                            </label>
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
                                           name="environmentalCheckbox[{{$environmental->id}}]"
                                        {{ isset($linkedEnvironmentalObservations) && $linkedEnvironmentalObservations->firstWhere('id', $environmental->id) ? 'checked' : '' }}>

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
                        <label for="furtherSwitch" class="form-check-label">
                            @if(($observation -> further) === 'NA' ||
                                 empty(trim($observation -> further)))
                                Further Action Required
                            @else
                                <mark>Further Action Required</mark>

                            @endif
                        </label>
                        <input class="form-check-input"
                               role="switch"
                               type="checkbox"
                               id="furtherSwitch"
                               aria-expanded="false"
                               onchange="openList('furtherTextarea','furtherSwitch')">
                    </div>
                    <div id="furtherTextarea" hidden>
                    <textarea type="text"
                              name="further"
                              class="form-control"
                              id="further"
                              placeholder="Further Action Required">{{$observation -> further }}</textarea>
                        @error('further')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>

                {{--CORRECTIVE ACTION INPUT--}}
                <div class="mb-3 col-md-auto">
                    <div class="form-check form-switch">
                        <label for="correctiveSwitch" class="form-check-label">
                            @if(($observation -> corrective) === 'NA' ||
                                     empty(trim($observation -> corrective)))
                                Corrective/Immediate Action Taken
                            @else
                                <mark>Corrective/Immediate Action Taken</mark>

                            @endif
                        </label>
                        <input class="form-check-input"
                               role="switch"
                               type="checkbox"
                               id="correctiveSwitch"
                               aria-expanded="false"
                               onchange="openList('correctiveTextarea','correctiveSwitch')">
                    </div>
                    <div id="correctiveTextarea" hidden>
                    <textarea type="text"
                              name="corrective"
                              class="form-control"
                              id="corrective"
                              placeholder="Corrective/Immediate Action Description">{{$observation -> corrective }}</textarea>
                        @error('corrective')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
            {{--Observation Photos --}}
            @if(!empty($observation->photos))
                <div class="row">
                    @foreach($observation->photos as $photo)
                        <div class="col-md-4 mb-3">
                            <div class="card" style="width: 18rem; border-radius: 10px;">
                                <img src="{{ asset('storage/' . $photo->url) }}" alt="Photo" style="border-radius: 10px;">
                                <button type="button" class="btn btn-danger btn-sm mt-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deletePhotoModal"
                                        data-photo-id="{{ $photo->id }}">
                                    Delete
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Delete Photos Button -->
{{--                <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#deletePhotosModal">--}}
{{--                    Delete Photo(s)--}}
{{--                </button>--}}
{{--                <div class="row">--}}
{{--                    @foreach($observation->photos as $photo)--}}
{{--                        <div class="col-md-4 mb-3">--}}
{{--                            <div class="card" style="width: 18rem; border-radius: 10px;">--}}
{{--                                <img src="{{ asset('storage/' . $photo->url) }}" alt="Photo"--}}
{{--                                     style=" border-radius: 10px;">--}}
{{--                                <!-- Delete Button -->--}}
{{--                                <form action="{{ route('photos.destroy', $photo->id) }}" method="POST"--}}
{{--                                      style="margin-top: 10px;">--}}
{{--                                    @csrf--}}
{{--                                    @method('delete')--}}
{{--                                    <button type="submit"--}}
{{--                                            class="btn btn-danger btn-sm"--}}
{{--                                            onclick="return confirm('Are you sure you want to delete this photo?')">--}}
{{--                                        Delete--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
            @endif

            <div class="mb-3">
                <span id="test"></span>
                <label for="photosInput" class="form-label">You can add photos to this observation</label>
                <input type="file"
                       class="form-control"
                       id="photosInput"
                       name="photos[]" multiple>
                @error('photos.*')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <small class="text-muted">Accepted formats: JPG, PNG. Max size: 2MB.</small>
                <!-- Preview Container -->
                <div id="previewContainer" class="row mt-3">

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <!-- Delete Photo Modal -->
    <div class="modal fade" id="deletePhotoModal" tabindex="-1" aria-labelledby="deletePhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deletePhotoForm" action="{{ route('photos.destroy', 0) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePhotoModalLabel">Delete Photo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this photo?
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="photo_id" id="photoId">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Photos Modal for bulk photos -->
{{--    <div class="modal fade" id="deletePhotosModal" tabindex="-1" aria-labelledby="deletePhotosModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <form id="deletePhotosForm" action="{{ route('photos.bulkDestroy') }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title" id="deletePhotosModalLabel">Delete Photo(s)</h5>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <p>Select the photos you want to delete:</p>--}}
{{--                        <div class="row">--}}
{{--                            @foreach($observation->photos as $photo)--}}
{{--                                <div class="col-md-4 mb-3">--}}
{{--                                    <div class="card" style="width: 100%; border-radius: 10px;">--}}
{{--                                        <img src="{{ asset('storage/' . $photo->url) }}" alt="Photo" style="border-radius: 10px;">--}}
{{--                                        <div class="form-check text-center mt-2">--}}
{{--                                            <input class="form-check-input" type="checkbox" name="photo_ids" value="{{ $photo->id }}">--}}
{{--                                            <label class="form-check-label">--}}
{{--                                                Select--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>--}}
{{--                        <button type="submit" class="btn btn-danger">Delete Selected Photos</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <script>
        // function openList($listName, $switchName, $containerName) {
        //     if (!document.getElementById($switchName).checked) {
        //         document.getElementById($listName).hidden = true;
        //         if ($containerName != null) {
        //             document.getElementById($containerName).classList.remove('bg-body-secondary');
        //         }
        //     } else {
        //         document.getElementById($listName).hidden = false;
        //         if ($containerName != null) {
        //             document.getElementById($containerName).classList.add('bg-body-secondary');
        //         }
        //     }
        //
        // }
        function openList(listName, switchName, containerName = null) {
            const listElement = document.getElementById(listName);
            const switchElement = document.getElementById(switchName);
            const containerElement = containerName ? document.getElementById(containerName) : null;

            const isChecked = switchElement.checked;
            listElement.hidden = !isChecked;
            switchElement.setAttribute('aria-expanded', isChecked ? 'true' : 'false');

            if (containerElement) {
                containerElement.classList.toggle('bg-body-secondary', isChecked);
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deletePhotoModal = document.getElementById('deletePhotoModal');
            const deletePhotoForm = document.getElementById('deletePhotoForm');
            const photoIdInput = document.getElementById('photoId');

            deletePhotoModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const photoId = button.getAttribute('data-photo-id'); // Extract photo ID
                const actionUrl = deletePhotoForm.getAttribute('action').replace('/0', '/' + photoId);

                deletePhotoForm.setAttribute('action', actionUrl); // Update form action
                photoIdInput.value = photoId; // Set the hidden input value
            });
        });

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
