@extends('web_layouts.app')

@section('content')
    <!-- header-style-one start here -->
    <header class="site-header header-style-one">
        <div class="main-navigationbar sticky-header" id="header-sticky">
            <div class="container">
                <div class="navigationbar-row flex align-center justify-between">
                    @if (isset($themeSetting['logo_status']) && $themeSetting['logo_status'] == '1')
                        <div class="logo-col">
                            <h1>
                                <a href="#!" tabindex="0">
                                    <img src="{{ isset($themeSetting['logo_image']) ? get_file($themeSetting['logo_image']) : asset('Modules/CarService/Resources/assets/images/logo.png') }}"
                                        alt="logo" loading="lazy">
                                </a>
                            </h1>
                        </div>
                    @endif
                    @if (isset($themeSetting['menu_status']) && $themeSetting['menu_status'] == '1')
                        <div class="menu-item-left">
                            <nav class="menu-items-col">
                                <ul class="main-nav flex align-center">
                                    <li class="menu-lnk has-item">
                                        <a href="#home" class="click-btn" tabindex="0">
                                            {{ isset($themeSetting['menu_title_1']) ? $themeSetting['menu_title_1'] : __('Home') }}
                                        </a>
                                    </li>
                                    <li class="menu-lnk has-item">
                                        <a href="#about" class="click-btn" tabindex="0">
                                            {{ isset($themeSetting['menu_title_2']) ? $themeSetting['menu_title_2'] : __('about us') }}
                                        </a>
                                    </li>
                                    <li class="menu-lnk has-item">
                                        <a href="#services" class="click-btn" tabindex="0">
                                            {{ isset($themeSetting['menu_title_3']) ? $themeSetting['menu_title_3'] : __('our services') }}
                                        </a>
                                    </li>
                                    <li class="menu-lnk has-item">
                                        <a href="#team" tabindex="0">
                                            {{ isset($themeSetting['menu_title_4']) ? $themeSetting['menu_title_4'] : __('our team') }}
                                        </a>
                                    </li>
                                    <li class="menu-lnk">
                                        <a href="#portfolio" tabindex="0">
                                            {{ isset($themeSetting['menu_title_5']) ? $themeSetting['menu_title_5'] : __('portfolio') }}
                                        </a>
                                    </li>
                                    <li class="menu-lnk">
                                        <a href="#blog" tabindex="0">
                                            {{ isset($themeSetting['menu_title_6']) ? $themeSetting['menu_title_6'] : __('blog') }}
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="menu-item-right">
                            <ul class="flex align-center">
                                <li class="contact-btn">
                                    <a href="#Contact" class="btn" tabindex="0"> <svg class="contat-svg"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            enable-background="new 0 0 50 50" height="50px" id="Layer_1" version="1.1"
                                            viewBox="0 0 50 50" width="50px" xml:space="preserve">
                                            <rect fill="none" height="50" width="50"></rect>
                                            <path
                                                d="M30.217,35.252c0,0,4.049-2.318,5.109-2.875  c1.057-0.559,2.152-0.7,2.817-0.294c1.007,0.616,9.463,6.241,10.175,6.739c0.712,0.499,1.055,1.924,0.076,3.32  c-0.975,1.396-5.473,6.916-7.379,6.857c-1.909-0.062-9.846-0.236-24.813-15.207C1.238,18.826,1.061,10.887,1,8.978  C0.939,7.07,6.459,2.571,7.855,1.595c1.398-0.975,2.825-0.608,3.321,0.078c0.564,0.781,6.124,9.21,6.736,10.176  c0.419,0.66,0.265,1.761-0.294,2.819c-0.556,1.06-2.874,5.109-2.874,5.109s1.634,2.787,7.16,8.312  C27.431,33.615,30.217,35.252,30.217,35.252z"
                                                fill="none" stroke="#fffff" stroke-miterlimit="10" stroke-width="2">
                                            </path>
                                        </svg>
                                        {{ isset($banner->menu_title_7) ? $banner->menu_title_7 : __('Contact Us') }}

                                    </a>
                                </li>
                                <li class="mobile-menu">
                                    <div class="mobile-menu-button btn" onclick="myFunction(this)">
                                        <div class="one"></div>
                                        <div class="two"></div>
                                        <div class="three"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <main class="wrapper">
        <!-- home-banner-sec -->
        @if (isset($themeSetting['banner_status']) && $themeSetting['banner_status'] == '1')
            <section class="home-banner-sec  pb" id="home">
                <img src="{{ asset('Modules/CarService/Resources/assets/images/banner-left.png') }}" alt="design-1"
                    class="bnr-img home-bnr-left" loading="lazy">
                <img src="{{ asset('Modules/CarService/Resources/assets/images/banner-right.png') }}" alt="design-2"
                    class="bnr-img home-bnr-right" loading="lazy">
                <img src="{{ asset('Modules/CarService/Resources/assets/images/banner-img1.png') }}" alt="car-tools"
                    class="bnr-img banner-img1" loading="lazy">
                <img src="{{ asset('Modules/CarService/Resources/assets/images/banner-img2.png') }}" alt="car-tools"
                    class="bnr-img banner-img2" loading="lazy">
                <img src="{{ asset('Modules/CarService/Resources/assets/images/banner-img3.png') }}" alt="car-tools"
                    class="bnr-img banner-img3" loading="lazy">
                <img src="{{ asset('Modules/CarService/Resources/assets/images/banner-img4.png') }}" alt="car-tools"
                    class="bnr-img banner-img4" loading="lazy">
                <div class="swiper home-banner-slider">
                    <div class="swiper-wrapper">
                        @if (count(json_decode($themeSetting['banner_repeater'])) > 0)
                            @foreach (json_decode($themeSetting['banner_repeater']) as $banner)
                                <div class="swiper-slide">
                                    <div class="row align-center justify-center">
                                        <div class="col-md-10 col-12">
                                            <div class="banner-content">
                                                <div class="banner-content-inner">
                                                    <div class="section-title">
                                                        <h2>
                                                            {{ isset($banner->big_text) ? $banner->big_text : __('Auto Maintenance & Repair Service') }}
                                                        </h2>
                                                    </div>
                                                    <p>
                                                        {{ isset($banner->content) ? $banner->content : __('Our car services provide expert care for your vehicle, ensuring optimal performance and reliability on the road.') }}
                                                    </p>
                                                    <a href="#appointment" class="btn" tabindex="0">
                                                        {{ isset($banner->button_text) ? $banner->button_text : __('Get Service') }}
                                                    </a>
                                                </div>
                                                <div class="product-item-img">
                                                    <img src="{{ isset($banner->image) ? get_file($banner->image) : asset('Modules/CarService/Resources/assets/images/home-main.png') }}"
                                                        alt="Product-image" loading="lazy">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="arrow-button">
                            <div class="arrow-wrapper flex align-center">
                                <div class="home-arrow swiper-button-prev"> <svg xmlns="http://www.w3.org/2000/svg"
                                        width="38" height="31" viewBox="0 0 38 31" fill="none">
                                        <path
                                            d="M15.5217 30.84C14.9082 30.8313 14.3231 30.5805 13.8936 30.1423L0.730153 17.002C-0.181775 16.0975 -0.187825 14.625 0.716674 13.713C0.721116 13.7084 0.725635 13.7039 0.730153 13.6995L13.8937 0.559286C14.8693 -0.276207 16.3375 -0.162628 17.173 0.813021C17.9186 1.68375 17.9186 2.96789 17.173 3.83854L5.66071 15.3508L17.2892 26.8631C18.191 27.7702 18.191 29.2352 17.2892 30.1423C16.8262 30.6159 16.1834 30.8697 15.5217 30.84Z"
                                            fill="#D9D9D9" />
                                        <path
                                            d="M34.9878 17.6764L2.42791 17.6764C1.14346 17.6764 0.102172 16.6351 0.102172 15.3506C0.102173 14.0662 1.14346 13.0249 2.42791 13.0249L34.9878 13.0249C36.2723 13.0249 37.3135 14.0662 37.3135 15.3506C37.3135 16.6351 36.2723 17.6764 34.9878 17.6764Z"
                                            fill="#D9D9D9" />
                                    </svg></div>
                                <div class="home-arrow swiper-button-next"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="38" height="31" viewBox="0 0 38 31" fill="none">
                                        <path
                                            d="M15.5217 30.84C14.9082 30.8313 14.3231 30.5805 13.8936 30.1423L0.730153 17.002C-0.181775 16.0975 -0.187825 14.625 0.716674 13.713C0.721116 13.7084 0.725635 13.7039 0.730153 13.6995L13.8937 0.559286C14.8693 -0.276207 16.3375 -0.162628 17.173 0.813021C17.9186 1.68375 17.9186 2.96789 17.173 3.83854L5.66071 15.3508L17.2892 26.8631C18.191 27.7702 18.191 29.2352 17.2892 30.1423C16.8262 30.6159 16.1834 30.8697 15.5217 30.84Z"
                                            fill="#D9D9D9" />
                                        <path
                                            d="M34.9878 17.6764L2.42791 17.6764C1.14346 17.6764 0.102172 16.6351 0.102172 15.3506C0.102173 14.0662 1.14346 13.0249 2.42791 13.0249L34.9878 13.0249C36.2723 13.0249 37.3135 14.0662 37.3135 15.3506C37.3135 16.6351 36.2723 17.6764 34.9878 17.6764Z"
                                            fill="#D9D9D9" />
                                    </svg></div>
                            </div>
                        </div>
                    </div>
            </section>
        @endif

        <!-- car-about-sec -->
        @if (isset($themeSetting['about_status']) && $themeSetting['about_status'] == '1')
            <section class="car-about-sec pt pb" id="about">
                <div class="container">
                    <img src="{{ asset('Modules/CarService/Resources/assets/images/design-1.png') }}" alt="design-1"
                        class="design-1" loading="lazy">
                    <img src="{{ asset('Modules/CarService/Resources/assets/images/design-2.png') }}" alt="design-2"
                        class="design-2" loading="lazy">
                    <div class="row align-center">
                        <div class="col-md-7 col-12">
                            <div class="car-about-left-wrp">
                                <div class="section-title">
                                    <a href="#" class="subtitle" tabindex="0">
                                        {{ isset($themeSetting['about_title']) ? $themeSetting['about_title'] : __('About US') }}
                                    </a>
                                    <h2>
                                        {{ isset($themeSetting['about_sub_title']) ? $themeSetting['about_sub_title'] : __('WE ARE THE BEST CAR DETAILING SERVICE') }}
                                    </h2>
                                    <p>
                                        {{ isset($themeSetting['about_content']) ? $themeSetting['about_content'] : __('Behind the Wheel of Excellence: Discover the Heart and Heritage of Our Detailing Craftsmanship, Where Passion Fuels Precision, and Every Vehicle Telis a Tale of Meticulous Care and Unmatched Dedication.') }}
                                    </p>
                                </div>
                                <ul class="photo-about-dtl">
                                    <li>
                                        {{ isset($themeSetting['about_label_1']) ? $themeSetting['about_label_1'] : __('Passionate Heritage') }}
                                    </li>
                                    <li>
                                        {{ isset($themeSetting['about_label_2']) ? $themeSetting['about_label_2'] : __('Craftsmanship Ethos') }}
                                    </li>
                                    <li>
                                        {{ isset($themeSetting['about_label_3']) ? $themeSetting['about_label_3'] : __('lient-Centric Approach') }}
                                    </li>
                                    <li>
                                        {{ isset($themeSetting['about_label_4']) ? $themeSetting['about_label_4'] : __('Innovation and Excellence') }}
                                    </li>
                                </ul>
                                <a href="#appointment" class="btn" tabindex="0">
                                    {{ isset($banner->button_text) ? $banner->button_text : __('Get Service') }}
                                </a>
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="car-about-right-wrp">
                                <img src="{{ isset($banner->about_image) ? get_file($banner->about_image) : asset('Modules/CarService/Resources/assets/images/about-photo.png') }}"
                                    alt="about-photo" class="about-photo" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- photo-service-category-sec -->
        @if (isset($themeSetting['service_status']) && $themeSetting['service_status'] == '1')
            <section class="service-category-sec pt pb" id="services">
                <div class="container">
                    <div class="section-title text-center">
                        <a href="#" class="subtitle" tabindex="0">
                            {{ isset($themeSetting['service_sub_title']) ? $themeSetting['service_sub_title'] : __('Our Services') }}
                        </a>
                        <h2>
                            {{ isset($themeSetting['service_title']) ? $themeSetting['service_title'] : __('WE PROVIDE PROFESSIONAL SERVICES') }}
                        </h2>
                        <p>
                            {{ isset($themeSetting['service_content']) ? $themeSetting['service_content'] : __('We offer professional services tailored to your specific needs, ensuring top-notch quality and reliability in every aspect of our work.') }}
                        </p>
                    </div>
                    <div class="row">
                        @if (count($services) > 0)
                            @foreach ($services as $service)
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="service-category">
                                        <div class="service-category-content">
                                            <div class="service-category-top">
                                                <img src="{{ check_file($service->image) ? get_file($service->image) : get_file('Modules/CarService/Resources/assets/images/service-1.png') }}"
                                                    alt="services" loading="lazy">
                                                <h3>{{ $service->name }}</h3>
                                                <p>{{ $service->description }}</p>
                                            </div>
                                            <div class="service-category-bottom">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                    viewBox="0 0 19 19" fill="none">
                                                    <circle cx="9.5" cy="9.5" r="9.5" fill="#D16527" />
                                                    <path
                                                        d="M12.0337 9.94806L8.14866 13.8318C7.97819 14.0019 7.70199 14.0019 7.53109 13.8318C7.36061 13.6618 7.36061 13.3856 7.53109 13.2156L11.108 9.63994L7.53152 6.06432C7.36104 5.89427 7.36104 5.61808 7.53152 5.4476C7.70199 5.27756 7.97862 5.27756 8.14909 5.4476L12.0342 9.33135C12.202 9.49963 12.202 9.78017 12.0337 9.94806Z"
                                                        fill="white" />
                                                </svg>
                                                {{ __('Details Service') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </section>
        @endif

        <!-- team-sec -->
        @if (isset($themeSetting['staff_status']) && $themeSetting['staff_status'] == '1')
            <section class="car-service-sec  pt pb" id="team">
                <div class="container">
                    <div class="section-title text-center">
                        <a href="#" class="subtitle" tabindex="0">
                            {{ isset($themeSetting['staff_title']) ? $themeSetting['staff_title'] : __('OUR TEAM') }}
                        </a>
                        <h2>
                            {{ isset($themeSetting['staff_sub_title']) ? $themeSetting['staff_sub_title'] : __('WE ARE SERVICES PROVIDED') }}
                        </h2>

                        <p>
                            {{ isset($themeSetting['staff_content']) ? $themeSetting['staff_content'] : __('Choose From Our Range Of Photobooth Options, Including Open-Air And Enclosed Booths, To Suit Your Wedding Theme And Style.') }}
                        </p>
                    </div>

                    <div class="swiper service-slider">
                        @if (count($staffs) > 0)
                            <div class="swiper-wrapper">
                                @foreach ($staffs as $staff)
                                    <div class="swiper-slide">
                                        <div class="service-card">
                                            <div class="service-card-image">
                                                <a href="#" class="img-wrapper" tabindex="0">
                                                    <img src="{{ check_file($staff->user->avatar) ? get_file($staff->user->avatar) : get_file('uploads/default/avatar.png') }}"
                                                        alt="service-image" loading="lazy">
                                                </a>
                                                <div class="service-card-content">
                                                    <h3>{{ $staff->user->name }}</h3>
                                                    {{-- <span>Technician</span> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        <!-- portfolio-sec -->
        @if (isset($themeSetting['portfolio-title_status']) && $themeSetting['portfolio-title_status'] == '1')
            <section class="portfolio-sec pt pb" id="portfolio">
                <div class="container">
                    <div class="section-title text-center">
                        <a href="#" class="subtitle" tabindex="0">
                            {{ isset($themeSetting['portfolio-title_title']) ? $themeSetting['portfolio-title_title'] : __('Portfolio') }}
                        </a>
                        <h2>
                            {{ isset($themeSetting['portfolio-title_sub_title']) ? $themeSetting['portfolio-title_sub_title'] : __('Explore Our Car Detailing Portfolio') }}
                        </h2>
                        <p>
                            {{ isset($themeSetting['portfolio-title_content']) ? $themeSetting['portfolio-title_content'] : __('We\'re your trusted partner in keeping your car in top shape. From maintenance to repairs, we\'ve got you covered with expert care and personalized service.') }}
                        </p>
                    </div>
                    @if (isset($themeSetting['portfolio_status']) && $themeSetting['portfolio_status'] == '1')
                        <div class="swiper portfolio-slider">
                            <div class="swiper-wrapper">
                                @if (count(json_decode($themeSetting['portfolio_repeater'])) > 0)
                                    @foreach (json_decode($themeSetting['portfolio_repeater']) as $portfolio_repeater)
                                        <div class="swiper-slide">
                                            <div class="portfolio-card">
                                                <div class="portfolio-img">
                                                    <img src="{{ isset($portfolio_repeater->image) ? get_file($portfolio_repeater->image) : asset('Modules/Photography/Resources/assets/images/portfolio-1.png') }}"
                                                        alt="client-logo-image" loading="lazy">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="arrow-button">
                                <div class="arrow-wrapper flex align-center">
                                    <div class="portfolio-arrow swiper-button-prev"> <svg
                                            xmlns="http://www.w3.org/2000/svg" width="38" height="31"
                                            viewBox="0 0 38 31" fill="none">
                                            <path
                                                d="M15.5217 30.84C14.9082 30.8313 14.3231 30.5805 13.8936 30.1423L0.730153 17.002C-0.181775 16.0975 -0.187825 14.625 0.716674 13.713C0.721116 13.7084 0.725635 13.7039 0.730153 13.6995L13.8937 0.559286C14.8693 -0.276207 16.3375 -0.162628 17.173 0.813021C17.9186 1.68375 17.9186 2.96789 17.173 3.83854L5.66071 15.3508L17.2892 26.8631C18.191 27.7702 18.191 29.2352 17.2892 30.1423C16.8262 30.6159 16.1834 30.8697 15.5217 30.84Z"
                                                fill="#D9D9D9" />
                                            <path
                                                d="M34.9878 17.6764L2.42791 17.6764C1.14346 17.6764 0.102172 16.6351 0.102172 15.3506C0.102173 14.0662 1.14346 13.0249 2.42791 13.0249L34.9878 13.0249C36.2723 13.0249 37.3135 14.0662 37.3135 15.3506C37.3135 16.6351 36.2723 17.6764 34.9878 17.6764Z"
                                                fill="#D9D9D9" />
                                        </svg>
                                    </div>
                                    <div class="portfolio-arrow swiper-button-next"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="38" height="31"
                                            viewBox="0 0 38 31" fill="none">
                                            <path
                                                d="M15.5217 30.84C14.9082 30.8313 14.3231 30.5805 13.8936 30.1423L0.730153 17.002C-0.181775 16.0975 -0.187825 14.625 0.716674 13.713C0.721116 13.7084 0.725635 13.7039 0.730153 13.6995L13.8937 0.559286C14.8693 -0.276207 16.3375 -0.162628 17.173 0.813021C17.9186 1.68375 17.9186 2.96789 17.173 3.83854L5.66071 15.3508L17.2892 26.8631C18.191 27.7702 18.191 29.2352 17.2892 30.1423C16.8262 30.6159 16.1834 30.8697 15.5217 30.84Z"
                                                fill="#D9D9D9" />
                                            <path
                                                d="M34.9878 17.6764L2.42791 17.6764C1.14346 17.6764 0.102172 16.6351 0.102172 15.3506C0.102173 14.0662 1.14346 13.0249 2.42791 13.0249L34.9878 13.0249C36.2723 13.0249 37.3135 14.0662 37.3135 15.3506C37.3135 16.6351 36.2723 17.6764 34.9878 17.6764Z"
                                                fill="#D9D9D9" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @endif

        <!-- Extra sec -->
        @if (isset($themeSetting['info_status']) && $themeSetting['info_status'] == '1')
            <section class="contact-sec pt pb">
                <div class="container">
                    <img src="{{ isset($themeSetting['info_image']) ? get_file($themeSetting['info_image']) : asset('Modules/CarService/Resources/assets/images/appointment-left.png') }}"
                        alt="design-1" class="contact-left" loading="lazy">
                    <div class="row flex justify-center">
                        <div class="col-lg-6 ">
                            <div class="contact-content text-center">
                                <h2>{{ isset($themeSetting['info_title']) ? $themeSetting['info_title'] : 'WANT TO TALK?' }}
                                </h2>
                                <a href="tel:(123) 556 4321" class="appoint-contact" target="_blank" tabindex="0">
                                    {{ isset($themeSetting['info_sub_title']) ? $themeSetting['info_sub_title'] : 'Call :(123) 556 4321' }}</a>
                                <p>
                                    {{ isset($themeSetting['info_content']) ? $themeSetting['info_content'] : ' Need a special repair service? we are happy to fulfil every request in order to exceed your expectations.' }}</a>
                                </p>
                                <a href="#appointment" class="btn" tabindex="0">
                                    {{ isset($themeSetting['info_button_text']) ? $themeSetting['info_button_text'] : 'Book An Appointment' }}</a></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if (isset($themeSetting['working-hours_status']) && $themeSetting['working-hours_status'] == '1')
            <section class="car-banner-sec pt pb"
                style="background-image: url({{ isset($themeSetting['working-hours_image']) ? get_file($themeSetting['working-hours_image']) : asset('Modules/Barber/Resources/assets/images/working-hrs-bg.png') }});">
                <div class="container">
                    <div class="working-hrs-wrp">
                        <div class="section-title">
                            <h3 class="h5">
                                {{ isset($themeSetting['working-hours_working_title']) ? $themeSetting['working-hours_working_title'] : __('ENABLE WORKING HOURS') }}
                            </h3>
                        </div>
                        <ul class="flex justify-around">
                            @foreach ($workingDays as $workingDay)
                                <li>
                                    <span>{{ ucfirst($workingDay->day_name) }}</span>
                                    <p class="{{ $workingDay->day_off == 'on' ? 'close' : '' }}  ">
                                        {{ $workingDay->day_off == 'on' ? 'Close' : date('H:i',strtotime($workingDay->start_time)) . ' to ' . date('H:i',strtotime($workingDay->end_time)) }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        @endif

        <!-- appointment-sec -->
        <section class="appointment-sec pt pb" id="appointment">
            @include('web_layouts.appointment-form')
        </section>

        <!-- article-sec -->
        @if (isset($themeSetting['blog_status']) && $themeSetting['blog_status'] == '1')
            <section class="article-sec pt pb" id="blog">
                <div class="container">
                    <div class="section-title text-center">
                        <a href="#" class="subtitle" tabindex="0">
                            {{ isset($themeSetting['blog_title']) ? $themeSetting['blog_title'] : __('Blogs') }}
                        </a>
                        <h2>
                            {{ isset($themeSetting['blog_sub_title']) ? $themeSetting['blog_sub_title'] : __('OUR LATEST NEWS') }}
                        </h2>
                        <p>
                            {{ isset($themeSetting['blog_content']) ? $themeSetting['blog_content'] : __('Welcome to our Latest News column, where we keep you updated on the latest happenings and developments.') }}
                        </p>
                    </div>
                    <div class="article-slider-wrp">
                        <div class="swiper article-slider">
                            <div class="swiper-wrapper">
                                @if (count($blogs) > 0)
                                    @foreach ($blogs as $blog)
                                        <div class="swiper-slide">
                                            <div class="article-card">
                                                <div class="article-card-inner flex align-center">
                                                    <div class="article-img-box-inner">
                                                        <div class="article-card-image">
                                                            <a href="#!" tabindex="0" class="article-image">
                                                                <img src="{{ isset($blog->image) ? get_file($blog->image) : asset('Modules/CarService/Resources/assets/images/blog-img-1.png') }}"
                                                                    alt="article-card-image" loading="lazy">
                                                            </a>
                                                            <div class="article-content">
                                                                <div class="article-content-top">
                                                                    <div class="article-date">
                                                                        <p>{{ __('Post by Thomas deo ') . \Carbon\Carbon::parse($blog->date)->format('F j, Y') }}
                                                                        </p>
                                                                    </div>
                                                                    <h3>
                                                                        <a href="#" tabindex="0">
                                                                            {{ $blog->title }}
                                                                        </a>
                                                                    </h3>
                                                                    <p class="comment">{{ $blog->description }}</p>
                                                                </div>
                                                                {{-- <div class="article-content-bottom"><a href="#" class="article-btn" tabindex="0">{{ __('Read More') }}</a></div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="arrow-button">
                                <div class="arrow-wrapper flex align-center">
                                    <div class="article-arrow swiper-button-prev"> <svg xmlns="http://www.w3.org/2000/svg"
                                            width="38" height="31" viewBox="0 0 38 31" fill="none">
                                            <path
                                                d="M15.5217 30.84C14.9082 30.8313 14.3231 30.5805 13.8936 30.1423L0.730153 17.002C-0.181775 16.0975 -0.187825 14.625 0.716674 13.713C0.721116 13.7084 0.725635 13.7039 0.730153 13.6995L13.8937 0.559286C14.8693 -0.276207 16.3375 -0.162628 17.173 0.813021C17.9186 1.68375 17.9186 2.96789 17.173 3.83854L5.66071 15.3508L17.2892 26.8631C18.191 27.7702 18.191 29.2352 17.2892 30.1423C16.8262 30.6159 16.1834 30.8697 15.5217 30.84Z"
                                                fill="#D9D9D9" />
                                            <path
                                                d="M34.9878 17.6764L2.42791 17.6764C1.14346 17.6764 0.102172 16.6351 0.102172 15.3506C0.102173 14.0662 1.14346 13.0249 2.42791 13.0249L34.9878 13.0249C36.2723 13.0249 37.3135 14.0662 37.3135 15.3506C37.3135 16.6351 36.2723 17.6764 34.9878 17.6764Z"
                                                fill="#D9D9D9" />
                                        </svg></div>
                                    <div class="article-arrow swiper-button-next"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="38" height="31" viewBox="0 0 38 31" fill="none">
                                            <path
                                                d="M15.5217 30.84C14.9082 30.8313 14.3231 30.5805 13.8936 30.1423L0.730153 17.002C-0.181775 16.0975 -0.187825 14.625 0.716674 13.713C0.721116 13.7084 0.725635 13.7039 0.730153 13.6995L13.8937 0.559286C14.8693 -0.276207 16.3375 -0.162628 17.173 0.813021C17.9186 1.68375 17.9186 2.96789 17.173 3.83854L5.66071 15.3508L17.2892 26.8631C18.191 27.7702 18.191 29.2352 17.2892 30.1423C16.8262 30.6159 16.1834 30.8697 15.5217 30.84Z"
                                                fill="#D9D9D9" />
                                            <path
                                                d="M34.9878 17.6764L2.42791 17.6764C1.14346 17.6764 0.102172 16.6351 0.102172 15.3506C0.102173 14.0662 1.14346 13.0249 2.42791 13.0249L34.9878 13.0249C36.2723 13.0249 37.3135 14.0662 37.3135 15.3506C37.3135 16.6351 36.2723 17.6764 34.9878 17.6764Z"
                                                fill="#D9D9D9" />
                                        </svg></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- testimonial-sec -->
        @if (isset($themeSetting['testimonial_status']) && $themeSetting['testimonial_status'] == '1')
            <section class="testimonial-sec">
                <div class="container">
                    <div class="testimonial-title">
                        <h2>
                            {{ isset($themeSetting['testimonial_title']) ? $themeSetting['testimonial_title'] : __('Testimonial') }}
                        </h2>
                    </div>
                    <div class="swiper testimonial-slider">
                        <div class="swiper-wrapper">
                            @if (count($testimonials) > 0)
                                @foreach ($testimonials as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="testimonial-card">
                                            <div class="testimonial-card-content">
                                                <div class="testi-img">
                                                    <img src="{{ check_file($testimonial->image) ? get_file($testimonial->image) : asset('Modules/CarService/Resources/assets/images/testi-img.png') }}"
                                                        alt="testi-img" loading="lazy">
                                                </div>
                                                <div class="testi-content">
                                                    <div class="star-img">
                                                        <img src="{{ asset('Modules/CarService/Resources/assets/images/test-quot.png') }}"
                                                            alt="testi-review" loading="lazy">
                                                    </div>
                                                    <h3>{{ $testimonial->customer->name }}</h3>
                                                    <p>{{ $testimonial->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="arrow-button">
                            <div class="arrow-wrapper flex align-center">
                                <div class=" swiper-button-prev"> <svg xmlns="http://www.w3.org/2000/svg" width="38"
                                        height="31" viewBox="0 0 38 31" fill="none">
                                        <path
                                            d="M15.5217 30.84C14.9082 30.8313 14.3231 30.5805 13.8936 30.1423L0.730153 17.002C-0.181775 16.0975 -0.187825 14.625 0.716674 13.713C0.721116 13.7084 0.725635 13.7039 0.730153 13.6995L13.8937 0.559286C14.8693 -0.276207 16.3375 -0.162628 17.173 0.813021C17.9186 1.68375 17.9186 2.96789 17.173 3.83854L5.66071 15.3508L17.2892 26.8631C18.191 27.7702 18.191 29.2352 17.2892 30.1423C16.8262 30.6159 16.1834 30.8697 15.5217 30.84Z"
                                            fill="#D9D9D9" />
                                        <path
                                            d="M34.9878 17.6764L2.42791 17.6764C1.14346 17.6764 0.102172 16.6351 0.102172 15.3506C0.102173 14.0662 1.14346 13.0249 2.42791 13.0249L34.9878 13.0249C36.2723 13.0249 37.3135 14.0662 37.3135 15.3506C37.3135 16.6351 36.2723 17.6764 34.9878 17.6764Z"
                                            fill="#D9D9D9" />
                                    </svg></div>
                                <div class=" swiper-button-next"><svg xmlns="http://www.w3.org/2000/svg" width="38"
                                        height="31" viewBox="0 0 38 31" fill="none">
                                        <path
                                            d="M15.5217 30.84C14.9082 30.8313 14.3231 30.5805 13.8936 30.1423L0.730153 17.002C-0.181775 16.0975 -0.187825 14.625 0.716674 13.713C0.721116 13.7084 0.725635 13.7039 0.730153 13.6995L13.8937 0.559286C14.8693 -0.276207 16.3375 -0.162628 17.173 0.813021C17.9186 1.68375 17.9186 2.96789 17.173 3.83854L5.66071 15.3508L17.2892 26.8631C18.191 27.7702 18.191 29.2352 17.2892 30.1423C16.8262 30.6159 16.1834 30.8697 15.5217 30.84Z"
                                            fill="#D9D9D9" />
                                        <path
                                            d="M34.9878 17.6764L2.42791 17.6764C1.14346 17.6764 0.102172 16.6351 0.102172 15.3506C0.102173 14.0662 1.14346 13.0249 2.42791 13.0249L34.9878 13.0249C36.2723 13.0249 37.3135 14.0662 37.3135 15.3506C37.3135 16.6351 36.2723 17.6764 34.9878 17.6764Z"
                                            fill="#D9D9D9" />
                                    </svg></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif


        <!-- client-logo-sec -->
        @if (isset($themeSetting['brand_carousel_status']) && $themeSetting['brand_carousel_status'] == '1')
            <section class="client-logo-sec pt pb">
                <div class="container">
                    <div class="client-logo-slider swiper">
                        <div class="swiper-wrapper">
                            @if (count(json_decode($themeSetting['brand_carousel_repeater'])) > 0)
                                @foreach (json_decode($themeSetting['brand_carousel_repeater']) as $brand_carousel_repeater)
                                    <div class="swiper-slide client-logo-card">
                                        <a href="#" tabindex="0">
                                            <img src="{{ isset($brand_carousel_repeater->image) ? get_file($brand_carousel_repeater->image) : asset('Modules/CarService/Resources/assets/images/client-logo-1.png') }} "
                                                alt="client-logo-image" loading="lazy">
                                        </a>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <div class="arrow-button">
                            <div class="arrow-wrapper flex align-center">
                                <div class="logo-arrow swiper-button-prev"> <svg xmlns="http://www.w3.org/2000/svg"
                                        width="38" height="31" viewBox="0 0 38 31" fill="none">
                                        <path
                                            d="M15.5217 30.84C14.9082 30.8313 14.3231 30.5805 13.8936 30.1423L0.730153 17.002C-0.181775 16.0975 -0.187825 14.625 0.716674 13.713C0.721116 13.7084 0.725635 13.7039 0.730153 13.6995L13.8937 0.559286C14.8693 -0.276207 16.3375 -0.162628 17.173 0.813021C17.9186 1.68375 17.9186 2.96789 17.173 3.83854L5.66071 15.3508L17.2892 26.8631C18.191 27.7702 18.191 29.2352 17.2892 30.1423C16.8262 30.6159 16.1834 30.8697 15.5217 30.84Z"
                                            fill="#D9D9D9" />
                                        <path
                                            d="M34.9878 17.6764L2.42791 17.6764C1.14346 17.6764 0.102172 16.6351 0.102172 15.3506C0.102173 14.0662 1.14346 13.0249 2.42791 13.0249L34.9878 13.0249C36.2723 13.0249 37.3135 14.0662 37.3135 15.3506C37.3135 16.6351 36.2723 17.6764 34.9878 17.6764Z"
                                            fill="#D9D9D9" />
                                    </svg></div>
                                <div class="logo-arrow swiper-button-next"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="38" height="31" viewBox="0 0 38 31" fill="none">
                                        <path
                                            d="M15.5217 30.84C14.9082 30.8313 14.3231 30.5805 13.8936 30.1423L0.730153 17.002C-0.181775 16.0975 -0.187825 14.625 0.716674 13.713C0.721116 13.7084 0.725635 13.7039 0.730153 13.6995L13.8937 0.559286C14.8693 -0.276207 16.3375 -0.162628 17.173 0.813021C17.9186 1.68375 17.9186 2.96789 17.173 3.83854L5.66071 15.3508L17.2892 26.8631C18.191 27.7702 18.191 29.2352 17.2892 30.1423C16.8262 30.6159 16.1834 30.8697 15.5217 30.84Z"
                                            fill="#D9D9D9" />
                                        <path
                                            d="M34.9878 17.6764L2.42791 17.6764C1.14346 17.6764 0.102172 16.6351 0.102172 15.3506C0.102173 14.0662 1.14346 13.0249 2.42791 13.0249L34.9878 13.0249C36.2723 13.0249 37.3135 14.0662 37.3135 15.3506C37.3135 16.6351 36.2723 17.6764 34.9878 17.6764Z"
                                            fill="#D9D9D9" />
                                    </svg></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- contact-us -->
        <section class="contact-us" id="Contact">
            <div class="container">
                <div class="row contact-us-wrapper">
                    <div class="contact-left-inner"
                        style="background-image: url({{ isset($themeSetting['contact_info_image']) ? get_file($themeSetting['contact_info_image']) : asset('Modules/CarService/Resources/assets/images/contact-us.png') }});">
                        <form class="contact-form" action="{{ route('contacts.store', ['business' => $business]) }}"
                            method="post">
                            @csrf
                            <div class="form-container">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Name" required=""
                                                name="name" id="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email"
                                                required="" name="email" id="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="number" class="form-control" placeholder="Phone number"
                                                required="" name="contact" id="contact">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="subject"
                                                required="" name="subject" id="subject">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" placeholder="Message" rows="8" name="description"
                                                id="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="theme" value="{{ $module }}">
                            </div>
                            <div class="form-container">
                                <button class="btn contact-btn" type="submit">{{ __('Send') }}</button>
                            </div>
                        </form>
                    </div>
                    @if (isset($themeSetting['contact_info_status']) && $themeSetting['contact_info_status'] == '1')
                        <div class="contact-right-inner">
                            <div class="contact-right-top">
                                <div class="section-title">
                                    <h2>
                                        {{ isset($themeSetting['contact_info_title']) ? $themeSetting['contact_info_title'] : __('photo studio') }}
                                    </h2>
                                </div>
                                <p>{{ isset($themeSetting['contact_info_description']) ? $themeSetting['contact_info_description'] : __('Got questions or ready to book your session? Reach out to us! Were here to help bring your vision to life. Contact us today to get started.') }}
                                </p>
                            </div>
                            <div class="contact-right-bottom">
                                <ul>
                                    <li class="contact-info">
                                        <p><span>{{ isset($themeSetting['contact_info_label_1']) ? $themeSetting['contact_info_label_1'] : __('Address:') }}
                                            </span>{{ isset($themeSetting['contact_info_value_1']) ? $themeSetting['contact_info_value_1'] : __('7515 Carriage Court, Coachella, CA, 92236 USA') }}
                                        </p>
                                    </li>
                                    <li class="contact-info">
                                        <p><span>{{ isset($themeSetting['contact_info_label_2']) ? $themeSetting['contact_info_label_2'] : __('Phone:') }}</span>
                                            <a href="tel:{{ isset($themeSetting['contact_info_value_2']) ? $themeSetting['contact_info_value_2'] : __('(+001) 123-456-7890') }}"
                                                tabindex="0">{{ isset($themeSetting['contact_info_value_2']) ? $themeSetting['contact_info_value_2'] : __('(+001) 123-456-7890') }}
                                            </a>
                                        </p>
                                    </li>
                                    <li class="contact-info">
                                        <p><span>{{ isset($themeSetting['contact_info_label_3']) ? $themeSetting['contact_info_label_3'] : __('mail:') }}</span>
                                            <a href="mailto: {{ isset($themeSetting['contact_info_value_3']) ? $themeSetting['contact_info_value_3'] : __('photobooth@templatetrip.com') }}"
                                                tabindex="0">{{ isset($themeSetting['contact_info_value_3']) ? $themeSetting['contact_info_value_3'] : __('photobooth@templatetrip.com') }}</a>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- mapping-sec -->
        @if (isset($themeSetting['map_area_status']) && $themeSetting['map_area_status'] == '1')
            <section class="contact-direction-sec">
                <div class="container">
                    <div class="contact-direction-inner">
                        @isset($themeSetting['map_area_iframe'])
                            {!! $themeSetting['map_area_iframe'] !!}
                        @endisset
                    </div>
                </div>
            </section>
        @endif

    </main>

    <!-- Footer-sec -->
    <footer class="site-footer footer-style-seven">
        <div class="container">
            <div class="footer-wrapper flex justify-between">
                <div class="footer-left">
                    @if (isset($themeSetting['logo_status']) && $themeSetting['logo_status'] == '1')
                        <div class="footer-logo">
                            <a href="#!" tabindex="0">
                                <img src="{{ isset($themeSetting['footer_top_image']) ? get_file($themeSetting['footer_top_image']) : asset('Modules/Barber/Resources/assets/images/footer-logo.png') }}"
                                    alt="logo" loading="lazy">
                            </a>
                        </div>
                    @endif
                    @if (isset($themeSetting['news_letter_status']) && $themeSetting['news_letter_status'] == '1')
                        <form class="subscribe-form-wrapper"
                            action="{{ route('subscribes.store', ['business' => $business]) }}" method="post">
                            @csrf
                            <div class="input-wrapper flex">
                                <input type="email" placeholder="Your Email Address" class="form-control"
                                    name="email" id="email">
                                <button type="submit"
                                    class="subscribe-btn btn">{{ isset($themeSetting['news_letter_button_text']) ? $themeSetting['news_letter_button_text'] : __('Subscribe') }}
                                </button>
                            </div>
                            <input type="hidden" name="theme" value="{{ $module }}">
                        </form>
                        <p>{{ isset($themeSetting['news_letter_sub_title']) ? $themeSetting['news_letter_sub_title'] : __('We care about our customers - you have always been an integral part of who we are. Join today.') }}
                        </p>
                    @endif
                </div>
                <div class="footer-right">
                    <div class="footer-row flex">
                        @if (isset($themeSetting['footer_top_status']) && $themeSetting['footer_top_status'] == '1')
                            <div class="footer-col">
                                <div class="footer-widget set has-children1">
                                    <h2 class="acnav-label1">
                                        <span>
                                            {{ isset($themeSetting['footer_top_title_1']) ? $themeSetting['footer_top_title_1'] : __('Quick link') }}
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.2" viewBox="0 0 10 5"
                                            width="10" height="5">
                                            <path class="a"
                                                d="m5.4 5.1q-0.3 0-0.5-0.2l-3.7-3.7c-0.3-0.3-0.3-0.7 0-1 0.2-0.3 0.7-0.3 0.9 0l3.3 3.2 3.2-3.2c0.2-0.3 0.7-0.3 0.9 0 0.3 0.3 0.3 0.7 0 1l-3.7 3.7q-0.2 0.2-0.4 0.2z">
                                            </path>
                                        </svg>
                                    </h2>
                                    <ul class="acnav-list1">
                                        <li>
                                            <a href="#" tabindex="0">
                                                {{ isset($themeSetting['footer_top_1_label_1']) ? $themeSetting['footer_top_1_label_1'] : __('Home') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" tabindex="0">
                                                {{ isset($themeSetting['footer_top_1_label_2']) ? $themeSetting['footer_top_1_label_2'] : __('portfolio') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" tabindex="0">
                                                {{ isset($themeSetting['footer_top_1_label_3']) ? $themeSetting['footer_top_1_label_3'] : __('our team') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" tabindex="0">
                                                {{ isset($themeSetting['footer_top_1_label_4']) ? $themeSetting['footer_top_1_label_4'] : __('article') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#appointment" tabindex="0">
                                                {{ isset($themeSetting['footer_top_1_label_5']) ? $themeSetting['footer_top_1_label_5'] : __('Appointment') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-col">
                                <div class="footer-widget set has-children1">
                                    <h2 class="acnav-label1">
                                        <span>{{ isset($themeSetting['footer_top_title_2']) ? $themeSetting['footer_top_title_2'] : __('Our Company') }}
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.2" viewBox="0 0 10 5"
                                            width="10" height="5">
                                            <path class="a"
                                                d="m5.4 5.1q-0.3 0-0.5-0.2l-3.7-3.7c-0.3-0.3-0.3-0.7 0-1 0.2-0.3 0.7-0.3 0.9 0l3.3 3.2 3.2-3.2c0.2-0.3 0.7-0.3 0.9 0 0.3 0.3 0.3 0.7 0 1l-3.7 3.7q-0.2 0.2-0.4 0.2z">
                                            </path>
                                        </svg>
                                    </h2>
                                    <ul class="acnav-list1">
                                        <li>
                                            <a href="#" tabindex="0">
                                                {{ isset($themeSetting['footer_top_2_label_1']) ? $themeSetting['footer_top_2_label_1'] : __('About Us') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" tabindex="0">
                                                {{ isset($themeSetting['footer_top_2_label_2']) ? $themeSetting['footer_top_2_label_2'] : __('Our Services') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" tabindex="0">
                                                {{ isset($themeSetting['footer_top_2_label_3']) ? $themeSetting['footer_top_2_label_3'] : __('Contact Us') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" tabindex="0">
                                                {{ isset($themeSetting['footer_top_2_label_4']) ? $themeSetting['footer_top_2_label_4'] : __('Pricing') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-col">
                                <div class="footer-widget set has-children1">
                                    <h2 class="acnav-label1">
                                        <span>
                                            {{ isset($themeSetting['footer_top_title_3']) ? $themeSetting['footer_top_title_3'] : __('Contact Info') }}
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.2" viewBox="0 0 10 5"
                                            width="10" height="5">
                                            <path class="a"
                                                d="m5.4 5.1q-0.3 0-0.5-0.2l-3.7-3.7c-0.3-0.3-0.3-0.7 0-1 0.2-0.3 0.7-0.3 0.9 0l3.3 3.2 3.2-3.2c0.2-0.3 0.7-0.3 0.9 0 0.3 0.3 0.3 0.7 0 1l-3.7 3.7q-0.2 0.2-0.4 0.2z">
                                            </path>
                                        </svg>
                                    </h2>
                                    <ul class="acnav-list1">
                                        <li class="footer-col-links">
                                            <div class="contact-info">
                                                <p><span>{{ isset($themeSetting['contact_info_label_1']) ? $themeSetting['contact_info_label_1'] : __('Address:') }}
                                                    </span>{{ isset($themeSetting['contact_info_value_1']) ? $themeSetting['contact_info_value_1'] : __('7515 Carriage Court, Coachella, CA, 92236 USA') }}
                                                </p>
                                            </div>
                                        </li>
                                        <li class="footer-col-links">
                                            <div class="contact-info">
                                                <p><span>{{ isset($themeSetting['contact_info_label_2']) ? $themeSetting['contact_info_label_2'] : __('Phone:') }}</span>
                                                    <a href="tel:{{ isset($themeSetting['contact_info_value_2']) ? $themeSetting['contact_info_value_2'] : __('(+001) 123-456-7890') }}"
                                                        tabindex="0">{{ isset($themeSetting['contact_info_value_2']) ? $themeSetting['contact_info_value_2'] : __('(+001) 123-456-7890') }}</a>
                                                </p>
                                            </div>
                                        </li>
                                        <li class="footer-col-links">
                                            <div class="contact-info">
                                                <p><span>{{ isset($themeSetting['contact_info_label_3']) ? $themeSetting['contact_info_label_3'] : __('mail:') }}</span>
                                                    <a href="mailto:{{ isset($themeSetting['contact_info_value_3']) ? $themeSetting['contact_info_value_3'] : __('photobooth@templatetrip.com') }}"
                                                        tabindex="0">{{ isset($themeSetting['contact_info_value_3']) ? $themeSetting['contact_info_value_3'] : __('photobooth@templatetrip.com') }}</a>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        @if (isset($themeSetting['footer_bottom_status']) && $themeSetting['footer_bottom_status'] == '1')
            <div class="footer-bottom">
                <div class="container">
                    <div class="footer-bottom-inner flex align-center justify-between">
                        <p>{{ isset($themeSetting['footer_bottom_copyright_text']) ? $themeSetting['footer_bottom_copyright_text'] : __('Copyright 2024, All Rights Reserved.') }}
                        </p>
                        <ul class="footer-social-icon flex align-center">
                            <li>
                                <a href="{{ isset($themeSetting['footer_bottom_social_icon_1_title']) ? $themeSetting['footer_bottom_social_icon_1_title'] : __('https://www.facebook.com/facebook/') }}"
                                    tabindex="0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="10"
                                        viewBox="0 0 6 10" fill="none">
                                        <path
                                            d="M4.10758 9.4434V5.22322H5.52355L5.73599 3.57805H4.10758V2.52785C4.10758 2.05168 4.23927 1.72718 4.92286 1.72718L5.7933 1.72683V0.255329C5.64277 0.235767 5.12605 0.190918 4.52464 0.190918C3.26881 0.190918 2.40904 0.95747 2.40904 2.36491V3.57805H0.98877V5.22322H2.40904V9.4434H4.10758Z"
                                            fill="#262626"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ isset($themeSetting['footer_bottom_social_icon_2_title']) ? $themeSetting['footer_bottom_social_icon_2_title'] : __('https://www.instagram.com/') }}"
                                    target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                        viewBox="0 0 17 17" fill="none">
                                        <g clip-path="url(#clip0_2502_6555)">
                                            <path
                                                d="M8.3524 2.2837C10.4157 2.2837 10.6601 2.29275 11.4715 2.32895C12.2257 2.36213 12.6329 2.48883 12.9044 2.59441C13.2634 2.73317 13.5228 2.9021 13.7913 3.17057C14.0627 3.44206 14.2287 3.69847 14.3674 4.05744C14.473 4.32893 14.5997 4.73918 14.6329 5.4903C14.6691 6.30478 14.6781 6.54912 14.6781 8.60943C14.6781 10.6728 14.6691 10.9171 14.6329 11.7286C14.5997 12.4827 14.473 12.8899 14.3674 13.1614C14.2287 13.5204 14.0597 13.7798 13.7913 14.0483C13.5198 14.3198 13.2634 14.4857 12.9044 14.6245C12.6329 14.73 12.2226 14.8567 11.4715 14.8899C10.6571 14.9261 10.4127 14.9352 8.3524 14.9352C6.28907 14.9352 6.04473 14.9261 5.23328 14.8899C4.47914 14.8567 4.0719 14.73 3.80041 14.6245C3.44144 14.4857 3.18202 14.3168 2.91354 14.0483C2.64205 13.7768 2.47614 13.5204 2.33738 13.1614C2.2318 12.8899 2.1051 12.4797 2.07192 11.7286C2.03572 10.9141 2.02667 10.6697 2.02667 8.60943C2.02667 6.5461 2.03572 6.30176 2.07192 5.4903C2.1051 4.73616 2.2318 4.32893 2.33738 4.05744C2.47614 3.69847 2.64507 3.43904 2.91354 3.17057C3.18503 2.89908 3.44144 2.73317 3.80041 2.59441C4.0719 2.48883 4.48215 2.36213 5.23328 2.32895C6.04473 2.29275 6.28907 2.2837 8.3524 2.2837ZM8.3524 0.893066C6.25589 0.893066 5.99345 0.902116 5.16993 0.938315C4.34942 0.974514 3.78533 1.10724 3.29664 1.29729C2.78685 1.49638 2.35548 1.75882 1.92713 2.19019C1.49576 2.61854 1.23332 3.04991 1.03422 3.55669C0.844181 4.04839 0.711452 4.60947 0.675253 5.42997C0.639055 6.25651 0.630005 6.51895 0.630005 8.61546C0.630005 10.712 0.639055 10.9744 0.675253 11.7979C0.711452 12.6184 0.844181 13.1825 1.03422 13.6712C1.23332 14.181 1.49576 14.6124 1.92713 15.0407C2.35548 15.4691 2.78685 15.7345 3.29363 15.9306C3.78533 16.1207 4.34641 16.2534 5.16691 16.2896C5.99043 16.3258 6.25287 16.3348 8.34938 16.3348C10.4459 16.3348 10.7083 16.3258 11.5319 16.2896C12.3524 16.2534 12.9165 16.1207 13.4051 15.9306C13.9119 15.7345 14.3433 15.4691 14.7716 15.0407C15.2 14.6124 15.4655 14.181 15.6615 13.6742C15.8516 13.1825 15.9843 12.6215 16.0205 11.801C16.0567 10.9774 16.0657 10.715 16.0657 8.61848C16.0657 6.52197 16.0567 6.25953 16.0205 5.43601C15.9843 4.6155 15.8516 4.05141 15.6615 3.56272C15.4715 3.04991 15.209 2.61854 14.7777 2.19019C14.3493 1.76184 13.918 1.49638 13.4112 1.3003C12.9195 1.11026 12.3584 0.97753 11.5379 0.941331C10.7114 0.902116 10.4489 0.893066 8.3524 0.893066Z"
                                                fill="black"></path>
                                            <path
                                                d="M8.35252 4.64893C6.1625 4.64893 4.38574 6.42568 4.38574 8.6157C4.38574 10.8057 6.1625 12.5825 8.35252 12.5825C10.5425 12.5825 12.3193 10.8057 12.3193 8.6157C12.3193 6.42568 10.5425 4.64893 8.35252 4.64893ZM8.35252 11.1888C6.93172 11.1888 5.77939 10.0365 5.77939 8.6157C5.77939 7.1949 6.93172 6.04258 8.35252 6.04258C9.77332 6.04258 10.9256 7.1949 10.9256 8.6157C10.9256 10.0365 9.77332 11.1888 8.35252 11.1888Z"
                                                fill="black"></path>
                                            <path
                                                d="M13.4022 4.492C13.4022 5.00482 12.9859 5.41809 12.4761 5.41809C11.9633 5.41809 11.55 5.0018 11.55 4.492C11.55 3.97919 11.9663 3.56592 12.4761 3.56592C12.9859 3.56592 13.4022 3.9822 13.4022 4.492Z"
                                                fill="black"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_2502_6555">
                                                <rect width="15.4448" height="15.4448" fill="white"
                                                    transform="translate(0.630005 0.893066)"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ isset($themeSetting['footer_bottom_social_icon_3_title']) ? $themeSetting['footer_bottom_social_icon_3_title'] : __('https://www.youtube.com/') }}"
                                    target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                        viewBox="0 0 17 17" fill="none">
                                        <g clip-path="url(#clip0_2502_6554)">
                                            <path
                                                d="M16.238 5.52648C16.238 5.52648 16.0871 4.46164 15.6226 3.99407C15.0344 3.37869 14.3767 3.37568 14.0751 3.33948C11.9152 3.18262 8.67243 3.18262 8.67243 3.18262H8.6664C8.6664 3.18262 5.4236 3.18262 3.26374 3.33948C2.96208 3.37568 2.30447 3.37869 1.71624 3.99407C1.25169 4.46164 1.10388 5.52648 1.10388 5.52648C1.10388 5.52648 0.947021 6.77836 0.947021 8.02721V9.19764C0.947021 10.4465 1.10087 11.6984 1.10087 11.6984C1.10087 11.6984 1.25169 12.7632 1.71323 13.2308C2.30146 13.8462 3.0737 13.825 3.41758 13.8914C4.65437 14.0091 8.66942 14.0453 8.66942 14.0453C8.66942 14.0453 11.9152 14.0392 14.0751 13.8854C14.3767 13.8492 15.0344 13.8462 15.6226 13.2308C16.0871 12.7632 16.238 11.6984 16.238 11.6984C16.238 11.6984 16.3918 10.4495 16.3918 9.19764V8.02721C16.3918 6.77836 16.238 5.52648 16.238 5.52648ZM7.07366 10.6184V6.27761L11.2456 8.45556L7.07366 10.6184Z"
                                                fill="black"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_2502_6554">
                                                <rect width="15.4448" height="15.4448" fill="white"
                                                    transform="translate(0.947021 0.893066)"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </footer>
@endsection

<script>
    function myFunction(x) {
                x.classList.toggle("change");
            }
</script>
