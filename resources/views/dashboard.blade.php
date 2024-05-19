@extends('layouts.main')
@section('page-title')
    {{ __('Dashboard') }}
@endsection

@section('content')

    <div class="row bookinggo-raw">
        <div class="row bookinggo-dash-row justify-content-between align-items-center">
            <div class="d-flex bookinggo-row-inner col-md-10 mb-3 mb-md-0">
                <h5 class="h3   mb-0">{{ __('Dashboard') }}</h5>
                <div class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0 cust-btn" data-bs-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false"
                        data-bs-placement="bottom" data-bs-original-title="Select your bussiness">
                        <i class="ti ti-apps"></i>
                        <span class="hide-mob">{{ Auth::user()->ActiveBusinessName() }}</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end" style="">
                        @foreach (getBusiness() as $businesses)
                            @if ($businesses->id == getActiveBusiness())
                                <div class="d-flex justify-content-between bd-highlight">
                                    <a href=" # " class="dropdown-item ">
                                        <i class="ti ti-checks text-primary"></i>
                                        <span>{{ $businesses->name }}</span>
                                    </a>
                                </div>
                            @else
                            @php
                                $route = ($businesses->is_disable == 1) ?  route('business.change', $businesses->id) : '#';
                            @endphp
                                <div class="d-flex justify-content-between bd-highlight">
                
                                <a href="{{ $route }}" class="dropdown-item">
                                    <span>{{ $businesses->name }}</span>
                                </a>
                                @if ($businesses->is_disable == 0)
                                        <div class="action-btn mt-2">
                                            <i class="ti ti-lock"></i>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="row g-3 mt-3">
                        <div class="col-xxl-6">
                            <div class="stats-row row g-3 h-100">
                                <div class="col-xl-4  col-md-6 col-12 mt-0">
                                    <div class="card stats-wrapper dash-info-card">
                                        <div class="card-body stats">
                                            <div class="theme-avtar bg-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                                                    viewBox="0 0 100 100" fill="none">
                                                    <path
                                                        d="M28.523 27.653L26.477 27.721V27.653C26.4738 23.3787 28.1661 19.2777 31.1827 16.2495C34.1992 13.2213 38.2937 11.5132 42.568 11.5H57.432C61.7063 11.5132 65.8008 13.2213 68.8173 16.2495C71.8339 19.2777 73.5262 23.3787 73.523 27.653L71.477 27.721C71.4859 25.8683 71.1297 24.0319 70.4285 22.317C69.7274 20.602 68.6951 19.042 67.3907 17.7262C66.0864 16.4105 64.5355 15.3646 62.8267 14.6486C61.1179 13.9325 59.2847 13.5602 57.432 13.553H42.568C38.837 13.5644 35.2629 15.0553 32.6298 17.6987C29.9968 20.3421 28.5198 23.922 28.523 27.653ZM5 27.721V41.833L43.276 54.762C43.8806 53.4906 44.8332 52.4166 46.0234 51.6646C47.2136 50.9126 48.5926 50.5135 50.0005 50.5135C51.4084 50.5135 52.7874 50.9126 53.9776 51.6646C55.1678 52.4166 56.1204 53.4906 56.725 54.762L95 41.833V27.721H5ZM57.5 58.111C57.5 60.1001 56.7098 62.0078 55.3033 63.4143C53.8968 64.8208 51.9891 65.611 50 65.611C48.0109 65.611 46.1032 64.8208 44.6967 63.4143C43.2902 62.0078 42.5 60.1001 42.5 58.111C42.5014 57.6412 42.546 57.1726 42.633 56.711L5 44V88.5H95V44L57.367 56.711C57.454 57.1726 57.4986 57.6412 57.5 58.111Z"
                                                        fill="white" />
                                                </svg>
                                            </div>
                                            <h6 class="mt-4 mb-3">{{ __('Total Business') }}</h6>
                                            <h3 class="mb-0">{{ $total_business }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4  col-md-6 col-12 mt-0">
                                    <div class="card stats-wrapper dash-info-card">
                                        <div class="card-body stats">
                                            <div class="theme-avtar bg-dark">
                                                <svg width="100" height="100" viewBox="0 0 100 100" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M71.2063 52.4174C83.9141 52.4174 94.2162 62.7195 94.2162 75.4273C94.2162 88.1352 83.9141 98.4375 71.2063 98.4375C58.4985 98.4375 48.1963 88.1353 48.1963 75.4273C48.1963 62.7195 58.4985 52.4174 71.2063 52.4174ZM91.434 25.523H5.78381V72.4244C5.78381 76.2289 8.88674 79.3316 12.691 79.3316H45.3619C45.1711 78.0578 45.0713 76.7543 45.0713 75.4273C45.0713 73.2461 45.3403 71.1279 45.8438 69.1025H45.6381C45.1625 69.1025 44.7748 68.7147 44.7748 68.2393V62.2977C44.7748 61.8221 45.1627 61.4344 45.6381 61.4344H49.1309C51.5959 57.5537 55.0563 54.3676 59.1526 52.2342V47.9197C59.1526 47.4441 59.5405 47.0562 60.0158 47.0562H65.9574C66.433 47.0562 66.8209 47.4441 66.8209 47.9197V49.6607C68.2469 49.4195 69.7117 49.2924 71.2063 49.2924C71.9899 49.2924 72.7647 49.3289 73.5307 49.3965V47.9197C73.5307 47.4441 73.9186 47.0562 74.394 47.0562H80.3356C80.8112 47.0562 81.199 47.4441 81.199 47.9197V51.2729C85.2123 52.935 88.7219 55.568 91.4342 58.8797V25.523H91.434ZM18.0965 1.5625H21.5207C22.4717 1.5625 23.2475 2.33809 23.2475 3.28926V13.7639C23.2475 14.715 22.4717 15.4906 21.5207 15.4906H18.0965C17.1453 15.4906 16.3698 14.7148 16.3698 13.7639V3.28926C16.3696 2.33828 17.1453 1.5625 18.0965 1.5625ZM75.6973 1.5625H79.1213C80.0725 1.5625 80.8481 2.33809 80.8481 3.28926V13.7639C80.8481 14.715 80.0723 15.4906 79.1213 15.4906H75.6973C74.7463 15.4906 73.9705 14.7148 73.9705 13.7639V3.28926C73.9705 2.33828 74.7461 1.5625 75.6973 1.5625ZM56.4969 1.5625H59.9209C60.8721 1.5625 61.6477 2.33809 61.6477 3.28926V13.7639C61.6477 14.715 60.8719 15.4906 59.9209 15.4906H56.4969C55.5457 15.4906 54.7701 14.7148 54.7701 13.7639V3.28926C54.7701 2.33828 55.5459 1.5625 56.4969 1.5625ZM37.2967 1.5625H40.7209C41.6721 1.5625 42.4477 2.33809 42.4477 3.28926V13.7639C42.4477 14.715 41.6719 15.4906 40.7209 15.4906H37.2967C36.3455 15.4906 35.5699 14.7148 35.5699 13.7639V3.28926C35.5699 2.33828 36.3455 1.5625 37.2967 1.5625ZM5.78381 22.398H91.4342V14.2311C91.4342 10.4268 88.3313 7.32383 84.527 7.32383H83.9733V13.7641C83.9733 16.4398 81.7973 18.6158 79.1215 18.6158H75.6973C73.0215 18.6158 70.8455 16.4398 70.8455 13.7641V7.32383H64.7729V13.7641C64.7729 16.4398 62.5969 18.6158 59.9211 18.6158H56.4971C53.8213 18.6158 51.6453 16.4398 51.6453 13.7641V7.32383H45.5727V13.7641C45.5727 16.4398 43.3967 18.6158 40.7209 18.6158H37.2967C34.6209 18.6158 32.4449 16.4398 32.4449 13.7641V7.32383H26.3723V13.7641C26.3723 16.4398 24.1963 18.6158 21.5205 18.6158H18.0965C15.4207 18.6158 13.2448 16.4398 13.2448 13.7641V7.32383H12.691C8.88655 7.32383 5.78381 10.4268 5.78381 14.2311V22.398ZM16.019 62.2977C16.019 61.8221 16.4069 61.4344 16.8824 61.4344H22.8239C23.2994 61.4344 23.6871 61.8223 23.6871 62.2977V68.2393C23.6871 68.7148 23.2992 69.1025 22.8239 69.1025H16.8824C16.4069 69.1025 16.019 68.7147 16.019 68.2393V62.2977ZM16.019 47.9197C16.019 47.4441 16.4069 47.0562 16.8824 47.0562H22.8239C23.2994 47.0562 23.6871 47.4441 23.6871 47.9197V53.8613C23.6871 54.3369 23.2992 54.7246 22.8239 54.7246H16.8824C16.4069 54.7246 16.019 54.3367 16.019 53.8613V47.9197ZM16.019 33.5418C16.019 33.0662 16.4069 32.6785 16.8824 32.6785H22.8239C23.2994 32.6785 23.6871 33.0664 23.6871 33.5418V39.4834C23.6871 39.959 23.2992 40.3469 22.8239 40.3469H16.8824C16.4069 40.3469 16.019 39.959 16.019 39.4834V33.5418ZM30.3969 33.5418C30.3969 33.0662 30.7848 32.6785 31.2604 32.6785H37.202C37.6776 32.6785 38.0653 33.0664 38.0653 33.5418V39.4834C38.0653 39.959 37.6774 40.3469 37.202 40.3469H31.2604C30.7848 40.3469 30.3969 39.959 30.3969 39.4834V33.5418ZM44.7748 33.5418C44.7748 33.0662 45.1627 32.6785 45.6381 32.6785H51.5795C52.0551 32.6785 52.4428 33.0664 52.4428 33.5418V39.4834C52.4428 39.959 52.0549 40.3469 51.5795 40.3469H45.6381C45.1625 40.3469 44.7748 39.959 44.7748 39.4834V33.5418ZM59.1528 33.5418C59.1528 33.0662 59.5407 32.6785 60.016 32.6785H65.9576C66.4332 32.6785 66.8211 33.0664 66.8211 33.5418V39.4834C66.8211 39.959 66.4332 40.3469 65.9576 40.3469H60.016C59.5405 40.3469 59.1528 39.959 59.1528 39.4834V33.5418ZM73.5307 33.5418C73.5307 33.0662 73.9186 32.6785 74.394 32.6785H80.3356C80.8112 32.6785 81.199 33.0664 81.199 33.5418V39.4834C81.199 39.959 80.8112 40.3469 80.3356 40.3469H74.394C73.9184 40.3469 73.5307 39.959 73.5307 39.4834V33.5418ZM44.7748 47.9197V53.8613C44.7748 54.3369 45.1627 54.7246 45.6381 54.7246H51.5795C52.0551 54.7246 52.4428 54.3367 52.4428 53.8613V47.9197C52.4428 47.4441 52.0549 47.0562 51.5795 47.0562H45.6381C45.1627 47.0564 44.7748 47.4441 44.7748 47.9197ZM30.3969 47.9197C30.3969 47.4441 30.7848 47.0562 31.2604 47.0562H37.202C37.6776 47.0562 38.0653 47.4441 38.0653 47.9197V53.8613C38.0653 54.3369 37.6774 54.7246 37.202 54.7246H31.2604C30.7848 54.7246 30.3969 54.3367 30.3969 53.8613V47.9197ZM30.3969 62.2977C30.3969 61.8221 30.7848 61.4344 31.2604 61.4344H37.202C37.6776 61.4344 38.0653 61.8223 38.0653 62.2977V68.2393C38.0653 68.7148 37.6774 69.1025 37.202 69.1025H31.2604C30.7848 69.1025 30.3969 68.7147 30.3969 68.2393V62.2977ZM69.7078 67.0787V75.4275C69.7078 76.0201 70.052 76.5324 70.5514 76.7756L76.0313 79.9395C76.7457 80.3533 77.6604 80.1096 78.074 79.3951C78.4877 78.6807 78.244 77.766 77.5297 77.3523L72.7049 74.5668V67.0791C72.7049 66.2516 72.034 65.5807 71.2065 65.5807C70.3787 65.5803 69.7078 66.2512 69.7078 67.0787ZM86.1981 74.1488H84.5731C83.8668 74.1488 83.2944 74.7213 83.2944 75.4273C83.2944 76.1334 83.8668 76.7059 84.5731 76.7059H86.1981C86.9041 76.7059 87.4766 76.1334 87.4766 75.4273C87.4766 74.7213 86.9043 74.1488 86.1981 74.1488ZM80.9031 63.9227L79.7541 65.0717C79.2549 65.5709 79.2549 66.3805 79.7541 66.8797C80.2533 67.3789 81.0629 67.3789 81.5621 66.8797L82.7114 65.7307C83.2106 65.2314 83.2106 64.4219 82.7114 63.9227C82.2119 63.4232 81.4024 63.4232 80.9031 63.9227ZM69.9278 60.4355V62.0605C69.9278 62.7668 70.5002 63.3393 71.2063 63.3393C71.9123 63.3393 72.4848 62.7668 72.4848 62.0605V60.4355C72.4848 59.7295 71.9123 59.157 71.2063 59.157C70.5002 59.157 69.9278 59.7295 69.9278 60.4355ZM59.7014 65.7307L60.8506 66.8797C61.3498 67.3789 62.1594 67.3789 62.6586 66.8797C63.1578 66.3805 63.1578 65.5709 62.6586 65.0717L61.5096 63.9227C61.0102 63.4234 60.2008 63.4234 59.7016 63.9227C59.2022 64.4219 59.2022 65.2314 59.7014 65.7307ZM56.2145 76.7061H57.8397C58.5459 76.7061 59.1184 76.1336 59.1184 75.4275C59.1184 74.7215 58.5459 74.149 57.8397 74.149H56.2145C55.5084 74.149 54.936 74.7215 54.936 75.4275C54.936 76.1336 55.5084 76.7061 56.2145 76.7061ZM61.5096 86.9322L62.6586 85.783C63.1578 85.2838 63.1578 84.4742 62.6586 83.975C62.1594 83.4758 61.3498 83.4758 60.8506 83.975L59.7014 85.124C59.2022 85.6234 59.2022 86.4328 59.7014 86.932C60.2006 87.4313 61.0102 87.4314 61.5096 86.9322ZM72.4848 90.4191V88.7939C72.4848 88.0877 71.9123 87.5152 71.2063 87.5152C70.5002 87.5152 69.9278 88.0877 69.9278 88.7939V90.4191C69.9278 91.1252 70.5002 91.6977 71.2063 91.6977C71.9123 91.6977 72.4848 91.1254 72.4848 90.4191ZM82.7112 85.1242L81.5621 83.9752C81.0629 83.476 80.2533 83.476 79.7541 83.9752C79.2549 84.4744 79.2549 85.284 79.7541 85.7832L80.9031 86.9324C81.4026 87.4316 82.2119 87.4316 82.7112 86.9324C83.2104 86.433 83.2104 85.6234 82.7112 85.1242ZM71.2063 56.765C60.8996 56.765 52.5438 65.1207 52.5438 75.4275C52.5438 85.7344 60.8994 94.09 71.2063 94.09C81.5131 94.09 89.8688 85.7344 89.8688 75.4275C89.8688 65.1207 81.5131 56.765 71.2063 56.765Z"
                                                        fill="white" />
                                                </svg>
                                            </div>
                                            <h6 class="mt-4 mb-3">{{ __('Total Appointment') }}</h6>
                                            <h3 class="mb-0">{{ $total_appointment }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mt-0">
                                    <div class="card stats-wrapper dash-info-card">
                                        <div class="card-body stats">
                                            <div class="theme-avtar bg-primary">
                                                <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                                width="30.000000pt" height="28.000000pt" viewBox="0 0 30.000000 28.000000"
                                                preserveAspectRatio="xMidYMid meet">

                                                <g transform="translate(0.000000,28.000000) scale(0.100000,-0.100000)"
                                                fill="#000000" stroke="none">
                                                <path d="M34 262 c-6 -4 -17 -18 -24 -31 -10 -20 -9 -27 7 -50 28 -37 65 -39
                                                92 -5 11 15 21 23 21 19 0 -5 9 0 19 9 17 16 22 16 48 3 27 -14 30 -14 61 14
                                                32 29 41 49 22 49 -5 0 -10 -6 -10 -13 0 -8 -9 -22 -21 -32 -17 -16 -24 -17
                                                -51 -7 -27 10 -35 9 -49 -4 -17 -15 -19 -14 -25 10 -9 38 -59 59 -90 38z m42
                                                -24 c4 -6 3 -8 -4 -4 -6 3 -13 2 -16 -3 -4 -5 3 -12 14 -16 11 -3 20 -12 20
                                                -20 0 -19 -27 -26 -40 -10 -9 11 -7 12 12 8 l23 -5 -23 19 c-18 15 -20 21 -10
                                                31 15 15 15 15 24 0z" fill="white"/>
                                                <path d="M250 100 c0 -83 1 -90 20 -90 19 0 20 7 20 90 0 83 -1 90 -20 90 -19
                                                0 -20 -7 -20 -90z" fill="white"/>
                                                <path d="M110 75 c0 -58 2 -65 20 -65 18 0 20 7 20 65 0 58 -2 65 -20 65 -18
                                                0 -20 -7 -20 -65z" fill="white"/>
                                                <path d="M187 113 c-4 -3 -7 -28 -7 -55 0 -41 3 -48 20 -48 18 0 20 7 20 55 0
                                                39 -4 55 -13 55 -8 0 -17 -3 -20 -7z" fill="white"/>
                                                <path d="M40 45 c0 -28 4 -35 20 -35 16 0 20 7 20 35 0 28 -4 35 -20 35 -16 0
                                                -20 -7 -20 -35z" fill="white"/>
                                                </g>
                                                </svg>
                                            </div>
                                            <h6 class="mt-4 mb-3">{{ __('Total Revenue') }}</h6>
                                            <h3 class="mb-0">{{ $total_appointment_payment .'.00' }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mt-0">
                                    <div class="card stats-wrapper dash-info-card">
                                        <div class="card-body stats">
                                            <div class="theme-avtar bg-danger">
                                                <svg width="100" height="100" viewBox="0 0 100 100" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M11.6465 39.029C13.8856 47.5767 21.107 55.4511 30.2598 55.4511C39.5487 55.4511 46.8861 47.612 49.1806 39.087C50.053 38.9887 50.7741 38.323 50.8523 37.4153L51.1423 34.0467C51.2154 33.1692 50.6657 32.4178 49.8664 32.1405C49.8513 31.9388 49.8462 31.7345 49.8235 31.5353C49.6521 23.8147 48.3107 17.5817 42.234 15.0048C35.8195 12.2867 30.1665 12.2489 26.0162 13.8626C25.7439 13.971 25.0404 14.9065 24.7656 15.0754C24.4907 15.2444 23.0358 14.7653 22.4837 14.8939C13.3813 16.1949 10.3783 24.7703 11.0414 31.4572C11.0212 31.6437 11.0086 31.8329 10.9935 32.022C10.1135 32.2413 9.48315 33.0406 9.56384 33.9735L9.85128 37.3422C9.93449 38.2953 10.7161 38.9862 11.6465 39.029ZM13.5855 32.3573C17.5719 30.8974 25.2396 27.8439 26.0717 26.2403C29.5588 29.8636 41.8735 31.8984 47.2794 32.5767C47.3021 32.9272 47.3324 33.2675 47.3324 33.6205C47.3324 42.5086 39.874 52.8414 30.2598 52.8414C20.6808 52.8414 13.5225 42.6952 13.5225 33.6205C13.52 33.1944 13.5527 32.7784 13.5855 32.3573Z"
                                                        fill="white" />
                                                    <path
                                                        d="M44.9269 52.3875C44.4478 52.3143 43.9788 52.4227 43.6712 52.5463L36.0035 62.9169L30.1866 58.2775L30.1513 58.3078V58.3406L30.1437 58.333L24.3268 62.9724L16.6591 52.6018C16.354 52.4757 15.8825 52.3673 15.4034 52.4404C0.917802 54.4828 0 87.2009 0 87.2009L30.179 87.221V87.1681L60.3303 87.1479C60.3303 87.1479 59.41 54.4298 44.9269 52.3875Z"
                                                        fill="white" />
                                                    <path
                                                        d="M60.5069 38.5826C62.3223 45.5166 68.1821 51.8983 75.6027 51.8983C83.1367 51.8983 89.0898 45.5418 90.9507 38.6255C91.6567 38.5448 92.2442 38.0077 92.3072 37.2715L92.5417 34.5408C92.6022 33.8272 92.1534 33.217 91.5054 32.9926C91.4953 32.8338 91.4877 32.6648 91.4701 32.506C91.3314 26.2453 90.2447 21.1847 85.3178 19.097C80.1161 16.8933 75.5296 16.8605 72.1635 18.1691C71.9441 18.2574 71.3743 19.0163 71.1524 19.1575C70.9254 19.2962 69.7479 18.9028 69.3016 19.0087C61.9189 20.0627 59.4807 27.0193 60.0177 32.4429C60.0001 32.5967 59.9925 32.748 59.9799 32.9018C59.2663 33.0809 58.757 33.7289 58.8226 34.4828L59.0545 37.2135C59.1176 37.985 59.753 38.5473 60.5069 38.5826ZM62.0777 33.1691C65.3102 31.984 71.5331 29.508 72.2063 28.2069C75.0379 31.1419 85.0253 32.7909 89.4075 33.3481C89.4277 33.6255 89.4529 33.9079 89.4529 34.1928C89.4529 41.3991 83.4065 49.7828 75.6052 49.7828C67.8342 49.7828 62.0273 41.5529 62.0273 34.1928C62.0273 33.8499 62.05 33.5095 62.0777 33.1691Z"
                                                        fill="white" />
                                                    <path
                                                        d="M87.5014 49.4197C87.1131 49.3592 86.7323 49.4475 86.4878 49.5458L80.2649 57.9598L75.5473 54.1979L75.5195 54.2205V54.2483L75.512 54.2432L70.7944 58.0052L64.5715 49.5912C64.3244 49.4903 63.9411 49.4071 63.5579 49.4651C59.7228 50.0047 57.0677 53.2019 55.2195 57.2538C56.3113 58.9407 57.8493 61.631 59.1529 65.1711C60.4515 68.6885 61.3113 73.4792 61.871 77.6724L75.5422 77.68V77.6346L100 77.6194C99.9976 77.6119 99.2513 51.0688 87.5014 49.4197Z"
                                                        fill="white" />
                                                </svg>
                                            </div>
                                            <h6 class="mt-4 mb-3">{{ __('Total Staff') }}</h6>
                                            <h3 class="mb-0">{{ $total_staff }}</h3>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-4 col-md-6 col-12 mt-0">
                                    <div class="card stats-wrapper dash-info-card">
                                        <div class="card-body stats">
                                            <div class="theme-avtar bg-secondary">
                                                <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                                width="30.000000pt" height="30.000000pt" viewBox="0 0 30.000000 30.000000"
                                                preserveAspectRatio="xMidYMid meet">

                                                <g transform="translate(0.000000,30.000000) scale(0.100000,-0.100000)"
                                                fill="#000000" stroke="none">
                                                <path d="M122 284 c-10 -11 -17 -12 -27 -4 -13 11 -26 0 -38 -33 -4 -10 -11
                                                -16 -16 -13 -5 3 -15 -1 -22 -10 -10 -12 -10 -17 0 -23 10 -6 9 -12 -3 -24
                                                -20 -20 -20 -34 -1 -54 12 -12 13 -18 4 -29 -7 -8 -7 -14 -1 -14 19 0 36 33
                                                37 71 3 126 190 124 190 -1 0 -55 -39 -94 -95 -95 -40 -1 -81 -27 -66 -42 4
                                                -4 11 -2 15 6 6 10 11 9 24 -3 20 -20 34 -20 54 -1 11 11 19 13 28 5 14 -11
                                                27 0 39 34 3 10 9 16 13 13 3 -4 12 -2 20 4 9 8 10 15 3 24 -8 9 -6 17 5 28
                                                19 20 19 34 0 54 -11 11 -13 19 -5 28 7 9 6 16 -5 25 -8 7 -15 9 -15 5 0 -4
                                                -7 -2 -15 5 -9 7 -13 15 -10 18 3 3 0 11 -6 19 -8 9 -15 10 -24 3 -9 -8 -17
                                                -6 -28 5 -19 19 -38 19 -55 -1z" fill="white"/>
                                                <path d="M112 188 c-7 -7 -12 -23 -12 -37 0 -17 -16 -41 -46 -72 -43 -44 -50
                                                -69 -20 -69 6 0 32 20 56 45 24 25 53 45 65 45 28 0 45 18 45 49 l0 24 -25
                                                -23 c-19 -18 -28 -21 -37 -12 -9 9 -6 18 12 37 l23 25 -24 0 c-14 0 -30 -5
                                                -37 -12z" fill="white"/>
                                                </g>
                                                </svg>
                                            </div>
                                            <h6 class="mt-4 mb-3">{{ __('Total Service') }}</h6>
                                            <h3 class="mb-0">{{ $total_service }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-12 mt-0">
                                    <div class="card stats-wrapper dash-info-card">
                                        <div class="card-body stats">
                                            <div class="theme-avtar bg-info">
                                                <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                                width="28.000000pt" height="30.000000pt" viewBox="0 0 28.000000 30.000000"
                                                preserveAspectRatio="xMidYMid meet">

                                                <g transform="translate(0.000000,30.000000) scale(0.100000,-0.100000)"
                                                fill="#000000" stroke="none">
                                                <path d="M78 271 c-46 -41 -43 -79 12 -169 25 -40 47 -72 50 -72 5 0 70 99 90
                                                138 16 33 3 77 -32 107 -40 33 -79 32 -120 -4z m86 -34 c22 -16 18 -55 -6 -71
                                                -40 -24 -80 44 -42 71 10 7 21 13 24 13 3 0 14 -6 24 -13z" fill="white"/>
                                                <path d="M37 84 c-36 -20 -32 -44 13 -67 41 -22 161 -19 198 4 36 22 27 55
                                                -21 72 -13 5 -24 -4 -42 -33 -32 -51 -55 -51 -89 0 -14 22 -27 40 -29 40 -1
                                                -1 -15 -8 -30 -16z" fill="white"/>
                                                </g>
                                                </svg>
                                            </div>
                                            <h6 class="mt-4 mb-3">{{ __('Total Location') }}</h6>
                                            <h3 class="mb-0">{{ $total_location }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div class="theme-card dashboard-theme-card card p-3 mb-0">
                                <div class="theme-image">
                                <span class="badges bg-success">{{ __('Current Business') }}</span>
                                @if ($business->form_type == 'website')
                                    <img src="{{ get_module_card_img($business->layouts) }}" alt="theme-image">  
                                @else
                                    <img src="{{ asset(get_file('form_layouts/' . $business->layouts . '/images/form.png')) }}" alt="theme-image">    
                                @endif
                                </div>
                                <div class="theme-bottom-content">
                                    <div class="theme-card-lable">
                                        <b>{{ $business->name }}</b>
                                    </div>
                                    <div class="theme-card-button ">
                                        <a class="btn btn-sm btn2 btn-primary text-end" href="{{ route('business.manage', $business->id) }}">
                                            {{ __('Edit Business') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row g-3 mt-3">
                        <div class="col-xl-6  col-12">
                            <div class="card mb-0 h-100">
                                <div class="d-flex align-items-center qr-code-wrapper h-100">
                                    <div class="flex-1 stats-wrapper">
                                        <div class="card-body stats welcome-card">
                                            <div class="row align-items-center">
                                                <div class="col-xxl-12">
                                                    <h3 class="mb-1" id="greetings"></h3>
                                                    <h4 class="f-w-400">
                                                        <a href="{{ check_file(Auth::user()->avatar) ? get_file(Auth::user()->avatar) : get_file('uploads/default/avatar.png') }}"
                                                            target="_blank">
                                                            <img src="{{ check_file(Auth::user()->avatar) ? get_file(Auth::user()->avatar) : get_file('uploads/default/avatar.png') }}"
                                                                alt="user-image"
                                                                class="wid-35 me-2 img-thumbnail rounded-circle">
                                                        </a>
                                                        {{ __(Auth::user()->name) }}
                                                    </h4>
                                                    <p>{{ __('Have a nice day! Did you know that you can quickly add your favorite thing to the business?') }}
                                                    </p>
                                                </div>
    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stats-wrapper info-card">
                                        <div class="card-body stats ps-3 pe-3">
                                            <h6 class="">{{ $business->name }}</h6>
                                            <div class="mb-3 qrcode">
                                                {!! QrCode::generate(route('appointments.form', $business->slug)) !!}
                                            </div>
                                            <div class="d-flex justify-content-between social-share-icon">
                                                <a href="#!" class="btn btn-light-primary btn-sm w-100 cp_link"
                                                    data-link="{{ route('appointments.form', $business->slug) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ __('Click to copy link') }}">
                                                    {{ __('Business Link') }}
                                                    <i class="ms-1"data-feather="copy"></i>
                                                </a>
                                                <a href="#" id="socialShareButton"
                                                    class="socialShareButton btn btn-sm btn-primary ms-1 share-btn">
                                                    <i class="ti ti-share"></i>
                                                </a>
                                                <div id="sharingButtonsContainer" class="sharingButtonsContainer"
                                                    style="display: none;">
                                                    <div
                                                        class="Demo1 d-flex align-items-center justify-content-center mb-5 hidden">
                                                    </div>
                                                </div>
                                            </div>
    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6  col-12">
                            <div id="embedded-code-sidenav" class="card mb-0">
                                <div class="card-header">
                                    <h5>{{ __('Embedded Code') }}</h5>
                                    <small class="text-muted">{{ __('Copy this code and put anywhere') }}</small>
                                </div>
                                <div class="bg-none">
                                    <div class="row company-setting">
                                        <div class="">
                                            <form id="setting-form" method="post" action="#" enctype ="multipart/form-data">
                                                @csrf
                                                <div class="card-header card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                {{ Form::label('embedded_code', __('Embedded Code'), ['class' => 'form-label']) }}
                                                                {{ Form::textarea('embedded_code', EmbeddedCode(), ['class' => 'form-control', 'rows' => '2', 'readonly']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xxl-7 mb-4">
                    <div class="card overflow-auto card-dash">
                        <div class="card-header">
                            <h5>{{ __('Latest Service') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Duration') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latest_services as $latest_service)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ check_file($latest_service->image) ? get_file($latest_service->image) : get_file('uploads/default/avatar.png') }}"
                                                            class="wid-30 rounded-circle me-2" alt="avatar image"
                                                            height="30">
                                                        <p class="mb-0">{{ $latest_service->name }}</p>
                                                    </div>
                                                </td>
                                                <td>{{ $latest_service->price }}</td>
                                                <td>{{ $latest_service->duration }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-5 mb-4">
                    <div class="card overflow-auto card-dash">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>{{ __('Recent Appointment') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <div id="appointment-chart" data-color="primary" data-height="280" class="p-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mb-4">
            <div class="card">
                <div class="card-header  d-flex justify-content-between align-items-center">
                    <h5>{{ __('Latest Appointment') }}</h5>
                    <a class="btn btn-primary" href="{{ route('appointment.index') }}">{{ __('View All') }}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Id') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Duration') }}</th>
                                    <th>{{ __('Customer') }}</th>
                                    <th>{{ __('Staff') }}</th>
                                    <th>{{ __('Service') }}</th>
                                    <th>{{ __('Location') }}</th>
                                    <th>{{ __('Payment') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th class="text-end me-3">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latest_appointments as $latest_appointment)
                                    <tr>
                                        <th scope="row">
                                            <a href="#"
                                                class="btn btn-sm btn-secondary d-inline-flex align-items-center"
                                                data-url="{{ route('appointment.show', $latest_appointment->id) }}"
                                                data-size="lg" class="dropdown-item" data-ajax-popup="true"
                                                data-title="{{ __('Appointment Details') }}" data-bs-toggle="tooltip"
                                                data-bs-original-title="{{ __('Appointment Details') }}">
                                                <span
                                                    class="text-white">{{ App\Models\Appointment::appointmentNumberFormat($latest_appointment->id, $latest_appointment->created_by, $latest_appointment->business_id) }}</span>
                                            </a>
                                        </th>
                                        <td>{{ $latest_appointment->date }}</td>
                                        <td>{{ $latest_appointment->time }}</td>
                                        <td>{{ !empty($latest_appointment->CustomerData) ? $latest_appointment->CustomerData->name : 'Guest' }}
                                        </td>
                                        <td>{{ !empty($latest_appointment->StaffData) ? $latest_appointment->StaffData->name : '-' }}
                                        </td>
                                        <td>{{ !empty($latest_appointment->ServiceData) ? $latest_appointment->ServiceData->name : '-' }}
                                        </td>
                                        <td>{{ !empty($latest_appointment->LocationData) ? $latest_appointment->LocationData->name : '-' }}
                                        </td>
                                        <td>{{ !empty($latest_appointment->payment_type) ? $latest_appointment->payment_type : '-' }}
                                        </td>
                                        <td class="status_badge">
                                            <a href="#" class="btn btn-sm" style="background-color: #{{ !empty($latest_appointment->StatusData->status_color) ? $latest_appointment->StatusData->status_color : '5bc0de' }};"
                                                data-url="{{ route('appointment.status.change', $latest_appointment->id) }}"
                                                class="dropdown-item" data-ajax-popup="true"
                                                data-title="{{ __('Update Status') }}" data-bs-toggle="tooltip"
                                                data-bs-original-title="{{ __('Update Status') }}">
                                                <span
                                                    class="white-space">{{ !empty($latest_appointment->StatusData) ? $latest_appointment->StatusData->title : 'Pending' }}</span>
                                            </a>
                                        </td>
                                        <td class="text-end">
                                            @permission('appointment edit')
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                        data-url="{{ route('appointment.edit', $latest_appointment->id) }}"
                                                        class="dropdown-item" data-ajax-popup="true"
                                                        data-title="{{ __('Edit Appointment') }}" data-bs-toggle="tooltip"
                                                        data-bs-original-title="{{ __('Edit') }}">
                                                        <span class="text-white"> <i class="ti ti-edit"></i></span></a>
                                                </div>
                                            @endpermission
                                            @permission('appointment delete')
                                                <div class="action-btn bg-danger ms-2">
                                                    <form method="POST"
                                                        action="{{ route('appointment.destroy', $latest_appointment->id) }}"
                                                        id="user-form-{{ $latest_appointment->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="button"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm"
                                                            data-bs-toggle="tooltip" title='Delete'>
                                                            <span class="text-white"> <i class="ti ti-trash"></i></span>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/plugins/apexcharts.js') }}"></script>
    <script>
        "use strict";
        $(document).ready(function() {
            $('.cp_link').on('click', function() {
                var value = $(this).attr('data-link');
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(value).select();
                document.execCommand("copy");
                $temp.remove();
                toastrs('Success', '{{ __('Link copied') }}', 'success')
            });
        });

        var today = new Date()
        var curHr = today.getHours()
        var target = document.getElementById("greetings");

        if (curHr < 12) {
            target.innerHTML = "{{ __('Good Morning,') }}";
        } else if (curHr < 17) {
            target.innerHTML = "{{ __('Good Afternoon,') }}";
        } else {
            target.innerHTML = "{{ __('Good Evening,') }}";
        }

        (function() {
            var chartBarOptions = {
                series: [{
                    name: '{{ __('Appointment') }}',
                    data: {!! json_encode($chartData['data']) !!},
                }, ],

                chart: {
                    height: 300,
                    type: 'area',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: {!! json_encode($chartData['label']) !!},
                    title: {
                        text: '{{ __('Days') }}'
                    }
                },
                colors: ['#6fd944', '#6fd944'],

                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                },
                yaxis: {
                    title: {
                        text: '{{ __('Appointment') }}'
                    },

                }

            };
            var arChart = new ApexCharts(document.querySelector("#appointment-chart"), chartBarOptions);
            arChart.render();
        })();

        $(document).ready(function() {
            var customURL ='{{ route("appointments.form", $business->slug) }}';
            $('.Demo1').socialSharingPlugin({
                url: customURL,
                title: $('meta[property="og:title"]').attr('content'),
                description: $('meta[property="og:description"]').attr('content'),
                img: $('meta[property="og:image"]').attr('content'),
                enable: ['whatsapp', 'facebook', 'twitter', 'pinterest', 'instagram']
            });

            $('.socialShareButton').click(function(e) {
                e.preventDefault();
                $('.sharingButtonsContainer').toggle();
            });
        });
    </script>
@endpush
