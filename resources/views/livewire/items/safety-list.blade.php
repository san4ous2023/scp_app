<div class="col-auto me-3 mt-2 mb-2 {{$listItemsSwitch == false ? '' : 'bg-body-secondary rounded-2'}}">
    <div class="mb-3 mt-2">
        <div class="form-check form-switch">
            <label for="listItemsSwitch" class="form-check-label">{{$title}}</label>
            <input class="form-check-input" role="switch" type="checkbox" id="listItemsSwitch"
                   wire:model.live="listItemsSwitch">
        </div>
    </div>

    <div class="mb-3" {{$listItemsSwitch == false ? 'hidden' : ''}}>

        <div class=" col-1 " style=" font-size:10px;max-width: 16px">
            AT RISK
        </div>

        @foreach($listItems as $listItem)
            <div class="row gx-3 p-2  align-items-center">
                <div class="form-check col-1">
                    <input class="form-check-input" type="checkbox"
                           wire:model.live="listItemsCheckbox.{{$listItem->id}}">
                </div>
                <div class="col text-wrap">{{$listItem->title}}</div>
            </div>

        @endforeach
    </div>

</div>
