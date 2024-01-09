<?php

namespace App\Livewire\Admin;

use App\Models\Department;
use App\Models\Status;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\hse\observations\Observation;

class AdminObservation extends Component
{
    use WithPagination;

    //public $observations;
    public $departments;
    public $statuses;
    public $users;


    public function mount()
    {
       // $this->observations = Observation::all();
        $this->departments = Department::all();
        $this->statuses = Status::all();
        $this->users = User::all();
        //dd($this->observations);
    }




    public function render()
    {

        return view('livewire.admin.observation', [
           // 'observations'=>AdminObservation::paginate(10),
            'observations'=>Observation::paginate(10)
        ]);
    }
}
