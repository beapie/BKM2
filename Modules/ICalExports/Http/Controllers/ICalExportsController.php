<?php

namespace Modules\ICalExports\Http\Controllers;

use App\Models\Appointment;
use App\Models\Business;
use App\Models\Location;
use App\Models\Service;
use App\Models\User;
use Illuminate\Routing\Controller;
use Eluceo\iCal\Domain\Entity\Event;
use Eluceo\iCal\Domain\ValueObject\SingleDay;
use Eluceo\iCal\Domain\ValueObject\Date;
use Eluceo\iCal\Domain\Entity\Calendar;
use Eluceo\iCal\Presentation\Factory\CalendarFactory;

class ICalExportsController extends Controller
{

    public function index($slug, $id)
    {
        $business = Business::where('slug', $slug)->first();
        $user = User::find($business->created_by);
        if (module_is_active('ICalExports', $user->id)) {
            if (!empty($slug) && !empty($id)) {
                $appointment = Appointment::find($id);
                if ($appointment) {
                    $customer  = User::find($appointment->customer_id);
                    $location   = Location::find($appointment->location_id);
                    $service    = Service::find($appointment->service_id);
                    $staff      = user::find($appointment->staff_id);
                    $appointment_number = Appointment::appointmentNumberFormat($appointment->id, $business->created_by, $business->id);

                    $appointmentDetails = "Service Name: $service->name\n" .
                        "Appointment No: $appointment_number\n" .
                        "Slot Time: $appointment->time\n" .
                        "Customer Name: $customer->name\n" .
                        "Location: $location->name\n" .
                        "Staff Name: $staff->name\n" .
                        "Staff Email: $staff->email\n";

                    // 1. Create Event domain entity
                    $event = (new Event())
                        ->setSummary($business->name)
                        ->setDescription($appointmentDetails)
                        ->setOccurrence(
                            new SingleDay(
                                new Date(
                                    \DateTimeImmutable::createFromFormat('d-m-Y', $appointment->date)
                                )
                            )
                        );

                    // 2. Create Calendar domain entity
                    $calendar = new Calendar([$event]);

                    // 3. Transform domain entity into an iCalendar component
                    $componentFactory = new CalendarFactory();
                    $calendarComponent = $componentFactory->createCalendar($calendar);

                    // 4. Set headers
                    return response($calendarComponent)
                        ->header('Content-Type', 'text/calendar; charset=utf-8')
                        ->header('Content-Disposition', 'attachment; filename="appointment.ics"');
                } else {
                    return redirect()->route("appointments.form", ["slug" => $slug, "appointment" => $id]);
                }
            } else {
                return redirect()->route("appointments.form", ["slug" => $slug, "appointment" => $id]);
            }
        } else {
            return redirect()->route("appointments.form", ["slug" => $slug, "appointment" => $id]);
        }
    }
}
