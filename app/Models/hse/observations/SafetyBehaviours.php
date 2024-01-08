<?php

namespace App\Models\hse\observations;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyBehaviours extends Model
{
    use HasFactory;

    public function observations(){
        return $this->belongsToMany(Observation::class)->withPivot('state');
    }
}
