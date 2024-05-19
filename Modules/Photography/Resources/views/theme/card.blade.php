<div class="col-xxl-3 col-lg-4 col-md-6 col-sm-5 business-view-card business-view">
    <label for="photography">
        <input type="radio" id="photography" name="layouts" value="Photography">
        <div class="business-view-inner">
            <div class="buisness-img">
                <img src="{{ get_module_card_img('Photography') }}" alt="form" width="100%">
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <div class="mt-3">
                    <h6>{{ __('Photography') }}</h6>
                </div>
                @if($btn)
                <div>
                    <a href="{{ route('business.customize',['Photography']) }}" class="btn btn-sm btn-primary">{{ __('Customize') }}</a>
                </div>
                @endif
            </div>
        </div>
    </label>
</div>