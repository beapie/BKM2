<?php

namespace Modules\PWA\Http\Controllers;

use App\Models\Business;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PWAController extends Controller
{
    public function savePWA(Request $request, $id)
    {
        if (\Auth::user()->isAbleTo('business PWA settings')) {
            $business_id = $id;
            $business = Business::find($id);
            $business['enable_pwa'] = $request->enable_pwa ?? 'off';

            if ($request->enable_pwa == 'on') {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'pwa_app_title' => 'required|max:100',
                        'pwa_app_name' => 'required|max:50',
                        'pwa_app_background_color' => 'required|max:15',
                        'pwa_app_theme_color' => 'required|max:15',
                    ]
                );

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $company_settings = getCompanyAllSetting();

                $company_favicon = get_file('uploads/logo/favicon.png');


                $lang = \Auth::user()->lang;

                if ($company_settings['enable_businesslink'] == 'on') {
                    $start_url = url('/appointments/' . $business['slug']);
                } else if ($company_settings['enable_domain'] == 'on') {
                    $start_url = 'https://' . $company_settings['domains'] . '/';
                } else {
                    $start_url = 'https://' . $company_settings['subdomain'] . '/';
                }


                $mainfest = '{
                                "lang": "' . $lang . '",
                                "name": "' . $request->pwa_app_title . '",
                                "short_name": "' . $request->pwa_app_name . '",
                                "start_url": "' . $start_url . '",
                                "display": "standalone",
                                "background_color": "' . $request->pwa_app_background_color . '",
                                "theme_color": "' . $request->pwa_app_theme_color . '",
                                "orientation": "portrait",
                                "categories": [
                                    "shopping"
                                ],
                                "icons": [
                                    {
                                        "src": "' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "320x320",
                                        "type": "image/png",
                                        "purpose": "any"
                                    },
                                    {
                                        "src": "' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "320x320",
                                        "type": "image/png",
                                        "purpose": "any"
                                    },
                                    {
                                        "src": "' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "152x152",
                                        "type": "image/png",
                                        "purpose": "any"
                                    },
                                    {
                                        "src": "' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "192x192",
                                        "type": "image/png",
                                        "purpose": "any"
                                    },
                                    {
                                        "src": "' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "256x256",
                                        "type": "image/png",
                                        "purpose": "any"
                                    },
                                    {
                                        "src": "' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "512x512",
                                        "type": "image/png",
                                        "purpose": "any"
                                    },
                                    {
                                        "src": "' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '",
                                        "sizes": "1024x1024",
                                        "type": "image/png",
                                        "purpose": "any"
                                    }
                                ]
                            }';



                if (!file_exists('uploads/theme_app/business_' . $business_id)) {
                    mkdir('uploads/theme_app/business_' . $business_id, 0777, true);
                }
                if (!file_exists('uploads/theme_app/business_' . $business_id . '/manifest.json')) {
                    fopen('uploads/theme_app/business_' . $business_id . "/manifest.json", "w");
                }
                \File::put('uploads/theme_app/business_' . $business_id . '/manifest.json', $mainfest);
            }

            $business->save();
            $tab = 11;
            return redirect()->back()->with('success', __('PWA Successfully Updated.'))->with('tab', $tab);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
