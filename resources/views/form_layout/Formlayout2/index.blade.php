@extends('form_layout.layout')
@section('form_content')
    <main>
        <section class="appointment-sec align-center pt pb">
            <div class="container">
                <div class="section-title text-center">
                    <h2>{{ __('Book an') }} <b>{{ $business->name }}</b> {{ __('Appointment') }}</h2>
                </div>
                <div class="form-wrapper">
                    <div class="row">
                        <div class="col-lg-5 col-md-4 col-12">
                            <div class="form-left">
                                <div class="form-image">
                                    <img src="{{ asset('form_layouts/Formlayout2/images/' . $business->theme_color . '.png') }}"
                                        alt="form-image" loading="lazy">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-8 col-12">
                            <div class="form-right">
                                <div class="steps">
                                    <ul>
                                        <li class="stapes_statusactive">
                                            <span>
                                                <svg width="23" height="29" viewBox="0 0 23 29" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M22.085 23.5459C21.4406 21.6278 18.8719 20.4272 17.0406 19.6224C16.3231 19.3081 14.3369 18.775 14.0982 17.8716C14.0127 17.5462 14.0242 17.2393 14.0943 16.9452C13.9839 16.9664 13.8719 16.9788 13.7561 16.9788H12.5628C11.6102 16.9788 10.8361 16.2038 10.8361 15.2518C10.8361 14.3004 11.6105 13.527 12.5628 13.527H13.7561C14.1503 13.527 14.5241 13.6604 14.8255 13.8985C15.2674 13.8396 15.6937 13.7452 16.0911 13.6214C16.613 12.528 17.0201 11.2204 17.1113 10.095C17.5007 5.27963 14.5487 2.46235 10.3161 2.94939C7.23864 3.30363 5.40023 5.59835 5.20151 8.55259C5.00055 11.5638 6.11704 13.7878 7.30296 15.4192C7.82232 16.1324 8.36791 16.591 8.28407 17.4505C8.18679 18.4668 7.10008 18.75 6.3228 19.0624C5.40184 19.4323 4.40983 19.9936 3.94135 20.2531C2.32759 21.1443 0.556395 22.2176 0.158315 23.6857C-0.723285 26.9395 2.254 27.9251 4.71192 28.3801C6.82136 28.7692 9.19992 28.8 11.1564 28.8C14.6953 28.8 21.0588 28.6582 22.085 25.998C22.3769 25.2432 22.2518 24.0403 22.085 23.5459Z"
                                                        fill="#777777" />
                                                    <path
                                                        d="M14.5113 14.7658C14.3494 14.519 14.0726 14.3552 13.7568 14.3552H12.5635C12.0656 14.3552 11.664 14.7574 11.664 15.2528C11.664 15.7501 12.0656 16.153 12.5635 16.153H13.7568C14.1053 16.153 14.4009 15.9542 14.5501 15.6669C16.2137 15.536 17.6608 15.0278 18.6765 14.2774C18.9097 14.4278 19.1856 14.5158 19.4832 14.5158H19.5581C20.3875 14.5158 21.0582 13.8445 21.0582 13.0141V10.0163C21.0582 9.4192 20.7081 8.904 20.2032 8.66464C19.983 3.85088 15.9981 0 11.1302 0C6.26238 0 2.27678 3.85088 2.05758 8.66464C1.55166 8.90432 1.2019 9.4192 1.2019 10.0163V13.0141C1.2019 13.8445 1.87326 14.5158 2.70078 14.5158H2.77662C3.60478 14.5158 4.27646 13.8445 4.27646 13.0141V10.0163C4.27646 9.42784 3.9363 8.92032 3.4419 8.67488C3.65598 4.61888 7.02174 1.38592 11.1302 1.38592C15.2371 1.38592 18.6045 4.61888 18.8176 8.67488C18.3238 8.92064 17.984 9.42784 17.984 10.0163V13.0141C17.984 13.2131 18.0227 13.3984 18.0909 13.5715C17.2166 14.1971 15.944 14.6429 14.5113 14.7658Z"
                                                        fill="#777777" />
                                                </svg>
                                            </span>
                                            {{ __('Service') }}
                                        </li>
                                        <li class="stapes_status">
                                            <span>
                                                <svg class="group-1000001935" width="32" height="32"
                                                    viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M21.7012 18.8256L17.2395 15.4793V8.66296C17.2395 7.97758 16.6855 7.42358 16.0001 7.42358C15.3147 7.42358 14.7607 7.97758 14.7607 8.66296V16.0991C14.7607 16.4895 14.9442 16.8576 15.2565 17.0906L20.2139 20.8086C20.4369 20.976 20.6972 21.0565 20.9562 21.0565C21.3342 21.0565 21.7061 20.8867 21.949 20.5595C22.3606 20.0129 22.249 19.2358 21.7012 18.8256Z"
                                                        fill="#777777" />
                                                    <path
                                                        d="M16 0C7.17706 0 0 7.17706 0 16C0 24.8229 7.17706 32 16 32C24.8229 32 32 24.8229 32 16C32 7.17706 24.8229 0 16 0ZM16 29.5213C8.54531 29.5213 2.47869 23.4547 2.47869 16C2.47869 8.54531 8.54531 2.47869 16 2.47869C23.4559 2.47869 29.5213 8.54531 29.5213 16C29.5213 23.4547 23.4547 29.5213 16 29.5213Z"
                                                        fill="#777777" />
                                                </svg>
                                            </span>
                                            {{ __('Pick a Time') }}
                                        </li>
                                        @if ((!empty($files) && $files->value == 'on') || (!empty($custom_field) && $custom_field == 'on'))
                                            <li class="stapes_status">
                                                <span>
                                                    <svg width="100" height="100" viewBox="0 0 100 100" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_293_32)">
                                                            <path
                                                                d="M60.7429 43.3594C51.2657 43.3594 43.5554 51.0696 43.5554 60.5469C43.5554 70.0241 51.2657 77.7344 60.7429 77.7344C70.2202 77.7344 77.9304 70.0241 77.9304 60.5469C77.9304 51.0696 70.2202 43.3594 60.7429 43.3594ZM60.7429 73.8281C53.4195 73.8281 47.4617 67.8703 47.4617 60.5469C47.4617 53.2234 53.4195 47.2656 60.7429 47.2656C68.0664 47.2656 74.0242 53.2234 74.0242 60.5469C74.0242 67.8703 68.0664 73.8281 60.7429 73.8281Z"
                                                                fill="#777777" />
                                                            <path
                                                                d="M98.2552 88.694L82.7545 73.1926C84.903 69.4672 86.1336 65.1482 86.1336 60.5469C86.1336 53.756 83.4534 47.58 79.0962 43.0191V21.0915C79.0947 21.0915 79.0932 21.0915 79.0917 21.0915C79.0917 20.5833 78.8979 20.0844 78.5248 19.7105L59.3864 0.572205C59.0126 0.198364 58.5129 0.00534059 58.0048 0.00534059C58.0048 0.00305176 58.0048 0.00228883 58.0055 0H6.05469C2.82364 0 0.195312 2.62833 0.195312 5.85938V94.1406C0.195312 97.3717 2.82364 100 6.05469 100H73.2376C76.4679 100 79.097 97.3717 79.097 94.1406V88.2675L88.8893 98.0606C90.1802 99.3515 91.8762 99.9969 93.573 99.9969C95.269 99.9969 96.965 99.3515 98.2559 98.0606C100.838 95.4781 100.838 91.2766 98.2552 88.694ZM60.743 82.0312C48.8968 82.0312 39.2586 72.393 39.2586 60.5469C39.2586 48.7007 48.8968 39.0625 60.743 39.0625C72.5891 39.0625 82.2273 48.7007 82.2273 60.5469C82.2273 72.393 72.5891 82.0312 60.743 82.0312ZM59.9587 6.66885L72.4281 19.1391H61.9118C60.8345 19.1391 59.9587 18.2625 59.9587 17.186V6.66885ZM75.1907 94.1406C75.1907 95.2179 74.3141 96.0938 73.2376 96.0938H6.05469C4.97742 96.0938 4.10156 95.2179 4.10156 94.1406V5.85938C4.10156 4.7821 4.97742 3.90625 6.05469 3.90625H56.0524V17.1852C56.0524 20.4163 58.6807 23.0446 61.9118 23.0446H75.19V39.6797C71.0869 36.8294 66.1072 35.1562 60.743 35.1562C46.7423 35.1562 35.3523 46.5462 35.3523 60.5469C35.3523 63.2805 35.7887 65.9149 36.5921 68.3846H12.7251C11.647 68.3846 10.7719 69.2589 10.7719 70.3377C10.7719 71.4157 11.647 72.2908 12.7251 72.2908H37.6656C37.8494 72.2908 38.028 72.2633 38.1966 72.2153C42.4294 80.3604 50.9468 85.9375 60.743 85.9375C65.3435 85.9375 69.6625 84.7069 73.3879 82.5584L75.1907 84.3613V94.1406ZM95.4933 95.298C94.4344 96.3577 92.7109 96.3577 91.6519 95.298L76.664 80.3101C78.0769 79.1695 79.3648 77.8816 80.5054 76.4687L95.4933 91.4558C96.553 92.5156 96.553 94.239 95.4933 95.298Z"
                                                                fill="#777777" />
                                                            <path
                                                                d="M60.7429 51.7588C59.6641 51.7588 58.7898 52.6331 58.7898 53.7119C58.7898 54.7907 59.6641 55.665 60.7429 55.665C63.4346 55.665 65.625 57.8554 65.625 60.5471C65.625 61.6259 66.4993 62.5002 67.5781 62.5002C68.6569 62.5002 69.5312 61.6259 69.5312 60.5471C69.5312 55.7009 65.5891 51.7588 60.7429 51.7588Z"
                                                                fill="#777777" />
                                                            <path
                                                                d="M30.3025 54.8428H12.7251C11.6471 54.8428 10.772 55.7171 10.772 56.7959C10.772 57.8747 11.6471 58.749 12.7251 58.749H30.3025C31.3813 58.749 32.2556 57.8747 32.2556 56.7959C32.2556 55.7171 31.3813 54.8428 30.3025 54.8428Z"
                                                                fill="#777777" />
                                                            <path
                                                                d="M31.4598 41.3008H12.7251C11.6471 41.3008 10.772 42.1751 10.772 43.2539C10.772 44.3319 11.6471 45.207 12.7251 45.207H31.4598C32.5386 45.207 33.413 44.3319 33.413 43.2539C33.413 42.1751 32.5386 41.3008 31.4598 41.3008Z"
                                                                fill="#777777" />
                                                            <path
                                                                d="M37.3047 81.9258C36.7905 81.9258 36.2869 82.1341 35.9238 82.498C35.5606 82.8611 35.3516 83.3647 35.3516 83.8789C35.3516 84.3924 35.5606 84.8967 35.9238 85.2591C36.2869 85.623 36.7905 85.832 37.3047 85.832C37.8181 85.832 38.3224 85.623 38.6871 85.2591C39.0503 84.8967 39.2578 84.3924 39.2578 83.8789C39.2578 83.3647 39.0503 82.8611 38.6871 82.498C38.3224 82.1341 37.8181 81.9258 37.3047 81.9258Z"
                                                                fill="#777777" />
                                                            <path
                                                                d="M29.2832 81.9258H12.7251C11.6471 81.9258 10.772 82.8001 10.772 83.8789C10.772 84.9569 11.6471 85.832 12.7251 85.832H29.2832C30.3612 85.832 31.2363 84.9569 31.2363 83.8789C31.2363 82.8001 30.362 81.9258 29.2832 81.9258Z"
                                                                fill="#777777" />
                                                            <path
                                                                d="M12.7244 31.666C13.2401 31.666 13.7421 31.457 14.1053 31.0938C14.4707 30.7284 14.6775 30.2271 14.6775 29.7129C14.6775 29.1994 14.4707 28.6959 14.1053 28.3304C13.7421 27.9673 13.2378 27.7598 12.7244 27.7598C12.2109 27.7598 11.7089 27.9673 11.3434 28.3304C10.9803 28.6936 10.7712 29.1971 10.7712 29.7129C10.7712 30.2271 10.9803 30.7307 11.3434 31.0938C11.7074 31.457 12.2109 31.666 12.7244 31.666Z"
                                                                fill="#777777" />
                                                            <path
                                                                d="M50.1953 27.7598H21.0037C19.9256 27.7598 19.0505 28.6341 19.0505 29.7129C19.0505 30.7909 19.9256 31.666 21.0037 31.666H50.1953C51.274 31.666 52.1484 30.7909 52.1484 29.7129C52.1484 28.6341 51.274 27.7598 50.1953 27.7598Z"
                                                                fill="#777777" />
                                                            <path
                                                                d="M12.7251 18.124H50.1953C51.2741 18.124 52.1485 17.2497 52.1485 16.1709C52.1485 15.0921 51.2741 14.2178 50.1953 14.2178H12.7251C11.6471 14.2178 10.772 15.0921 10.772 16.1709C10.772 17.2497 11.6471 18.124 12.7251 18.124Z"
                                                                fill="#777777" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_293_32">
                                                                <rect width="100" height="100" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                                {{ __('Additional Details') }}
                                            </li>
                                        @endif
                                        <li class="stapes_status">
                                            <span>
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M28 9.33341V22.6667C28 26.6667 26 29.3334 21.3333 29.3334H10.6667C6 29.3334 4 26.6667 4 22.6667V9.33341C4 5.33341 6 2.66675 10.6667 2.66675H21.3333C26 2.66675 28 5.33341 28 9.33341Z"
                                                        stroke="#777777" stroke-width="1.7" stroke-miterlimit="10"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M19.3335 6V8.66667C19.3335 10.1333 20.5335 11.3333 22.0002 11.3333H24.6668"
                                                        stroke="#777777" stroke-width="1.7" stroke-miterlimit="10"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M10.6665 17.3333H15.9998" stroke="#777777" stroke-width="1.7"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M10.6665 22.6667H21.3332" stroke="#777777" stroke-width="1.7"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                            {{ __('Your Details') }}
                                        </li>

                                        <li class="stapes_status">
                                            <span>
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.6665 16.8132H25.3332" stroke="#777777" stroke-width="1.5"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M25.3332 13.7067V23.2401C25.2932 27.0401 24.2531 28.0001 20.2931 28.0001H7.70654C3.67988 28.0001 2.6665 27.0001 2.6665 23.0267V13.7067C2.6665 10.1067 3.5065 8.94673 6.6665 8.76007C6.9865 8.74673 7.33321 8.7334 7.70654 8.7334H20.2931C24.3198 8.7334 25.3332 9.7334 25.3332 13.7067Z"
                                                        stroke="#777777" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M29.3332 8.97333V18.2933C29.3332 21.8933 28.4932 23.0533 25.3332 23.24V13.7067C25.3332 9.73333 24.3198 8.73333 20.2931 8.73333H7.70654C7.33321 8.73333 6.9865 8.74667 6.6665 8.76C6.7065 4.96 7.74654 4 11.7065 4H24.2931C28.3198 4 29.3332 5 29.3332 8.97333Z"
                                                        stroke="#777777" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M7 23.7466H9.29329" stroke="#777777" stroke-width="1.5"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M12.1465 23.7466H16.7332" stroke="#777777" stroke-width="1.5"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                            {{ __('Payment') }}
                                        </li>
                                        <li class="stapes_status">
                                            <span>
                                                <svg class="done-svg" width="100" height="100"
                                                    viewBox="0 0 100 100" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_293_39)">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M50 0C22.4219 0 0 22.4219 0 50C0 77.5781 22.4219 100 50 100C77.5781 100 100 77.5781 100 50C100 22.4219 77.5781 0 50 0Z"
                                                            fill="#777777" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M74.1797 33.1445C75.3906 34.3555 75.3906 36.3477 74.1797 37.5586L44.8828 66.8555C44.2773 67.4609 43.4766 67.7734 42.6758 67.7734C41.875 67.7734 41.0742 67.4609 40.4688 66.8555L25.8203 52.207C24.6094 50.9961 24.6094 49.0039 25.8203 47.793C27.0312 46.582 29.0234 46.582 30.2344 47.793L42.6758 60.2344L69.7656 33.1445C70.9766 31.9141 72.9687 31.9141 74.1797 33.1445Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_293_39">
                                                            <rect width="100" height="100" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
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
                                                <h3>{{ __('Please Select Services:') }}</h3>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
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
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label>{{ __('Choose a location') }}</label>
                                                            <select id="locationSelect" name="location">
                                                                <option value="" disabled selected>
                                                                    {{ __('Select location') }}</option>
                                                                @foreach ($locations as $ke => $location)
                                                                    <option value="{{ $location->id }}">
                                                                        {{ $location->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label>{{ __('Staff') }}</label>
                                                            <select id="staffSelect" name="staff">
                                                                <option value="" disabled selected>
                                                                    {{ __('Select staff') }}</option>
                                                                {{-- @foreach ($staffs as $k => $staff)
                                                                    <option value="{{ $staff->user->id }}">
                                                                        {{ $staff->name }}</option>
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
                                                            <label>{{ __('Appointment date') }}</label>
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
                                                        <a href="javascript:;">{{ __('New Registration') }}</a>
                                                    </li>
                                                    <li data-tab="existing-user" class="tab-link">
                                                        <a href="javascript:;">{{ __('Already Have Account') }}</a>
                                                    </li>
                                                    <li data-tab="guest-user" class="tab-link">
                                                        <a href="javascript:;">{{ __('Guest Booking') }}</a>
                                                    </li>
                                                </ul>
                                                <input type="hidden" name="type" id="selected_tab" value="new-user">
                                                <div class="tabs-container">
                                                    <div id="new-user" class="tab-content active">
                                                        <div class="appointment-form">
                                                            <div class="row">
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label>{{ __('Name') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            name="name" id="name"
                                                                            placeholder="Your name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label>{{ __('Email') }}</label>
                                                                        <input type="email" class="form-control"
                                                                            name="email" id="email"
                                                                            placeholder="Your email">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label>{{ __('Paasword') }}</label>
                                                                        <input type="password" class="form-control"
                                                                            name="password" id="password"
                                                                            placeholder="Your password">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label>{{ __('Contact') }}</label>
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

                                                                        <label>{{ __('Email') }}</label>
                                                                        <input type="email" class="form-control"
                                                                            name="email" id="email"
                                                                            placeholder="Your email">
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="guest-user" class="tab-content">
                                                        <div class="appointment-form">
                                                            <div class="row">
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label>{{ __('Name') }}</label>
                                                                        <input type="text" class="form-control"
                                                                            name="name" id="name"
                                                                            placeholder="Your name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label>{{ __('Email') }}</label>
                                                                        <input type="email" class="form-control"
                                                                            name="email" id="email"
                                                                            placeholder="Your email">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label>{{ __('Contact') }}</label>
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
            </div>
        </section>
    </main>
@endsection
