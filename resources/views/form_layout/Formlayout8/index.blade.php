@extends('form_layout.layout')
@section('form_content')
    <main>
        <section class="appointment-sec align-center pt pb">
            <div class="container">
                <div class="section-title text-center">
                    <h2>{{ __('Book an ') }}<b> {{ $business->name }}</b> {{ __('Appointment') }}</h2>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="form-steps-left">
                            <div class="steps">
                                <ul>
                                    <li class="stapes_status">
                                        <svg width="30" height="28" viewBox="0 0 30 28" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M26.4749 10.0614C23.9108 10.0614 22.8624 8.24804 24.1374 6.02387C24.8741 4.73471 24.4349 3.09137 23.1458 2.35471L20.6949 0.952207C19.5758 0.286373 18.1308 0.68304 17.4649 1.80221L17.3091 2.07137C16.0341 4.29554 13.9374 4.29554 12.6483 2.07137L12.4924 1.80221C11.8549 0.68304 10.4099 0.286373 9.29075 0.952207L6.83992 2.35471C5.55075 3.09137 5.11159 4.74887 5.84825 6.03804C7.13742 8.24804 6.08909 10.0614 3.52492 10.0614C2.05159 10.0614 0.833252 11.2655 0.833252 12.753V15.2464C0.833252 16.7197 2.03742 17.938 3.52492 17.938C6.08909 17.938 7.13742 19.7514 5.84825 21.9755C5.11159 23.2647 5.55075 24.908 6.83992 25.6447L9.29075 27.0472C10.4099 27.713 11.8549 27.3164 12.5208 26.1972L12.6766 25.928C13.9516 23.7039 16.0483 23.7039 17.3374 25.928L17.4933 26.1972C18.1591 27.3164 19.6041 27.713 20.7233 27.0472L23.1741 25.6447C24.4633 24.908 24.9024 23.2505 24.1658 21.9755C22.8766 19.7514 23.9249 17.938 26.4891 17.938C27.9624 17.938 29.1808 16.7339 29.1808 15.2464V12.753C29.1666 11.2797 27.9624 10.0614 26.4749 10.0614ZM14.9999 18.6039C12.4641 18.6039 10.3958 16.5355 10.3958 13.9997C10.3958 11.4639 12.4641 9.39554 14.9999 9.39554C17.5358 9.39554 19.6041 11.4639 19.6041 13.9997C19.6041 16.5355 17.5358 18.6039 14.9999 18.6039Z"
                                                fill="#222222" />
                                        </svg>
                                        <span>{{ __('Service') }}</span>
                                    </li>
                                    <li class="stapes_status">
                                        <svg width="34" height="34" viewBox="0 0 34 34" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.9999 32.2288C8.59909 32.2288 1.77075 25.4005 1.77075 16.9997C1.77075 8.59884 8.59909 1.77051 16.9999 1.77051C25.4008 1.77051 32.2291 8.59884 32.2291 16.9997C32.2291 25.4005 25.4008 32.2288 16.9999 32.2288ZM16.9999 3.89551C9.77492 3.89551 3.89575 9.77468 3.89575 16.9997C3.89575 24.2247 9.77492 30.1038 16.9999 30.1038C24.2249 30.1038 30.1041 24.2247 30.1041 16.9997C30.1041 9.77468 24.2249 3.89551 16.9999 3.89551Z"
                                                fill="#222222" />
                                            <path
                                                d="M22.2558 22.568C22.0717 22.568 21.8875 22.5255 21.7175 22.4121L17.3258 19.7913C16.235 19.1396 15.4275 17.7088 15.4275 16.448V10.6396C15.4275 10.0588 15.9092 9.57715 16.49 9.57715C17.0708 9.57715 17.5525 10.0588 17.5525 10.6396V16.448C17.5525 16.958 17.9775 17.7088 18.4167 17.9638L22.8083 20.5846C23.3183 20.8821 23.4742 21.5338 23.1767 22.0438C22.9642 22.3838 22.61 22.568 22.2558 22.568Z"
                                                fill="#222222" />
                                        </svg>
                                        <span>{{ __('Pick a Time') }}</span>
                                    </li>
                                    @if ((!empty($files) && $files->value == 'on') || (!empty($custom_field) && $custom_field == 'on'))
                                        <li class="stapes_status">
                                            <span>
                                                <svg width="100" height="100" viewBox="0 0 100 100" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_293_32)">
                                                        <path
                                                            d="M60.7429 43.3594C51.2657 43.3594 43.5554 51.0696 43.5554 60.5469C43.5554 70.0241 51.2657 77.7344 60.7429 77.7344C70.2202 77.7344 77.9304 70.0241 77.9304 60.5469C77.9304 51.0696 70.2202 43.3594 60.7429 43.3594ZM60.7429 73.8281C53.4195 73.8281 47.4617 67.8703 47.4617 60.5469C47.4617 53.2234 53.4195 47.2656 60.7429 47.2656C68.0664 47.2656 74.0242 53.2234 74.0242 60.5469C74.0242 67.8703 68.0664 73.8281 60.7429 73.8281Z"
                                                            fill="#222222" />
                                                        <path
                                                            d="M98.2552 88.694L82.7545 73.1926C84.903 69.4672 86.1336 65.1482 86.1336 60.5469C86.1336 53.756 83.4534 47.58 79.0962 43.0191V21.0915C79.0947 21.0915 79.0932 21.0915 79.0917 21.0915C79.0917 20.5833 78.8979 20.0844 78.5248 19.7105L59.3864 0.572205C59.0126 0.198364 58.5129 0.00534059 58.0048 0.00534059C58.0048 0.00305176 58.0048 0.00228883 58.0055 0H6.05469C2.82364 0 0.195312 2.62833 0.195312 5.85938V94.1406C0.195312 97.3717 2.82364 100 6.05469 100H73.2376C76.4679 100 79.097 97.3717 79.097 94.1406V88.2675L88.8893 98.0606C90.1802 99.3515 91.8762 99.9969 93.573 99.9969C95.269 99.9969 96.965 99.3515 98.2559 98.0606C100.838 95.4781 100.838 91.2766 98.2552 88.694ZM60.743 82.0312C48.8968 82.0312 39.2586 72.393 39.2586 60.5469C39.2586 48.7007 48.8968 39.0625 60.743 39.0625C72.5891 39.0625 82.2273 48.7007 82.2273 60.5469C82.2273 72.393 72.5891 82.0312 60.743 82.0312ZM59.9587 6.66885L72.4281 19.1391H61.9118C60.8345 19.1391 59.9587 18.2625 59.9587 17.186V6.66885ZM75.1907 94.1406C75.1907 95.2179 74.3141 96.0938 73.2376 96.0938H6.05469C4.97742 96.0938 4.10156 95.2179 4.10156 94.1406V5.85938C4.10156 4.7821 4.97742 3.90625 6.05469 3.90625H56.0524V17.1852C56.0524 20.4163 58.6807 23.0446 61.9118 23.0446H75.19V39.6797C71.0869 36.8294 66.1072 35.1562 60.743 35.1562C46.7423 35.1562 35.3523 46.5462 35.3523 60.5469C35.3523 63.2805 35.7887 65.9149 36.5921 68.3846H12.7251C11.647 68.3846 10.7719 69.2589 10.7719 70.3377C10.7719 71.4157 11.647 72.2908 12.7251 72.2908H37.6656C37.8494 72.2908 38.028 72.2633 38.1966 72.2153C42.4294 80.3604 50.9468 85.9375 60.743 85.9375C65.3435 85.9375 69.6625 84.7069 73.3879 82.5584L75.1907 84.3613V94.1406ZM95.4933 95.298C94.4344 96.3577 92.7109 96.3577 91.6519 95.298L76.664 80.3101C78.0769 79.1695 79.3648 77.8816 80.5054 76.4687L95.4933 91.4558C96.553 92.5156 96.553 94.239 95.4933 95.298Z"
                                                            fill="#222222" />
                                                        <path
                                                            d="M60.7429 51.7588C59.6641 51.7588 58.7898 52.6331 58.7898 53.7119C58.7898 54.7907 59.6641 55.665 60.7429 55.665C63.4346 55.665 65.625 57.8554 65.625 60.5471C65.625 61.6259 66.4993 62.5002 67.5781 62.5002C68.6569 62.5002 69.5312 61.6259 69.5312 60.5471C69.5312 55.7009 65.5891 51.7588 60.7429 51.7588Z"
                                                            fill="#222222" />
                                                        <path
                                                            d="M30.3025 54.8428H12.7251C11.6471 54.8428 10.772 55.7171 10.772 56.7959C10.772 57.8747 11.6471 58.749 12.7251 58.749H30.3025C31.3813 58.749 32.2556 57.8747 32.2556 56.7959C32.2556 55.7171 31.3813 54.8428 30.3025 54.8428Z"
                                                            fill="#222222" />
                                                        <path
                                                            d="M31.4598 41.3008H12.7251C11.6471 41.3008 10.772 42.1751 10.772 43.2539C10.772 44.3319 11.6471 45.207 12.7251 45.207H31.4598C32.5386 45.207 33.413 44.3319 33.413 43.2539C33.413 42.1751 32.5386 41.3008 31.4598 41.3008Z"
                                                            fill="#222222" />
                                                        <path
                                                            d="M37.3047 81.9258C36.7905 81.9258 36.2869 82.1341 35.9238 82.498C35.5606 82.8611 35.3516 83.3647 35.3516 83.8789C35.3516 84.3924 35.5606 84.8967 35.9238 85.2591C36.2869 85.623 36.7905 85.832 37.3047 85.832C37.8181 85.832 38.3224 85.623 38.6871 85.2591C39.0503 84.8967 39.2578 84.3924 39.2578 83.8789C39.2578 83.3647 39.0503 82.8611 38.6871 82.498C38.3224 82.1341 37.8181 81.9258 37.3047 81.9258Z"
                                                            fill="#222222" />
                                                        <path
                                                            d="M29.2832 81.9258H12.7251C11.6471 81.9258 10.772 82.8001 10.772 83.8789C10.772 84.9569 11.6471 85.832 12.7251 85.832H29.2832C30.3612 85.832 31.2363 84.9569 31.2363 83.8789C31.2363 82.8001 30.362 81.9258 29.2832 81.9258Z"
                                                            fill="#222222" />
                                                        <path
                                                            d="M12.7244 31.666C13.2401 31.666 13.7421 31.457 14.1053 31.0938C14.4707 30.7284 14.6775 30.2271 14.6775 29.7129C14.6775 29.1994 14.4707 28.6959 14.1053 28.3304C13.7421 27.9673 13.2378 27.7598 12.7244 27.7598C12.2109 27.7598 11.7089 27.9673 11.3434 28.3304C10.9803 28.6936 10.7712 29.1971 10.7712 29.7129C10.7712 30.2271 10.9803 30.7307 11.3434 31.0938C11.7074 31.457 12.2109 31.666 12.7244 31.666Z"
                                                            fill="#222222" />
                                                        <path
                                                            d="M50.1953 27.7598H21.0037C19.9256 27.7598 19.0505 28.6341 19.0505 29.7129C19.0505 30.7909 19.9256 31.666 21.0037 31.666H50.1953C51.274 31.666 52.1484 30.7909 52.1484 29.7129C52.1484 28.6341 51.274 27.7598 50.1953 27.7598Z"
                                                            fill="#222222" />
                                                        <path
                                                            d="M12.7251 18.124H50.1953C51.2741 18.124 52.1485 17.2497 52.1485 16.1709C52.1485 15.0921 51.2741 14.2178 50.1953 14.2178H12.7251C11.6471 14.2178 10.772 15.0921 10.772 16.1709C10.772 17.2497 11.6471 18.124 12.7251 18.124Z"
                                                            fill="#222222" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_293_32">
                                                            <rect width="100" height="100" fill="#222222" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            {{ __('Additional Details') }}
                                        </li>
                                    @endif
                                    <li class="stapes_status">
                                        <svg width="34" height="34" viewBox="0 0 34 34" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M29.75 9.91634V24.083C29.75 28.333 27.625 31.1663 22.6667 31.1663H11.3333C6.375 31.1663 4.25 28.333 4.25 24.083V9.91634C4.25 5.66634 6.375 2.83301 11.3333 2.83301H22.6667C27.625 2.83301 29.75 5.66634 29.75 9.91634Z"
                                                stroke="#222222" stroke-width="1.7" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M20.5417 6.375V9.20833C20.5417 10.7667 21.8167 12.0417 23.3751 12.0417H26.2084"
                                                stroke="#222222" stroke-width="1.7" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M11.3333 18.417H16.9999" stroke="#222222" stroke-width="1.7"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M11.3333 24.083H22.6666" stroke="#222222" stroke-width="1.7"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span>{{ __('Share Your Details') }}</span>
                                    </li>
                                    <li class="stapes_status">
                                        <svg class="vuesax-linear-cards" width="40" height="40" viewBox="0 0 40 40"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.33325 21.0166H31.6666" stroke="#666666" stroke-width="1.6"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M31.6666 17.1332V29.0498C31.6166 33.7998 30.3165 34.9998 25.3665 34.9998H9.6333C4.59997 34.9998 3.33325 33.7498 3.33325 28.7832V17.1332C3.33325 12.6332 4.38325 11.1832 8.33325 10.9498C8.73325 10.9332 9.16663 10.9165 9.6333 10.9165H25.3665C30.3999 10.9165 31.6666 12.1665 31.6666 17.1332Z"
                                                stroke="#666666" stroke-width="1.6" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M36.6666 11.2167V22.8667C36.6666 27.3667 35.6166 28.8167 31.6666 29.05V17.1333C31.6666 12.1667 30.3999 10.9167 25.3665 10.9167H9.6333C9.16663 10.9167 8.73325 10.9333 8.33325 10.95C8.38325 6.2 9.6833 5 14.6333 5H30.3665C35.3999 5 36.6666 6.25 36.6666 11.2167Z"
                                                stroke="#666666" stroke-width="1.6" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M8.75 29.6831H11.6166" stroke="#666666" stroke-width="1.6"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M15.1833 29.6831H20.9167" stroke="#666666" stroke-width="1.6"
                                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        {{ __('Payment') }}
                                    </li>
                                    <li class="stapes_status">
                                        <span>
                                            <svg width="100" height="100" viewBox="0 0 100 100" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_294_43)">
                                                    <path
                                                        d="M72.1024 34.1347C73.6282 35.6606 73.6282 38.134 72.1024 39.6591L45.8969 65.8653C44.371 67.3904 41.8983 67.3904 40.3725 65.8653L27.8976 53.3897C26.3718 51.8646 26.3718 49.3912 27.8976 47.8661C29.4228 46.3402 31.8962 46.3402 33.4213 47.8661L43.1343 57.579L66.5779 34.1347C68.1038 32.6096 70.5772 32.6096 72.1024 34.1347ZM100 50C100 77.6375 77.6337 100 50 100C22.3625 100 0 77.6337 0 50C0 22.3625 22.3663 0 50 0C77.6375 0 100 22.3663 100 50ZM92.1875 50C92.1875 26.6808 73.3162 7.8125 50 7.8125C26.6808 7.8125 7.8125 26.6838 7.8125 50C7.8125 73.3192 26.6838 92.1875 50 92.1875C73.3192 92.1875 92.1875 73.3162 92.1875 50Z"
                                                        fill="#222222" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_294_43">
                                                        <rect width="100" height="100" fill="#222222" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </span>
                                        {{ __('Done') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
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
                                                    <label>{{ __('Choose a location') }}</label>
                                                    <select id="locationSelect" name="location">
                                                        <option value="" disabled selected>
                                                            {{ __('Select location') }}
                                                        </option>
                                                        @foreach ($locations as $ke => $location)
                                                            <option value="{{ $location->id }}">{{ $location->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>{{ __('Staff') }}</label>
                                                    <select id="staffSelect" name="staff">
                                                        <option value="" disabled selected>{{ __('Select staff') }}
                                                        </option>
                                                        {{-- @foreach ($staffs as $k => $staff)
                                                            <option value="{{ $staff->user->id }}">{{ $staff->name }}
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
                                                        <rect height="29.377" rx="4.333" width="9.638" x="59.181"
                                                            y="46.444"></rect>
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
                                            <div id="new-user" class="tab-content active">
                                                <div class="appointment-form">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Name') }}</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" placeholder="Your name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Email') }}</label>
                                                                <input type="email" class="form-control" name="email"
                                                                    id="email" placeholder="Your email">
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
                                                                <input type="number" class="form-control" name="contact"
                                                                    id="contact" placeholder="Phone number">
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
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="guest-user" class="tab-content">
                                                <div class="appointment-form">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Name') }}</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" placeholder="Your name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Email') }}</label>
                                                                <input type="email" class="form-control" name="email"
                                                                    id="email" placeholder="Your email">
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
                                                    <input class="form-check-input payment_method" name="payment_method"
                                                        type="radio" id="manually" data-payment="manually"
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
        </section>
    </main>
@endsection

@push('script')
@endpush
