{{Form::model($service,array('route' => array('service.update', $service->id), 'method' => 'PUT', 'id' => 'business-edit-form','enctype' => 'multipart/form-data')) }}
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('name',__('Service Name'),['class'=>'form-label']) }}
                    {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Service Name'),'required'=>'required'))}}
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
                        <label for="service_image">
                            <div class=" bg-primary "> <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}</div>

                                <input type="file" class="form-control file" name="service_image"
                                              id="service_image" data-filename="service_image"
                                              onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        </label>
                        <img id="blah" width="100"
                        src="{{check_file($service->image) ? get_file($service->image): get_file('uploads/default/avatar.png')}}" />
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{Form::label('category',__('category'),['class'=>'form-label']) }}
                    {{ Form::select('category', $category, $service->category_id, ['class' => 'form-control', 'required' => 'required']) }}
                    @error('category')
                    <small class="invalid-category" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                @stack('service_tax')
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('price',__('Price'),['class'=>'form-label']) }}
                    {{Form::number('price',null,array('class'=>'form-control','placeholder'=>__('Enter Price'),'required'=>'required'))}}
                    @error('price')
                    <small class="invalid-price" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('duration',__('Duration (minute)'),['class'=>'form-label']) }}
                    {{Form::number('duration',null,array('class'=>'form-control','placeholder'=>__('Enter Duration'),'required'=>'required','min'=>"0", 'max'=>"510"))}}
                    @error('duration')
                    <small class="invalid-duration" role="alert">
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
