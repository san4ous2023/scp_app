<?php

namespace App\Livewire\Items;

use App\Models\hse\observations\UnsafeConditions;
use Livewire\Component;

class SafetyList extends Component
{
    public $listItems = [];
    #[Reactive]
    public $listItemsCheckbox = [];

    public $title;

    public bool $listItemsSwitch;

    public function mount($listItems, $listItemsCheckbox, $title)
    {
        //dd($listItems);
        $this->listItemsSwitch = false;
        $this->listItemsCheckbox = $listItemsCheckbox;
        //$this->listItems = UnsafeConditions::all();
//        $this->listItems = $listItems;
//
//        foreach ($this->listItems as $listItem){
//            $this->listItemsCheckbox = array_fill_keys($listItem->pluck('id')->toArray(), false);
//
//        }
    }

    public function render()
    {
        return view('livewire.items.safety-list');
    }
}
