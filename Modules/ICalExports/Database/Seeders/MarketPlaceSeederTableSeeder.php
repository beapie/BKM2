<?php

namespace Modules\ICalExports\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\LandingPage\Entities\MarketplacePageSetting;


class MarketPlaceSeederTableSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $module = 'ICalExports';

        $data['product_main_banner'] = '';
        $data['product_main_status'] = 'on';
        $data['product_main_heading'] = 'ICalExports';
        $data['product_main_description'] = "<p>Welcome to the iCal module of BookingGo SaaS, where managing your important event dates is a breeze. Our platform is designed to simplify the complexities of scheduling by offering a straightforward yet robust solution for organizing your calendar. Whether you're juggling multiple meetings, deadlines, or personal commitments, our intuitive interface ensures that you can stay on top of your schedule with ease. No more scrambling to find scattered notes or emails - with BookingGo SaaS, all your crucial events are conveniently consolidated in one centralized location.</p>";
        $data['product_main_demo_link'] = '#';
        $data['product_main_demo_button_text'] = 'View Live Demo';
        $data['dedicated_theme_heading'] = 'Simplify Your Schedule with BookingGo SaaS';
        $data['dedicated_theme_description'] = '<p>Simplify event management with BookingGo SaaS - effortlessly integrate and customize your calendar entries with our intuitive iCal module.</p>';

        $data['dedicated_theme_sections'] = '[{"dedicated_theme_section_image":"","dedicated_theme_section_heading":"Seamless Integration with Your Calendar","dedicated_theme_section_description":"<p>Gone are the days of manually inputting event details into your calendar. With our iCal module, adding important dates to your schedule is as simple as a few clicks. Our platform seamlessly integrates with your preferred calendar application, whether its Google Calendar, Outlook, or any other popular platform. Once you input the event details - including date, time, location, and description - our system handles the rest, ensuring your calendar is always up to date. Say goodbye to the hassle of manual data entry and hello to effortless synchronization across all your devices.<\/p>","dedicated_theme_section_cards":{"1":{"title":null,"description":null}}},{"dedicated_theme_section_image":"","dedicated_theme_section_heading":"Customizable Event Entries","dedicated_theme_section_description":"<p>We understand that every event is unique, so our iCal module offers customizable event entries to suit your specific needs. Whether youre scheduling a recurring team meeting, a one-time client appointment, or a personal milestone, our platform adapts to accommodate your requirements. Add as much or as little detail as youd like, ensuring that all pertinent information is readily available at a glance. With customizable fields for event names, descriptions, locations, and more, you can tailor each entry to align with your workflow and preferences.<\/p>","dedicated_theme_section_cards":{"1":{"title":null,"description":null}}}]';
        $data['dedicated_theme_sections_heading'] = '';
        $data['screenshots'] = '[{"screenshots":"","screenshots_heading":"ICalExports"},{"screenshots":"","screenshots_heading":"ICalExports"},{"screenshots":"","screenshots_heading":"ICalExports"}]';
        $data['addon_heading'] = 'Why choose dedicated modulesfor Your Business?';
        $data['addon_description'] = '<p>With BookingGo, you can conveniently manage all your business functions from a single location.</p>';
        $data['addon_section_status'] = 'on';
        $data['whychoose_heading'] = 'Why choose dedicated modulesfor Your Business?';
        $data['whychoose_description'] = '<p>With BookingGo, you can conveniently manage all your business functions from a single location.</p>';
        $data['pricing_plan_heading'] = 'Empower Your Workforce with BookingGo';
        $data['pricing_plan_description'] = '<p>Access over Premium Add-ons for Stripe , Paypal , Google Recaptcha, and more, all in one place!</p>';
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
