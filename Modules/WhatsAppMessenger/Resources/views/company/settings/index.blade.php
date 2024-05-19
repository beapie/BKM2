<div class="card" id="whatsappmessenger-sidenav">
    {{ Form::open(['route' => 'whatsappmessenger.setting.store', 'enctype' => 'multipart/form-data']) }}
    @csrf
    <div class="card-header">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10">
                <h5 class="">{{ __('WhatsApp Messenger') }}</h5>
                <small>{{ __('WhatsApp live support setting for customers') }}</small>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="whatsappmessenger_number" class="form-label">{{ __('Contact Number') }}</label>
                    <input class="form-control" placeholder="{{ __('Enter Number') }}" name="whatsappmessenger_number"
                        type="text" value="{{ isset($settings['whatsappmessenger_number']) ? $settings['whatsappmessenger_number'] : '' }}"
                        id="whatsappmessenger_number">
                </div>
            </div>
        </div>

    </div>
    <div class="card-footer text-end">
        <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="{{ __('Save Changes') }}">
    </div>
    {{ Form::close() }}
</div>


