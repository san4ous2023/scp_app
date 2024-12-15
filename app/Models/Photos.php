<?php

namespace App\Models;

use App\Models\hse\observations\Observation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['url','observation_id'];
    public function observations(){
        return $this->belongsTo(Observation::class);
    }
    // Check if you have any 'onDelete' cascade
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($photo) {
            // Make sure that this deletion does not remove the observation itself
            // unless explicitly needed (e.g., if you want photos to be deleted with observation).
        });
    }
}
