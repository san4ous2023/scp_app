<?php

namespace App\Livewire\Observation;

use App\Models\Department;
use Livewire\Component;

class Create extends Component
{
    public int $user_id,$department_id,$status_id;
    public bool $checkboxState;
    public string $content;
    public $departments = [];
    public function getDep(){
        $this->departments = Department::all();
    }

    public function mount(){
        $this->checkboxState=false;
        $this->content = 'Hello world';

        //if ($this->checkboxState){


      //  }

    }



    public function render()
    {

        return view('livewire.observation.create1')->extends('components.layouts.app');
    }
}
