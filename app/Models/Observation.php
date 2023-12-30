<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function department(){
        return $this->belongsTo(Department::class,'department_id','id');
    }

    public function user(){
        return $this->belongsTo(Role::class,'user_id','id');
    }
    public function status(){
        return $this->belongsTo(Role::class,'status_id','id');
    }

}
