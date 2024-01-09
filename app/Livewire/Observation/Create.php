<?php

namespace App\Livewire\Observation;

use App\Models\Department;
use App\Models\hse\observations\EnvironmentalObservation;
use App\Models\hse\observations\Observation;
use App\Models\hse\observations\QualityObservations;
use App\Models\hse\observations\SafetyBehaviours;
use App\Models\hse\observations\UnsafeConditions;
use App\Models\Photos;
use App\Models\Status;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    #[Validate(['photos.*'=>'image|max:2048'])] // 2MB Max
    public $photos=[];

    public int $user_id, $department_id, $status_id;
    public bool $furtherSwitch;
    public bool $correctiveSwitch;
    public bool $behavioursSwitch;
    public bool $unsafeSwitch;
    public bool $qualitySwitch;
    public bool $environmentalSwitch;

    #[Validate('')]
    public string $location;
    #[Validate('')]
    public string $site;
    #[Validate('required')]
    public $departments = [];

    #[Validate('required')]
    public $user;

    #[Validate('required')]
    public $description;
    public string $further;
    public string $corrective;
    public $guestUser;
    public $safetyBehaviours=[];
    public $safeCheckbox=[];
    public $riskCheckbox=[];
    private $safeBehaviours=[];
    private $riskBehaviours=[];



    public $unsafeConditions =[];
    public $unsafeCheckbox=[];
    public $qualityCheckbox=[];
    public $environmentalCheckbox=[];

    public $qualityObservations=[];

    public $environmentalObservations=[];

    public function getDep()
    {
        $this->departments = Department::all();
        $this->guestUser = User::first();
        $this->user = auth()->user() ?? $this->guestUser;
    }

    public function pressSafeCheckbox(int $id){
        if ($this->safeCheckbox[$id]){
            $this->riskCheckbox[$id] = false;
        }

    }
    public function pressRiskCheckbox(int $id){
        if ($this->riskCheckbox[$id]){
             $this->safeCheckbox[$id] = false;
        }

    }

    public function mount()
    {
        $this->furtherSwitch = false;
        $this->correctiveSwitch = false;
        $this->behavioursSwitch = false;
        $this->unsafeSwitch = false;
        $this->qualitySwitch = false;
        $this->environmentalSwitch = false;
        //$this->content = 'Hello world';
        $this->departments = Department::all();
        $this->guestUser = User::first();
        $this->user = auth()->user() ?? $this->guestUser;
        $this->safetyBehaviours = SafetyBehaviours::all();
        $this->unsafeConditions = UnsafeConditions::all();
        $this->qualityObservations = QualityObservations::all();
        $this->environmentalObservations = EnvironmentalObservation::all();

        foreach ($this->safetyBehaviours as $behaviours){
            $this->safeCheckbox = array_fill_keys($behaviours->pluck('id')->toArray(), false );
            $this->riskCheckbox = array_fill_keys($behaviours->pluck('id')->toArray(), false);
        }
        foreach ($this->unsafeConditions as $unsafeCondition){
            $this->unsafeCheckbox = array_fill_keys($unsafeCondition->pluck('id')->toArray(), false);

        }
        foreach ($this->qualityObservations as $qualityObservation){
            $this->qualityCheckbox = array_fill_keys($qualityObservation->pluck('id')->toArray(), false);

        }
        foreach ($this->environmentalObservations as $environmentalObservation){
            $this->environmentalCheckbox = array_fill_keys($environmentalObservation->pluck('id')->toArray(), false);

        }
//        for ($i=0; $i<count($this->safetyBehaviours); $i++){
//            $this->safeCheckbox[$i]=false;
//            $this->riskCheckbox[$i]=false;
//        }



        //if ($this->checkboxState){


        //  }

    }



    public function createObservation()
    {

        //$name = $this->photo->getClientOriginalName();
        $paths=[];
        $i=1;


        //dd($paths);
$this->safeBehaviours = array_keys(array_filter($this->safeCheckbox));
$this->riskBehaviours = array_keys(array_filter($this->riskCheckbox));


        //dd($this->unsafeCheckbox);
        //dd($this->riskBehaviours[0]);
        $this->validate();

        $observation = Observation::create([
                'site' => $this->site ?? 'SCP',
                'location' => $this->location ?? 'vessel',
                'department_id' =>$this->user->department->id,
                'user_id' =>$this->user->id,
                'description' =>$this->description,
                'further' =>$this->further ?? 'NA',
                'corrective' =>$this->corrective ?? 'NA',
                //'' =>$this->,
            ]
        );
        foreach ($this->safeBehaviours as $safeBehaviour) {
            $observation->safetyBehaviours()->attach($safeBehaviour,['state'=>'SAFE']);}

        foreach ($this->riskBehaviours as $riskBehaviour) {
            $observation->safetyBehaviours()->attach($riskBehaviour,['state'=>'AT RISK']);
        }

        foreach (array_keys(array_filter($this->unsafeCheckbox)) as $unsafeCondition) {
            $observation->unsafeConditions()->attach($unsafeCondition);
        }
        foreach (array_keys(array_filter($this->qualityCheckbox)) as $qualityObservation) {
            $observation->qualityObservations()->attach($qualityObservation);
        }
        foreach (array_keys(array_filter($this->environmentalCheckbox)) as $environmentalObservation) {
            $observation->environmentalObservations()->attach($environmentalObservation);
        }

        if(!is_null($this->photos)) {
            foreach ($this->photos as $photo) {
                $extension = $photo->getClientOriginalExtension();
                $name = $this->user->id . '_' . date('YmdHis', time()) . '_' . $i . '.' . $extension;
                $path = $photo->storeAs('images', $name, 'public');

                $photos1 = Photos::create([
                    'url' => $path,
                ]);
                $observation->photos()->save($photos1);

                $i++;
            }
        }

        //$observation->safetyBehaviours()->attach($this->safetyBehaviours->id,['state'=>'SAFE']);
        return redirect('/observations');

    }

    public function render()
    {

        return view('livewire.observation.create1')->extends('components.layouts.app');
    }
}
