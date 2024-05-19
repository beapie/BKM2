<div class="col-xxl-3 col-lg-4 col-md-6 col-sm-5 business-view-card business-view">
    <label for="carservice">
        <input type="radio" id="carservice" name="layouts" value="CarService">
        <div class="business-view-inner">
            <div class="buisness-img">
                <img src="{{ get_module_card_img('CarService') }}" alt="form" width="100%">
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <div class="mt-3">
                    <h6>{{ __('CarService') }}</h6>
                </div>
                @if ($btn)
                    <div>
                        <a href="{{ route('business.customize', ['CarService']) }}" class="btn btn-sm btn-primary">
                            {{ __('Customize') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </label>
</div>
