
<div class="modal-body pb-0">
    @foreach($services as $service)

    @php
    $flexible_hours = \Modules\FlexibleHours\Entities\FlexibleHour::where('service_id',$service->id)->get();
    $isChecked = $flexible_hours->isNotEmpty();
    @endphp
    <div class="row">
        <div class="flexible_card card ">
            <div class="row align-items-center mb-2">
                <div class="col-12">
                    <div class="flexible_button_text d-flex align-items-center mb-3">
                        <div class="custom-control  d-flex align-items-center">
                            <input class="form-check-input service-checkbox " type="checkbox" value="" id="{{$service->id}}" {{ $isChecked ? 'checked' : '' }}>
                            <h5 class="card-title mb-0" >{{ $service->name }} - {{ currency_format_with_sym($service->price,$service->business_id) }}</h5>
                        </div>
                        @permission('flexible hour add')
                        <a class="btn btn-primary text-white btn-sm  flexible-hour-btn {{$isChecked ? '' : 'disabled' }}" data-service-id="{{$service->id}}" data-ajax-popup-over="true" data-url="{{ route('flexible.hour.add',[$service->id,'staff_id' => $staff->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Flexible Hour') }}" data-title="{{$service->name}}">{{ __('Add Flexible Hour') }}</a>
                        @endpermission
                    </div>

                </div>
                @if($flexible_hours->isNotEmpty())
                @foreach($flexible_hours as $flexible_hour)
                @php
                $days = json_decode($flexible_hour->days, true);
                $daysString = implode(' ', array_keys(array_filter($days, function($status) {
                return $status == 'on';
                })));
                @endphp
                <div class="col-ms-4 text-end mb-2">
                    <div class="flexible-wrapper d-flex">
                        <a class="text-white btn bg-info text-start" data-ajax-popup-over="true" data-url="{{ route('flexible.hour.edit',$flexible_hour->id,) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Edit Flexible Hour') }}" data-title="{{$service->name}}">{{ $daysString }}<br>
                            {{ date("g:iA", strtotime($flexible_hour->start_time))  }} - {{ date("g:iA", strtotime($flexible_hour->end_time)) }} = {{currency_format_with_sym($flexible_hour->price,$flexible_hour->business_id)}} </a>

                        {{ Form::open(['route' => ['flexible.hour.delete', $flexible_hour->id], 'class' => 'm-0']) }}
                        @method('DELETE')
                        <a href="#" class="btn bg-danger show_confirm" data-bs-toggle="tooltip" title="" data-bs-original-title="Delete" aria-label="Delete" data-confirm-yes="delete-form-3"><i class="ti ti-trash text-white text-white"></i></a>
                        {{ Form::close() }}
                    </div>

                </div>
                @endforeach
                @endif

            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    <input type="submit" value="{{ __('Create') }}" class="btn btn-primary">
</div>

<script>
    $(document).ready(function() {
        // Enable/disable button based on checkbox state
        $('.service-checkbox').change(function() {
            var serviceId = $(this).attr('id');
            var button = $('.flexible-hour-btn[data-service-id="' + serviceId + '"]');
            if ($(this).is(':checked')) {
                button.removeClass('disabled');
            } else {
                button.addClass('disabled');
            }
        });
    });
</script>