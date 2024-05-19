<!--Brand Settings-->
<div id="site-settings" class="">
    {{ Form::open(['route' => ['company.settings.save'], 'enctype' => 'multipart/form-data', 'id' => 'setting-form']) }}
    @method('post')
    <div class="card">
        <div class="card-header">
            <h5>{{ __('Brand Settings') }}</h5>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-lg-4 col-12 d-flex">
                    <div class="card w-100">
                        <div class="card-header">
                            <h5 class="small-title">{{ __('Logo Dark') }}</h5>
                        </div>
                        <div class="card-body setting-card setting-logo-box p-3">
                            <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                <div class="logo-content img-fluid logo-set-bg  text-center py-2">
                                    @php
                                        $logo_dark = isset($settings['logo_dark']) ? (check_file($settings['logo_dark']) ? $settings['logo_dark'] : 'uploads/logo/logo_dark.png') : 'uploads/logo/logo_dark.png';
                                    @endphp
                                    <img alt="image" src="{{ get_file($logo_dark) }}{{ '?' . time() }}"
                                        class="small-logo" id="pre_default_logo">
                                </div>
                                <div class="choose-files mt-3">
                                    <label for="logo_dark">
                                        <div class=" bg-primary "> <i
                                                class="ti ti-upload px-1"></i>{{ __('Choose file here') }}</div>
                                        <input type="file" class="form-control file" name="logo_dark" id="logo_dark"
                                            data-filename="logo_dark"
                                            onchange="document.getElementById('pre_default_logo').src = window.URL.createObjectURL(this.files[0])">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 d-flex">
                    <div class="card w-100">
                        <div class="card-header">
                            <h5 class="small-title">{{ __('Logo Light') }}</h5>
                        </div>
                        <div class="card-body setting-card setting-logo-box p-3">
                            <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                <div class="logo-content img-fluid logo-set-bg text-center py-2">
                                    @php
                                        $logo_light = isset($settings['logo_light']) ? (check_file($settings['logo_light']) ? $settings['logo_light'] : 'uploads/logo/logo_light.png') : 'uploads/logo/logo_light.png';
                                    @endphp
                                    <img alt="image" src="{{ get_file($logo_light) }}{{ '?' . time() }}"
                                        class="img_setting small-logo" id="landing_page_logo">
                                </div>
                                <div class="choose-files mt-3">
                                    <label for="logo_light">
                                        <div class=" bg-primary "> <i
                                                class="ti ti-upload px-1"></i>{{ __('Choose file here') }}</div>
                                        <input type="file" class="form-control file" name="logo_light"
                                            id="logo_light" data-filename="logo_light"
                                            onchange="document.getElementById('landing_page_logo').src = window.URL.createObjectURL(this.files[0])">

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 d-flex">
                    <div class="card w-100">
                        <div class="card-header">
                            <h5 class="small-title">{{ __('Favicon') }}</h5>
                        </div>
                        <div class="card-body setting-card setting-logo-box p-3">
                            <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                <div class="logo-content img-fluid logo-set-bg text-center py-2">
                                    @php
                                        $favicon = isset($settings['favicon']) ? (check_file($settings['favicon']) ? $settings['favicon'] : 'uploads/logo/favicon.png') : 'uploads/logo/favicon.png';
                                    @endphp
                                    <img src="{{ get_file($favicon) }}{{ '?' . time() }}" class="setting-img"
                                        width="40px" id="img_favicon" />
                                </div>
                                <div class="choose-files mt-3">
                                    <label for="favicon">
                                        <div class=" bg-primary "> <i
                                                class="ti ti-upload px-1"></i>{{ __('Choose file here') }}</div>
                                        <input type="file" class="form-control file" name="favicon" id="favicon"
                                            data-filename="favicon"
                                            onchange="document.getElementById('img_favicon').src = window.URL.createObjectURL(this.files[0])">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5 col-12">
                    <div class="form-group">
                        <label for="title_text" class="form-label">{{ __('Title Text') }}</label>
                        {{ Form::text('title_text', !empty($settings['title_text']) ? $settings['title_text'] : null, ['class' => 'form-control', 'placeholder' => __('Enter Title Text')]) }}
                    </div>
                </div>
                <div class="col-sm-5 col-12">
                    <div class="form-group">
                        <label for="footer_text" class="form-label">{{ __('Footer Text') }}</label>
                        {{ Form::text('footer_text', !empty($settings['footer_text']) ? $settings['footer_text'] : null, ['class' => 'form-control', 'placeholder' => __('Enter Footer Text')]) }}
                    </div>
                </div>

                <div class="col-sm-2 col-12">
                    <h6 class="">
                        <i data-feather="align-right" class=""></i>{{ __('Enable RTL') }}
                    </h6>
                    <div class="form-check form-switch mt-2">
                        <input type="checkbox" class="form-check-input" id="site_rtl" name="site_rtl"
                            {{ isset($settings['site_rtl']) && $settings['site_rtl'] == 'on' ? 'checked' : '' }} />
                        <label class="form-check-label f-w-600 pl-1" for="site_rtl">{{ __('RTL Layout') }}</label>
                    </div>
                </div>

                <div class="row mt-2">
                    <h4 class="small-title">{{ __('Theme Customizer') }}</h4>
                    <div class="settings-card p-3">
                        <div class="row">
                            <div class="col-lg-4 col-xl-4 col-md-4">
                                <h6 class="">
                                    <i data-feather="credit-card" class="me-2"></i>{{ __('Primary color settings') }}
                                </h6>
                                <hr class="my-2" />
                                <div class="color-wrp">
                                    <div class="theme-color themes-color">
                                        <a href="#!"
                                            class="themes-color-change{{ isset($settings['color']) && $settings['color'] == 'theme-1' ? 'active_color' : '' }}"
                                            data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                        <input type="radio" class="d-none"
                                            {{ isset($settings['color']) && $settings['color'] == 'theme-1' ? 'checked' : '' }}
                                            name="color" value="theme-1">

                                        <a href="#!"
                                            class="themes-color-change{{ isset($settings['color']) && $settings['color'] == 'theme-2' ? 'active_color' : '' }} "
                                            data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                        <input type="radio" class="d-none"
                                            {{ isset($settings['color']) && $settings['color'] == 'theme-2' ? 'checked' : '' }}
                                            name="color" value="theme-2">
                                        <a href="#!"
                                            class="themes-color-change{{ isset($settings['color']) && $settings['color'] == 'theme-3' ? 'active_color' : '' }}"
                                            data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                        <input type="radio" class="d-none"
                                            {{ isset($settings['color']) && $settings['color'] == 'theme-3' ? 'checked' : '' }}
                                            name="color" value="theme-3">
                                        <a href="#!"
                                            class="themes-color-change{{ isset($settings['color']) && $settings['color'] == 'theme-4' ? 'active_color' : '' }}"
                                            data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                        <input type="radio" class="d-none"
                                            {{ isset($settings['color']) && $settings['color'] == 'theme-4' ? 'checked' : '' }}
                                            name="color" value="theme-4">
                                        <a href="#!"
                                            class="themes-color-change{{ isset($settings['color']) && $settings['color'] == 'theme-5' ? 'active_color' : '' }}"
                                            data-value="theme-5" onclick="check_theme('theme-5')"></a>
                                        <input type="radio" class="d-none"
                                            {{ isset($settings['color']) && $settings['color'] == 'theme-5' ? 'checked' : '' }}
                                            name="color" value="theme-5">
                                        <a href="#!"
                                            class="themes-color-change{{ isset($settings['color']) && $settings['color'] == 'theme-6' ? 'active_color' : '' }}"
                                            data-value="theme-6" onclick="check_theme('theme-6')"></a>
                                        <input type="radio" class="d-none"
                                            {{ isset($settings['color']) && $settings['color'] == 'theme-6' ? 'checked' : '' }}
                                            name="color" value="theme-6">
                                        <a href="#!"
                                            class="themes-color-change{{ isset($settings['color']) && $settings['color'] == 'theme-7' ? 'active_color' : '' }}"
                                            data-value="theme-7" onclick="check_theme('theme-7')"></a>
                                        <input type="radio" class="d-none"
                                            {{ isset($settings['color']) && $settings['color'] == 'theme-7' ? 'checked' : '' }}
                                            name="color" value="theme-7">
                                        <a href="#!"
                                            class="themes-color-change{{ isset($settings['color']) && $settings['color'] == 'theme-8' ? 'active_color' : '' }}"
                                            data-value="theme-8" onclick="check_theme('theme-8')"></a>
                                        <input type="radio" class="d-none"
                                            {{ isset($settings['color']) && $settings['color'] == 'theme-8' ? 'checked' : '' }}
                                            name="color" value="theme-8">
                                        <a href="#!"
                                            class="themes-color-change{{ isset($settings['color']) && $settings['color'] == 'theme-9' ? 'active_color' : '' }}"
                                            data-value="theme-9" onclick="check_theme('theme-9')"></a>
                                        <input type="radio" class="d-none"
                                            {{ isset($settings['color']) && $settings['color'] == 'theme-9' ? 'checked' : '' }}
                                            name="color" value="theme-9">
                                        <a href="#!"
                                            class="themes-color-change{{ isset($settings['color']) && $settings['color'] == 'theme-10' ? 'active_color' : '' }}"
                                            data-value="theme-10" onclick="check_theme('theme-10')"></a>
                                        <input type="radio" class="d-none"
                                            {{ isset($settings['color']) && $settings['color'] == 'theme-10' ? 'checked' : '' }}
                                            name="color" value="theme-10">
                                    </div>
                                    <div class="color-picker-wrp ">
                                        <input type="color"
                                            value="{{ isset($settings['color']) ? $settings['color'] : '' }}"
                                            class="colorPicker {{ isset($settings['color_flag']) && $settings['color_flag'] == 'true' ? 'active_color' : '' }}"
                                            name="custom_color" id="color-picker">
                                        <input type='hidden' name="color_flag"
                                            value={{ isset($settings['color_flag']) && $settings['color_flag'] == 'true' ? 'true' : 'false' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-md-4">
                                <h6>
                                    <i data-feather="layout" class="me-2"></i> {{ __('Sidebar settings') }}
                                </h6>
                                <hr class="my-2" />
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="site_transparent"
                                        name="site_transparent"
                                        {{ isset($settings['site_transparent']) && $settings['site_transparent'] == 'on' ? 'checked' : '' }} />

                                    <label class="form-check-label f-w-600 pl-1"
                                        for="site_transparent">{{ __('Transparent layout') }}</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-md-4">
                                <h6 class="">
                                    <i data-feather="sun" class=""></i>{{ __('Layout settings') }}
                                </h6>
                                <hr class=" my-2 " />
                                <div class="form-check form-switch mt-2" id="style-link"
                                    data-style-dark="{{ asset('assets/css/style-dark.css') }}"
                                    data-style-light="{{ asset('assets/css/style.css') }}">

                                    <input type="checkbox" class="form-check-input" id="cust-darklayout"
                                        name="cust_darklayout"
                                        {{ isset($settings['cust_darklayout']) && $settings['cust_darklayout'] == 'on' ? 'checked' : '' }} />
                                    <label class="form-check-label f-w-600 pl-1"
                                        for="cust-darklayout">{{ __('Dark Layout') }}</label>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer text-end">
            <input class="btn btn-print-invoice  btn-primary " type="submit" value="{{ __('Save Changes') }}">
        </div>
        {{ Form::close() }}
    </div>
</div>

<!--system settings-->
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card" id="system-settings">
            <div class="card-header">
                <h5 class="small-title">{{ __('System Settings') }}</h5>
            </div>
            {{ Form::open(['route' => ['company.system.setting.store'], 'id' => 'setting-system-form']) }}
            @method('post')
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-2">
                        <div class="form-group col switch-width">
                            {{ Form::label('currency_format', __('Decimal Format'), ['class' => ' col-form-label']) }}
                            <select class="form-control" data-trigger name="currency_format" id="currency_format"
                                placeholder="This is a search placeholder">
                                <option value="0"
                                    {{ isset($settings['currency_format']) && $settings['currency_format'] == '0' ? 'selected' : '' }}>
                                    1</option>
                                <option value="1"
                                    {{ isset($settings['currency_format']) && $settings['currency_format'] == '1' ? 'selected' : '' }}>
                                    1.0</option>
                                <option value="2"
                                    {{ isset($settings['currency_format']) && $settings['currency_format'] == '2' ? 'selected' : '' }}>
                                    1.00</option>
                                <option value="3"
                                    {{ isset($settings['currency_format']) && $settings['currency_format'] == '3' ? 'selected' : '' }}>
                                    1.000</option>
                                <option value="4"
                                    {{ isset($settings['currency_format']) && $settings['currency_format'] == '4' ? 'selected' : '' }}>
                                    1.0000</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group col switch-width">
                            {{ Form::label('defult_currancy', __('Default Currancy'), ['class' => ' col-form-label']) }}
                            <select class="form-control" data-trigger name="defult_currancy" id="defult_currancy"
                                placeholder="This is a search placeholder">
                                @foreach (currency() as $c)
                                    <option value="{{ $c->symbol }}-{{ $c->code }}"
                                        data-symbol="{{ $c->symbol }}"
                                        {{ isset($settings['defult_currancy']) && $settings['defult_currancy'] == $c->code ? 'selected' : '' }}>
                                        {{ $c->symbol }} - {{ $c->code }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group col switch-width">
                            {{ Form::label('defult_language', __('Default Language'), ['class' => ' col-form-label']) }}
                            <select class="form-control" data-trigger name="defult_language" id="defult_language"
                                placeholder="This is a search placeholder">
                                @foreach (languages() as $key => $language)
                                    <option value="{{ $key }}"
                                        {{ isset($settings['defult_language']) && $settings['defult_language'] == $key ? 'selected' : '' }}>
                                        {{ Str::ucfirst($language) }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="form-group col switch-width">
                            {{ Form::label('defult_timezone', __('Default Timezone'), ['class' => ' col-form-label']) }}
                            {{ Form::select('defult_timezone', $timezones, isset($settings['defult_timezone']) ? $settings['defult_timezone'] : null, ['id' => 'timezone', 'class' => 'form-control choices', 'searchEnabled' => 'true']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"
                                for="example3cols3Input">{{ __('Currency Symbol Position') }}</label>
                            <div class="row ms-1">
                                <div class="form-check col-md-6">
                                    <input class="form-check-input" type="radio"
                                        name="site_currency_symbol_position" value="pre"
                                        @if (!isset($settings['site_currency_symbol_position']) || $settings['site_currency_symbol_position'] == 'pre') checked @endif id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ __('Pre') }}
                                    </label>
                                </div>
                                <div class="form-check col-md-6">
                                    <input class="form-check-input" type="radio"
                                        name="site_currency_symbol_position" value="post"
                                        @if (isset($settings['site_currency_symbol_position']) && $settings['site_currency_symbol_position'] == 'post') checked @endif id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        {{ __('Post') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="site_date_format" class="form-label">{{ __('Date Format') }}</label>
                            <select type="text" name="site_date_format" class="form-control selectric"
                                id="site_date_format">
                                <option value="d-m-Y" @if (isset($settings['site_date_format']) && $settings['site_date_format'] == 'd-m-Y') selected="selected" @endif>
                                    DD-MM-YYYY</option>
                                <option value="m-d-Y" @if (isset($settings['site_date_format']) && $settings['site_date_format'] == 'm-d-Y') selected="selected" @endif>
                                    MM-DD-YYYY</option>
                                <option value="Y-m-d" @if (isset($settings['site_date_format']) && $settings['site_date_format'] == 'Y-m-d') selected="selected" @endif>
                                    YYYY-MM-DD</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="site_time_format" class="form-label">{{ __('Time Format') }}</label>
                            <select type="text" name="site_time_format" class="form-control selectric"
                                id="site_time_format">
                                <option value="g:i A" @if (isset($settings['site_time_format']) && $settings['site_time_format'] == 'g:i A') selected="selected" @endif>
                                    10:30 PM</option>
                                <option value="H:i" @if (isset($settings['site_time_format']) && $settings['site_time_format'] == 'H:i') selected="selected" @endif>
                                    22:30</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                {{ Form::label('appointment_prefix', __('Appointment Prefix'), ['class' => 'form-label']) }}
                                {{ Form::text('appointment_prefix', !empty($settings['appointment_prefix']) ? $settings['appointment_prefix'] : '#APP00000', ['class' => 'form-control', 'placeholder' => 'Enter appointment Prefix']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <input class="btn btn-print-invoice  btn-primary " type="submit" value="{{ __('Save Changes') }}">
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<!--embedded code settings-->
<div id="embedded-code-sidenav" class="card">
    <div class="card-header">
        <h5>{{ __('Embedded Code Settings') }}</h5>
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

{{-- Custom JS --}}
<div class="card" id="custom-js-sidenav">
    <div class="card-header">
        <h5>{{ 'Custom Js' }}</h5>
        <small class="text-secondary font-weight-bold">
            {{-- {{ __("This is a page meant for more advanced users, simply ignore it if you don't understand what cache is.") }} --}}
        </small>
    </div>
    {{ Form::open(['url' => route('company.custom.js.store'), 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
    <div class="card-body">
        <div class="row">
            <div class="col-12 form-group">
                <div class="input-group">
                    {{ Form::textarea('custom_js', !empty($settings['custom_js']) ? $settings['custom_js'] : null, ['class' => 'form-control ', 'required' => 'required', 'placeholder' => '<script>console.log(hello);</script>', 'rows' => 4]) }}
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="{{ __('Save Changes') }}">
    </div>
    {{ Form::close() }}
</div>

{{-- Custom CSS --}}
<div class="card" id="custom-css-sidenav">
    <div class="card-header">
        <h5>{{ 'Custom CSS' }}</h5>
        <small class="text-secondary font-weight-bold">
            {{-- {{ __("This is a page meant for more advanced users, simply ignore it if you don't understand what cache is.") }} --}}
        </small>
    </div>
    {{ Form::open(['url' => route('company.custom.css.store'), 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
    <div class="card-body">
        <div class="row">
            <div class="col-12 form-group">
                <div class="input-group">
                    {{ Form::textarea('custom_css', !empty($settings['custom_css']) ? $settings['custom_css'] : null, ['class' => 'form-control ', 'required' => 'required', 'placeholder' => '<style>.body{color:aliceblue;}</style>', 'rows' => 4]) }}
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="{{ __('Save Changes') }}">
    </div>
    {{ Form::close() }}
</div>

<script>
    $('.colorPicker').on('click', function(e) {
        $('body').removeClass('custom-color');
        if (/^theme-\d+$/) {
            $('body').removeClassRegex(/^theme-\d+$/);
        }
        $('body').addClass('custom-color');
        $('.themes-color-change').removeClass('active_color');
        $(this).addClass('active_color');
        const input = document.getElementById("color-picker");
        setColor();
        input.addEventListener("input", setColor);

        function setColor() {
            $(':root').css('--color-customColor', input.value);
        }

        $(`input[name='color_flag`).val('true');
    });

    $('.themes-color-change').on('click', function() {

        $(`input[name='color_flag`).val('false');

        var color_val = $(this).data('value');
        $('body').removeClass('custom-color');
        if (/^theme-\d+$/) {
            $('body').removeClassRegex(/^theme-\d+$/);
        }
        $('body').addClass(color_val);
        $('.theme-color').prop('checked', false);
        $('.themes-color-change').removeClass('active_color');
        $('.colorPicker').removeClass('active_color');
        $(this).addClass('active_color');
        $(`input[value=${color_val}]`).prop('checked', true);
    });

    $.fn.removeClassRegex = function(regex) {
        return $(this).removeClass(function(index, classes) {
            return classes.split(/\s+/).filter(function(c) {
                return regex.test(c);
            }).join(' ');
        });
    };
</script>
