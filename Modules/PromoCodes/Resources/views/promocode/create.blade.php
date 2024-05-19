{{ Form::open(array('route' => 'promocode.store')) }}
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('promo_code', __('Promo Code'), ['class' => 'form-label']) }}
                    <div class="input-group mb-3">
                        {{ Form::text('promo_code', null, ['class' => 'form-control', 'id' => 'promo_code', 'placeholder' => __("Enter Promo Code"), 'aria-label' => __("Enter Promo Code"), 'required' => 'required' ,'aria-describedby' => 'generateButton']) }}
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" id="generateButton">{{ __('Generate') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row form-group">
                {{ Form::label('discount', __('Discount'), ['class' => 'form-label']) }}
                <div class="col-md-6">
                    {{ Form::label('In Percentage', __('In Percenrage'), ['class' => 'form-label']) }}
                    {{ Form::number('discount', null, ['class' => 'form-control', 'max' => 100, 'required' => 'required', 'placeholder' => __('Discount in Percentage')]) }}
                </div>
                <div class="col-md-6">
                    {{ Form::label('flat_rate', __('Flat Rate'), ['class' => 'form-label']) }}
                    {{ Form::number('flat_rate', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Flat Rate')]) }}
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-6">
                    {{ Form::label('discount_type', __('Discount Type (Percentage / Flat Rate)'), ['class' => 'form-label']) }}
                    <div class="form-check form-switch pt-2">
                        <input type="hidden" name="discount_type" value="off">
                        <input id="switch-shadow" class="form-check-input" name="discount_type" type="checkbox">
                        <label class="form-check-label" for="switch-shadow"></label>
                    </div>
                </div>
                <div class="col-md-6">
                    {{ Form::label('once_per_customer', __('Once Per Customer'), ['class' => 'form-label']) }}
                    <div class="form-check form-switch pt-2">
                        <input type="hidden" name="once_per_customer" value="off">
                        <input id="switch-shadow" class="form-check-input" name="once_per_customer" type="checkbox">
                        <label for="switch-shadow" class="form-check-label"></label>
                    </div>
                </div>
                <small><span class="text-primary">{{ __('Note') }}</span> {{ __('Enabling the discount button allows percentage discounts, while disabling it enables flat-rate discounts.') }}</small>
            </div>

            <div class="col-md-12 form-group">
                {{ Form::label('services', __('Services'), ['class' => 'form-label']) }}
                {{ Form::select('services[]', $services, null, ['class' => 'form-control choices', 'id' => 'service' ,'required' => 'required', 'multiple']) }}
            </div>

            <div class="col-md-12 form-group">
                {{ Form::label('Use Limit', __('Use Limit'), ['class' => 'form-label']) }}
                {{ Form::number('use_limit', null, ['class' => 'form-control', 'required' => 'required']) }}
            </div>

            <div class="row form-group">
                {{ Form::label('Date Limit', __('Date Limit'), ['class' => 'form-label']) }}
                <div class="col-md-6">
                    {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                    {{ Form::date('start_date', null, ['class' => 'form-control']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                    {{ Form::date('end_date', null, ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="col-md-12 form-group">
                {{ Form::label('customer_limit', __('Customer Limit'), ['class' => 'form-label']) }}
                {{ Form::select('customers[]', $customers, null, ['class' => 'form-control choices', 'id'=>'customer' ,'required' => 'required', 'multiple']) }}
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
        {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
    </div>
{{ Form::close() }}

<script>
    $(document).ready(function() {
        $('#generateButton').click(function() {
            var generatedCode = generateRandomCode();
            $('#promo_code').val(generatedCode);
        });

        function generateRandomCode() {
            var length = 8;
            var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            var code = '';
            
            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * chars.length);
                code += chars.charAt(randomIndex);
            }
            
            return code;
        }
    });
</script>