@push('css')
    <link rel="stylesheet" href="{{ asset('Modules/PromoCodes/Resources/assets/css/style.css') }}">
@endpush

<div class="promo_code">
    {{ __('Promo Code') }}
    <div class="promo-code-wrapper">
    <input type="text" name="promocode" id="promocode" class="form-control">
    <input type="hidden" id="after_promo_price" name="after_promo_price" value="">
    <input type="hidden" id="promo_code_id" name="promo_code_id" value="">
    <button class="btn btn-primary" type="button" id="promo_code_apply">{{ __('Apply') }}</button>
</div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            $("#promo_code_apply").on('click', function(){
                
                var serviceValue = $('#serviceSelect').val();
                var promoCode = $('#promocode').val();
                var service_price = $('#final_amount').val();
                
                // use for flexible hours
                var staffSelect = $('#staffSelect').val();
                var selectedDate = $('#datepicker').val();
                var selectedSloteTime = $("input[name='duration']:checked").val();
                
                var formData = new FormData();
                var activeTabContent = $('.tab-content.active');
                var formType = activeTabContent.attr('id');
                var customerTab = activeTabContent.find('input');

                customerTab.each(function() {
                    var inputName = $(this).attr('name');
                    var inputValue = $(this).val();
                    formData.append(inputName, inputValue);
                });
                 // Add additional data to FormData object
                formData.append('service', serviceValue);
                formData.append('promocode', promoCode);
                formData.append('type', formType);
                formData.append('staffSelect', staffSelect);
                formData.append('selectedDate', selectedDate);
                formData.append('selectedSloteTime', selectedSloteTime);

                if (service_price !== "" && service_price !== undefined) {
                    formData.append('service_price', service_price);
                }
                
                var customerTab = customerTab.serialize();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                
                $.ajax({
                    url: '{{ route('apply.promocode') }}',
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        var promo_code_price = data.apply_discount;
                        console.log(data);
                        if (data.after_promo_tax !== "" && data.after_promo_tax !== undefined) {
                            var tax_data = data.after_promo_tax[0];
                            
                            var service_price = tax_data.service_price;
                            var tax_amount = tax_data.tax_amount;
                            var last_tax_amount = tax_data.tax;
                            var tax_type = tax_data.tax_type;
                            
                            var sectionTitleDiv = $('.appointment-form.payment-method-form .appointment_info_details');
                            sectionTitleDiv.children('p:not([id])').remove();

                            if(tax_type == 'exclude_taxes'){
                                var service = 'Coupon Price: ' + promo_code_price;
                                var serviceTag = $('<p>').text(service).addClass('h6');
                                sectionTitleDiv.append(serviceTag);
                                
                                var taxText = 'Service Tax: ' + tax_amount;
                                var taxPTag = $('<p>').text(taxText).addClass('h6');

                                sectionTitleDiv.append(taxPTag);
                               
                                var final = 'Final Price: ' + last_tax_amount;
                                var finalTag = $('<p>').text(final).addClass('h6');
                                sectionTitleDiv.append(finalTag);

                                var last_amount = $('<input>', { type: 'hidden', name: 'service_price', value: service_price, id: 'service_price'});
                                sectionTitleDiv.append(last_amount);
                                // $('#serviceAmount').html('Service Amount: ' + data.final_amount);
                                        
                                // var taxInput = $('<input>', { type: 'hidden', name: 'service_tax', value: tax_amount });
                                $('#after_promo_price').val(last_tax_amount);
                                $('#promo_code_id').val(data.promo_code_id);
                                sectionTitleDiv.append(taxInput);
                            } else {
                                var final = 'Final Price: ' + last_tax_amount;
                                
                                var last_amount = $('<input>', { type: 'hidden', name: 'service_price', value: service_price, id: 'service_price'});
                                sectionTitleDiv.append(last_amount);

                                $('#serviceAmount').html( final + ' (Total Amount Containg all taxes*)');
                                var taxInput = $('<input>', { type: 'hidden', name: 'service_tax', value: tax_amount });
                                $('#after_promo_price').val(last_tax_amount);
                                $('#promo_code_id').val(data.promo_code_id);
                                sectionTitleDiv.append(taxInput);
                            }
                        } else {   
                            var afterPromoPrice = data.final_amount;
                            
                            var sectionTitleDiv = $('.appointment-form.payment-method-form .appointment_info_details');
                            $('#after_promo_price').val(afterPromoPrice);
                            $('#promo_code_id').val(data.promo_code_id);
                            var last_amount = $('<input>', { type: 'hidden', name: 'last_amount', value: data.final_amount, id: 'last_amount'});
                            $('#serviceAmount').html('Total Amount: ' + data.final_amount);
                            var coupon_code = 'Coupon Price: ' + data.apply_discount;
                            var couponTag = $('<p>').text(coupon_code).addClass('h6');
                            sectionTitleDiv.append(couponTag);
                        }
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.error;
                        toastrs('error', errorMessage, 'Error');
                    }
                });
            });
        });
    </script>
@endpush