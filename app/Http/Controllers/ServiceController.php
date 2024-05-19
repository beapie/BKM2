<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Business;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\saveTax;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if(Auth::user()->isAbleTo('service create'))
        {
            $business = Business::find($request->business_id);
            $category = category::where('created_by',creatorId())->where('business_id',$business->id)->select('name', 'id')->get()->prepend(['id' => null, 'name' => 'Select category'])->pluck('name', 'id');




            return view('service.create',compact('business','category'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->isAbleTo('service create'))
        {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'category' => 'required',
                    'price' => 'required',
                    'duration' => 'required',
                    ]
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                $business = Business::find($request->business_id);

                $service                   = new Service();
                $service->name             = $request->name;
                $service->category_id      = $request->category;
                $service->price            = $request->price;
                $service->duration         = $request->duration;
                $service->description      = !empty($request->description) ? $request->description : '';
                $service->business_id      = !empty($business) ? $business->id : 0;
                $service->created_by       = creatorId();
                if ($request->hasFile('service_image'))
                {
                    $filenameWithExt = $request->file('service_image')->getClientOriginalName();
                    $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension       = $request->file('service_image')->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                    $uplaod = upload_file($request,'service_image',$fileNameToStore,'Service');
                    if($uplaod['flag'] == 1)
                    {
                        $url = $uplaod['url'];
                    }
                    else
                    {
                        return redirect()->back()->with('error',$uplaod['msg']);
                    }
                }
                $service->image  = !empty($request->service_image) ? $url : '';
                $service->save();
                $tab = 2;
                event(new saveTax($service, $request->all()));

                return redirect()->back()->with('success', __('Service successfully created.'))->with('tab', $tab);
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        if(Auth::user()->isAbleTo('service edit'))
        {
            $category = category::where('created_by',creatorId())->where('business_id',$service->business_id)->select('name', 'id')->get()->prepend(['id' => null, 'name' => 'Select category'])->pluck('name', 'id');

            return view('service.edit',compact('service','category'));
        }
        else
        {
           return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        if(Auth::user()->isAbleTo('service edit'))
        {

            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'category' => 'required',
                    'price' => 'required',
                    'description' => 'required',
                ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $service->name          = $request->name;
            $service->category_id   = $request->category;
            $service->price         = $request->price;
            $service->duration         = $request->duration;
            $service->description   = $request->description;

            if ($request->hasFile('service_image'))
            {
                if(!empty($service->image))
                {
                    delete_file($service->image);
                }
                $filenameWithExt = $request->file('service_image')->getClientOriginalName();
                $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension       = $request->file('service_image')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                $uplaod = upload_file($request,'service_image',$fileNameToStore,'Service');
                if($uplaod['flag'] == 1)
                {
                    $url = $uplaod['url'];
                }
                else
                {
                    return redirect()->back()->with('error',$uplaod['msg']);
                }
                $service->image  = !empty($request->service_image) ? $url : '';
            }

            $service->save();
            $tab = 2;
            event(new saveTax($service, $request->all()));

            return redirect()->back()->with('success', __('Service updated successfully!'))->with('tab', $tab);
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if(Auth::user()->isAbleTo('location delete'))
        {
            if(!empty($service->image))
            {
                delete_file($service->image);
            }
            $service->delete();
            $tab = 2;
            return redirect()->back()->with('error', __('Service successfully delete.'))->with('tab', $tab);
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
