<?php

namespace App\Models;

use App\Models\hse\observations\Observation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public function observations(){
        return $this->hasMany(Observation::class,'status_id','id');
    }
}
