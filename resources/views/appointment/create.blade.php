{{ Form::open(['url' => 'appointment', 'method' => 'post','data-url' => route('appointment.duration'),'id'=>'appointment-form-date']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('customer', __('Customer'), ['class' => 'form-label']) }}
                {{ Form::select('customer', $customer, null, ['class' => 'form-control', 'required' => 'required']) }}
                @error('customer')
                    <small class="invalid-customer" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('location', __('Location'), ['class' => 'form-label']) }}
                {{ Form::select('location', $location, null, ['class' => 'form-control', 'required' => 'required']) }}
                @error('location')
                    <small class="invalid-location" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('service', __('Service'), ['class' => 'form-label']) }}
                {{ Form::select('service', $service, null, ['class' => 'form-control', 'required' => 'required', 'id' => 'service']) }}
                @error('service')
                    <small class="invalid-service" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('staff', __('Staff'), ['class' => 'form-label']) }}
                {{ Form::select('staff', $staff, null, ['class' => 'form-control', 'required' => 'required']) }}
                @error('staff')
                    <small class="invalid-staff" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('notes', __('Notes'), ['class' => 'form-label']) }}
                {{ Form::textarea('notes', null, ['class' => 'form-control', 'placeholder' => __('Enter notes'), 'rows' => '4']) }}
                @error('notes')
                    <small class="invalid-notes" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
        {!! Form::hidden('appointment_status', 'Pending') !!}

        <div class="form-group col-md-6">
            <label for="appointment_date" class="col-form-label">{{ __('Appointment Date') }}</label>
            <div class="input-group date ">
                <input class="form-control datepicker" type="text" id="datepicker" name="appointment_date"
                    autocomplete="off" required="required" data-dates={{ json_encode($combinedArray) }} data-holiday={{ json_encode($businesholiday) }}>
                <span class="input-group-text">
                    <i class="feather icon-calendar"></i>
                </span>
            </div>
        </div>

        <div id="timeSlotsContainer"></div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
        {{ Form::submit(__('Create'), ['class' => 'btn  btn-primary']) }}
    </div>
    {{ Form::close() }}
    
    
