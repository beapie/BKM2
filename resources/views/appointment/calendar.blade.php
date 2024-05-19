@extends('layouts.main')

@section('page-title')
    {{ __('Appointment Calendar') }}
@endsection
@section('page-breadcrumb')
    {{ __('Appointment Calendar') }}
@endsection

@section('page-action')
    <div class="col-auto ps-3 mt-1">
        @permission('appointment create')
            <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md"
                data-title="{{ __('Create New Appointment') }}" data-url="{{ route('appointment.create') }}"
                data-bs-toggle="tooltip" data-bs-original-title="{{ __('Create') }}"><i class="ti ti-plus"></i>
            </a>
        @endpermission
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-8 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>{{ __('Calendar') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id='calendar' class='calendar' data-toggle="calendar"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">{{ __('Appointments') }}</h4>
                    <ul class="event-cards list-group list-group-flush mt-3 w-100">
                        @foreach ($appointments as $appointment)
                            @php
                                $month = date('m', strtotime($appointment->date));
                            @endphp
                            @if ($month == date('m'))
                                <li class="list-group-item card mb-3">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <div class="d-flex align-items-center">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-calendar"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="m-0">
                                                        <div class="fc-daygrid-event sp-inheri">
                                                            <div class="fc-event-title-container">
                                                                <div class="fc-event-title text-dark">
                                                                    {{ $appointment->date }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </h6>
                                                    <small class="text-muted">{{ $appointment->time }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/assets/js/calendar.js') }}"></script>
    <script type="text/javascript">
        (function() {
            var etitle;
            var etype;
            var etypeclass;
            var locale = "{{ app()->getLocale() }}";
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    timeGridDay: "{{ __('Day') }}",
                    timeGridWeek: "{{ __('Week') }}",
                    dayGridMonth: "{{ __('Month') }}"
                },
                locale: locale,
                themeSystem: 'bootstrap',
                slotDuration: '00:10:00',
                navLinks: true,
                droppable: true,
                selectable: true,
                selectMirror: true,
                editable: true,
                dayMaxEvents: true,
                handleWindowResize: true,
                events: {!! json_encode($appointments) !!},
                eventClick: function(e) {
                    e.jsEvent.preventDefault();
                    var title = e.title;
                    var url = e.el.href;
                    var size = 'md';
                    $("#commonModal .modal-title").html('Appointment Details');
                    $("#commonModal .modal-dialog").addClass('modal-' + size);
                    $.ajax({
                        url: url,
                        success: function(data) {
                            $('#commonModal .body').html(data);
                            $("#commonModal").modal('show');
                            common_bind();
                        },
                        error: function(data) {
                            data = data.responseJSON;
                            toastrs('Error', data.error, 'error')
                        }
                    });
                }

            });
            calendar.render();
        })();
    </script>
@endpush
