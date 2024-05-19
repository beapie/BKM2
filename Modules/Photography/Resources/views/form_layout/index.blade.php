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
                            <a href="#" tabindex="0">
                                <img src="{{ isset($themeSetting['logo_image']) ? get_file($themeSetting['logo_image']) : asset('Modules/Photography/Resources/assets/images/logo.png') }}" alt="logo" loading="lazy">
                            </a>
                        </h1>
                    </div>
                    @endif
                    @if (isset($themeSetting['menu_status']) && $themeSetting['menu_status'] == '1')
                        <div class="menu-item-left">
                            <nav class="menu-items-col">
                                <ul class="main-nav flex align-center">
                                    <li class="menu-lnk has-item">
                                        <a href="#home" class="click-btn" tabindex="0">{{ isset($themeSetting['menu_title_1']) ? $themeSetting['menu_title_1'] : __('Home') }}</a>
                                    </li>
                                    <li class="menu-lnk has-item">
                                        <a href="#about" class="click-btn" tabindex="0">{{ isset($themeSetting['menu_title_2']) ? $themeSetting['menu_title_2'] : __('about us') }}</a>
                                    </li>
                                    <li class="menu-lnk has-item">
                                        <a href="#service" class="click-btn" tabindex="0">{{ isset($themeSetting['menu_title_3']) ? $themeSetting['menu_title_3'] : __('our services') }}</a>
                                    </li>
                                    <li class="menu-lnk has-item">
                                        <a href="#our-team" tabindex="0">{{ isset($themeSetting['menu_title_4']) ? $themeSetting['menu_title_4'] : __('our team') }}</a>
                                    </li>
                                    <li class="menu-lnk">
                                        <a href="#portfolio" tabindex="0">{{ isset($themeSetting['menu_title_5']) ? $themeSetting['menu_title_5'] : __('portfolio') }}</a>
                                    </li>
                                    <li class="menu-lnk">
                                        <a href="#article" tabindex="0"> {{ isset($themeSetting['menu_title_6']) ? $themeSetting['menu_title_6'] : __('blog') }}</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="menu-item-right">
                            <ul class="flex align-center">
                                <li class="contact-btn">
                                    <a href="#contact-us" class="btn justify-center" tabindex="0"> <span>{{ isset($themeSetting['menu_title_7']) ? $themeSetting['menu_title_7'] : __('contact us') }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24"
                                            fill="none">
                                            <path
                                                d="M23.4648 16.875C23.4008 16.8242 18.75 13.4719 17.4734 13.7125C16.8641 13.8203 16.5156 14.2359 15.8164 15.068C15.7039 15.2023 15.4336 15.5242 15.2234 15.7531C14.7816 15.609 14.3505 15.4336 13.9336 15.2281C11.7817 14.1805 10.043 12.4418 8.99531 10.2898C8.78974 9.87298 8.61429 9.44193 8.47031 9C8.7 8.78906 9.02188 8.51875 9.15938 8.40312C9.9875 7.70781 10.4039 7.35937 10.5117 6.74844C10.7328 5.48281 7.38281 0.8 7.34766 0.757812C7.19566 0.54068 6.9973 0.360049 6.76693 0.228987C6.53656 0.0979247 6.27994 0.0197095 6.01562 0C4.65781 0 0.78125 5.02891 0.78125 5.87578C0.78125 5.925 0.852344 10.9281 7.02187 17.2039C13.2914 23.3664 18.2938 23.4375 18.343 23.4375C19.1906 23.4375 24.2188 19.5609 24.2188 18.2031C24.1993 17.9397 24.1215 17.684 23.9911 17.4543C23.8608 17.2246 23.681 17.0268 23.4648 16.875Z"
                                                fill="white"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li class="mobile-menu">
                                    <div class="mobile-menu-button btn open-menu" onclick="myFunction(this)">
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
<!-- header-style-one end here -->

<main class="wrapper">
    <!-- home-banner-sec -->
    <section class="home-banner-sec pt pb" id="home">
        <img src="{{ asset('Modules/Photography/Resources/assets/images/home-design.png') }}" alt="design-1" class="home-design desk-only" loading="lazy">
        <div class="container-offset offset-right">
            <div class="banner-top">
                <div class="swiper swiper-container  gallery-main">
                    <div class="swiper-wrapper">
                        @if (isset($themeSetting['banner_status']) && $themeSetting['banner_status'] == '1')
                            @if (count(json_decode($themeSetting['banner_repeater'])) > 0)
                                @foreach (json_decode($themeSetting['banner_repeater']) as $banner)
                                    <div class="swiper-slide">
                                        <div class="row align-center gallery-main-row">
                                            <div class="col-md-6 col-12">
                                                <div class="product-item-img">
                                                    <img src="{{ isset($banner->image) ? get_file($banner->image) : asset('Modules/Photography/Resources/assets/images/home-main.png') }}" alt="Product-image" loading="lazy">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="banner-content">
                                                    <div class="banner-content-inner">
                                                        <div class="section-title">
                                                            <div class="subtitle">
                                                                {{ isset($banner->small_text) ? $banner->small_text : __('PERFECT MOOD IS ALWAYS HERE') }}
                                                            </div>
                                                            <h2>{{ isset($banner->big_text) ? $banner->big_text : __('Capture Your Moments Here') }}</h2>
                                                        </div>
                                                        <p>{{ isset($banner->content) ? $banner->content : __('At our studio, were not just snapping photos were weaving stories. With heart and hustle, we turn your moments into magic. Lets make memories together!') }}</p>
                                                        <a href="#appointment" class="btn btn-white" tabindex="0">{{ isset($banner->button_text) ? $banner->button_text : __('Book an Appointment') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="banner-bottom">
                <div class="row">
                    <div class="col-md-8 col-12">
                        <div class="arrow-wrapper flex align-center">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                    @if (isset($themeSetting['working-hours_status']) && $themeSetting['working-hours_status'] == '1')
                        <div class="col-md-4 col-12">
                            <div class="working-hrs-wrp">
                                <div class="section-title">
                                    <h3 class="h5">
                                        {{ isset($themeSetting['working-hours_working_title']) ? $themeSetting['working-hours_working_title'] : __('ENABLE WORKING HOURS') }}
                                    </h3>
                                </div>
                                <ul>
                                    @foreach ($workingDays as $workingDay)
                                        <li>
                                            <span>{{ ucfirst($workingDay->day_name) }}</span>
                                            <p class="{{ $workingDay->day_off == 'on' ? 'close' : ''}}  ">{{ $workingDay->day_off == 'on' ? 'Close' : date('H:i',strtotime($workingDay->start_time)).' to '.date('H:i',strtotime($workingDay->end_time)) }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- photo-about-sec -->
    @if (isset($themeSetting['about_status']) && $themeSetting['about_status'] == '1')
        <section class="photo-about-sec pt pb" id="about">
            <div class="container">
                <div class="row align-center">
                    <div class="col-md-7 col-12">
                        <div class="photo-about-left-wrp">
                            <div class="section-title">
                                <div class="subtitle">
                                    {{ isset($themeSetting['about_title']) ? $themeSetting['about_title'] : __('about US') }}
                                </div>
                                <h2>{{ isset($themeSetting['about_sub_title']) ? $themeSetting['about_sub_title'] : __('We love high quality photo products') }} </h2>
                                <p>{{ isset($themeSetting['about_content']) ? $themeSetting['about_content'] : __('Dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernaturaut odit aut fugit, sed quia.') }} </p>
                            </div>
                            <ul class="counter-wrp">
                                <li class="counter-item">
                                    <span>{{ isset($themeSetting['about_label_1']) ? $themeSetting['about_label_1'] : __('Years') }} </span>
                                    <div class="counting" data-count="{{ isset($themeSetting['about_value_1']) ? $themeSetting['about_value_1'] : '12' }}">{{ __('0') }}</div>
                                </li>
                                <li class="counter-item">
                                    <span>{{ isset($themeSetting['about_label_2']) ? $themeSetting['about_label_2'] : __('People') }}</span>
                                    <div class="counting" data-count="{{ isset($themeSetting['about_value_2']) ? $themeSetting['about_value_2'] : '100' }}">{{  __('0') }}</div>
                                </li>
                                <li class="counter-item">
                                    <span>{{ isset($themeSetting['about_label_3']) ? $themeSetting['about_label_3'] : __('Order') }}</span>
                                    <div class="counting" data-count="{{  isset($themeSetting['about_value_3']) ? $themeSetting['about_value_3'] : '350'  }}">{{ __('0') }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5 col-12">
                        <div class="photo-about-right-wrp">
                            <img src="{{ asset('Modules/Photography/Resources/assets/images/design-1.png') }}" alt="design-1" class="design-1 desk-only"
                                loading="lazy">
                            <img src="{{ asset('Modules/Photography/Resources/assets/images/design-2.png') }}" alt="design-2" class="design-2 desk-only"
                                loading="lazy">
                            <img src="{{ isset($themeSetting['about_image']) ? get_file($themeSetting['about_image']) : asset('Modules/Photography/Resources/assets/images/about-photo.png') }}" alt="about-photo" class="about-photo"
                                loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- photo-service-sec -->
    <section class="photo-service-sec pt" id="service">
        <div class="container">
            @if (isset($themeSetting['service_status']) && $themeSetting['service_status'] == '1')
                <div class="section-title">
                    <h2>{{ isset($themeSetting['service_title']) ? $themeSetting['service_title'] : __('WE ARE SERVICES PROVIDED')}}</h2>
                    <p>{{ isset($themeSetting['service_content']) ? $themeSetting['service_content'] : __('Choose from our range of photobooth options, including open-air and enclosed booths, to suit your wedding theme and style.')}} </p>
                </div>
            @endif
            <div class="row">
                @foreach ($services as $service)
                    <div class="col-md-6 col-12">
                        <div class="photo-card">
                            <div class="photo-card-image">
                                <a href="#" class="img-wrapper" tabindex="0">
                                    <img src="{{ check_file($service->image) ? get_file($service->image) : get_file('uploads/default/avatar.png') }}" alt="product-image" loading="lazy">
                                </a>
                            </div>
                            <div class="photo-card-content">
                                <span>{{ $service->Category->name }}</span>
                                <h3>{{ $service->name }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- photo-banner-sec -->
    @if (isset($themeSetting['info_status']) && $themeSetting['info_status'] == '1')
        <section class="photo-banner-sec pt pb" id="photo-banner"
            style="background-image: url({{ isset($themeSetting['info_image']) ? get_file($themeSetting['info_image']) : asset('Modules/Photography/Resources/assets/images/photo-banner.png') }});">
            <div class="container">
                <div class="photo-banner-content">
                    <h2 class="large-text">
                        {{ isset($themeSetting['info_content']) ? ($themeSetting['info_content']) : ('info_content Our photography studio is dedicated to capturing the essence of your') }}
                    </h2>
                    <a href="#appointment" class="btn" tabindex="0">{{ isset($themeSetting['info_button_text']) ? $themeSetting['info_button_text'] : __('Book an Appointment')  }}</a>
                </div>
            </div>
        </section>
    @endif

    <!-- appointment-sec -->
    <section class="appointment-sec pt pb" id="appointment">
        @include('web_layouts.appointment-form')
    </section>

    <!-- our-team-sec -->
    <section class="our-team-sec pt pb" id="our-team">
        <div class="container">
            <div class="flower-vector-img desk-only">
                <img src="{{ asset('Modules/Photography/Resources/assets/images/yellow-vector-flower') }}.png" alt="Vector-flower">
            </div>
            @if (isset($themeSetting['staff_status']) && $themeSetting['staff_status'] == '1')
                <div class="section-title">
                    <div class="subtitle">{{ isset($themeSetting['staff_title']) ? $themeSetting['staff_title'] : __('OUr TEAM') }}</div>
                    <h2>{{ isset($themeSetting['staff_sub_title']) ? $themeSetting['staff_sub_title'] : __('OUR PHOTOGRAPHY TEAm') }} </h2>
                </div>
            @endif
            <div class="our-team-slider swiper">
                <div class="swiper-wrapper">
                    @foreach ($staffs as $staff)
                        <div class="swiper-slide">
                            <div class="our-team-card">
                                <div class="our-team-img">
                                    <img src="{{ check_file($staff->user->avatar) ? get_file($staff->user->avatar) : get_file('uploads/default/avatar.png') }}" alt="client-logo-image" loading="lazy">
                                </div>
                                <div class="our-team-content text-center">
                                    <div class="team-designation">
                                        {{-- <span>Photographer</span> --}}
                                        <p>{{  $staff->name  }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- testimonial-sec -->
    <section class="testimonial-sec" id="testimonial">
        <div class="container">
            @if (isset($themeSetting['testimonial_status']) && $themeSetting['testimonial_status'] == '1')
                <div class="testimonial-title">
                    <h2>{{ isset($themeSetting['testimonial_title']) ? $themeSetting['testimonial_title'] : __('testimonial') }} </h2>
                </div>
            @endif
            <div class="row">
                <div class="col-md-5 col-12">
                    <div class="testimonial-thumb swiper">
                        <div class="swiper-wrapper">
                            @foreach ($testimonials as $testimonial)
                                <div class="swiper-slide">
                                    <div class="test-thumb-img">
                                        <img src="{{ check_file($testimonial->image) ? get_file($testimonial->image) : get_file('uploads/default/avatar.png') }}" alt="" loading="lazy"
                                            class="main-testimonial-img">
                                        <img src="{{ asset('Modules/Photography/Resources/assets/images/test-quot.png') }}" alt="" loading="lazy" class="test-quot">
                                    </div>
                                    <div class="test-thumb-detail">
                                        <h6>
                                            {{ $testimonial->customer->name }}
                                        </h6>
                                        {{-- <p>
                                            CEO, Business Co.
                                        </p> --}}
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="swiper-slide">
                                <div class="test-thumb-img">
                                    <img src="{{ asset('Modules/Photography/Resources/assets/images/test-2.png') }}" alt="" loading="lazy"
                                        class="main-testimonial-img">
                                    <img src="{{ asset('Modules/Photography/Resources/assets/images/test-quot.png') }}" alt="" loading="lazy" class="test-quot">
                                </div>
                                <div class="test-thumb-detail">
                                    <h6>
                                        HANNAH HILL
                                    </h6>
                                    <p>
                                        CEO, Business Co.
                                    </p>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-12">
                    <div class="testimonial-slider swiper">
                        <div class="swiper-wrapper">
                            @foreach ($testimonials as $testimonial)
                                <div class="swiper-slide">
                                    <div class="test-content">
                                        <p>{{ $testimonial->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="swiper-slide">
                                <div class="test-content">
                                    <p>Beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                                        aspernatur aut odit aut fugit, sed. Labore et dolore magna aliqua ut enim ad
                                        minim. Beatae vitae dicta. Adipiscing elit, sed do eiusmod tempor
                                        incididunt.</p>
                                    <p>Labore et dolore magna aliqua ut enim ad minim. Adipiscing elit, sed do
                                        eiusmod tempor incididunt ut labore.</p>
                                </div>
                            </div> --}}

                        </div>
                        <div class="arrow-wrapper flex align-center">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="arrow-vector-img desk-only">
                <img src="{{ asset('Modules/Photography/Resources/assets/images/design-1.png') }}" alt="design-1" class="design-1" loading="lazy">
            </div>
        </div>
    </section>

    <!-- portfolio-sec -->
    <section class="portfolio-sec pt" id="portfolio">
        @if (isset($themeSetting['portfolio-title_status']) && $themeSetting['portfolio-title_status'] == '1')
            <div class="container">
                <div class="flower-vector-img desk-only">
                    <img src="{{ asset('Modules/Photography/Resources/assets/images/vector-flower.png') }}" alt="Vector-flower">
                </div>
                <div class="section-title text-center">
                    <div class="subtitle">{{ isset($themeSetting['portfolio-title_title']) ? $themeSetting['portfolio-title_title'] : __('PHOTOGRAPHY PORTFOLIO') }}  </div>
                    <h2>{{ isset($themeSetting['portfolio-title_sub_title']) ? $themeSetting['portfolio-title_sub_title'] : __('Creative photo projects') }} </h2>
                </div>
            </div>
        @endif
        @if (isset($themeSetting['portfolio_status']) && $themeSetting['portfolio_status'] == '1')
            <div class="portfolio-slider swiper">
                <div class="swiper-wrapper">
                    @if (count(json_decode($themeSetting['portfolio_repeater'])) > 0)
                        @foreach (json_decode($themeSetting['portfolio_repeater']) as $portfolio_repeater)
                            <div class="swiper-slide">
                                <div class="portfolio-card">
                                    <div class="portfolio-img">
                                        <img src="{{ isset($portfolio_repeater->image) ? get_file($portfolio_repeater->image) : asset('Modules/Photography/Resources/assets/images/portfolio-1.png') }}" alt="client-logo-image" loading="lazy">
                                    </div>
                                    <div class="portfolio-content text-center">
                                        <div class="pro-year">
                                            <span>{{ isset($portfolio_repeater->small_text) ? $portfolio_repeater->small_text : __('2020') }} </span>
                                            <p>{{ isset($portfolio_repeater->big_text) ? $portfolio_repeater->big_text : __('beauty')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endif
    </section>

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
                                        <img src="{{ isset($brand_carousel_repeater->image) ? get_file($brand_carousel_repeater->image) : asset('Modules/Photography/Resources/assets/images/client-logo-1.png') }}" alt="client-logo-image" loading="lazy">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- article-sec -->
    <section class="article-sec pt pb" id="article">
        <div class="container">
            @if (isset($themeSetting['blog_status']) && $themeSetting['blog_status'] == '1')
                <div class="section-title">
                    <div class="subtitle">{{ isset($themeSetting['blog_title']) ? $themeSetting['blog_title'] : __('OUR article') }}</div>
                    <h2>{{ isset($themeSetting['blog_sub_title']) ? $themeSetting['blog_sub_title'] : __('From our blog') }}</h2>
                </div>
            @endif
            <div class="article-slider-wrp">
                <div class="article-slider swiper">
                    <div class="swiper-wrapper">
                        @foreach ($blogs as $blog)
                            <div class="swiper-slide">
                                <div class="article-card">
                                    <div class="article-card-inner flex align-center">
                                        <div class="article-card-image">
                                            <a href="#" tabindex="0" class="article-image">
                                                <img src="{{ check_file($blog->image) ? get_file($blog->image) : get_file('uploads/default/avatar.png') }}" alt="article-card-image"
                                                    loading="lazy">
                                            </a>
                                        </div>
                                        <div class="article-content uppercase">
                                            <div class="article-content-top">
                                                <div class="author-name">
                                                    <p>{{ $blog->title }}</p>
                                                </div>
                                                <h6>
                                                    <a href="#" tabindex="0">
                                                        {{ $blog->description }}
                                                    </a>
                                                </h6>

                                                <span class="comment">{{ \Carbon\Carbon::parse($blog->date)->format('F j, Y')  }}</span>

                                            </div>
                                            {{-- <div class="article-content-bottom">
                                                <a href="javascript:void(0)" class="article-btn" tabindex="0">Read
                                                    More</a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <div class="star-vector-img desk-only">
            <img src="{{ asset('Modules/Photography/Resources/assets/images/Vector-star.png') }}" alt="Vector-star">
        </div>
        <div class="arrow-vector-img desk-only">
            <img src="{{ asset('Modules/Photography/Resources/assets/images/Arrow.png') }}" alt="Arrow">
        </div>
    </section>
    <!-- contact-us -->
    <section class="contact-us pt" id="contact-us">
        <div class="container">
            <div class="row contact-us-wrapper">
                <div class="col-md-7 col-12">
                    <div class="contact-left-inner">
                        <form class="contact-form" action="{{ route('contacts.store', ['business'=>$business]) }}" method="post">
                            @csrf
                            <div class="form-container">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Name" required="" name="name" id="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email" required="" name="email" id="email">
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
                                            <textarea class="form-control" name="message" placeholder="Message"
                                                rows="8" name="description" id="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="theme" value="{{ $module }}">
                            <div class="form-container">
                                <button class="btn contact-btn" type="submit">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @if (isset($themeSetting['contact_info_status']) && $themeSetting['contact_info_status'] == '1')
                    <div class="col-md-5 col-12">
                        <div class="contact-right-inner">
                            <div class="contact-right-top">
                                <div class="section-title">
                                    <div class="subtitle">{{ isset($themeSetting['contact_info_title']) ? $themeSetting['contact_info_title'] : __('photo studio') }}</div>
                                    <h2>{{ isset($themeSetting['contact_info_sub_title']) ? $themeSetting['contact_info_sub_title'] : __('contact') }}</h2>
                                </div>
                                <p>{{ isset($themeSetting['contact_info_description']) ? $themeSetting['contact_info_description'] : __('Got questions or ready to book your session? Reach out to us! Were here to help bring your vision to life. Contact us today to get started.') }}</p>
                            </div>
                            <div class="contact-right-bottom">
                                <ul>
                                    <li class="contact-info">
                                        <p><span>{{ isset($themeSetting['contact_info_label_1']) ? $themeSetting['contact_info_label_1'] : __('Address:') }} </span>{{ isset($themeSetting['contact_info_value_1']) ? $themeSetting['contact_info_value_1'] : __('7515 Carriage Court, Coachella, CA, 92236 USA') }}</p>
                                    </li>
                                    <li class="contact-info">
                                        <p><span>{{ isset($themeSetting['contact_info_label_2']) ? $themeSetting['contact_info_label_2'] : __('Phone:') }}</span>
                                            <a href="tel:{{ isset($themeSetting['contact_info_value_2']) ? $themeSetting['contact_info_value_2'] : __('(+001) 123-456-7890') }}" tabindex="0">{{ isset($themeSetting['contact_info_value_2']) ? $themeSetting['contact_info_value_2'] : __('(+001) 123-456-7890') }} </a>
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
                            <div class="vector-img desk-only">
                                <img src="{{ asset('Modules/Photography/Resources/assets/images/contact-vector.png') }}" alt="" loading="lazy">
                            </div>
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

    <!-- gallery-sec -->
    <section class="gallery-sec">
        @if (isset($themeSetting['gallery-title_status']) && $themeSetting['gallery-title_status'] == '1')
            <div class="gallery-title">
                <h2>{{ isset($themeSetting['gallery-title_title']) ? $themeSetting['gallery-title_title'] : __('OUR GELEERY') }}</h2>
            </div>
        @endif
        @if (isset($themeSetting['gallery_carousel_status']) && $themeSetting['gallery_carousel_status'] == '1')
            <div class="swiper gallery-slider">
                <div class="swiper-wrapper">
                    @if (count(json_decode($themeSetting['gallery_carousel_repeater'])) > 0)
                    @foreach (json_decode($themeSetting['gallery_carousel_repeater']) as $gallery_carousel_repeater)
                            <div class="swiper-slide">
                                <div class="gallery-image">
                                    <img src="{{ isset($gallery_carousel_repeater->image) ? get_file($gallery_carousel_repeater->image) : asset('Modules/Photography/Resources/assets/images/gallery-1.png') }}" alt="gallery-image" loading="lazy">
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        @endif
    </section>
</main>

<!-- footer start here -->
<footer class="site-footer footer-style-seven">
    <div class="container">
        <div class="footer-wrapper flex justify-between">
            <div class="footer-left">
                @if (isset($themeSetting['footer_top_status']) && $themeSetting['footer_top_status'] == '1')
                    <div class="footer-logo">
                        <a href="#" tabindex="0">
                            <img src="{{ isset($themeSetting['footer_top_image']) ? get_file($themeSetting['footer_top_image']) : asset('Modules/Photography/Resources/assets/images/footer-logo.png') }}" alt="logo" loading="lazy">
                        </a>
                    </div>
                @endif
                @if (isset($themeSetting['news_letter_status']) && $themeSetting['news_letter_status'] == '1')
                    <form class="subscribe-form-wrapper" action="{{ route('subscribes.store', ['business'=>$business]) }}" method="post">
                        @csrf
                        <div class="input-wrapper flex">
                            <input type="email" placeholder="Your Email Address" class="form-control" name="email" id="email">
                            <button type="submit" class="subscribe-btn btn">{{ isset($themeSetting['news_letter_button_text']) ? $themeSetting['news_letter_button_text'] : __('Subscribe') }}
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
                                    <span> {{ isset($themeSetting['footer_top_title_1']) ? $themeSetting['footer_top_title_1'] : __('Quick link') }} </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.2" viewBox="0 0 10 5" width="10"
                                        height="5">
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
                                        <a href="#" tabindex="0">
                                            {{ isset($themeSetting['footer_top_1_label_5']) ? $themeSetting['footer_top_1_label_5'] : __('Appointment') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-col">
                            <div class="footer-widget set has-children1">
                                <h2 class="acnav-label1">
                                    <span>{{ isset($themeSetting['footer_top_title_2']) ? $themeSetting['footer_top_title_2'] : __('Our Company') }} </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.2" viewBox="0 0 10 5" width="10"
                                        height="5">
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
                                    <span> {{ isset($themeSetting['footer_top_title_3']) ? $themeSetting['footer_top_title_3'] : __('Contact Info') }}  </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.2" viewBox="0 0 10 5" width="10"
                                        height="5">
                                        <path class="a"
                                            d="m5.4 5.1q-0.3 0-0.5-0.2l-3.7-3.7c-0.3-0.3-0.3-0.7 0-1 0.2-0.3 0.7-0.3 0.9 0l3.3 3.2 3.2-3.2c0.2-0.3 0.7-0.3 0.9 0 0.3 0.3 0.3 0.7 0 1l-3.7 3.7q-0.2 0.2-0.4 0.2z">
                                        </path>
                                    </svg>
                                </h2>
                                <ul class="acnav-list1">
                                    <li class="footer-col-links">
                                        <div class="contact-info">
                                            <p><span>{{ isset($themeSetting['contact_info_label_1']) ? $themeSetting['contact_info_label_1'] : __('Address:') }} </span>{{ isset($themeSetting['contact_info_value_1']) ? $themeSetting['contact_info_value_1'] : __('7515 Carriage Court, Coachella, CA, 92236 USA') }}</p>
                                        </div>
                                    </li>
                                    <li class="footer-col-links">
                                        <div class="contact-info">
                                            <p><span>{{ isset($themeSetting['contact_info_label_2']) ? $themeSetting['contact_info_label_2'] : __('Phone:') }}</span>
                                                <a href="tel:{{ isset($themeSetting['contact_info_value_2']) ? $themeSetting['contact_info_value_2'] : __('(+001) 123-456-7890') }}" tabindex="0">{{ isset($themeSetting['contact_info_value_2']) ? $themeSetting['contact_info_value_2'] : __('(+001) 123-456-7890') }}</a>
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
                    <p>{{ isset($themeSetting['footer_bottom_copyright_text']) ? $themeSetting['footer_bottom_copyright_text'] : __('Copyright 2024, All Rights Reserved.') }} </p>
                    <ul class="footer-social-icon flex align-center">
                        <li>
                            <a href="{{ isset($themeSetting['footer_bottom_social_icon_1_title']) ? $themeSetting['footer_bottom_social_icon_1_title'] : __('https://www.facebook.com/facebook/') }}" tabindex="0">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="6" height="10" viewBox="0 0 6 10"
                                    fill="none">
                                    <path
                                        d="M4.10758 9.4434V5.22322H5.52355L5.73599 3.57805H4.10758V2.52785C4.10758 2.05168 4.23927 1.72718 4.92286 1.72718L5.7933 1.72683V0.255329C5.64277 0.235767 5.12605 0.190918 4.52464 0.190918C3.26881 0.190918 2.40904 0.95747 2.40904 2.36491V3.57805H0.98877V5.22322H2.40904V9.4434H4.10758Z"
                                        fill="#262626"></path>
                                </svg> --}}
                                <i class="{{ isset($themeSetting['footer_bottom_social_icon_1']) ? $themeSetting['footer_bottom_social_icon_1'] : __('fab fa-whatsapp') }}"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ isset($themeSetting['footer_bottom_social_icon_2_title']) ? $themeSetting['footer_bottom_social_icon_2_title'] : __('https://www.instagram.com/') }}" target="_blank">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                    fill="none">
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
                                </svg> --}}
                                <i class="{{ isset($themeSetting['footer_bottom_social_icon_2']) ? $themeSetting['footer_bottom_social_icon_2'] : __('fab fa-facebook') }}"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ isset($themeSetting['footer_bottom_social_icon_3_title']) ? $themeSetting['footer_bottom_social_icon_3_title'] : __('https://www.youtube.com/') }}" target="_blank">
                                <i class="{{ isset($themeSetting['footer_bottom_social_icon_3']) ? $themeSetting['footer_bottom_social_icon_3'] : __('fab fa-twitter') }}"></i>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                    fill="none">
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
                                </svg> --}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
</footer>
<!-- footer start here -->

@endsection

<script>
    function myFunction(x) {
                x.classList.toggle("change");
            }
</script>
