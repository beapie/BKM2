<?php

namespace Modules\CarService\Entities;

use App\Models\Business;
use App\Models\ThemeSetting;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarServiceUtility extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\CarService\Database\factories\CarServiceUtilityFactory::new();
    }

    public static function defaultdata($company_id = null, $business_id = null)
    {
        $theme_setting = [
            'logo_status',
            'menu_status',
            'working-hours_status',
            'about_status',
            'service_status',
            'info_status',
            'staff_status',
            'testimonial_status',
            'portfolio-title_status',
            'blog_status',
            'contact_info_status',
            'map_area_status',
            'footer_top_status',
            'footer_bottom_status',
        ];

        if (!empty($company_id && $business_id)) {
            $company = User::where('type', 'company')->where('id', $company_id)->first();
            $business = Business::where('created_by', $company->id)->where('id', $business_id)->first();

            foreach ($theme_setting as $key => $value) {
                $themeSetting = ThemeSetting::where('key', $value)->where('business_id', $business->id)->where('created_by', $company->id)->where('theme', 'CarService')->first();
                if ($themeSetting == null) {
                    ThemeSetting::create([
                        'key' => $value,
                        'value' => 1,
                        'theme' => 'CarService',
                        'business_id' => !empty($business->id) ? $business->id : 0,
                        'created_by' => !empty($company->id) ? $company->id : 2,
                    ]);
                }
            }
        }
    }
}
