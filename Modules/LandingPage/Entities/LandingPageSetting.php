<?php

namespace Modules\LandingPage\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LandingPageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value'
    ];
    public static $fontweight = [
        'normal' => 'Normal',
        'bold' => 'Bold',
        'lighter' => 'Lighter',
        'bolder' => 'Bolder',
    ];

    public static $settings_data;

    protected $table = 'landing_page_settings';


    protected static function newFactory()
    {
        return \Modules\LandingPage\Database\factories\LandingPageSettingFactory::new();
    }

    public static function settings()
    {
        if (self::$settings_data == null) {
            $data = LandingPageSetting::get();
            self::$settings_data = $data;
        }

        $settings = [
            'topbar_status' => 'on',
            'topbar_notification_msg' => '70% Special Offer. Don’t Miss it. The offer ends in 72 hours.',
            'menubar_status' => 'on',
            'menubar_page' => '[
                {"template_name":"page_content","page_url":"","menubar_page_contant":"<p>At WorkDo our vision is to become a one-stop destination for all your IT needs by creating disruptive web solutions that remain accessible to all. We diligently work towards bringing our clients IT solutions that transform the way their businesses function. Rather than confuse you with the complexities of web services we focus on bringing our clients simplified web solutions. From Web development, to Web maintenance, we are dedicated to making your IT life easier.<\/p>","login":"on","menubar_page_name":"About Us","menubar_page_short_description":"WorkDo offers comprehensive web solutions to businesses. We aim to provide products that are beautifully designed, user friendly and a delight to use.","page_slug":"about_us","header":"on","footer":"on"}
            ]',
            'site_logo' => 'site_logo.png',
            'site_description' => '',
            'home_status' => 'on',
            'home_offer_text' => '70% Special Offer1',
            'home_title' => 'Home',
            'home_heading' => 'Empowering Businesses with Seamless Booking Management Solutions and Enhanced Customer Experiences.',
            'home_description' => 'Simplify your booking processes with BookingGo SaaS, the ultimate solution for efficient and hassle-free booking management.',
            'home_trusted_by' => 'Our best partners and +11,000 customers worldwide satisfied with our services.',
            'home_live_demo_link' => 'https://bookinggo-demo.workdo.io/login',
            'home_buy_now_link' => '',
            'home_banner' => 'home_banner.png',
            'home_logo' => 'home_logo.png',
            'home_link_button_text' => 'View Live Demo',
            'feature_status' => 'on',
            'feature_title' => 'Features',
            'feature_heading' => '',
            'feature_description' => '',
            'feature_buy_now_link' => '',
            'feature_more_details_link' => '',
            'feature_of_features' => '[
                {"feature_logo":"1690960676-feature_logo.png",
                "feature_heading":"Streamlined Booking Management","feature_description":"<p>BookingGo SaaS simplifies the booking process, allowing businesses to efficiently manage appointments, reservations, and schedules through intuitive tools, ultimately saving time and resources.<\/p>","feature_more_details_link":"#","feature_more_details_button_text":"Find Out More"},{"feature_logo":"1690960805-feature_logo.png","feature_heading":"Enhanced Customer Experience","feature_description":"<p>With BookingGo SaaS, businesses can provide customers with a seamless booking experience, including easy online reservations, real-time availability updates, and personalized communication, leading to increased satisfaction and loyalty.<\/p>","feature_more_details_link":"#","feature_more_details_button_text":"Find Out More"},{"feature_logo":"1690960837-feature_logo.png","feature_heading":"Comprehensive Business Insights","feature_description":"<p>BookingGo SaaS offers advanced analytics and reporting features, providing businesses with valuable insights into booking trends, customer preferences, and performance metrics, enabling data-driven decision-making and strategic planning.<\/p>",
                 "feature_more_details_link":"#","feature_more_details_button_text":"Find Out More"
                }
            ]',
            'feature_logo' => '',
            'highlight_feature_heading' => 'Why choose dedicated modules for Your Business?',
            'highlight_feature_description' => 'With Dash, you can conveniently manage all your business functions from a single location.',
            'highlight_feature_image' => '',
            'other_features' => '
            [
             {"other_features_image":"feature-image-2.png","other_features_tag":"SALES","other_features_heading":"Photography Studio Business Theme","other_featured_description":"The Photography Studio Business Theme is a customizable template designed to simplify the booking process for photography studios. It offers personalized session details collection, package selection options, customizable add-ons for extra services, integrated payment processing, and automated appointment confirmations.","other_feature_buy_now_link":null,"cards":
                 {"1":{"title":"Streamlined Booking Process","description":"Clients can easily select session details, packages, and additional services, streamlining the booking process and reducing friction."},
                 "2":{"title":"Enhanced Customer Satisfaction","description":"Automated appointment confirmations and integrated payment processing enhance customer satisfaction by providing a seamless booking experience."},
                 "3":{"title":"Increased Revenue Opportunities","description":"Customizable add-ons for extra services enable photography studios to upsell and increase revenue per booking."}}
             },
             {"other_features_image":"feature-image-3.png","other_features_tag":"SALES","other_features_heading":"Car Services Business Theme","other_featured_description":"<p>The Car Services Business Theme is tailored to meet the needs of auto service providers. It offers streamlined service selection, appointment scheduling, vehicle details collection, service add-on options, price estimation, and automated appointment reminders.<\/p>","other_feature_buy_now_link":null,"cards":
                 {"1":{"title":"Improved Efficiency","description":"Streamlined service selection and appointment scheduling save time for both service providers and clients, improving overall efficiency."},
                 "2":{"title":"Enhanced Communication","description":"Automated appointment reminders keep clients informed and reduce no-shows, improving communication and appointment adherence."},
                 "3":{"title":"Personalized Service Options","description":"Service add-on options allow clients to customize their service packages, enhancing satisfaction and loyalty."}}
             },
             {"other_features_image":"feature-image-4.png","other_features_tag":"SALES","other_features_heading":"Custom Status Module in BookingGo SaaS","other_featured_description":"<p>The Custom Status module within BookingGo SaaS offers administrators the ability to tailor appointment statuses to suit unique business workflows and requirements, providing enhanced clarity and efficiency in appointment management.<\/p>","other_feature_buy_now_link":null,"cards":
                 {"1":{"title":"Flexibility","description":"Administrators can define custom appointment statuses, aligning them with specific business processes and requirements."},
                 "2":{"title":"Improved Workflow","description":"Tailoring appointment statuses enhances clarity in the booking process, streamlining appointment management."},
                 "3":{"title":"Enhanced Efficiency","description":"Customized statuses ensure that appointments are accurately tracked and managed, optimizing overall efficiency in scheduling and organization."}}
             },
             {"other_features_image":"feature-image-5.png","other_features_tag":"SALES","other_features_heading":"Optimizing Appointment Scheduling","other_featured_description":"<p>Appointment Slot Capacity Setting – designed to revolutionize appointment scheduling for businesses. This innovative setting allows administrators to define the maximum number of appointments that can be scheduled within specific time slots, enhancing resource utilization and service levels.<\/p>","other_feature_buy_now_link":null,"cards":
                 {"1":{"title":"Enhanced Efficiency","description":"Define maximum appointment capacities within time slots to optimize resource utilization and streamline scheduling."},
                 "2":{"title":"Customizable Settings","description":"Administrators can tailor appointment slots to match operational capacity, ensuring appointments are efficiently managed."},
                 "3":{"title":"Improved Customer Service","description":"By maintaining optimal appointment levels, businesses can deliver exceptional customer service and minimize scheduling conflicts."}}
             }
            ]',
            'screenshots_status' => 'on',
            'screenshots_heading' => '',
            'screenshots_description' => '',
            'screenshots' => '[
                {"screenshots":"screenshot-1.png","screenshots_heading":"Dashboard"},
                {"screenshots":"screenshot-2.png","screenshots_heading":"Bussiness Form"},
                {"screenshots":"screenshot-3.png","screenshots_heading":"Bussiness Theme"},
                {"screenshots":"screenshot-4.png","screenshots_heading":"Appointment"},
                {"screenshots":"screenshot-5.png","screenshots_heading":"Setting"}
            ]',
            'footer_status' => 'on',
            'joinus_status' => 'on',
            'joinus_heading' => 'Join Our Community',
            'joinus_description' => 'We build modern web tools to help you jump-start your daily business work.',
            'footer_logo' => '1690967309-footer_logo.png',
            'footer_description' => 'We build modern web tools to help you jump-start your daily business work.',
            'footer_live_demo_link' => '#',
            'all_rights_reserve_text' => 'All Rights Reserved to',
            'footer_support_link' => '#',
            'all_rights_reserve_website_name' => 'workdo.io',
            'all_rights_reserve_website_url' => 'https://workdo.io/',
            'footer_sections_details' => '[{"footer_section_heading":"Company","footer_section_text":{"1":{"title":"About Us","link":"#"},"2":{"title":"Freebies","link":"#"},"3":{"title":"Premium","link":"#"},"4":{"title":"Blog","link":"#"},"5":{"title":"Affiliate Program","link":"#"},"6":{"title":"Get coupon","link":"#"}}},{"footer_section_heading":"Help and Support","footer_section_text":{"1":{"title":"Knowledge Center","link":"#"},"2":{"title":"Contact Us","link":"#"},"3":{"title":"Premium Support","link":"#"},"4":{"title":"Sponsorships","link":"#"},"5":{"title":"Custom Development","link":"#"}}},{"footer_section_heading":"Help and Support","footer_section_text":{"1":{"title":"Terms & Conditions","link":"#"},"2":{"title":"Privacy Policy","link":"#"},"3":{"title":"Licenses","link":"#"}}}]',
            'footer_gotoshop_button_text' => 'Go to Shop',
            'footer_support_button_text' => 'Support',
            'reviews' => '[{"review_header_tag":"SOLID FOUNDATION","review_heading":"A style theme, together with a dedicated Laravel backend and an intuitive mobile app","review_description":"<p>gives your business an unfair advantage. The package doesn\u2019t just provide you with everything you need to start selling online. It gives you a solid foundation for an eCommerce business for years to come.<\/p>","review_live_demo_link":"https://bookinggo-demo.workdo.io/login","review_live_demo_button_text":"View Live Demo"},{"review_header_tag":"SOLID FOUNDATION","review_heading":"A style theme, together with a dedicated Laravel backend and an intuitive mobile app","review_description":"<p>gives your business an unfair advantage. The package doesn\u2019t just provide you with everything you need to start selling online. It gives you a solid foundation for an eCommerce business for years to come.<\/p>","review_live_demo_link":"https://bookinggo-demo.workdo.io/login","review_live_demo_button_text":"View Live Demo"},{"review_header_tag":"SOLID FOUNDATION","review_heading":"A style theme, together with a dedicated Laravel backend and an intuitive mobile app","review_description":"<p>gives your business an unfair advantage. The package doesn\u2019t just provide you with everything you need to start selling online. It gives you a solid foundation for an eCommerce business for years to come.<\/p>","review_live_demo_link":"https://bookinggo-demo.workdo.io/login","review_live_demo_button_text":"View Live Demo"},{"review_header_tag":"SOLID FOUNDATION","review_heading":"A style theme, together with a dedicated Laravel backend and an intuitive mobile app","review_description":"<p>gives your business an unfair advantage. The package doesn\u2019t just provide you with everything you need to start selling online. It gives you a solid foundation for an eCommerce business for years to come.<\/p>","review_live_demo_link":"https://bookinggo-demo.workdo.io/login","review_live_demo_button_text":"View Live Demo"},{"review_header_tag":"SOLID FOUNDATION","review_heading":"A style theme, together with a dedicated Laravel backend and an intuitive mobile app","review_description":"gives your business an unfair advantage. The package doesn\u2019t just provide you with everything you need to start selling online. It gives you a solid foundation for an eCommerce business for years to come.","review_live_demo_link":"https://bookinggo-demo.workdo.io/login","review_live_demo_button_text":"View Live Demo"}]',
            'dedicated_heading' => 'Why Choose a Dedicated Fashion Theme for Your Business?',
            'dedicated_description' => 'With Alligō, you can take care of the entire partner lifecycle - from onboarding through nurturing, cooperating, and rewarding. Find top performers and let go of those who arent a good fit.',
            'dedicated_live_demo_link' => 'https://bookinggo-demo.workdo.io/login',
            'dedicated_link_button_text' => 'View Live Demo',
            'dedicated_card_details' => '[{"dedicated_card_logo":"1690966583-dedicated_card_logo.png","dedicated_card_heading":"High-Performing, Secure PHP Framework","dedicated_card_description":"Unlike many frameworks that come and go, the framework stood the test of time. Over the years, it grew to become one of the fastest and most secure frameworks in the market.","dedicated_card_more_details_link":"#","dedicated_card_more_details_button_text":"Find Out More"},{"dedicated_card_logo":"1690966606-dedicated_card_logo.png","dedicated_card_heading":"Stable Codebase","dedicated_card_description":"Some frameworks come and go - but Laravel is here to stay. Laravels active developer community helps keep its codebase up-to-date and stable. This, in turn, helps ensure the stability of your eCommerce website.","dedicated_card_more_details_link":"#","dedicated_card_more_details_button_text":"Find Out more"},{"dedicated_card_logo":"1690966638-dedicated_card_logo.png","dedicated_card_heading":"Secure Integrations","dedicated_card_description":"As you grow, you may want to expand your store with new functionalities or payment methods. Thanks to Laravels flexibility, it\u2019s easy to add new integrations and customize the store even once its already developed.<","dedicated_card_more_details_link":"#","dedicated_card_more_details_button_text":"Find Out more"}]',
            'dedicated_section_status' => 'on',
            'buildtech_heading' => 'Built with Technology You Can Trust',
            'buildtech_description' => 'Our backend is built with Laravel - one of the most popular and highest-rated web development frameworks. Find out why we chose it - and how it benefits your business.',
            'buildtech_live_demo_link' => '',
            'buildtech_link_button_text' => '',
            'buildtech_card_details' => '[{"buildtech_card_logo":"1690966770-buildtech_card_logo.png","buildtech_card_heading":"Sell More Than Your Competitors","buildtech_card_description":"Your online store has one goal - to sell your products. Thanks to years of experience in the industry, we know the ins and outs of online sales. And we put that knowledge into every package that we offer. With the Style eCommerce package, you get a store that\u2019s optimized for helping you sell more in the fashion niche.","buildtech_card_more_details_link":"#","buildtech_card_more_details_button_text":"Find Out More"},{"buildtech_card_logo":"1690966899-buildtech_card_logo.png","buildtech_card_heading":"Get a Headstart over Your Competitors","buildtech_card_description":"In business, you have to act fast. By choosing our Style theme package, you can get everything you need to start selling right away. Hit the market with your product sooner, attract early sales, and build an audience from day one.","buildtech_card_more_details_link":"#","buildtech_card_more_details_button_text":"Find Out More"},{"buildtech_card_logo":"1690966833-buildtech_card_logo.png","buildtech_card_heading":"Avoid Design Mistakes","buildtech_card_description":"When you get a ready-made package, you avoid common design mistakes that could cost your business a fortune. Not only that. Thanks to a higher conversion rate, you can achieve better ROI on your marketing expenses.","buildtech_card_more_details_link":"#","buildtech_card_more_details_button_text":"Find Out More"},{"buildtech_card_logo":"1690966858-buildtech_card_logo.png","buildtech_card_heading":"Build a Long-Term Asset","buildtech_card_description":"The key to success in eCommerce is to scale your store and build an audience of loyal, recurring customers. With our package, you get more than just a store. You get an asset that\u2019s ready for you to take care of it and grow it for years to come.","buildtech_card_more_details_link":"#","buildtech_card_more_details_button_text":"Find Out More"}]',
            'buildtech_section_status' => 'on',
            'packagedetails_section_status' => 'on',
            'packagedetails_heading' => 'Start an Online Fashion Business with a Complete eCommerce Package',
            'packagedetails_short_description' => 'Get a fashion-themed eCommerce store with a secure backend and convenient mobile app. Build a brand, manage your store wherever you are, and grow an online business.',
            'packagedetails_long_description' => 'An effective fashion theme should be visually appealing and easy to navigate. A good theme makes it easy for customers to find and buy the items they&rsquo;re interested in. The theme should also be responsive so that it looks good on all devices.With the Style theme, you get all of the above - and more. The theme gives you everything you need to sell your products and keep your audience coming back for more. Easily customize the theme and adjust its design to your branding needs. Add products, polish product pages, and start growing your online business.',
            'packagedetails_link' => 'https://bookinggo-demo.workdo.io/login',
            'packagedetails_button_text' => 'Get the Package',
            'discover_status' => 'on',
            'discover_heading' => '',
            'discover_description' => '',
            'discover_live_demo_link' => '',
            'discover_buy_now_link' => '',
            'discover_of_features' => '',
            'plan_status' => 'on',
            'plan_title' => 'Plan',
            'plan_heading' => '',
            'plan_description' => '',
            'faq_status' => 'on',
            'faq_title' => 'Faq',
            'faq_heading' => '',
            'faq_description' => '',
            'faqs' => '',
            'testimonials_status' => 'on',
            'testimonials_heading' => '',
            'testimonials_description' => '',
            'testimonials_long_description' => '',
            'testimonials' => '',
            'feature_of_features_cards' => '',
            'landing_page_section_sequence' => '["is_banner_section_active","is_features_section_active",
            "is_screenshots_section_active","is_buildtech_section_active","is_reviews_section_active",
            "is_package_details_section_active",
            "is_dedicated_section_active"]',
            'is_top_bar_active' => 'on',
            'is_banner_section_active' => 'on',
            'is_features_section_active' => 'on',
            'is_reviews_section_active' => 'on',
            'is_screenshots_section_active' => 'on',
            'is_dedicated_section_active' => 'on',
            'is_faq_section_active' => 'on',
            'is_buildtech_section_active' => 'on',
            'is_package_details_section_active' => 'on',

        ];


        foreach (self::$settings_data as $row) {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }

    public static function keyWiseUpload_file($request, $key_name, $name, $path, $data_key, $custom_validation = [])
    {
        $multifile = [
            $key_name => $request->file($key_name)[$data_key][$key_name],
        ];

        try {
            $settings = getAdminAllSetting();

            if (!empty($settings['storage_setting'])) {

                if ($settings['storage_setting'] == 'wasabi') {

                    config(
                        [
                            'filesystems.disks.wasabi.key' => $settings['wasabi_key'],
                            'filesystems.disks.wasabi.secret' => $settings['wasabi_secret'],
                            'filesystems.disks.wasabi.region' => $settings['wasabi_region'],
                            'filesystems.disks.wasabi.bucket' => $settings['wasabi_bucket'],
                            'filesystems.disks.wasabi.endpoint' => 'https://s3.' . $settings['wasabi_region'] . '.wasabisys.com'
                        ]
                    );

                    $max_size = !empty($settings['wasabi_max_upload_size']) ? $settings['wasabi_max_upload_size'] : '2048';
                    $mimes =  !empty($settings['wasabi_storage_validation']) ? $settings['wasabi_storage_validation'] : '';
                } else if ($settings['storage_setting'] == 's3') {
                    config(
                        [
                            'filesystems.disks.s3.key' => $settings['s3_key'],
                            'filesystems.disks.s3.secret' => $settings['s3_secret'],
                            'filesystems.disks.s3.region' => $settings['s3_region'],
                            'filesystems.disks.s3.bucket' => $settings['s3_bucket'],
                            'filesystems.disks.s3.use_path_style_endpoint' => false,
                        ]
                    );
                    $max_size = !empty($settings['s3_max_upload_size']) ? $settings['s3_max_upload_size'] : '2048';
                    $mimes =  !empty($settings['s3_storage_validation']) ? $settings['s3_storage_validation'] : '';
                } else {
                    $max_size = !empty($settings['local_storage_max_upload_size']) ? $settings['local_storage_max_upload_size'] : '2048';

                    $mimes =  !empty($settings['local_storage_validation']) ? $settings['local_storage_validation'] : '';
                }


                $file = $request->$key_name;


                if (count($custom_validation) > 0) {
                    $validation = $custom_validation;
                } else {

                    $validation = [
                        'mimes:' . $mimes,
                        'max:' . $max_size,
                    ];
                }

                $validator = \Validator::make($multifile, [
                    $key_name => $validation
                ]);


                if ($validator->fails()) {
                    $res = [
                        'flag' => 0,
                        'msg' => $validator->messages()->first(),
                    ];
                    return $res;
                } else {

                    $name = $name;

                    if ($settings['storage_setting'] == 'local') {

                        \Storage::disk()->putFileAs(
                            $path,
                            $request->file($key_name)[$data_key][$key_name],
                            $name
                        );


                        $path = $name;
                    } else if ($settings['storage_setting'] == 'wasabi') {

                        $path = \Storage::disk('wasabi')->putFileAs(
                            $path,
                            $file,
                            $name
                        );

                        // $path = $path.$name;

                    } else if ($settings['storage_setting'] == 's3') {

                        $path = \Storage::disk('s3')->putFileAs(
                            $path,
                            $file,
                            $name
                        );
                    }


                    $res = [
                        'flag' => 1,
                        'msg'  => 'success',
                        'url'  => $path
                    ];
                    return $res;
                }
            } else {
                $res = [
                    'flag' => 0,
                    'msg' => __('Please set proper configuration for storage.'),
                ];
                return $res;
            }
        } catch (\Exception $e) {
            $res = [
                'flag' => 0,
                'msg' => $e->getMessage(),
            ];
            return $res;
        }
    }

    public static function get_google_fonts()
    {

        $googlefonts_api_key = 'AIzaSyDGB-PBetPTdbjjj6gNwoabznzEnZSgQHQ';

        // google api key
        $google_api_key = $googlefonts_api_key;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/webfonts/v1/webfonts?key=" . $google_api_key);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $fonts_list = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($http_code != 200) {
            $data = [];
            return $data;
            // exit('Error : Failed to get Google Fonts list');
        }
        // echo out list of fonts
        $data = array_column($fonts_list['items'], 'family');

        return $data;
    }

    public static function saveSettings($data = [])
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {

                LandingPageSetting::updateOrCreate(['name' =>  $key], ['value' => $value]);
            }

            return true;
        }

        return false;
    }

    public static function pwa_store()
    {
        try {
            $pwa_data = \File::get(('uploads/customer_app/manifest.json'));

            $pwa_data = json_decode($pwa_data);
        } catch (\Throwable $th) {
            $pwa_data = [];
        }
        return $pwa_data;
    }

    //PixelField
    public static function pixel_plateforms()
    {
        $plateforms = [
            '' => 'Please select',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'linkedin' => 'Linkedin',
            'pinterest' => 'Pinterest',
            'quora' => 'Quora',
            'bing' => 'Bing',
            'google-adwords' => 'Google Adwords',
            'google-analytics' => 'Google Analytics',
            'snapchat' => 'Snapchat',
            'tiktok' => 'Tiktok',
        ];

        return $plateforms;
    }

    public static function qr_code()
    {
        $qr_type = [
            0 => 'Normal',
            2 => 'Text',
            4 => 'Image',
        ];

        return $qr_type;
    }
}
