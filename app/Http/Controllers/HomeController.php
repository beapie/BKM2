<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\AddOn;
use App\Models\Appointment;
use App\Models\Plan;
use App\Models\Service;
use App\Models\User;
use App\Models\Setting;
use App\Models\Business;
use App\Models\Location;
use App\Models\Staff;
use App\Models\BusinessHours;
use App\Models\BusinessHoliday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nwidart\Modules\Facades\Module;
use App\Models\ThemeSetting;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\File;
use App\Models\CustomField;
use Carbon\Carbon;
use Modules\TrackingPixel\Entities\PixelFields;
use App\Models\AppointmentPayment;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($slug = null, $appointment = null)
    {
        if(Auth::check())
        {
            return redirect('dashboard');
        }
        else
        {            
            if(!file_exists(storage_path() . "/installed"))
            {
                header('location:install');
                die;
            }
            else
            {
                $uri = url()->full();
                if ($uri == env('APP_URL')) {
                    if(admin_setting('landing_page') == 'on')
                    {
                        if(module_is_active('LandingPage'))
                        {                        
                            return view('landingpage::layouts.landingpage');
                        }
                        else
                        {
                            return view('marketplace.landing');
                        }
                    }
                    else
                    {
                        return redirect('login');
                    }
                }
                else{
                    $segments = explode('/', str_replace('' . url('') . '', '', $uri));
                        $segments = $segments[1] ?? null;

                        if ($segments == null) {
                            $local = parse_url(config('app.url'))['host'];
                            // Get the request host
                            $remote = request()->getHost();
                            // Get the remote domain

                            // remove WWW
                            $remote = str_replace('www.', '', $remote);
                            $domain = Setting::where('key', '=', 'domains')->where('value', '=', $remote)->first();
                            if ($domain) {
                                $enable_domain = Setting::where('key', '=', 'enable_domain')->where('value', 'on')->where('business', $domain->business)->first();
                                if ($enable_domain) {
                                    $business = Business::find($enable_domain->business);
                                }
                            }
                            $sub_domain = Setting::where('key', '=', 'subdomain')->where('value', '=', $remote)->first();
                            if ($sub_domain) {
                                $enable_subdomain = Setting::where('key', '=', 'enable_subdomain')->where('value', 'on')->where('business', $sub_domain->business)->first();
                                if ($enable_subdomain) {
                                    $business = Business::find($enable_subdomain->business);
                                }
                            }

                            if (isset($business)) {
                                $slug = $business->slug;
                                $services = Service::where('business_id', $business->id)->get();
                                $locations = Location::where('business_id', $business->id)->get();
                                $staffs = Staff::where('business_id', $business->id)->get();

                                $busineshours = BusinessHours::where('created_by', $business->created_by)
                                                ->where('business_id', $business->id)
                                                ->where('day_off', 'on')
                                                ->select('day_name')
                                                ->get()
                                                ->pluck('day_name')
                                                ->map(function ($day) {
                                                    return date('w', strtotime($day));
                                                })
                                                ->toArray();

                                $businesholiday = BusinessHoliday::where('created_by', $business->created_by)
                                                ->where('business_id', $business->id)
                                                ->pluck('date')
                                                ->map(function($date) {
                                                    return Carbon::parse($date)->format('d-m-Y');
                                                    })
                                                ->toArray(); 
                                // $combinedArray = array_merge($busineshours, $businesholiday);
                                $combinedArray = $busineshours;

                                $company_settings = getCompanyAllSetting($business->created_by, $business->id);
                                $customCss = isset($company_settings['custom_css']) ? $company_settings['custom_css'] : null;
                                $customJs = isset($company_settings['custom_js']) ? $company_settings['custom_js'] : null;

                                $files = File::where('business_id', $business->id)->where('created_by', $business->created_by)->first();

                                $custom_field = company_setting('custom_field_enable', $business->created_by, $business->id);

                                $custom_fields = CustomField::where('created_by', $business->created_by)->where('business_id', $business->id)->get();
                                $workingDays = BusinessHours::where('created_by', $business->created_by)
                                                ->where('business_id', $business->id)
                                                ->get();
                                $pixelScript = [];
                                if(module_is_active('TrackingPixel', $business->created_by)){
                                    $pixels = PixelFields::where('created_by',$business->created_by)->where('business_id',$business->id)->get();
                                    foreach ($pixels as $pixel) {
                                        $pixelScript[] = pixelSourceCode($pixel['platform'], $pixel['pixel_id']);
                                    }
                                }

                                $number =  Appointment::appointmentNumberFormat($appointment, $business->id);
                                if ($appointment != 'failed' && $appointment != null && (strpos($number, '#APP') === 0)) {
                                    $appointment_number = $number;
                                } elseif ($appointment == 'failed') {
                                    $appointment_number = 'failed';
                                } else {
                                    $appointment_number = '';
                                }

                                if($business->form_type == 'form-layout')
                                {
                                    return view('form_layout.'.$business->layouts. '.index',compact('slug','business','services','locations','staffs','customCss','customJs','combinedArray','files','custom_field','custom_fields','businesholiday','pixelScript','appointment_number'));
                                }
                                else
                                {
                                    $module = $business->layouts;
                                    if(module_is_active($business->layouts,$business->created_by))
                                    {
                                        $themeSetting = ThemeSetting::where('theme', $module)->where('business_id', $business->id)->pluck('value', 'key');
                                        $testimonials = Testimonial::where('business_id', $business->id)->where('theme', $module)->get();
                                        $blogs = Blog::where('business_id', $business->id)->where('theme', $module)->get();

                                        return view(strtolower($business->layouts) . '::form_layout.index', compact('slug', 'business', 'services', 'locations', 'staffs', 'customCss', 'customJs', 'combinedArray', 'files', 'custom_field', 'custom_fields', 'module', 'themeSetting', 'workingDays', 'testimonials', 'blogs', 'businesholiday', 'appointment_number','pixelScript'));
                                    }
                                    else
                                    {
                                        return view('web_layouts.module_not_found', compact('module'));

                                    // return redirect()->back()->with('error', __('please activate this module'.$business->layouts));
                                    }
                                }

                                // return view('embeded_appointment.index',compact('slug','business','services','locations','staffs','customCss','customJs','combinedArray','files','custom_field','custom_fields'));
                            } else {
                                if(admin_setting('landing_page') == 'on')
                                {
                                    if(module_is_active('LandingPage'))
                                    {                        
                                        return view('landingpage::layouts.landingpage');
                                    }
                                    else
                                    {
                                        return view('marketplace.landing');
                                    }
                                }
                                else
                                {
                                    return redirect('login');
                                }
                            }
                        }
                }
            }
        }
    }

    public function Dashboard()
    {
        if (Auth::check()) {
            if (Auth::user()->type == 'super admin') {
                $user                       = Auth::user();
                $user['total_user']         = $user->countCompany();
                $user['total_paid_user']    = $user->countPaidCompany();
                $user['total_orders']       = Order::total_orders();
                $user['total_orders_price'] = Order::total_orders_price();
                $chartData                  = $this->getOrderChart(['duration' => 'week']);
                $user['total_plans'] = Plan::all()->count();

                $popular_plan = DB::table('orders')
                    ->select('orders.plan_id', 'plans.*', DB::raw('count(*) as count'))
                    ->join('plans', 'orders.plan_id', '=', 'plans.id')
                    ->groupBy('orders.plan_id')
                    ->orderByDesc('count')
                    ->first();

                $user['popular_plan'] = $popular_plan;

                return view('dashboard.dashboard', compact('user', 'chartData'));
            } else {
                $user = auth()->user();
                $menu = new \App\Classes\Menu($user);
                event(new \App\Events\CompanyMenuEvent($menu));
                $menu_items = $menu->menu;
                $dashboardItem = collect($menu_items)->first(function ($item) {
                    return $item['parent'] === 'dashboard';
                });

                if ($dashboardItem) {
                    $route = isset($dashboardItem['route']) ? $dashboardItem['route'] : null;
                    if ($route) {
                        return redirect()->route($route);
                    }
                }
                $total_business = getBusiness()->count();
                $total_service = Service::where('business_id', getActiveBusiness())->where('created_by', creatorId())->count();
                $total_appointment = Appointment::where('business_id', getActiveBusiness())->where('created_by', creatorId())->count();
                $total_staff = User::where('type', 'staff')->where('business_id', getActiveBusiness())->where('created_by', creatorId())->count();
                $total_location = Location::where('business_id', getActiveBusiness())->where('created_by', creatorId())->count();
                $total_appointment_payment = AppointmentPayment::where('business_id', getActiveBusiness())->where('created_by', creatorId())->sum('amount');  

                $latest_services = Service::where('business_id', getActiveBusiness())
                    ->where('created_by', creatorId())
                    ->latest()
                    ->take(5)
                    ->get();

                $latest_appointments = Appointment::where('business_id', getActiveBusiness())
                    ->where('created_by', creatorId())
                    ->latest()
                    ->take(5)
                    ->get();

                $business = Business::find(getActiveBusiness());

                $chartData = $this->getAppointmentChart(['duration' => 'week']);

                $compact = ['total_business', 'total_service', 'total_appointment', 'total_staff', 'latest_services', 'latest_appointments', 'business', 'chartData','total_location','total_appointment_payment'];
                return view('dashboard', compact($compact));
            }
        } else {

            return redirect()->route('start');
        }
    }

    public function getAppointmentChart($arrParam)
    {
        $arrDuration = [];
        if ($arrParam['duration']) {
            if ($arrParam['duration'] == 'week') {
                $previous_week = strtotime("-1 week +1 day");
                for ($i = 0; $i < 7; $i++) {
                    $arrDuration[date('Y-m-d', $previous_week)] = date('d-M', $previous_week);
                    $previous_week                              = strtotime(date('Y-m-d', $previous_week) . " +1 day");
                }
            }
        }

        // Create an array of dates from your $arrDuration array
        $dates = array_keys($arrDuration);

        $orders = Appointment::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as total')
        )
            ->where('business_id', getActiveBusiness())
            ->whereIn(DB::raw('DATE(created_at)'), $dates)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();
        // Initialize an empty $arrTask array
        $arrTask = ['label' => [], 'data' => []];

        foreach ($dates as $date) {
            $label = $arrDuration[$date];
            $total = 0;

            foreach ($orders as $item) {
                if ($item->date == $date) {
                    $total = $item->total;
                    break;
                }
            }

            $arrTask['label'][] = $label;
            $arrTask['data'][] = $total;
        }
        return $arrTask;
    }

    public function getOrderChart($arrParam)
    {
        $arrDuration = [];
        if ($arrParam['duration']) {
            if ($arrParam['duration'] == 'week') {
                $previous_week = strtotime("-2 week +1 day");
                for ($i = 0; $i < 14; $i++) {
                    $arrDuration[date('Y-m-d', $previous_week)] = date('d-M', $previous_week);
                    $previous_week                              = strtotime(date('Y-m-d', $previous_week) . " +1 day");
                }
            }
        }

        // Create an array of dates from your $arrDuration array
        $dates = array_keys($arrDuration);

        $orders = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as total')
        )
            ->whereIn(DB::raw('DATE(created_at)'), $dates)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();
        // Initialize an empty $arrTask array
        $arrTask = ['label' => [], 'data' => []];

        foreach ($dates as $date) {
            $label = $arrDuration[$date];
            $total = 0;

            foreach ($orders as $item) {
                if ($item->date == $date) {
                    $total = $item->total;
                    break;
                }
            }

            $arrTask['label'][] = $label;
            $arrTask['data'][] = $total;
        }
        return $arrTask;
    }

    public function SoftwareDetails($slug)
    {
        $modules_all = Module::getByStatus(1);
        $modules = [];
        if (count($modules_all) > 0) {
            $modules = array_intersect_key(
                $modules_all,  // the array with all keys
                array_flip(array_rand($modules_all, (count($modules_all) <  6) ? count($modules_all) : 6)) // keys to be extracted
            );
        }
        $plan = Plan::first();
        $addon = AddOn::where('name', $slug)->first();
        if (!empty($addon) && !empty($addon->module)) {
            $module = Module::find($addon->module);
            if (!empty($module)) {
                try {   
                    if (module_is_active('LandingPage')) {
                        return view('landingpage::marketplace.index', compact('modules', 'module', 'plan'));
                    } else {                        
                        return view($module->getLowerName() . '::marketplace.index', compact('modules', 'module', 'plan'));
                    }
                } catch (\Throwable $th) {
                }
            }
        }

        if (module_is_active('LandingPage')) {
            $layout = 'landingpage::layouts.marketplace';
        } else {
            $layout = 'marketplace.marketplace';
        }

        return view('marketplace.detail_not_found', compact('modules', 'layout'));
    }
    public function Software(Request $request)
    {
        $query = $request->query('query');
        $modules = Module::getByStatus(1);

        if ($query) {
            $modules = array_filter($modules, function ($module) use ($query) {
                // You may need to adjust this condition based on your requirements
                return stripos($module->getName(), $query) !== false;
            });
        }
        // Rest of your code
        if (module_is_active('LandingPage')) {
            $layout = 'landingpage::layouts.marketplace';
        } else {
            $layout = 'marketplace.marketplace';
        }

        return view('marketplace.software', compact('modules', 'layout'));
    }
    public function Pricing()
    {
        if (Auth::check()) {
            if (Auth::user()->type == 'company') {
                return redirect('plans');
            } else {
                return redirect('dashboard');
            }
        } else {
            $plan = Plan::first();
            $modules = Module::getByStatus(1);

            if (module_is_active('LandingPage')) {
                $layout = 'landingpage::layouts.marketplace';
                return view('landingpage::layouts.pricing', compact('modules', 'plan', 'layout'));
            } else {
                $layout = 'marketplace.marketplace';
            }

            return view('marketplace.pricing', compact('modules', 'plan', 'layout'));
        }
    }
}
