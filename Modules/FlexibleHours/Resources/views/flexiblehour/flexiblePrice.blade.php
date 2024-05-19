@push('script')
    <script>
        $(document).ready(function() {
        
            $(document).on('change', '.timeslot, .timeslot-flexible', function() {
            var selectedFlexibleId = $(this).attr('data-id');
            var selectedServiceId = $(this).attr('service-id');
            if (selectedFlexibleId !== undefined && selectedServiceId !== undefined)
            {
                $.ajax({
                    url: "{{ route('flexible.price') }}",
                    method: 'GET',
                    data: {
                        flexible_id : selectedFlexibleId,
                        service_id : selectedServiceId,
                    },
                    success: function(data) {
                        if(data.flexible){
                           var flexible_price = data.flexible.price;        
                            $('#serviceAmount').html('Total Amount: ' + flexible_price);
                        }else{
                            toastrs('Error', data.error, 'error')
                        }
                    },
                    error: function(data) {
                        data = data.responseJSON;
                        toastrs('Error', data.error, 'error')
                    }
                });
            }
        });
    });
    </script>
@endpush