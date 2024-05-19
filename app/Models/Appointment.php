<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id','location_id','service_id','staff_id','date','time','notes','payment_type','appointment_status','business_id','created_by'
    ];


    public static function appointmentNumberFormat($number,$Id = null , $businessId = null)
    {
        $company_settings = getCompanyAllSetting($Id,$businessId);
        $data = !empty($company_settings['appointment_prefix']) ? $company_settings['appointment_prefix'] : '#APP0000';

        return $data . sprintf("%01d", $number);
    }

    public function CustomerData()
    {
        return $this->hasOne(Customer::class, 'user_id', 'customer_id');
    }

    public function StaffData()
    {
        return $this->hasOne(Staff::class, 'user_id', 'staff_id');
    }

    public function ServiceData()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    public function LocationData()
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function StatusData()
    {
        return $this->hasOne(CustomStatus::class, 'id', 'appointment_status');
    }
    public function payment()
    {
        return $this->hasOne(AppointmentPayment::class, 'appointment_id', 'id');
    }

}
