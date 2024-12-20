<?php

namespace App\Models\hse\observations;

use App\Models\Department;
use App\Models\hse\observations\Traits\Filterable;
use App\Models\Photos;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Observation extends Model
{
    use HasFactory;
    use Filterable;
    use SoftDeletes;
    protected $guarded = [];

    public function department(){
        return $this->belongsTo(Department::class,'department_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function status(){
        return $this->belongsTo(Status::class,);
    }
    public function safetyBehaviours(){
        return $this->belongsToMany(SafetyBehaviours::class)->withPivot('state');
    }
    public function qualityObservations(){
        return $this->belongsToMany(QualityObservations::class);
    }
    public function unsafeConditions():BelongsToMany
    {
        return $this->belongsToMany(UnsafeConditions::class);
    }
    public function environmentalObservations(){
        return $this->belongsToMany(EnvironmentalObservation::class);
    }

    public function photos(){
        return $this->hasMany(Photos::class);
    }

}
