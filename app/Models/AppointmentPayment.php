<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'payment_type',
        'amount',
        'coupon_amount',
        'final_amount',
        'tax_amount',
        'promo_code_id',
        'payment_date',
        'business_id',
        'created_by',
    ];
}
