{{Form::model($staff,array('route' => array('staff.update', $staff->id), 'method' => 'PUT', 'id' => 'business-edit-form','enctype' => 'multipart/form-data')) }}
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('name',__('Name'),['class'=>'form-label']) }}
                    {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
                    @error('name')
                    <small class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('image',__('Image'),['class'=>'form-label']) }}
                    <div class="choose-files ">
                        <label for="staff_image">
                            <div class=" bg-primary "> <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}</div>

                                <input type="file" class="form-control file" name="staff_image"
                                              id="staff_image" data-filename="staff_image"
                                              onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        </label>
                        <img id="blah" width="100"
                        src="{{check_file($staff->user->avatar) ? get_file($staff->user->avatar): get_file('uploads/default/avatar.png')}}" />
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('email',__('Email'),['class'=>'form-label']) }}
                    {{Form::email('email',$staff->user->email,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
                    @error('email')
                    <small class="invalid-email" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('loctaion',__('Locations'),['class'=>'form-label']) }}
                    {{ Form::select('location[]',$location, $staff->location_id , ['id' => 'location','class'=>"choices",'multiple'=>"",'searchEnabled'=>'true','required' => 'required']) }}
                    @error('loctaion')
                    <small class="invalid-loctaion" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('service',__('Service'),['class'=>'form-label']) }}
                    {{ Form::select('service[]',$service, $staff->service_id , ['id' => 'service','class'=>"choices",'multiple'=>"",'searchEnabled'=>'true','required' => 'required']) }}
                    @error('service')
                    <small class="invalid-service" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('description',__('Description'),['class'=>'form-label']) }}
                    {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description'),'required'=>'required','rows' => '4'))}}
                    @error('description')
                    <small class="invalid-description" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{__('Cancel')}}</button>
        {{Form::submit(__('Update'),array('class'=>'btn  btn-primary'))}}
    </div>
{{Form::close()}}
