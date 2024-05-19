<?php

namespace Modules\PWA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\LandingPage\Entities\MarketplacePageSetting;


class MarketPlaceSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $module = 'PWA';

        $data['product_main_banner'] = '';
        $data['product_main_status'] = 'on';
        $data['product_main_heading'] = 'PWA';
        $data['product_main_description'] = "<p>Empower your Bookinggo experience with our new Progressive Web Application (PWA) customization module! Take control of your application's appearance and seamlessly integrate it into your workflow with just a few clicks.</p>";
        $data['product_main_demo_link'] = '#';
        $data['product_main_demo_button_text'] = 'View Live Demo';
        $data['dedicated_theme_heading'] = 'Unlock the Power of PWA';
        $data['dedicated_theme_description'] = '<p>Our PWA module combines the reliability and speed of a native app with the accessibility and flexibility of the web. Revolutionize your Bookinggo experience by harnessing the full potential of PWAs.</p>';
        $data['dedicated_theme_sections'] = '[
            {
                "dedicated_theme_section_image": "",
                "dedicated_theme_section_heading": "Customization Made Simple",
                "dedicated_theme_section_description": "<p>With the PWA module, you have the freedom to tailor your Bookinggo application to match your brand identity or personal preferences. Whether its changing the application name, adjusting the color scheme, or even adding your logo, the possibilities are endless.<\/p>",
                "dedicated_theme_section_cards": {
                    "1": {
                        "title": null,
                        "description": null
                    }
                }
            },
            {
                "dedicated_theme_section_image": "",
                "dedicated_theme_section_heading": "Effortless Installation",
                "dedicated_theme_section_description": "<p>We have streamlined the installation process to make it as effortless as possible. With just a click of a button, you can copy the link to your customized Bookinggo application theme. From there, installing it on your PC is a simple process. Enjoy the convenience of instant access to your personalized Bookinggo experience without the hassle of traditional downloads or installations.<\/p>",
                "dedicated_theme_section_cards": {
                    "1": {
                        "title": null,
                        "description": null
                    }
                }
            },
            {
                "dedicated_theme_section_image":"",
                "dedicated_theme_section_heading":"Seamless Integration",
                "dedicated_theme_section_description":"<p>Once you have copied the link, installing your custom application theme on your PC is a breeze. Enjoy a seamless transition from your browser to your desktop, with all your customizations preserved. Say goodbye to clunky software installations and hello to a streamlined, personalized workflow.<\/p>",
                "dedicated_theme_section_cards":{
                    "1":{
                        "title":null,
                        "description":null
                    }
                }
            }
        ]';
        $data['dedicated_theme_sections_heading'] = '';
        $data['screenshots'] = '[{"screenshots":"","screenshots_heading":"PWA"},{"screenshots":"","screenshots_heading":"PWA"},{"screenshots":"","screenshots_heading":"PWA"},{"screenshots":"","screenshots_heading":"PWA"}]';
        $data['addon_heading'] = '<h2>Why choose dedicated modules<b> for Your Business?</b></h2>';
        $data['addon_description'] = '<p>With BookingGo, you can conveniently manage all your business functions from a single location.</p>';
        $data['addon_section_status'] = 'on';
        $data['whychoose_heading'] = 'Why choose dedicated modulesfor Your Business?';
        $data['whychoose_description'] = '<p>With BookingGo, you can conveniently manage all your business functions from a single location.</p>';
        $data['pricing_plan_heading'] = 'Empower Your Workforce with BookingGo';
        $data['pricing_plan_description'] = '<p>Access over Premium Add-ons for Stripe, Paypal, Google Recaptcha, and more, all in one place!</p>';
        $data['pricing_plan_demo_link'] = '#';
        $data['pricing_plan_demo_button_text'] = 'View Live Demo';
        $data['pricing_plan_text'] = '{"1":{"title":"Pay-as-you-go"},"2":{"title":"Unlimited installation"},"3":{"title":"Secure cloud storage"}}';
        $data['whychoose_sections_status'] = 'on';
        $data['dedicated_theme_section_status'] = 'on';


        foreach($data as $key => $value){
            if(!MarketplacePageSetting::where('name', '=', $key)->where('module', '=', $module)->exists()){
                MarketplacePageSetting::updateOrCreate(
                [
                    'name' => $key,
                    'module' => $module

                ],
                [
                    'value' => $value
                ]);
            }
        }
    }
}
