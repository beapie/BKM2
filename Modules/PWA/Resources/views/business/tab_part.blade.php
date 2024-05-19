<div class="tab-pane fade @if(session('tab') and session('tab') == 11) show active @endif" id="pwa-setting" role="tabpanel" aria-labelledby="pills-user-tab-11">
    {{ Form::open(['route' => ['business.pwa-setting', $business->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
    <div class="row business-hrs">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <h5 class="">{{ __('PWA (Progressive Web App)') }}</h5>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 text-end">
                            <div class="form-check form-switch custom-switch-v1 float-end">
                                <input type="checkbox" class="form-check-input enable_pwa_business" name="enable_pwa" id="enable_pwa" {{ $business['enable_pwa'] == 'on' ? 'checked=checked' : '' }}>
                                <label class="form-check-label" for="file_enable"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('pwa_app_title', __('App Title'), ['class' => 'form-label']) }}
                                {{ Form::text('pwa_app_title', !empty($pwa_data->name) ? $pwa_data->name : '', ['class' => 'form-control custom_lbl', 'placeholder' => __('App Title'), ($business['enable_pwa'] == 'on' ? '' : 'disabled') => ($business['enable_pwa'] == 'on' ? '' : 'disabled')]) }}

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('pwa_app_name', __('App Name'), ['class' => 'form-label']) }}
                                {{ Form::text('pwa_app_name', !empty($pwa_data->short_name) ? $pwa_data->short_name : '', ['class' => 'form-control custom_lbl', 'placeholder' => __('App Name'), ($business['enable_pwa'] == 'on' ? '' : 'disabled') => ($business['enable_pwa'] == 'on' ? '' : 'disabled')]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0 pwa_is_enable">
                                <div class="form-group mb-0 pwa_is_enable ">
                                    {{ Form::label('pwa_app_background_color', __('App Background Color'), ['class' => 'form-label']) }}
                                    <div class="d-flex align-items-center color-picker-wrapper">
                                        {{ Form::color('pwa_app_background_color', !empty($pwa_data->background_color) ? $pwa_data->background_color : '', ['class' => 'form-control color-picker', 'placeholder' => __('18761234567')]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0 pwa_is_enable">
                                {{ Form::label('pwa_app_theme_color', __('App Theme Color'), ['class' => 'form-label']) }}
                                <div class="d-flex align-items-center color-picker-wrapper">
                                    {{ Form::color('pwa_app_theme_color', !empty($pwa_data->theme_color) ? $pwa_data->theme_color : '', ['class' => 'form-control color-picker', 'placeholder' => __('18761234567')]) }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="{{ __('Save Changes') }}">
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>

<script>
    $(document).on('click', '#enable_pwa', function() {
        if ($('#enable_pwa').prop('checked')) {
            $(".custom_lbl").removeAttr("disabled");
        } else {
            $('.custom_lbl').attr("disabled", "disabled");
        }
    });
</script>