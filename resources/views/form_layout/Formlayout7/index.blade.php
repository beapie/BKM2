@extends('form_layout.layout')
@section('form_content')
    <main>
        <section class="appointment-sec pt pb">
            <h1 class="book-now">{{ __('Book now') }}</h1>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-12">
                        <div class="form-left-inner">
                            <img src="{{ asset('form_layouts/Formlayout7/images/' . $business->theme_color . '.png') }}"
                                alt="star-image" loading="lazy">
                            <div>
                                <div class="section-title">
                                    <h2>{{ __('Book an') }} <b>{{ $business->name }}</b> {{ __('Appointment') }}</h2>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-7 col-12">
                        <div class="form-box">
                            <div class="steps">
                                <ul>
                                    <li class="stapes_status">

                                        <span>
                                            {{ __('1') }}
                                        </span>
                                        {{ __('Service') }}
                                    </li>
                                    <li class="stapes_status">

                                        <span>
                                            {{ __('2') }}
                                        </span>
                                        {{ __('Pick a Time') }}
                                    </li>
                                    @if ((!empty($files) && $files->value == 'on') || (!empty($custom_field) && $custom_field == 'on'))
                                        <li class="stapes_status">

                                            <span>
                                                {{ __('3') }}
                                            </span>
                                            {{ __('Additional Details') }}
                                        </li>
                                    @endif
                                    <li class="stapes_status">

                                        <span>
                                            @if ((!empty($files) && $files->value == 'on') || (!empty($custom_field) && $custom_field == 'on'))
                                                {{ __('4') }}
                                            @else
                                                {{ __('3') }}
                                            @endif
                                        </span>
                                        {{ __('Your Details') }}
                                    </li>
                                    <li class="stapes_status">
                                        <span>
                                            @if ((!empty($files) && $files->value == 'on') || (!empty($custom_field) && $custom_field == 'on'))
                                                {{ __('5') }}
                                            @else
                                                {{ __('4') }}
                                            @endif
                                        </span>
                                        {{ __('Payment') }}
                                    </li>
                                    <li class="stapes_status">
                                        <span>
                                            @if ((!empty($files) && $files->value == 'on') || (!empty($custom_field) && $custom_field == 'on'))
                                                {{ __('6') }}
                                            @else
                                                {{ __('5') }}
                                            @endif
                                        </span>
                                        {{ __('Done') }}
                                    </li>
                                </ul>
                            </div>
                            {{ Form::open(['url' => '#', 'method' => 'post', 'id' => 'appointment-form', 'class' => 'appointment-forms', 'enctype' => 'multipart/form-data']) }}
                            @csrf
                            <div class="myContainer">
                                <div class="step-container active" id="step-first">
                                    <div class="appointment-wrp">
                                        <div class="appointment-form">
                                            <div class="section-title">
                                                <h3 class="h5">{{ __('Please Select Services:') }}</h3>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>{{ __('Choose a services') }}</label>
                                                        <select id="serviceSelect" name="service">
                                                            <option value="" disabled selected>
                                                                {{ __('Select services') }}</option>
                                                            @foreach ($services as $key => $service)
                                                                <option value="{{ $service->id }}" class="service">
                                                                    {{ $service->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>{{ __('Location') }}</label>
                                                        <select id="locationSelect" name="location">
                                                            <option value="" disabled selected>
                                                                {{ __('Select location') }}</option>
                                                            @foreach ($locations as $ke => $location)
                                                                <option value="{{ $location->id }}">{{ $location->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>{{ __('Staff') }}</label>
                                                        <select id="staffSelect" name="staff">
                                                            <option value="" disabled selected>
                                                                {{ __('Select staff') }}</option>
                                                            {{-- @foreach ($staffs as $k => $staff)
                                                                <option value="{{ $staff->user->id }}">{{ $staff->name }}</option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="step-btns">
                                            <button type="button" name="next" class="next action-button btn">
                                                {{ __('Next step') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-container">
                                    <div class="appointment-wrp">
                                        <div class="appointment-form">
                                            <div class="section-title">
                                                <h3 class="h6">{{ __('Appointment:') }}</h3>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>{{ __('Appointment date') }}</label>
                                                        <input class="datepicker" type="text" id="datepicker"
                                                            name="appointment_date" autocomplete="off" required="required"
                                                            value="{{ \Carbon\Carbon::today()->format('d-m-Y') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="check-box-div" id="timeSlotsContainer">

                                            </ul>
                                        </div>
                                        <div class="step-btns">
                                            <button type="button" name="BACK"
                                                class="action-button back btn-secondery btn ">
                                                {{ __('Back') }}
                                            </button>
                                            <button type="button" name="next" class="next action-button btn">
                                                {{ __('Next') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                @if ((!empty($files) && $files->value == 'on') || (!empty($custom_field) && $custom_field == 'on'))
                                    <div class="step-container">
                                        <div class="appointment-wrp">
                                            <h3>{{ __('Additional Details :') }}</h3>
                                            <div class="row">
                                                @foreach ($custom_fields as $custom_field)
                                                    <div class="col-md-6 col-12 form-group">
                                                        <label
                                                            for={{ $custom_field->label }}>{{ $custom_field->label }}</label>
                                                        @if ($custom_field->type === 'textfield')
                                                            <input type="text" name="values[{{ $custom_field->label }}]"
                                                                placeholder="Value" value="{{ $custom_field->value }}"
                                                                class="form-control">
                                                        @elseif($custom_field->type === 'textarea')
                                                            <textarea name="values[{{ $custom_field->label }}]" placeholder="Value" class=" form-control">{{ $custom_field->value }}</textarea>
                                                        @elseif($custom_field->type === 'date')
                                                            <input type="date" class="form-control "
                                                                name="values[{{ $custom_field->label }}]"
                                                                value="{{ $custom_field->value }}">
                                                        @elseif($custom_field->type === 'number')
                                                            <input type="number" class="form-control "
                                                                name="values[{{ $custom_field->label }}]"
                                                                placeholder="Value" value="{{ $custom_field->value }}">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>


                                            @if (!empty($files) && $files->value == 'on')
                                                <div class="row">
                                                    <div class="col-sm-3 col-12">
                                                        <div class="form-group">
                                                            {{ Form::label('attachment', $files->label) }}
                                                            <div class="chose-files" id="myfile">
                                                                <i class="ti ti-upload px-1"></i>
                                                                <span>{{ __('Choose file here') }}</span>
                                                                <input type="file" name="attachment" id="attachment"
                                                                    data-filename="attachment"
                                                                    placeholder="Choose file here">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="step-btns">
                                                <button type="button" name="back" class="back btn btn-transparent">
                                                    {{ __('Back') }}
                                                </button>
                                                <button type="button" name="next" class="next btn">
                                                    {{ __('Next') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="step-container final_stepss">
                                    <div class="appointment-wrp tab-wrp">
                                        <div class="tabs-wrapper">
                                            <div class="alert alert-danger flex align-center d-none" role="alert">
                                                <svg height="26" viewBox="0 0 128 128" width="26"
                                                    xmlns="http://www.w3.org/2000/svg" id="fi_4201973">
                                                    <g>
                                                        <path
                                                            d="m57.362 26.54-37.262 64.535a7.666 7.666 0 0 0 6.639 11.5h74.518a7.666 7.666 0 0 0 6.639-11.5l-37.258-64.535a7.665 7.665 0 0 0 -13.276 0z"
                                                            fill="#ee404c"></path>
                                                        <g fill="#fff7ed">
                                                            <rect height="29.377" rx="4.333" width="9.638"
                                                                x="59.181" y="46.444"></rect>
                                                            <circle cx="64" cy="87.428" r="4.819"></circle>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <div class="error-msg">

                                                </div>
                                            </div>
                                            <ul class="tabs">
                                                <li data-tab="new-user" class="active tab-link">
                                                    <a href="javascript:;">
                                                        <span>{{ __('1') }}</span>
                                                        {{ __('New Registration') }}
                                                    </a>
                                                </li>
                                                <li data-tab="existing-user" class="tab-link">
                                                    <a href="javascript:;">
                                                        <span>{{ __('2') }}</span>
                                                        {{ __('Already Have Account') }}
                                                    </a>
                                                </li>
                                                <li data-tab="guest-user" class="tab-link">
                                                    <a href="javascript:;">
                                                        <span>{{ __('3') }}</span>
                                                        {{ __('Guest Booking') }}
                                                    </a>
                                                </li>
                                            </ul>
                                            <input type="hidden" name="type" id="selected_tab" value="new-user">
                                            <div class="tabs-container">
                                                <div id="new-user" class="tab-content active appointment-form">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Name') }}</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" placeholder="Your name">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Email') }}</label>
                                                                <input type="email" class="form-control" name="email"
                                                                    id="email" placeholder="Your email">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Password') }}</label>
                                                                <input type="password" class="form-control"
                                                                    name="password" id="password"
                                                                    placeholder="Your password">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Contact') }}</label>
                                                                <input type="number" class="form-control" name="contact"
                                                                    id="contact" placeholder="Phone number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="existing-user" class="tab-content appointment-form">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Email') }}</label>
                                                                <input type="email" class="form-control" name="email"
                                                                    id="email" placeholder="Your email">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Password') }}</label>
                                                                <input type="password" class="form-control"
                                                                    name="password" id="password"
                                                                    placeholder="Your password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="guest-user" class="tab-content appointment-form">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Name') }}</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" placeholder="Your name">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Email') }}</label>
                                                                <input type="email" class="form-control" name="email"
                                                                    id="email" placeholder="Your email">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Contact') }}</label>
                                                                <input type="number" class="form-control" name="contact"
                                                                    id="contact" placeholder="Phone number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="step-btns">
                                            <button type="button" name="BACK" class="back btn btn-transparent">
                                                {{ __('Back') }}
                                            </button>
                                            <button type="button" name="next" class="next btn">
                                                {{ __('Next') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="step-container">
                                    <div class="appointment-wrp">
                                        <div class="appointment-form payment-method-form">
                                            <div class="section-title">
                                                <h3>{{ __('Payment:') }}</h3>
                                                <div class="flex appointment_info_details">
                                                    <p class="h6" id="serviceAmount"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-lg-4 col-12">
                                                    <div class="radio-group">
                                                        <input class="form-check-input payment_method"
                                                            name="payment_method" type="radio" id="manually"
                                                            data-payment="manually"
                                                            data-payment-action="{{ route('appointment.form.submit') }}">
                                                        <label for="manually">
                                                            <div class="radio-img">
                                                                <img src="{{ asset('assets/images/cod.png') }}"
                                                                    alt="paypal">
                                                            </div>
                                                            <p>{{ __('manually') }}</p>
                                                        </label>
                                                    </div>
                                                </div>
                                                @stack('appointment_payment')
                                            </div>
                                        </div>
                                        <div class="step-btns finle-step-btn flex align-center ">
                                            @stack('apply_coupon')
                                            <div class="step-btn-wrapper">
                                                <button type="button" name="back"
                                                    class="back btn btn-transparent">{{ __('Back') }}</button>
                                                <button type="submit" name="submit" class="btn appointment_payment">{{ __('Finish') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="step-container" id="final_step">
                                    <div class="appointment-wrp">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <span>
                                                        <svg id="fi_13965236" enable-background="new 0 0 100 100"
                                                            viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"
                                                            width="20px">
                                                            <path
                                                                d="m92.8660965 38.8007011c-1.4883041-1.4884987-2.6493912-3.2300644-3.4410553-5.1301155-.7916718-1.9000511-1.2033539-3.9583321-1.2033539-6.0588779 0-4.3804531-1.7733231-8.3284779-4.6339035-11.1995583-2.8710785-2.8605137-6.8189087-4.6337748-11.1994247-4.6337748-4.2010956 0-8.2227554-1.66786-11.1889305-4.6443415-3.0927697-3.0929631-7.1460686-4.6340331-11.1994286-4.6340331-4.053299 0-8.1066589 1.54107-11.1994286 4.6340332-1.4883041 1.4882402-3.2299995 2.6491966-5.1299858 3.4408636s-3.9583321 1.2034779-6.0588779 1.2034779c-4.3805809 0-8.3283482 1.7732611-11.1994934 4.6337748-2.8605137 2.8710804-4.6338396 6.8191051-4.6338396 11.1995583 0 2.1005459-.4116821 4.1588268-1.2033482 6.0588779-.791667 1.9000511-1.952817 3.6416168-3.4411216 5.1301155-3.0927701 3.0927047-4.6339042 7.145874-4.6339042 11.1992988 0 4.0531693 1.5411341 8.1065941 4.6339045 11.1992989 1.4883046 1.4884987 2.6494546 3.2300606 3.4411216 5.1301155.791666 1.9000473 1.2033482 3.9583359 1.2033482 6.058876 0 4.380455 1.7733259 8.328476 4.6338396 11.1995621 2.8711452 2.8605118 6.8189125 4.6337738 11.1994934 4.6337738 2.1005459 0 4.1588917.4118118 6.0588779 1.203476s3.6416817 1.9526215 5.1299858 3.4408646c3.0927694 3.0929641 7.1461293 4.6340331 11.1994283 4.6340331 4.05336 0 8.1066589-1.541069 11.1994286-4.6340332 1.488369-1.4882431 3.2300606-2.6492004 5.1300468-3.4408646s3.9583359-1.203476 6.0588837-1.203476c4.3805161 0 8.3283463-1.773262 11.1994247-4.6337738 2.8605804-2.8710861 4.6339035-6.8191071 4.6339035-11.1995621 0-2.1005402.4116821-4.1588287 1.2033539-6.058876.7916641-1.9000549 1.9527512-3.6416168 3.4410553-5.1301155 3.0928345-3.0927047 4.6339035-7.1461295 4.6339035-11.1992988 0-4.0534248-1.541069-8.1065941-4.6339035-11.1992989zm-19.8655014.1476632-28.0672493 28.0673141c-.7916679.7916641-1.8683548 1.2349167-2.9872398 1.2349167s-2.1955109-.4432526-2.987175-1.2349167l-11.9594632-11.9595261c-1.6466637-1.6467285-1.6466637-4.3173141 0-5.9746094 1.6466637-1.6464691 4.3277512-1.6464691 5.9744167 0l8.9722214 8.9830475 25.0800095-25.0802689c1.6466675-1.646471 4.3278198-1.646471 5.9744797 0 1.6466675 1.6467286 1.6466675 4.3173142 0 5.9640428z">
                                                            </path>
                                                        </svg>
                                                        <label id="appointment_number"></label>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="step-btns">
                                            @stack('iCal_exports')
                                            <a href="{{ route('appointments.form', ['slug' => $slug, 'appointment' => '']) }}"
                                                class="btn btn-transparent">{{ __('Book an Appointment') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @stack('calculate_tax')
                                @stack('flexible_price')
                                <input type="hidden" name="business_id" value="{{ $business->id }}">
                                <input type="hidden" name="payment" value="manually">

                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection

@push('script')
@endpush
