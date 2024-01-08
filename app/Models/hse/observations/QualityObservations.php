<?php

namespace App\Models\hse\observations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityObservations extends Model
{
    use HasFactory;

    public function observations(){
        return $this->belongsToMany(Observation::class);
    }
}
