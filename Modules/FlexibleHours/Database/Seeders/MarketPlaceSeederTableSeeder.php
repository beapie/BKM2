<?php

namespace Modules\FlexibleHours\Database\Seeders;

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
        $module = 'FlexibleHours ';

        $data['product_main_banner'] = '';
        $data['product_main_status'] = 'on';
        $data['product_main_heading'] = 'Flexible Hours';
        $data['product_main_description'] = "<p>Welcome to BookingGo's Flexible Hours Functionality, designed to give you greater control over your appointment schedule. With this feature, you can adjust your availability to better suit your needs, providing convenience for both you and your clients.</p>";
        $data['product_main_demo_link'] = '#';
        $data['product_main_demo_button_text'] = 'View Live Demo';
        $data['dedicated_theme_heading'] = 'Tailored Appointment Hours';
        $data['dedicated_theme_description'] = '<p>BookingGo allows you to customize your appointment hours based on your availability. Whether you prefer mornings, evenings, or weekends, you can set your schedule accordingly. Adjust your hours easily to accommodate personal commitments or peak business times.</p>';
        $data['dedicated_theme_sections'] = '[
            {
                "dedicated_theme_section_image": "",
                "dedicated_theme_section_heading": "Admin-Controlled Settings",
                "dedicated_theme_section_description": "<p>The admin sets the appointment hours, ensuring consistency across the platform. You dont have to worry about managing pricing details; simply focus on managing your schedule. Whether its peak hours or off-peak times, the admin has it covered.<\/p>",
                "dedicated_theme_section_cards": {
                    "1": {
                        "title": null,
                        "description": null
                    }
                }
            },
            {
                "dedicated_theme_section_image": "",
                "dedicated_theme_section_heading": "Streamlined Setup Process",
                "dedicated_theme_section_description": "<p>Setting up your flexible hours is straightforward with BookingGo. Our user-friendly interface lets you manage your schedule effortlessly. You can update your availability with ease, making it convenient to adapt to changing circumstances.<\/p>",
                "dedicated_theme_section_cards": {
                    "1": {
                        "title": null,
                        "description": null
                    }
                }
            },
            {
                "dedicated_theme_section_image":"",
                "dedicated_theme_section_heading":"Benefits of Flexibility",
                "dedicated_theme_section_description":"<p>By utilizing BookingGo Flexible Hours Functionality, you gain the freedom to manage your schedule according to your needs. This flexibility allows you to achieve a better work-life balance and optimize your productivity. Focus on delivering exceptional service to your clients without worrying about managing pricing details. The flexible hours that you have added will be highlighted on the front end, so that the users don’t get confused.<\/p>",
                "dedicated_theme_section_cards":{
                    "1":{
                        "title":null,
                        "description":null
                    }
                }
            }
        ]';
        $data['dedicated_theme_sections_heading'] = '';
        $data['screenshots'] = '[{"screenshots":"","screenshots_heading":"FlexibleHours"},{"screenshots":"","screenshots_heading":"FlexibleHours"},{"screenshots":"","screenshots_heading":"FlexibleHours"},{"screenshots":"","screenshots_heading":"FlexibleHours"}]';
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
