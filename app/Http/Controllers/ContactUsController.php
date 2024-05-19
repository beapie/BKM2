<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(Auth::user())
        {
            if(Auth::user()->isAbleTo('contact manage'))
            {
                if($request->business)
                {
                    $business_id = $request->business;
                }
                else
                {
                    $business_id = getActiveBusiness();
                }
    
                $business = Business::find($business_id);
                $contacts = ContactUs::where('business_id',$business->id)->get();
                
                return view('contact.index',compact('contacts','business'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
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
        $validator = \Validator::make(
            $request->all(), [
                'name' => 'required',
                'email' => 'required',
                'contact' => 'required',
                'subject' => 'required',
                'message' => 'required',
                'theme' => 'required',
                ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $contactus                    = new ContactUs();
            $contactus->name              = $request->name;
            $contactus->email             = $request->email;
            $contactus->contact           = $request->contact;
            $contactus->subject           = $request->subject;
            $contactus->description       = $request->message;
            $contactus->theme             = $request->theme;
            $contactus->business_id       = $request->business;
            $contactus->save();

            return redirect()->back()->with('success', __('Detail successfully submit.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactUs $contactUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactUs $contactUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactUs $contactUs,$id)
    {
        if(Auth::user()->isAbleTo('contact delete'))
        {
            $contactUs = ContactUs::find($id);
            $contactUs->delete();
            return redirect()->back()->with('error', __('Contact successfully delete.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
