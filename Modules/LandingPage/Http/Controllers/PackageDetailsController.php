<?php

namespace Modules\LandingPage\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\LandingPage\Entities\LandingPageSetting;

class PackageDetailsController extends Controller
{

    public function index()
    {
        
        if(\Auth::user()->isAbleTo('landingpage manage')){
            
            $settings = LandingPageSetting::settings();
            return view('landingpage::landingpage.packagedetails.index', compact('settings'));

        }else{

            return redirect()->back()->with('error',__('Permission Denied!'));
        }
    }


    public function create()
    {
        return view('landingpage::create');
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('landingpage::show');
    }


    public function edit($id)
    {
        return view('landingpage::edit');
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function packagedetails_store(Request $request)
    {
        $data['packagedetails_section_status'] = ($request->packagedetails_section_status == 'on') ? 'on' : 'off';
        $data['packagedetails_heading']= $request->packagedetails_heading;
        $data['packagedetails_short_description']= $request->packagedetails_short_description;
        $data['packagedetails_long_description']= $request->packagedetails_long_description;
        $data['packagedetails_link']= $request->packagedetails_link;
        $data['packagedetails_button_text']= $request->packagedetails_button_text;


        foreach($data as $key => $value){

            LandingPageSetting::updateOrCreate(['name' =>  $key],['value' => $value]);
        }

        return redirect()->back()->with(['success'=> 'PackageDetails updated successfully']);

    }
}
