<?php

namespace Modules\FlexibleHours\Http\Controllers;

use App\Models\Service;
use App\Models\Staff;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\FlexibleHours\Entities\FlexibleHour;
use Modules\FlexibleHours\Events\CreateFlexibleHour;
use Illuminate\Support\Facades\Auth;
use Modules\FlexibleHours\Events\DestroyFlexibleHour;
use Modules\FlexibleHours\Events\UpdateFlexibleHour;

class FlexibleHoursController extends Controller
{

    public function index()
    {
        return view('flexiblehours::index');
    }


    public function create($id, $staff_id)
    {
        $staff = Staff::find($staff_id);
        $service = Service::find($id);
        return view('flexiblehours::flexiblehour.add', compact('service', 'staff'));
    }

    public function store(Request $request)
    {
        $tab = 3;
        if (Auth::user()->isAbleTo('flexible hour add')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'start_time' => 'required',
                    'end_time'   => 'required',
                    'day'        => 'required',
                    'price'      => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first())->with('tab', $tab);
            }
            // Check if the day already exists for the given service, staff, and business
            $existingFlexibleHours = FlexibleHour::where('service_id', $request->service_id)
                ->where('staff_id', $request->staff_id)
                ->get();

            foreach ($existingFlexibleHours as $existingFlexibleHour) {
                if ($existingFlexibleHour->start_time <= $request->end_time && $existingFlexibleHour->end_time >= $request->start_time) {
                    $existingDaysArray = json_decode($existingFlexibleHour->days, true);
                    $requestDaysArray = json_decode($request->days_json, true);

                    foreach ($requestDaysArray as $day => $status) {
                        if ($status === 'on' && isset($existingDaysArray[$day]) && $existingDaysArray[$day] === 'on') {
                            return redirect()->back()->with('error', __('The requested interval is not available.'))->with('tab', $tab);
                        }
                    }
                }
            }

            $flexible_hour             = new FlexibleHour();
            $flexible_hour->service_id = $request->service_id;
            $flexible_hour->staff_id   = $request->staff_id;
            $flexible_hour->start_time = $request->start_time;
            $flexible_hour->end_time   = $request->end_time;
            $flexible_hour->days       = $request->days_json;
            $flexible_hour->price       = $request->price;
            $flexible_hour->business_id = getActiveBusiness();
            $flexible_hour->created_by = creatorId();
            $flexible_hour->save();
            event(new CreateFlexibleHour($request, $flexible_hour));
            return redirect()->back()->with('success', __('Flexible hour successfully created.'))->with('tab', $tab);

            // return response()->json(['sucess' => 'Flexible hour successfully updated']);
        } else {
            // return response()->json(['error' => __('Permission denied.')], 401);
            return redirect()->back()->with('error', __('Permission denied.'))->with('tab', $tab);
        }
    }

    public function show($id)
    {
        return view('flexiblehours::show');
    }


    public function edit($id)
    {
        if (Auth::user()->isAbleTo('flexible hour edit')) {
            $flexible_hour = FlexibleHour::find($id);
            if ($flexible_hour->created_by == creatorId() && $flexible_hour->business_id == getActiveBusiness()) {
                return view('flexiblehours::flexiblehour.edit', compact('flexible_hour'));
            } else {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->isAbleTo('flexible hour edit')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'start_time' => 'required',
                    'end_time'   => 'required',
                    'day'        => 'required',
                    'price'      => 'required',
                ]
            );
            $tab = 3;
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first())->with('tab', $tab);
            }
            $existingFlexibleHours = FlexibleHour::where('service_id', $request->service_id)
                ->where('staff_id', $request->staff_id)
                ->where('business_id', getActiveBusiness())
                ->where('id', '!=', $id)
                ->get();

            foreach ($existingFlexibleHours as $existingFlexibleHour) {
                $existingFlexibleHourDaysArray = json_decode($existingFlexibleHour->days, true);
                $requestDaysArray = json_decode($request->days_json, true);
                foreach ($existingFlexibleHourDaysArray as $day => $status) {
                    if ($status === 'on' && isset($requestDaysArray[$day]) && $requestDaysArray[$day] === 'on') {
                        return redirect()->back()->with('error', __('The requested interval is not available.'))->with('tab', $tab);
                    }
                }
            }
            $flexible_hour = FlexibleHour::find($id);
            if ($flexible_hour->created_by == creatorId() && $flexible_hour->business_id == getActiveBusiness()) {
                $flexible_hour->service_id = $flexible_hour->service_id;
                $flexible_hour->staff_id   = $flexible_hour->staff_id;
                $flexible_hour->start_time = $request->start_time;
                $flexible_hour->end_time   = $request->end_time;
                $flexible_hour->days       = $request->days_json;
                $flexible_hour->price      = $request->price;
                $flexible_hour->business_id = getActiveBusiness();
                $flexible_hour->created_by = creatorId();
                $flexible_hour->save();
                event(new UpdateFlexibleHour($request, $flexible_hour));
                return redirect()->back()->with('success', __('Flexible hour successfully updated.'))->with('tab', $tab);
            } else {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->isAbleTo('flexible hour delete')) {
            $flexible_hour = FlexibleHour::find($id);
            if ($flexible_hour->created_by == creatorId()  && $flexible_hour->business_id == getActiveBusiness()) {
                event(new DestroyFlexibleHour($flexible_hour));
                $flexible_hour->delete();
                $tab = 3;
                return redirect()->back()->with('success', __('Flexible hour successfully deleted.'))->with('tab', $tab);
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function serviceList($id)
    {
        $staff = Staff::find($id);
        $services = Service::whereIn('id', $staff->service_id)->get();
        return view('flexiblehours::flexiblehour.service_view', compact('services', 'staff'));
    }

    public function flexiblePriceGet(Request $request)
    {
        if ($request->flexible_id) {
            $flexible_service = FlexibleHour::find($request->flexible_id);
        } else if ($request->service_id) {
            $flexible_service = Service::find($request->service_id);
        }
        if ($flexible_service) {
            return response()->json(['flexible' => $flexible_service]);
        } else {
            return response()->json(['msg' => 'error', 'error' => 'Something went wrong.']);
        }
    }
}
