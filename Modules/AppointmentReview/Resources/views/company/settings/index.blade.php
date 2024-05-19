@php
    $company_settings = getCompanyAllSetting();
@endphp

<div class="card" id="appointment_review_sidenav">
    {{ Form::open(['route' => 'appointment.review.setting', 'enctype' => 'multipart/form-data']) }}
    <div class="card-header">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10">
                <h5 class="">{{ __('Appointment Review') }}</h5>
                <small>{{ __('Activate review settings to display staff ratings on the appointment form.') }}</small>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="form-label">{{ __('Rating') }}</label>
                <div class="form-check form-switch custom-switch-v1 float-end">
                    <input type="checkbox" name="appointment_review_is_on" class="form-check-input input-primary"
                        id="appointment_review_is_on"
                        {{ isset($company_settings['appointment_review_is_on']) && $company_settings['appointment_review_is_on'] == 'on' ? ' checked' : '' }}>
                    <label class="form-check-label" for="appointment_review_is_on"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="{{ __('Save Changes') }}">
    </div>
    {{ Form::close() }}
</div>

<div class="card" id="review_status_sidenav">
    {{ Form::open(['route' => 'review.status.setting', 'enctype' => 'multipart/form-data']) }}
    <div class="card-header">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10">
                <h5 class="">{{ __('Appointment Review Status') }}</h5>
                <small>{{ __('If the status is same in both the settings and the appointment, Appointment Review email will be sent.') }}</small>
            </div>
        </div>
    </div>
    @php
        use App\Models\CustomStatus;
        $customStatus = CustomStatus::where('created_by', creatorId())
            ->where('business_id', getActiveBusiness())
            ->get();
    @endphp
    <div class="card-body review-body">
        <div class="row">
            <div class="form-group col-md-12">
                <label class="form-label">{{ __('Appointment Status') }}</label>
                <div class="row ms-1">
                    @foreach ($customStatus as $status)
                        <div class="form-check col-md-3 col-sm-3 col-6">
                            <input class="form-check-input currency_note" type="radio" name="review_status"
                                value="{{ $status->title }}" @if (isset($company_settings['review_status']) && $company_settings['review_status'] == $status->title) checked @endif
                                id="review_status_{{ $status->title }}">
                            <label class="form-check-label" for="review_status_{{ $status->title }}">
                                {{ $status->title }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer text-end">
        <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="{{ __('Save Changes') }}">
    </div>
    {{ Form::close() }}
</div>
