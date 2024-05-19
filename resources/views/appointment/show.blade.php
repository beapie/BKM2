<div class="modal-body">
    <div class="row">
        <div class="col-md-6 col-sm-12 col-lg-6 ">
            <div class="">
                <address class="mb-0 text-sm">
                    <dl class="row align-items-center">
                        <dt class="col-sm-3 h6 text-sm">{{ __('Date:') }}</dt>
                        <dd class="col-sm-9 text-sm">
                            {{ $appointment->date }}
                        </dd>
                        <dt class="col-sm-3 h6 text-sm">{{ __('Duration:') }}</dt>
                        <dd class="col-sm-9 text-sm">
                            {{ $appointment->time }}
                        </dd>
                        <dt class="col-sm-3 h6 text-sm">{{ __('Customer:') }}</dt>
                        <dd class="col-sm-9 text-sm">
                            {{ !empty($appointment->CustomerData) ? $appointment->CustomerData->name : 'Guest' }}
                        </dd>
                        <dt class="col-sm-3 h6 text-sm">{{ __('Staff:') }}</dt>
                        <dd class="col-sm-9 text-sm">
                            {{ !empty($appointment->StaffData) ? $appointment->StaffData->name : '-' }}
                        </dd>
                        <dt class="col-sm-3 h6 text-sm">{{ __('Amount:') }}</dt>
                        <dd class="col-sm-9 text-sm">{{ !empty($appointment->payment) ? $appointment->payment->amount : 0 }}</dd>
                        @if (module_is_active('PromoCodes'))
                            <dt class="col-sm-3 h6 text-sm">{{ __('Coupon Price:') }}</dt>
                            <dd class="col-sm-9 text-sm">{{ !empty($appointment->payment) ? $appointment->payment->coupon_amount : 0 }}</dd>
                        @endif
                    </dl>
                </address>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-lg-6 ">
            <div class="">
                <dl class="row  align-items-center">
                    <dt class="col-sm-3 h6 text-sm">{{ __('Service:') }}</dt>
                    <dd class="col-sm-9 text-sm">
                        {{ !empty($appointment->ServiceData) ? $appointment->ServiceData->name : '-' }}
                    </dd>
                    <dt class="col-sm-3 h6 text-sm">{{ __('Location:') }}</dt>
                    <dd class="col-sm-9 text-sm">
                        {{ !empty($appointment->LocationData) ? $appointment->LocationData->name : '-' }}
                    </dd>
                    <dt class="col-sm-3 h6 text-sm">{{ __('Payment:') }}</dt>
                    <dd class="col-sm-9 text-sm">
                        {{ !empty($appointment->payment_type) ? $appointment->payment_type : '-' }}
                    </dd>
                    <dt class="col-sm-3 h6 text-sm">{{ __('Status:') }}</dt>
                    <dd class="col-sm-9 text-sm">
                        {{ !empty($appointment->StatusData) ? $appointment->StatusData->title : 'Pending' }}
                    </dd>
                    @if (module_is_active('PromoCodes'))
                        <dt class="col-sm-3 h6 text-sm">{{ __('Final Price:') }}</dt>
                        <dd class="col-sm-9 text-sm">{{ !empty($appointment->payment) ? $appointment->payment->final_amount : 0 }}</dd>
                    @endif
                    @if (module_is_active('ServiceTax'))
                            <dt class="col-sm-3 h6 text-sm">{{ __('Tax Price:') }}</dt>
                            <dd class="col-sm-9 text-sm">{{ !empty($appointment->payment) ? $appointment->payment->tax_amount : 0 }}</dd>
                    @endif
                </dl>
            </div>
        </div>
    </div>
    @if (!empty($appointment->attachment))
        <div class="row">
            <div class="col-12">
                <dl class="row  mb-0 align-items-center">
                    <dt class="col-12 h6">{{ __('Attachment') }}</dt>
                    <dd class="col-md-3 col-sm-7 text-sm">
                        <img src="{{ check_file($appointment->attachment) ? get_file($appointment->attachment) : '-' }}"
                            alt={{ str_replace(' ', '_', basename($appointment->attachment)) }}
                            class="img-fluid rounded-2" width="100%">
                    </dd>
                    <dd class="col-md-9 col-sm-5 d-flex align-items-center gap-2">
                        <div>
                            <form method="POST"
                                action="{{ route('appointment.attachment.destroy', $appointment->id) }}"
                                id="user-form-{{ $appointment->id }}">
                                @csrf
                                <button type="button"
                                    class="bg-danger btn btn-sm d-inline-flex align-items-center show_confirm"
                                    data-bs-toggle="tooltip" title='Delete'>
                                    <span class="text-white"> <i class="ti ti-trash"></i></span>
                                </button>
                            </form>
                        </div>
                        <a download
                            href="{{ check_file($appointment->attachment) ? get_file($appointment->attachment) : '-' }}"
                            class="action-btn btn-primary  btn btn-sm d-inline-flex align-items-center">
                            <i class="ti ti-download" data-toggle="popover" title="{{ __('Download') }}"></i>
                        </a>
                    </dd>
                </dl>
            </div>
        </div>
        <hr>
    @endif

    @if (!empty($appointment->custom_field))
        @php
            $customfields = json_decode($appointment->custom_field, true);
        @endphp
        <div class="row">
            <div class="col-12">
                <h5 class="mb-3">{{ __('Custom Details') }}</h5>
                @foreach ($customfields as $key => $value)
                    <dl class="row align-items-center">
                        <dt class="col-sm-5 h6">{{ $key }}:</dt>
                        <dd class="col-sm-7">
                            {{ $value }}
                        </dd>
                    </dl>
                @endforeach
            </div>
        </div>
    @endif
</div>
