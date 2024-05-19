<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','user_id','location_id','service_id','description','business_id','created_by'
    ];

    public function getLocationIdAttribute($id)
    {
        return explode(',',$id);
    }

    public function getServiceIdAttribute($id)
    {
        return explode(',',$id);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function Location()
    {
        return  Location::whereIn('id',$this->location_id);
    }

    public function Service()
    {
        return  Service::whereIn('id',$this->service_id);
    }
}
