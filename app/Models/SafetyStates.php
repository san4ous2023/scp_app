<?php

namespace App\Models;

use App\Models\hse\observations\Observation;
use App\Models\hse\observations\SafetyBehaviours;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyStates extends Model
{
    use HasFactory;

//    public function safetyBehaviours(){
//        return $this->hasMany(SafetyBehaviours::class,'safe_states_id','id');
//    }
    public function safetyBehaviours(){
        return $this->belongsToMany(SafetyBehaviours::class);
    }

}
