<?php

namespace Modules\FlexibleHours\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlexibleHour extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected static function newFactory()
    {
        return \Modules\FlexibleHours\Database\factories\FlexibleHourFactory::new();
    }
}
