
<div class="modal-body">
    <div class="form-control-label">{{ __('Customer') }} : </div>
    <p class="text-muted mb-4">
        {{ !empty($appointments->CustomerData) ? $appointments->CustomerData->name : 'Guest' }}
    </p>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-control-label">{{ __('Staff') }} </div>
            <p class="text-muted mb-4">
                {{ !empty($appointments->StaffData) ? $appointments->StaffData->name : '-' }}
            </p>
        </div>
        <div class="col-md-6">
            <div class="form-control-label">{{ __('Service') }} </div>
            <p class="text-muted mb-4">
                {{ !empty($appointments->ServiceData) ? $appointments->ServiceData->name : '-' }}
            </p>
        </div>
        <div class="col-md-6">
            <div class="form-control-label">{{ __('Location') }} </div>
            <p class="text-muted mb-4">
                {{ !empty($appointments->LocationData) ? $appointments->LocationData->name : '-' }}
            </p>
        </div>
        <div class="col-md-6">
            <div class="form-control-label">{{ __('Payment Type') }} </div>
            <p class="text-muted mb-4">
                {{ !empty($appointments->payment_type) ? $appointments->payment_type : '-' }}
            </p>
        </div>
        <div class="col-md-6">
            <div class="form-control-label">{{ __('Appointment Status') }} </div>
            <p class="text-muted mb-4">
                {{ !empty($appointments->appointment_status) ? $appointments->appointment_status : '-' }}
            </p>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="form-control-label">{{ __('Date') }}</div>
            <p class="mt-1">{{ $appointments->date }}</p>
        </div>
        <div class="col-md-6">
            <div class="form-control-label">{{ __('Time') }}</div>
            <p class="mt-1">{{ $appointments->time }}</p>
        </div>
    </div>
</div>


