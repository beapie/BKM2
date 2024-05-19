@extends('form_layout.layout')
@section('form_content')
    <main>
        <section class="appointment-sec align-center pt pb">
            <div class="container">
                <div class="form-wrapper">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-left">
                                <img src="{{ asset('form_layouts/' . $business->layouts . '/images/form-nine-img1.png') }}"class="bg bg-1"
                                    alt="bg-image">

                                <img src="{{ asset('form_layouts/' . $business->layouts . '/images/form-nine-img2.png') }}"
                                    class="bg bg-2" alt="bg-image">
                                <div class="section-title">
                                    <h2>{{ __('Make an') }} <b>{{ __('Appointment') }}</b></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <div class="form-right">
                                <div class="steps">
                                    <ul>
                                        <li class="stapes_status active">
                                            <div class="steps-icon">
                                                <span class="arrow">
                                                    <svg class="vector" width="24" height="17" viewBox="0 0 24 17"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M22.9182 0.914928C23.4714 1.46818 23.4714 2.36515 22.9182 2.91841L9.4599 16.3767C8.90666 16.9299 8.00968 16.9299 7.45643 16.3767L1.08143 10.0017C0.528195 9.44852 0.528195 8.55148 1.08143 7.99827C1.63468 7.44507 2.53166 7.44507 3.08491 7.99827L8.45817 13.3715L20.9148 0.914928C21.468 0.361691 22.365 0.361691 22.9182 0.914928Z"
                                                            fill="#C0D7F9" />
                                                    </svg>
                                                </span>
                                                <span class="service-svg">
                                                    <svg class="vuesax-bold-setting-22" width="28" height="28"
                                                        viewBox="0 0 28 28" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M23.4502 10.756C21.3385 10.756 20.4752 9.26269 21.5252 7.43102C22.1318 6.36936 21.7702 5.01602 20.7085 4.40936L18.6902 3.25436C17.7685 2.70602 16.5785 3.03269 16.0302 3.95436L15.9018 4.17602C14.8518 6.00769 13.1252 6.00769 12.0635 4.17602L11.9352 3.95436C11.4102 3.03269 10.2202 2.70602 9.2985 3.25436L7.28016 4.40936C6.2185 5.01602 5.85683 6.38102 6.4635 7.44269C7.52516 9.26269 6.66183 10.756 4.55016 10.756C3.33683 10.756 2.3335 11.7477 2.3335 12.9727V15.026C2.3335 16.2394 3.32516 17.2427 4.55016 17.2427C6.66183 17.2427 7.52516 18.736 6.4635 20.5677C5.85683 21.6294 6.2185 22.9827 7.28016 23.5894L9.2985 24.7444C10.2202 25.2927 11.4102 24.966 11.9585 24.0444L12.0868 23.8227C13.1368 21.991 14.8635 21.991 15.9252 23.8227L16.0535 24.0444C16.6018 24.966 17.7918 25.2927 18.7135 24.7444L20.7318 23.5894C21.7935 22.9827 22.1552 21.6177 21.5485 20.5677C20.4868 18.736 21.3502 17.2427 23.4618 17.2427C24.6752 17.2427 25.6785 16.251 25.6785 15.026V12.9727C25.6668 11.7594 24.6752 10.756 23.4502 10.756ZM14.0002 17.791C11.9118 17.791 10.2085 16.0877 10.2085 13.9994C10.2085 11.911 11.9118 10.2077 14.0002 10.2077C16.0885 10.2077 17.7918 11.911 17.7918 13.9994C17.7918 16.0877 16.0885 17.791 14.0002 17.791Z"
                                                            fill="white" />
                                                    </svg>
                                                </span>
                                            </div>
                                            {{ __('Service') }}
                                        </li>
                                        <li class="stapes_status">
                                            <div class="steps-icon">
                                                <span class="arrow">
                                                    <svg class="vector" width="24" height="17" viewBox="0 0 24 17"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M22.9182 0.914928C23.4714 1.46818 23.4714 2.36515 22.9182 2.91841L9.4599 16.3767C8.90666 16.9299 8.00968 16.9299 7.45643 16.3767L1.08143 10.0017C0.528195 9.44852 0.528195 8.55148 1.08143 7.99827C1.63468 7.44507 2.53166 7.44507 3.08491 7.99827L8.45817 13.3715L20.9148 0.914928C21.468 0.361691 22.365 0.361691 22.9182 0.914928Z"
                                                            fill="#C0D7F9" />
                                                    </svg>
                                                </span>
                                                <span class="service-svg">
                                                    <svg class="vuesax-bold-clock2" width="28" height="28"
                                                        viewBox="0 0 28 28" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.0002 2.33301C7.57183 2.33301 2.3335 7.57134 2.3335 13.9997C2.3335 20.428 7.57183 25.6663 14.0002 25.6663C20.4285 25.6663 25.6668 20.428 25.6668 13.9997C25.6668 7.57134 20.4285 2.33301 14.0002 2.33301ZM19.0752 18.1647C18.9118 18.4447 18.6202 18.5963 18.3168 18.5963C18.1652 18.5963 18.0135 18.5613 17.8735 18.468L14.2568 16.3097C13.3585 15.773 12.6935 14.5947 12.6935 13.5563V8.77301C12.6935 8.29467 13.0902 7.89801 13.5685 7.89801C14.0468 7.89801 14.4435 8.29467 14.4435 8.77301V13.5563C14.4435 13.9763 14.7935 14.5947 15.1552 14.8047L18.7718 16.963C19.1918 17.208 19.3318 17.7447 19.0752 18.1647Z"
                                                            fill="white" />
                                                    </svg>
                                                </span>
                                            </div>
                                            {{ __('Pick a Time') }}
                                        </li>
                                        @if ((!empty($files) && $files->value == 'on') || (!empty($custom_field) && $custom_field == 'on'))
                                            <li class="stapes_status">
                                                <div class="steps-icon">
                                                    <span class="arrow">
                                                        <svg class="vector" width="24" height="17"
                                                            viewBox="0 0 24 17" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M22.9182 0.914928C23.4714 1.46818 23.4714 2.36515 22.9182 2.91841L9.4599 16.3767C8.90666 16.9299 8.00968 16.9299 7.45643 16.3767L1.08143 10.0017C0.528195 9.44852 0.528195 8.55148 1.08143 7.99827C1.63468 7.44507 2.53166 7.44507 3.08491 7.99827L8.45817 13.3715L20.9148 0.914928C21.468 0.361691 22.365 0.361691 22.9182 0.914928Z"
                                                                fill="#C0D7F9" />
                                                        </svg>
                                                    </span>
                                                    <span class="service-svg">
                                                        <svg class="vector" width="22" height="24"
                                                            viewBox="0 0 22 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15.6667 0.333008H6.33333C2.25 0.333008 0.5 2.66634 0.5 6.16634V17.833C0.5 21.333 2.25 23.6663 6.33333 23.6663H15.6667C19.75 23.6663 21.5 21.333 21.5 17.833V6.16634C21.5 2.66634 19.75 0.333008 15.6667 0.333008ZM6.33333 12.2913H11C11.4783 12.2913 11.875 12.688 11.875 13.1663C11.875 13.6447 11.4783 14.0413 11 14.0413H6.33333C5.855 14.0413 5.45833 13.6447 5.45833 13.1663C5.45833 12.688 5.855 12.2913 6.33333 12.2913ZM15.6667 18.708H6.33333C5.855 18.708 5.45833 18.3113 5.45833 17.833C5.45833 17.3547 5.855 16.958 6.33333 16.958H15.6667C16.145 16.958 16.5417 17.3547 16.5417 17.833C16.5417 18.3113 16.145 18.708 15.6667 18.708ZM18.5833 8.79134H16.25C14.4767 8.79134 13.0417 7.35634 13.0417 5.58301V3.24967C13.0417 2.77134 13.4383 2.37467 13.9167 2.37467C14.395 2.37467 14.7917 2.77134 14.7917 3.24967V5.58301C14.7917 6.38801 15.445 7.04134 16.25 7.04134H18.5833C19.0617 7.04134 19.4583 7.43801 19.4583 7.91634C19.4583 8.39468 19.0617 8.79134 18.5833 8.79134Z"
                                                                fill="white" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                {{ __('Additional Details') }}
                                            </li>
                                        @endif

                                        <li class="stapes_status">
                                            <div class="steps-icon">
                                                <span class="arrow">
                                                    <svg class="vector" width="24" height="17" viewBox="0 0 24 17"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M22.9182 0.914928C23.4714 1.46818 23.4714 2.36515 22.9182 2.91841L9.4599 16.3767C8.90666 16.9299 8.00968 16.9299 7.45643 16.3767L1.08143 10.0017C0.528195 9.44852 0.528195 8.55148 1.08143 7.99827C1.63468 7.44507 2.53166 7.44507 3.08491 7.99827L8.45817 13.3715L20.9148 0.914928C21.468 0.361691 22.365 0.361691 22.9182 0.914928Z"
                                                            fill="#C0D7F9" />
                                                    </svg>
                                                </span>
                                                <span class="service-svg">
                                                    <svg class="vector" width="22" height="24" viewBox="0 0 22 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M15.6667 0.333008H6.33333C2.25 0.333008 0.5 2.66634 0.5 6.16634V17.833C0.5 21.333 2.25 23.6663 6.33333 23.6663H15.6667C19.75 23.6663 21.5 21.333 21.5 17.833V6.16634C21.5 2.66634 19.75 0.333008 15.6667 0.333008ZM6.33333 12.2913H11C11.4783 12.2913 11.875 12.688 11.875 13.1663C11.875 13.6447 11.4783 14.0413 11 14.0413H6.33333C5.855 14.0413 5.45833 13.6447 5.45833 13.1663C5.45833 12.688 5.855 12.2913 6.33333 12.2913ZM15.6667 18.708H6.33333C5.855 18.708 5.45833 18.3113 5.45833 17.833C5.45833 17.3547 5.855 16.958 6.33333 16.958H15.6667C16.145 16.958 16.5417 17.3547 16.5417 17.833C16.5417 18.3113 16.145 18.708 15.6667 18.708ZM18.5833 8.79134H16.25C14.4767 8.79134 13.0417 7.35634 13.0417 5.58301V3.24967C13.0417 2.77134 13.4383 2.37467 13.9167 2.37467C14.395 2.37467 14.7917 2.77134 14.7917 3.24967V5.58301C14.7917 6.38801 15.445 7.04134 16.25 7.04134H18.5833C19.0617 7.04134 19.4583 7.43801 19.4583 7.91634C19.4583 8.39468 19.0617 8.79134 18.5833 8.79134Z"
                                                            fill="white" />
                                                    </svg>
                                                </span>
                                            </div>
                                            {{ __('Share Your Details') }}
                                        </li>

                                        <li class="stapes_status">
                                            <div class="steps-icon">
                                                <span class="arrow">
                                                    <svg class="vector" width="24" height="17" viewBox="0 0 24 17"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M22.9182 0.914928C23.4714 1.46818 23.4714 2.36515 22.9182 2.91841L9.4599 16.3767C8.90666 16.9299 8.00968 16.9299 7.45643 16.3767L1.08143 10.0017C0.528195 9.44852 0.528195 8.55148 1.08143 7.99827C1.63468 7.44507 2.53166 7.44507 3.08491 7.99827L8.45817 13.3715L20.9148 0.914928C21.468 0.361691 22.365 0.361691 22.9182 0.914928Z"
                                                            fill="#C0D7F9" />
                                                    </svg>
                                                </span>
                                                <span class="service-svg">
                                                    <span>
                                                        <svg class="vuesax-linear-cards" width="40" height="40"
                                                            viewBox="0 0 40 40" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.33325 21.0166H31.6666" stroke="#666666"
                                                                stroke-width="1.6" stroke-miterlimit="10"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M31.6666 17.1332V29.0498C31.6166 33.7998 30.3165 34.9998 25.3665 34.9998H9.6333C4.59997 34.9998 3.33325 33.7498 3.33325 28.7832V17.1332C3.33325 12.6332 4.38325 11.1832 8.33325 10.9498C8.73325 10.9332 9.16663 10.9165 9.6333 10.9165H25.3665C30.3999 10.9165 31.6666 12.1665 31.6666 17.1332Z"
                                                                stroke="#666666" stroke-width="1.6"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M36.6666 11.2167V22.8667C36.6666 27.3667 35.6166 28.8167 31.6666 29.05V17.1333C31.6666 12.1667 30.3999 10.9167 25.3665 10.9167H9.6333C9.16663 10.9167 8.73325 10.9333 8.33325 10.95C8.38325 6.2 9.6833 5 14.6333 5H30.3665C35.3999 5 36.6666 6.25 36.6666 11.2167Z"
                                                                stroke="#666666" stroke-width="1.6"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M8.75 29.6831H11.6166" stroke="#666666"
                                                                stroke-width="1.6" stroke-miterlimit="10"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M15.1833 29.6831H20.9167" stroke="#666666"
                                                                stroke-width="1.6" stroke-miterlimit="10"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                </span>
                                            </div>
                                            {{ __('Payment') }}
                                        </li>
                                        <li class="stapes_status">
                                            <div class="steps-icon">
                                                <span class="arrow">
                                                    <svg class="vector" width="24" height="17"
                                                        viewBox="0 0 24 17" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M22.9182 0.914928C23.4714 1.46818 23.4714 2.36515 22.9182 2.91841L9.4599 16.3767C8.90666 16.9299 8.00968 16.9299 7.45643 16.3767L1.08143 10.0017C0.528195 9.44852 0.528195 8.55148 1.08143 7.99827C1.63468 7.44507 2.53166 7.44507 3.08491 7.99827L8.45817 13.3715L20.9148 0.914928C21.468 0.361691 22.365 0.361691 22.9182 0.914928Z"
                                                            fill="#C0D7F9" />
                                                    </svg>
                                                </span>
                                                <span class="service-svg">
                                                    <span>
                                                        <svg class="white-svg" width="100" height="100"
                                                            viewBox="0 0 100 100" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_294_43)">
                                                                <path
                                                                    d="M72.1024 34.1347C73.6282 35.6606 73.6282 38.134 72.1024 39.6591L45.8969 65.8653C44.371 67.3904 41.8983 67.3904 40.3725 65.8653L27.8976 53.3897C26.3718 51.8646 26.3718 49.3912 27.8976 47.8661C29.4228 46.3402 31.8962 46.3402 33.4213 47.8661L43.1343 57.579L66.5779 34.1347C68.1038 32.6096 70.5772 32.6096 72.1024 34.1347ZM100 50C100 77.6375 77.6337 100 50 100C22.3625 100 0 77.6337 0 50C0 22.3625 22.3663 0 50 0C77.6375 0 100 22.3663 100 50ZM92.1875 50C92.1875 26.6808 73.3162 7.8125 50 7.8125C26.6808 7.8125 7.8125 26.6838 7.8125 50C7.8125 73.3192 26.6838 92.1875 50 92.1875C73.3192 92.1875 92.1875 73.3162 92.1875 50Z"
                                                                    fill="white" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_294_43">
                                                                    <rect width="100" height="100" fill="white" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </span>
                                                </span>
                                            </div>
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
                                                <h3>{{ __('Please Select Services:') }}</h3>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <select id="serviceSelect" name="service">
                                                                <option value="" disabled selected>
                                                                    {{ __('Select services') }}
                                                                </option>
                                                                @foreach ($services as $key => $service)
                                                                    <option value="{{ $service->id }}" class="service">
                                                                        {{ $service->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <select id="locationSelect" name="location">
                                                                <option value="" disabled selected>
                                                                    {{ __('Select location') }}
                                                                </option>
                                                                @foreach ($locations as $ke => $location)
                                                                    <option value="{{ $location->id }}">
                                                                        {{ $location->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <select id="staffSelect" name="staff">
                                                                <option value="" disabled selected>
                                                                    {{ __('Select staff') }}
                                                                </option>
                                                                {{-- @foreach ($staffs as $k => $staff)
                                                                    <option value="{{ $staff->user->id }}">
                                                                        {{ $staff->name }}
                                                                    </option>
                                                                @endforeach --}}
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="step-btns">
                                                <button type="button" name="next" class="next btn">
                                                    {{ __('Next') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="step-container">
                                        <div class="appointment-wrp">
                                            <div class="appointment-form">
                                                <h3>{{ __('Appointment:') }}</h3>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <input class="datepicker" type="text" id="datepicker"
                                                                name="appointment_date" autocomplete="off"
                                                                required="required"
                                                                value="{{ \Carbon\Carbon::today()->format('d-m-Y') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="check-box-div" id="timeSlotsContainer">

                                                </ul>

                                            </div>
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

                                    @if ((!empty($files) && $files->value == 'on') || (!empty($custom_field) && $custom_field == 'on'))
                                        <div class="step-container">
                                            <div class="appointment-wrp">
                                                <div class="appointment-form">
                                                    <h3>{{ __('Additional Details :') }}</h3>
                                                    <div class="row">
                                                        @foreach ($custom_fields as $custom_field)
                                                            <div class="col-md-6 col-12 form-group">
                                                                <label
                                                                    for={{ $custom_field->label }}>{{ $custom_field->label }}</label>
                                                                @if ($custom_field->type === 'textfield')
                                                                    <input type="text"
                                                                        name="values[{{ $custom_field->label }}]"
                                                                        placeholder="Value"
                                                                        value="{{ $custom_field->value }}"
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
                                                                        placeholder="Value"
                                                                        value="{{ $custom_field->value }}">
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
                                                                        <input type="file" name="attachment"
                                                                            id="attachment" data-filename="attachment"
                                                                            placeholder="Choose file here">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="step-btns">
                                                    <button type="button" name="back"
                                                        class="back btn btn-transparent">
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
                                                <div class="tabs-wrapper">
                                                    <div class="alert alert-danger flex align-center d-none"
                                                        role="alert">
                                                        <svg height="26" viewBox="0 0 128 128" width="26"
                                                            xmlns="http://www.w3.org/2000/svg" id="fi_4201973">
                                                            <g>
                                                                <path
                                                                    d="m57.362 26.54-37.262 64.535a7.666 7.666 0 0 0 6.639 11.5h74.518a7.666 7.666 0 0 0 6.639-11.5l-37.258-64.535a7.665 7.665 0 0 0 -13.276 0z"
                                                                    fill="#ee404c"></path>
                                                                <g fill="#fff7ed">
                                                                    <rect height="29.377" rx="4.333" width="9.638"
                                                                        x="59.181" y="46.444"></rect>
                                                                    <circle cx="64" cy="87.428" r="4.819">
                                                                    </circle>
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
                                                    <input type="hidden" name="type" id="selected_tab"
                                                        value="new-user">
                                                    <div class="tabs-container">
                                                        <div id="new-user" class="tab-content active">
                                                            <div class="appointment-form">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                placeholder="Your name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <input type="email" class="form-control"
                                                                                name="email" id="email"
                                                                                placeholder="Your email">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <input type="password" class="form-control"
                                                                                name="password" id="password"
                                                                                placeholder="Your password">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <input type="number" class="form-control"
                                                                                name="contact" id="contact"
                                                                                placeholder="Phone number">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="existing-user" class="tab-content">
                                                            <div class="appointment-form">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <input type="email" class="form-control"
                                                                                name="email" id="email"
                                                                                placeholder="Your email">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <input type="password" class="form-control"
                                                                                name="password" id="password"
                                                                                placeholder="Your password">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="guest-user" class="tab-content">
                                                            <div class="appointment-form">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                placeholder="Your name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <input type="email" class="form-control"
                                                                                name="email" id="email"
                                                                                placeholder="Your email">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <input type="number" class="form-control"
                                                                                name="contact" id="contact"
                                                                                placeholder="Phone number">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="step-btns">
                                                    <button type="button" name="BACK"
                                                        class="back btn btn-transparent">
                                                        {{ __('Back') }}
                                                    </button>
                                                    <button type="button" name="next" class="next btn">
                                                        {{ __('Next') }}
                                                    </button>
                                                </div>
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

                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>
@endsection

@push('script')
@endpush
