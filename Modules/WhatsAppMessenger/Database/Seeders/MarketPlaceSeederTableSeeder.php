<?php

namespace Modules\WhatsAppMessenger\Database\Seeders;

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
        $module = 'WhatsAppMessenger';

        $data['product_main_banner'] = '';
        $data['product_main_status'] = 'on';
        $data['product_main_heading'] = 'WhatsAppMessenger';
        $data['product_main_description'] = '<p>BookingGo SaaS now includes the integration of WhatsApp Messenger, providing businesses with a powerful tool for streamlined communication with their clients. This integration allows for direct communication with customers through the popular messaging platform, enhancing convenience and accessibility.</p>';
        $data['product_main_demo_link'] = '#';
        $data['product_main_demo_button_text'] = 'View Live Demo';
        $data['dedicated_theme_heading'] = 'WhatsApp Messenger';
        $data['dedicated_theme_description'] = '<p>Implement the WhatsApp Messenger Module in BookingGo SaaS for efficient communication and customer engagement via WhatsApp.</p>';
        $data['dedicated_theme_sections'] = '[{"dedicated_theme_section_image":"","dedicated_theme_section_heading":"Effortless Communication","dedicated_theme_section_description":"<p>With WhatsApp Messenger integrated into BookingGo SaaS, businesses can effortlessly connect with their clients. Instead of relying on traditional communication channels like phone calls or emails, businesses can now communicate directly with customers through WhatsApp. This eliminates the need for clients to switch between different platforms, simplifying the communication process for both parties.<\/p>","dedicated_theme_section_cards":{"1":{"title":null,"description":null}}},{"dedicated_theme_section_image":"","dedicated_theme_section_heading":"Real-Time Updates","dedicated_theme_section_description":"<p>One of the key benefits of WhatsApp Messenger integration is the ability to provide real-time updates to clients. Businesses can send instant notifications about booking confirmations, changes in schedules, or special offers directly to their clients\' WhatsApp inbox. This ensures that clients receive important information promptly, reducing the likelihood of missed messages or misunderstandings.<\/p>","dedicated_theme_section_cards":{"1":{"title":null,"description":null}}}]';
        $data['dedicated_theme_sections_heading'] = '';
        $data['screenshots'] = '[{"screenshots":"","screenshots_heading":"WhatsAppMessenger"},{"screenshots":"","screenshots_heading":"WhatsAppMessenger"},{"screenshots":"","screenshots_heading":"WhatsAppMessenger"},{"screenshots":"","screenshots_heading":"WhatsAppMessenger"},{"screenshots":"","screenshots_heading":"WhatsAppMessenger"}]';
        $data['addon_heading'] = 'Why choose dedicated modulesfor Your Business?';
        $data['addon_description'] = '<p>With BookingGo, you can conveniently manage all your business functions from a single location.</p>';
        $data['addon_section_status'] = 'on';
        $data['whychoose_heading'] = 'Why choose dedicated modulesfor Your Business?';
        $data['whychoose_description'] = '<p>With BookingGO, you can conveniently manage all your business functions from a single location.</p>';
        $data['pricing_plan_heading'] = 'Empower Your Workforce with BookingGo';
        $data['pricing_plan_description'] = '<p>Access over Premium Add-ons for Stripe, Paypal, Google Recaptcha and more, all in one place!</p>';
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
