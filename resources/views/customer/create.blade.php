
    {{Form::open(array('url'=>'customer','method'=>'post', 'enctype' => 'multipart/form-data'))}}
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('name',__('Name'),['class'=>'form-label']) }}
                    {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Customer Name'),'required'=>'required'))}}
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
                        <label for="image">
                            <div class=" bg-primary "> <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}</div>

                                <input type="file" class="form-control file" name="image"
                                              id="image" data-filename="image"
                                              onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        </label>
                        <img id="blah" width="100" src="" />
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('email',__('Email'),['class'=>'form-label'])}}
                    {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Customer Email'),'required'=>'required'))}}
                    @error('email')
                    <small class="invalid-email" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('password',__('Password'),['class'=>'form-label'])}}
                    <input type="password" name="password" id="password" class="form-control" placeholder="**********">
                    @error('password')
                    <small class="invalid-password" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('mobile_no',__('Mobile No'),['class'=>'form-label'])}}
                    {{Form::text('mobile_no',null,array('class'=>'form-control','placeholder'=>__('Enter Customer Mobile No')))}}
                    <div class=" text-xs text-danger">
                        {{ __('Please add mobile number with country code. (ex. +91)') }}
                    </div>
                    @error('mobile_no')
                    <small class="invalid-mobile" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('gender',__('Gender'),['class'=>'form-label'])}}
                    {!! Form::select('gender', ['male' => 'Male', 'female' => 'Female'], null, ['class' => 'form-control']) !!}
                    @error('gender')
                    <small class="invalid-mobile" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('dob',__('Date of Birth'),['class'=>'form-label'])}}
                    {{Form::date('dob',null,array('class'=>'form-control','placeholder'=>__('Select Date')))}}
                    @error('dob')
                    <small class="invalid-mobile" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('description',__('Description'),['class'=>'form-label']) }}
                    {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description'),'rows' => '4'))}}
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
        {{Form::submit(__('Create'),array('class'=>'btn  btn-primary'))}}
    </div>
    {{Form::close()}}
