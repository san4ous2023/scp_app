<?php

namespace App\Models\hse\observations;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorrectPPE extends Model
{
    use HasFactory;

    public function safetyBehaviours(){
        return $this->belongsTo(SafetyBehaviours::class,'safety_behaviours_id','id');
    }
}
