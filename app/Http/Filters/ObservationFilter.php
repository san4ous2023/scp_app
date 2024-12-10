<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ObservationFilter extends AbstractFilter
{

    public const STATUS_ID = 'status_id';
    public const DEPARTMENT_ID = 'department_id';
    public const USER_ID = 'user_id';
    public const CREATED_AT = 'created_at';
    public const START_DATE = 'start_date';
    public const END_DATE = 'end_date';


    protected function getCallbacks(): array
    {
        return [
          self::STATUS_ID=>[$this,'status_id'],
            self::DEPARTMENT_ID => [$this, 'department_id'],
            self::USER_ID => [$this,'user_id'],
            //self::CREATED_AT => [$this,'created_at'],
            self::START_DATE => [$this,'start_date'],
            self::END_DATE => [$this,'end_date'],
        ];
    }
    public function status_id(Builder $builder,$value){
        $builder->where('status_id', $value);
    }

    public function department_id(Builder $builder,$value){
        $builder->where('department_id', $value);
    }

    public function user_id(Builder $builder,$value){
        $builder->where('user_id',  $value);
    }
//    public function CREATED_AT(Builder $builder,$value){
//        $builder->whereDate('created_at','>=', $value);
//    }

    public function start_date(Builder $builder,$value){
        $builder->whereDate('created_at','>=', $value);
    }
    public function end_date(Builder $builder,$value){
        $builder->whereDate('created_at','<=', $value);
    }




}
