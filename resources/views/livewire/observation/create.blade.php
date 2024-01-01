<div>

    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model="checkboxState">
        <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
    </div>

    <div class="dropdown" {{$checkboxState == false ? 'hidden' : ''}} >
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </div>
    <textarea type="text" wire:model="content">{{ $content }}</textarea>

</div>
