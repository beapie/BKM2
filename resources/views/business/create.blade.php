{{ Form::open(['route' => 'business.store', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="form-group">
        {{ Form::label('name', __('Name'), ['class' => 'col-form-label']) }}
        {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Business Name')]) }}
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav  business-tab gap-2" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <div class="nav-item-inner active" id="theme-setting-tab" data-bs-toggle="pill"
                        data-bs-target="#theme-setting">
                        <label for="radio1">
                            <input type="radio" id="radio1" name="form_type" required value="form-layout" checked>
                            <span>
                                {{ __('Form Layout') }}
                            </span>
                        </label>
                    </div>
                </li>
                <li class="nav-item" role="presentation">
                    <div id="seo-setting-tab2" class="nav-item-inner" data-bs-toggle="pill"
                        data-bs-target="#seo-setting">
                        <label for="radio2">
                            <input type="radio" id="radio2" name="form_type" required value="website">
                            <span>
                                {{ __('Website') }}
                            </span>
                        </label>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="theme-setting" role="tabpanel"
                    aria-labelledby="pills-user-tab-1">
                    <div class="row mt-4">
                        {{ Form::hidden('layouts', null, ['id' => 'themefile1']) }}
                        @foreach (\App\Models\Business::forms() as $key => $v)
                        @php
                            $form_name = str_replace("Formlayout", "Form Layout ", $key);
                            if (preg_match('/\d+$/', $form_name, $matches)) {
                                $form_name = str_replace($matches[0], ' ' . $matches[0], $form_name);
                            }
                        @endphp
                            <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-5 business-view-card">
                                <label for="{{ $key }}">
                                    <input type="radio" id="{{ $key }}" required="" value="{{ $key }}" checked="">
                                    <div class="business-view-inner">
                                        <div class="buisness-img">
                                            <img class="color_theme1 {{ $key }}_img"
                                                data-id="{{ $key }}"
                                                src="{{ asset(get_file('form_layouts/' . $key . '/images/form.png')) }}"
                                                alt="" style="height: 100%;width: 100%;">
                                        </div>
                                        <div class=" mt-3">
                                            <h6>{{ $form_name }}</h6>
                                            <span class="mb-1">{{ __('Select Sub-Color:') }}</span>
                                            <div class="d-flex align-items-center business-color-input"
                                                id="{{ $key }}">
                                                @foreach ($v as $css => $val)
                                                    <label class="colorinput">
                                                        <input type="radio" name="theme_color"
                                                            id="{{ $css }}" value="{{ $css }}"
                                                            data-theme="{{ $key }}"
                                                            data-imgpath="{{ $val['img_path'] }}"
                                                            class="colorinput-input"
                                                            @if ($css == 'color1-Formlayout1') checked @endif>
                                                        <span class="border-box">
                                                            <span class="colorinput-color"
                                                                style="background:{{ $val['color'] }}"></span>
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="seo-setting" role="tabpanel" aria-labelledby="pills-user-tab-1">
                    <div class="row mt-4">
                        @stack('theme_card')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
</div>

{{ Form::close() }}

<script>
    $(document).on('click', 'input[name="theme_color"]', function() {
        var eleParent = $(this).attr('data-theme');
        $('#themefile1').val(eleParent);
        var imgpath = $(this).attr('data-imgpath');
        $('.' + eleParent + '_img').attr('src', imgpath);

        $('.theme_preview_img').attr('src', imgpath);
        $(".business-view-card").removeClass('selected-theme')
        $(this).closest('.business-view-card').addClass('selected-theme');
    });

    $(document).on("click", ".color_theme1", function() {
        var id = $(this).attr('data-id');
        $(".business-view-card").removeClass('selected-theme')
        $(this).closest('.business-view-card').addClass('selected-theme');

        var dataId = $(this).attr("data-id");
        $('#color1-' + dataId).trigger('click');
        $(".business-view-card").addClass('')
    });

    $(document).ready(function() {
        var checked = $("input[type=radio][name='theme_color']:checked");
        $('#themefile1').val(checked.attr('data-theme'));
        $(checked).closest('.business-view-card').addClass('selected-theme');
    });

</script>
