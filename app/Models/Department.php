<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class,'department_id','id');
    }
    public function observations(){
        return $this->hasMany(Observation::class,'department_id','id');
    }

}
