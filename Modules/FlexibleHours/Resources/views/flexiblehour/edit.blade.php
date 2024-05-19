{{ Form::model($flexible_hour, array('route' => array('flexible.hour.update', $flexible_hour->id), 'method' => 'PUT','id' => 'flexible-hour-form')) }}
<input type="hidden" id="days_json" name="days_json">
<input type="hidden" id="service_id" name="service_id" value="{{$flexible_hour->service_id}}">
<input type="hidden" id="staff_id" name="staff_id" value="{{$flexible_hour->staff_id}}">
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="row mt-3">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h5>Start Time:</h5>
                    <input type="time" id="start_time" name="start_time" class="form-control" value="{{$flexible_hour->start_time}}">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h5>End Time:</h5>
                    <input type="time" id="end_time" name="end_time" class="form-control" value="{{$flexible_hour->end_time}}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <h5>Days:</h5>
                </div>
                @php
                $decodedData = json_decode($flexible_hour->days, true);
                $days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
                @endphp
                <div class="col-lg-11 col-md-10 col-sm-9 form-check-inline">
                    @foreach($days as $day)
                    <div class="d-flex flexible_days">
                        <label class="form-check-label" for="{{ $day }}">{{ ucfirst($day) }}</label>
                        <input type="checkbox" id="{{ $day }}" name="day[]" class="form-check-input" value="{{ $day }}" {{ $decodedData[$day] == 'on' ? 'checked' : '' }}>
                    </div>
                   
                    @endforeach
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <h5>Price:</h5>
                    <input type="number" id="price" name="price" class="form-control" value="{{$flexible_hour->price}}">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="button" value="{{ __('Save Changes') }}" class="btn btn-primary" onclick="submitForm()">
</div>
{{ Form::close() }}


<script>
    function submitForm() {
        var days = {
            Mon: document.getElementById('Mon').checked ? 'on' : 'off',
            Tue: document.getElementById('Tue').checked ? 'on' : 'off',
            Wed: document.getElementById('Wed').checked ? 'on' : 'off',
            Thu: document.getElementById('Thu').checked ? 'on' : 'off',
            Fri: document.getElementById('Fri').checked ? 'on' : 'off',
            Sat: document.getElementById('Sat').checked ? 'on' : 'off',
            Sun: document.getElementById('Sun').checked ? 'on' : 'off',
        };
        document.getElementById('days_json').value = JSON.stringify(days);

        document.getElementById('flexible-hour-form').submit();
    }
</script>