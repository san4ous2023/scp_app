<?php

namespace App\Models;

use App\Models\hse\observations\Observation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function observations(){
        return $this->belongsTo(Observation::class);
    }
}
