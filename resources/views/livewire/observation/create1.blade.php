<div>

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:click="getDep" wire:model.live="checkboxState">
        <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
    </div>

    <select class="form-select" aria-label="Default select example" {{$checkboxState == false ? 'hidden' : ''}}>

        @foreach($departments as $department)
            <option value="{{$department->id}}">{{$department->title}}</option>
        @endforeach


    </select>
    <textarea class="my-3"type="text" wire:model="content">{{ $content }}</textarea>

</div>
