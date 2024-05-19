
    {{Form::model($blog,array('route' => array('blogs.update', $blog->id), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('title',__('Title'),['class'=>'form-label']) }}
                    {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter blog title'),'required'=>'required'))}}
                    @error('title')
                    <small class="invalid-title" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('blog_image',__('Image'),['class'=>'form-label']) }}
                    <div class="choose-files ">
                        <label for="blog_image">
                            <div class=" bg-primary "> <i class="ti ti-upload px-1"></i>{{ __('Choose file here') }}</div>

                                <input type="file" class="form-control file" name="blog_image"
                                              id="blog_image" data-filename="blog_image"
                                              onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        </label>
                        <img id="blah" width="100"
                        src="{{check_file($blog->image) ? get_file($blog->image): get_file('uploads/default/avatar.png')}}" />
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('date',__('Date'),['class'=>'form-label'])}}
                    {{Form::date('date',null,array('class'=>'form-control','placeholder'=>__('Select Date')))}}
                    @error('date')
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
        {{Form::submit(__('Update'),array('class'=>'btn  btn-primary'))}}
    </div>
    {{Form::close()}}
