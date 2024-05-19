<?php

namespace Modules\AppointmentReview\Database\Seeders;

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
        $module = 'AppointmentReview';

        $data['product_main_banner'] = '';
        $data['product_main_status'] = 'on';
        $data['product_main_heading'] = 'AppointmentReview';
        $data['product_main_description'] = '<p>Elevate your BookingGo SaaS marketplace with the Appointment Review Module, a powerful tool designed to enhance customer engagement and satisfaction. With this feature enabled, customers can easily leave ratings for staff directly from the frontend interface, while admins gain valuable insights through the Manage Business Module.</p>';
        $data['product_main_demo_link'] = '#';
        $data['product_main_demo_button_text'] = 'View Live Demo';
        $data['dedicated_theme_heading'] = '<h2>Frontend Rating <b>Button for </b> Customer Convenience</h2>';
        $data['dedicated_theme_description'] = '<p>With the Appointment Review Module, customers can conveniently rate their appointment experience through a frontend rating button. This simplifies the feedback process, allowing customers to provide ratings for staff professionalism, and overall satisfaction with just a few clicks. By making it easy for customers to leave feedback, you encourage active participation and engagement with your platform.</p>';
        $data['dedicated_theme_sections'] = '[{"dedicated_theme_section_image":"","dedicated_theme_section_heading":"Admin Visibility and Insights","dedicated_theme_section_description":"<p>Admins gain valuable insights into staff performance through the Manage Business Module. Here, they can access comprehensive ratings data, including staff ratings and feedback submitted by customers. This data empowers admins to monitor performance, identify areas for improvement, and implement strategies to enhance customer satisfaction.<\/p>","dedicated_theme_section_cards":{"1":{"title":null,"description":null}}},{"dedicated_theme_section_image":"","dedicated_theme_section_heading":"Custom Email Templates for Personalized Communication","dedicated_theme_section_description":"<p>Admins can create custom email templates within the platform to send automated emails to customers once they submit a rating. These email templates allow admins to express gratitude for the feedback received and encourage continued engagement with the platform. By sending personalized emails, admins foster a sense of appreciation and build stronger relationships with customers.<\/p>","dedicated_theme_section_cards":{"1":{"title":null,"description":null}}}]';
        $data['dedicated_theme_sections_heading'] = '';
        $data['screenshots'] = '[{"screenshots":"","screenshots_heading":"Mailchimp"},{"screenshots":"","screenshots_heading":"Mailchimp"},{"screenshots":"","screenshots_heading":"Mailchimp"}]';
        $data['addon_heading'] = '<h2>Why choose dedicated modules<b> for Your Business?</b></h2>';
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
