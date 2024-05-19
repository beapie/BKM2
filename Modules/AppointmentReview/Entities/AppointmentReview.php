<?php

namespace Modules\AppointmentReview\Entities;

use App\Models\Business;
use App\Models\Staff;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppointmentReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'appointment_id',
        'business_id',
        'staff_id',
        'review',
        'description',
        'created_by',
    ];

    protected static function newFactory()
    {
        return \Modules\AppointmentReview\Database\factories\AppointmentReviewFactory::new();
    }


    public function BusinessData()
    {
        return $this->hasOne(Business::class, 'id', 'business_id');
    }

    public function AppointmentData()
    {
        return $this->hasOne(Appointment::class, 'id', 'appointment_id');
    }

    public static function AverageRatingForStaff($staff_id)
    {
        $reviews = AppointmentReview::select(\DB::raw('count(*) as total_reviews'), \DB::raw('avg(review) as avg_review_score'))
            ->where('staff_id', $staff_id)
            ->groupBy('staff_id')
            ->first();

        if ($reviews) {
            $average_rating = $reviews->avg_review_score;
            $staff = Staff::find($staff_id);

            if ($staff) {
                $staff->review = number_format($average_rating, 0);
                $staff->save();
            }

            return $average_rating;
        } else {
            return 0;
        }
    }

    public static function AverageRatingForAppointment($appointment_id)
    {
        // simple rating
        $review = AppointmentReview::where('appointment_id', $appointment_id)->first();

        if ($review) {
            return $review->review;
        } else {
            return 0;
        }
    }
}
