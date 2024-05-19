<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','category_id','price','business_id','created_by'
    ];

    public function Category()
    {
        return $this->hasOne(category::class, 'id', 'category_id');
    }
}
