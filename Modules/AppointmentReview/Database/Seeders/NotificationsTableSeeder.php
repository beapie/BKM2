<?php

namespace Modules\AppointmentReview\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $notifications = [
            'Appointment Review'
        ];

        $permissions = [
            'appointment manage',
        ];

        foreach($notifications as $key=>$n){
            $ntfy = Notification::where('action',$n)->where('type','mail')->where('module','AppointmentReview')->count();
            if($ntfy == 0){
                $new = new Notification();
                $new->action = $n;
                $new->status = 'on';
                $new->permissions = $permissions[$key];
                $new->module = 'AppointmentReview';
                $new->type = 'mail';
                $new->save();
            }
        }
    }
}
