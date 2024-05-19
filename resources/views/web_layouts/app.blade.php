<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="form-one">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $module }}</title>
    <meta name="description" content="form-one">
    <meta name="keywords" content="form-one">
    <link rel="icon" href="{{ asset('Modules/' . $module . '/favicon.png') }}">
    @if ($module == 'Spawellness')
        <link
            href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Dosis:wght@200..800&display=swap&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('Modules/' . $module . '/Resources/assets/css/animate.min.css') }}">
    @endif
    @if ($module == 'Law')
        <link
            href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
            rel="stylesheet">
    @endif
    @if ($module == 'Yoga')
        <link
            href="https://fonts.googleapis.com/css2?family=Aladin&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
    @endif
    @if ($module == 'EventPlanning')
        <link
            href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
            rel="stylesheet">
    @endif
    @if ($module == 'RealEstate')
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Questrial&display=swap"
            rel="stylesheet">
    @endif
    @if ($module == 'RiverRafting')
        <link
            href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap"
            rel="stylesheet">
    @endif
    @if ($module == 'Healthcare')
        <link
            href="https://fonts.googleapis.com/css2?family=Aoboshi+One&family=Outfit:wght@100..900&family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap"
            rel="stylesheet">
    @endif
    <link
        href="https://fonts.googleapis.com/css2?family=Kaisei+Tokumin&family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('Modules/' . $module . '/Resources/assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Modules/' . $module . '/Resources/assets/css/main-style.css') }}">
    <link rel="stylesheet" href="{{ asset('Modules/' . $module . '/Resources/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('form_layouts/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('module_assets/custom.css') }}">
    {{-- pwa customer app --}}
    <meta name="mobile-wep-app-capable" content="yes">
    <meta name="apple-mobile-wep-app-capable" content="yes">
    <meta name="msapplication-starturl" content="/">
    @if ($business->enable_pwa == 'on')
        <link rel="manifest" href="{{ get_file('uploads/theme_app/business_' . $business->id . '/manifest.json') }}" />
    @endif
    @if (!empty($business->pwa_business($business->slug)->theme_color))
        <meta name="theme-color" content="{{ $business->pwa_business($business->slug)->theme_color }}" />
    @endif
    @if (!empty($business->pwa_business($business->slug)->background_color))
        <meta name="apple-mobile-web-app-status-bar"
            content="{{ $business->pwa_business($business->slug)->background_color }}" />
    @endif
    {{-- custom-css --}}
    @if (!empty($customCss))
        <style type="text/css">
            {{ htmlspecialchars_decode($customCss) }}
        </style>
    @endif
    @stack('css')
</head>

<body>
    @if (isset($pixelScript))
        @foreach ($pixelScript as $script)
            <?= $script ?>
        @endforeach
    @endif
    @yield('content')

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999">
        <div id="liveToast" class="toast text-white  fade" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"> </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="{{ asset('Modules/' . $module . '/Resources/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('Modules/' . $module . '/Resources/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('Modules/' . $module . '/Resources/assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    
    @if ($business->enable_pwa_business == 'on')
        <script type="text/javascript">
                const container = document.querySelector("body")

                const coffees = [];

                if ("serviceWorker" in navigator) {
                    window.addEventListener("load", function() {
                        navigator.serviceWorker
                            .register("{{ asset('Modules/PWA/Resources/assets/js/serviceWorker.js') }}")
                            .then(res => console.log("service worker registered"))
                            .catch(err => console.log("service worker not registered", err))

                    })
                }
        </script>
    @endif
    <script>
        $(document).ready(function() {
            //service & location wise staff dropdown start
            $('#serviceSelect, #locationSelect').change(function() {
                var serviceValue = $('#serviceSelect').val();
                var locationValue = $('#locationSelect').val();

                // Check if both service and location are selected
                if (serviceValue && locationValue) {
                    fetchStaffData(serviceValue, locationValue);
                } else {
                    // Clear staff dropdown if either service or location is not selected
                    $('#staffSelect').empty();
                }
            });

            function fetchStaffData(serviceId, locationId) {
                $.ajax({
                    url: '{{ route('get.staff.data') }}',
                    method: 'GET',
                    data: {
                        service: serviceId,
                        location: locationId
                    },
                    success: function(response) {
                        updateStaffDropdown(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching staff data:', error);
                    }
                });
            }

            function updateStaffDropdown(staffData) {
                var staffSelect = $('#staffSelect');

                staffSelect.empty(); // Clear existing options
                staffSelect.append($('<option>', {
                    value: '',
                    text: 'Select staff'
                }));
                $.each(staffData, function(index, staff) {
                    staffSelect.append($('<option>', {
                        value: staff.user.id,
                        text: staff.name
                    }));
                });

                staffSelect.niceSelect('update');
            }
            //service & location wise staff dropdown end

            var daysOfWeek = '{{ json_encode($combinedArray) }}';
            var unavailableDates = '{{ json_encode($businesholiday) }}';
            $('#datepicker').datepicker({
                startDate: '+0d',
                format: 'dd-mm-yyyy',
                autoclose: true,
                daysOfWeekDisabled: daysOfWeek,
                datesDisabled: unavailableDates
            });
            // timeSlot duration start
            $('#serviceSelect').change(function() {
                var selectedService = $(this).val();
                var selectedDate = $('#datepicker').val();
                appointmentTimeSlot(selectedService, selectedDate);
            });


            $('#datepicker').on('changeDate', function() {
                var selectedService = $('#serviceSelect').val();
                var selectedDate = $(this).val();
                appointmentTimeSlot(selectedService, selectedDate);
            });

            function appointmentTimeSlot(selectedService, selectedDate) {
                if (selectedService && selectedDate) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: '{{ route('appointment.duration') }}',
                        method: 'POST',
                        data: {
                            service: selectedService,
                            date: selectedDate
                        },
                        context: this,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            if (response.result == 'success') {
                                // Handle the response from the server
                                var timeSlots = response.timeSlots;
                                // Display time slots below the datepicker
                                var timeSlotsContainer = $('#timeSlotsContainer');
                                timeSlotsContainer.empty(); // Clear previous time slots

                                if (timeSlots.length > 0) {

                                    timeSlots.forEach(function(timeSlot, index) {
                                        var newLiTag = $('<li class="checkbox-custom">');
                                        var input = $('<input type="radio">')
                                            .attr('id', 'radio' + index)
                                            .attr('name', 'duration')
                                            .attr('class', 'timeslot')
                                            .attr('data-id',timeSlot.flexible_id)
                                            .attr('service-id',timeSlot.service_id)
                                            .attr('value', timeSlot.start + '-' + timeSlot.end);
                                            input.attr('data-is', 'true');
                                            if (timeSlot.flexible_id) {
                                                input.addClass('timeslot-flexible');
                                            }
                                            

                                        var label = $('<label>')
                                            .attr('for', 'radio' + index)
                                            .addClass('btn');

                                            if (timeSlot.flexible_id) {
                                                label.addClass('timeslot-flexible');
                                            }

                                        var svgIcon = $(
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <g clip-path="url(#clip0_74_1151)">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <path d="M13.5634 11.7659L10.7748 9.67449V5.41426C10.7748 4.9859 10.4286 4.63965 10.0002 4.63965C9.57184 4.63965 9.22559 4.9859 9.22559 5.41426V10.0618C9.22559 10.3058 9.34023 10.5359 9.53543 10.6815L12.6338 13.0053C12.7732 13.1099 12.9359 13.1602 13.0978 13.1602C13.334 13.1602 13.5664 13.0541 13.7182 12.8496C13.9755 12.508 13.9057 12.0223 13.5634 11.7659Z" fill="#100F17"/>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <path d="M10 0C4.48566 0 0 4.48566 0 10C0 15.5143 4.48566 20 10 20C15.5143 20 20 15.5143 20 10C20 4.48566 15.5143 0 10 0ZM10 18.4508C5.34082 18.4508 1.54918 14.6592 1.54918 10C1.54918 5.34082 5.34082 1.54918 10 1.54918C14.66 1.54918 18.4508 5.34082 18.4508 10C18.4508 14.6592 14.6592 18.4508 10 18.4508Z" fill="#100F17"/>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </g>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </svg>'
                                        );
                                        var svgIcon = $(
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <g clip-path="url(#clip0_74_1151)">\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <path d="M13.5634 11.7659L10.7748 9.67449V5.41426C10.7748 4.9859 10.4286 4.63965 10.0002 4.63965C9.57184 4.63965 9.22559 4.9859 9.22559 5.41426V10.0618C9.22559 10.3058 9.34023 10.5359 9.53543 10.6815L12.6338 13.0053C12.7732 13.1099 12.9359 13.1602 13.0978 13.1602C13.334 13.1602 13.5664 13.0541 13.7182 12.8496C13.9755 12.508 13.9057 12.0223 13.5634 11.7659Z" fill="#100F17"/>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <path d="M10 0C4.48566 0 0 4.48566 0 10C0 15.5143 4.48566 20 10 20C15.5143 20 20 15.5143 20 10C20 4.48566 15.5143 0 10 0ZM10 18.4508C5.34082 18.4508 1.54918 14.6592 1.54918 10C1.54918 5.34082 5.34082 1.54918 10 1.54918C14.66 1.54918 18.4508 5.34082 18.4508 10C18.4508 14.6592 14.6592 18.4508 10 18.4508Z" fill="#100F17"/>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </g>\
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </svg>'
                                        );

                                        var span = $('<span>').text(timeSlot.start + ' to ' +
                                            timeSlot.end);

                                        // Append elements to label
                                        label.append(svgIcon);
                                        label.append(span);

                                        // Append elements to li tag
                                        newLiTag.append(input);
                                        newLiTag.append(label);

                                        // Append new li tag to ul
                                        timeSlotsContainer.append(newLiTag);
                                    });
                                } else {
                                    timeSlotsContainer.append('<p>No available time slots.</p>');
                                }
                            }
                        }
                    });
                }
            }
            // timeSlot duration end

            // book-appointment start
            $('.tab-link').on('click', function() {
                var selectedTab = $(this).data('tab');
                $('#selected_tab').val(selectedTab);
            });

            var services = @json($services);
            $('#serviceSelect').on('change', function() {
                var selectedId = $(this).val();
                var selectedService = services.find(service => service.id == selectedId);
                $('#serviceAmount').html('Total Amount: ' + selectedService.price);
            });
        })

        $('.payment_method').change(function() {
            var paymentMethod = $('input[name="payment_method"]:checked').data('payment');
            $('input[name="payment"]').val(paymentMethod);
        });

        $('#appointment-form').on('change', function(e) {
            var paymentAction = $('[data-payment-action]:checked').data("payment-action");
            action = '{{ route('appointment.form.submit') }}';
            if (paymentAction) {
                action = paymentAction;
                $("#appointment-form").attr("action", paymentAction);
            }
        });

        $(document).on('submit', '#appointment-form', function(e) {
                e.preventDefault();

                var isValid = validateFinalStepBeforeSubmit(); // Validate fields in the selected tab
                if (!isValid) {
                    return;
                }

                var formData = new FormData(this);
                var customerTab = $('.tab-content.active').find('input');
                customerTab.each(function() {
                    var inputName = $(this).attr('name');
                    var inputValue = $(this).val();
                    formData.append(inputName, inputValue);
                });
                   //flexible hour module logic
                   $('.timeslot:checked').each(function() {
                    var parentLi = $(this).closest('li');
                    var isFlexible = parentLi.find('.timeslot-flexible').attr('data-is');
                    if (isFlexible === 'true') {
                        formData.append('flexible_id', $(this).attr('data-id'));
                    }
                });
                var customerTab = customerTab.serialize();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: action,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        if (response.msg == 'success') {
                            window.location.href = response.url;
                        } else {
                            $('.alert-danger').removeClass('d-none');
                            $('.error-msg').html(response.error);
                        }
                    }
                });
            });

        // Check if appointment_number exists and activate all steps
        var appointment_number = '{{ $appointment_number }}';
        if (appointment_number != null && appointment_number != '') {
            $('.stapes_status').addClass('active')
            $('.step-container').addClass('d-none')
            $('.step-container').last().removeClass('d-none')
            $('.step-container').last().addClass('active')
            $('.step-container').first().removeClass('active')
            if (appointment_number == 'failed') {
                window.location.hash = '#appointment';
                $('.step-container').first().hide();
                text = 'Payment transaction unsuccessful. Please try again later or contact support for assistance.';
                $('#appointment_number').html(text);
            } else {
                window.location.hash = '#appointment';
                $('.step-container').first().hide();
                text = "Thank you! Your appointment booked successfully. Your appointment number is: " + appointment_number;
                $('#appointment_number').html(text);
            }
        }

        // step form validation start
        $(".step-container").on("click", ".next", function() {
            var buttonClicked = $(this);

            if (!validateCurrentStep(buttonClicked)) {
                return false;
            }

            if (buttonClicked.parents(".step-container").next().hasClass('final_stepss')) {
                $(".steps li").eq(buttonClicked.parents(".step-container").index() + 1).addClass(
                    "active");
                $(".step-container").removeClass("active");
                $(".final_stepss").addClass("active");
            } else {
                // Otherwise, move to the next step
                $(".steps li").eq(buttonClicked.parents(".step-container").index() + 1).addClass(
                    "active");
                buttonClicked.parents(".step-container").removeClass("active").next().addClass(
                    "active");
            };
        });

        // book-appointment end

        function validateCurrentStep(buttonClicked) {
            var isValid = true;
            var currentStep = buttonClicked.parents(".step-container");

            if (currentStep.hasClass('final_stepss')) {
                var selectedTab = $(".tabs-wrapper .tabs .active").attr("data-tab");
                isValid = validateFinalStep(selectedTab);
            } else {
                // Otherwise, validate fields for the current step
                var currentStepIndex = currentStep.index() + 1;
                if (currentStepIndex == "1") {
                    isValid = validateStep1();
                } else if (currentStepIndex == "2") {
                    isValid = validateStep2();
                }
                // Add more conditions for additional steps if needed
            }

            return isValid;
        }

        function validateFinalStepBeforeSubmit() {
            var selectedTab = $(".tabs-wrapper .tabs .active").attr("data-tab");
            return validateFinalStep(selectedTab);
        }

        function validateFinalStep(selectedTab) {
            var isValid = true;

            switch (selectedTab) {
                case "new-user":
                    isValid = validateNewUserFields();
                    break;
                case "existing-user":
                    isValid = validateExistingUserFields();
                    break;
                case "guest-user":
                    isValid = validateGuestUserFields();
                    break;
                default:
                    isValid = true;
            }

            return isValid;
        }

        function validateNewUserFields() {
            // Example validation for new user fields
            var name = $('#new-user #name').val();
            var email = $('#new-user #email').val();
            var password = $('#new-user #password').val();
            var contact = $('#new-user #contact').val();

            if (!name || !email || !password || !contact) {
                alert('Please fill in all required fields for new user.');
                return false;
            }
            return true;
        }

        function validateExistingUserFields() {
            // Example validation for new user fields
            var email = $('#existing-user #email').val();
            var password = $('#existing-user #password').val();
            if (!email || !password) {
                alert('Please fill in all required fields for existing user.');
                return false;
            }
            return true;
        }

        function validateGuestUserFields() {
            // Example validation for new user fields
            var name = $('#guest-user #name').val();
            var contact = $('#guest-user #contact').val();
            if (!name || !email || !contact) {
                alert('Please fill in all required fields for guest user.');
                return false;
            }
            return true;
        }


        function validateStep1() {
            var service = $('#serviceSelect').val();
            var staff = $('#staffSelect').val();
            var location = $('#locationSelect').val();

            if (!service || !staff || !location) {
                alert('Please select all required fields.');
                return false;
            }

            return true;
        }

        function validateStep2() {
            var date = $('#datepicker').val();
            var timeslot = $('.timeslot').is(':checked');
            if (!date || !timeslot) {
                alert('Please select all required field.');
                return false;
            }
            return true;
        }

        // step form validation end
        // step form validation end
    </script>
    @if ($module == 'Spawellness' && $module == 'Barber')
        <script>
            new WOW().init();
        </script>
    @endif

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
    @stack('script')

    {{-- custom-js --}}
    @if (!empty($customJs))
        <script type="text/javascript">
            {!! htmlspecialchars_decode($customJs) !!}
        </script>
    @endif
</body>

</html>
