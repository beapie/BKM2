<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('AppointmentReview') }}</title>
    <link rel="stylesheet" href="{{ asset('Modules/AppointmentReview/Resources/asset/main-style.css') }}">
    <link rel="stylesheet" href="{{ asset('Modules/AppointmentReview/Resources/asset/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="icon" href="{{ asset('Modules/AppointmentReview/favicon.png') }}">
    <style>
        /* Rating Star Widgets Style */
        .rating-stars ul {
            list-style-type: none;
            padding: 0;

            -moz-user-select: none;
            -webkit-user-select: none;
        }

        .rating-stars ul>li.star {
            display: inline-block;
        }

        /* Idle State of the stars */
        .rating-stars ul>li.star>i.fa {
            font-size: 2.5em;
            /* Change the size of the stars */
            color: #ccc;
            /* Color on idle state */
        }

        /* Hover state of the stars */
        .rating-stars ul>li.star.hover>i.fa {
            color: #FFCC36;
        }

        /* Selected state of the stars */
        .rating-stars ul>li.star.selected>i.fa {
            color: #FF912C;
        }

        .rating-stars {
            width: auto;
            display: inline-block;
            padding: 4px;
        }

        .rating-stars .stars {
            display: inline-block;
        }
    </style>

</head>

<body>
    <div class="review-page-sec">
        <div class="section-title text-center">
            <h2>{{ $business->name }}</h2>
        </div>
        <div class="review-page-sec-inner">
            <div class="review-form-wrp">
                <div class="row">
                    <div class="col-md-6 col-12">
                        {{ Form::open(['route' => ['review.store', $id], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

                        <input type="hidden" name="appointment_id" value="{{ $appointment_id }}">
                        <input type="hidden" name="business_id" value="{{ $business_id }}">
                        <input type="hidden" name="staff_id" value="{{ $staff_id }}">
                        <div class="review-wrp d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ check_file($staff->user->avatar) ? get_file($staff->user->avatar) : get_file('uploads/default/avatar.png') }}"
                                    class="wid-30 rounded-circle me-3" alt="avatar image" height="30">
                                <p class="mb-0">{{ $staff->name }}</p>
                            </div>
                        </div>
                        <div class='rating-stars form-group'>
                            {{ Form::label('review', __('Rating'), ['class' => 'form-label']) }}
                            <ul id='stars'>
                                <li class='star' title='Poor' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Fair' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Good' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Excellent' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                            {!! Form::hidden('review', null, ['id' => 'review']) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', __('Review'), ['class' => 'form-label']) }}
                            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Review', 'rows' => '10', 'required' => 'required']) }}
                        </div>
                        <div class="form-footer">
                            <input type="submit" value="{{ __('Save') }}" class="btn btn-sm btn-primary">
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-right-image">
                            <div class="form-wrp-image">
                                <img src="{{ asset('Modules/AppointmentReview/Resources/asset/images/form-wrp-img.png') }}"
                                    alt="form-image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="customer-review-wrp">
                <div class="review-title">
                    <h3>{{ __('Customer Review') }}</h3>
                </div>
                @foreach ($appointmentReviews as $appointmentReview)
                    @php
                        $created_at = $appointmentReview->created_at;
                        $current_time = time();
                        $created_at_timestamp = strtotime($created_at);
                        $time_difference = $current_time - $created_at_timestamp;
                        $weeks = floor($time_difference / (7 * 24 * 60 * 60));
                        $html_output = "{$weeks} Week" . ($weeks > 1 ? 's' : '') . ' ago';
                        $rating = $appointmentReview->review;
                        $max_rating = 5;
                    @endphp
                    <div class="testimonial-card">
                        <div class="testimonial-image">
                            <img src="{{ check_file($customers->customer->avatar) ? get_file($customers->customer->avatar) : get_file('uploads/users-avatar/avatar.png') }}"
                                alt="estimonial-image">
                        </div>
                        <div class="testimonial-content">
                            <h4>
                                @if ($appointmentReview->AppointmentData)
                                    @if ($appointmentReview->AppointmentData->CustomerData)
                                        {{ $appointmentReview->AppointmentData->CustomerData->name }}
                                    @else
                                        {{ $appointmentReview->AppointmentData->name }}
                                    @endif
                                @endif
                            </h4>
                            <div class="review-star-wrp d-flex align-items-center">
                                <div class="stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($rating < $i)
                                            @if (is_float($rating) && round($rating) == $i)
                                                <i class="text-warning fas fa-star-half-alt"></i>
                                            @else
                                                <i class="fas fa-star"></i>
                                            @endif
                                        @else
                                            <i class="text-warning fas fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span>{{ $html_output }}</span>
                            </div>
                            <p>{{ $appointmentReview->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999">
        <div id="liveToast" class="toast text-white  fade" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"> </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/custom-bootstrap.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
@if ($message = Session::get('success'))
    <script>
        toastrs('Success', '{!! $message !!}', 'success');
    </script>
@endif
@if ($message = Session::get('error'))
    <script>
        toastrs('Error', '{!! $message !!}', 'error');
    </script>
@endif
<script>
    $(document).ready(function() {
        $('#stars li').on('click', function() {
            var selectedValue = $(this).data('value');
            $('#review').val(selectedValue);
        });
    });
</script>
<script>
    $(document).ready(function() {

        /* 1. Visualizing things on Hover - See next part for action on click */
        $(document).on('mouseover', '#stars li', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function() {
            $(this).parent().children('li.star').each(function(e) {
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $(document).on('click', '#stars li', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');
            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            $('#rating_no').val(onStar);
            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
            if (ratingValue > 1) {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            } else {
                msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
            }
            responseMessage(msg);

        });
    });

    function responseMessage(msg) {
        $('.success-box').fadeIn(200);
        $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }
</script>

</html>
