<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use App\Models\Business;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomFieldController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }
    
    public function CustomFieldSetting($id , Request $request)
    {
        if(Auth::user()->isAbleTo('business update'))
        {
            $business = Business::find($id);

            if($request->custom_field_enable)
            {
                $validator = \Validator::make(
                    $request->all(), [
                        'labels' => 'required',
                        'types' => 'required',
                        ]
                    );
    
                    if($validator->fails())
                    {
                        $messages = $validator->getMessageBag();
    
                        return redirect()->back()->with('error', $messages->first());
                    }

                $data = [
                    'key' => 'custom_field_enable',
                    'business' => $business->id,
                    'created_by' => $business->created_by,
                ];
            
                Setting::updateOrInsert($data, ['value' => $request->custom_field_enable]);
                // Settings Cache forget
                comapnySettingCacheForget();

                // Delete old custom fields for the business
                CustomField::where('business_id',$business->id)->where('created_by',$business->created_by)->delete();

                foreach ($request->labels as $key => $label) {
                    CustomField::create([
                        'label' => $label,
                        'value' => !empty($request->values) ? $request->values[$key] : null,
                        'type' => $request->types[$key],
                        'business_id' => $business->id,
                        'created_by' => $business->created_by,
                    ]);
                }
                $tab = 10;
                return redirect()->back()->with('success', __('Custom field setting successfully created.'))->with('tab', $tab);
            }
            else
            {
                $data = [
                    'key' => 'custom_field_enable',
                    'business' => $business->id,
                    'created_by' => $business->created_by,
                ];
            
                Setting::updateOrInsert($data, ['value' => 'off']);
                // Settings Cache forget
                comapnySettingCacheForget();
                $tab = 10;
                return redirect()->back()->with('success', __('Custom field setting successfully created.'))->with('tab', $tab);
            }
            
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomField $customField)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomField $customField)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomField $customField)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomField $customField)
    {
        //
    }
}
