@extends('layouts.main')

@section('page-title')
    {{ __('Business') }}
@endsection
@section('page-breadcrumb')
{{ __('Business') }}
@endsection

@section('page-action')

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="pc-dt-simple">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th class="text-end me-3">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($businesses as $index => $business)
                                <tr>
                                    <th scope="row">{{++$index}}</th>
                                    <td><span class="white-space"><a href="{{ route('business.manage', $business->id) }}">{{$business->name}}</a></span></td>
                                    <td class="text-end">

                                        <div class="action-btn bg-primary ms-2">
                                            <a href="javascript:void(0)" class="mx-3 btn btn-sm d-inline-flex align-items-center cp_link" data-link="{{ route('appointments.form', $business->slug) }}" data-bs-placement="bottom" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Click to copy form link') }}">  
                                                <i class="ti ti-link text-white"></i>
                                            </a>
                                        </div>
                                        {{-- @permission('appointment manage') --}}
                                            <div class="action-btn bg-secondary ms-2">
                                                <a href="{{ route('appointment.index', ['business'=>$business->id]) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" title='Appointments'> <span class="text-white"> <i class="ti ti-credit-card"></i></span></a>
                                            </div>
                                        {{-- @endpermission --}}
                                        @permission('subscriber manage')
                                            <div class="action-btn bg-dark ms-2">
                                                <a href="{{ route('subscribes.index', ['business'=>$business->id]) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" title='Subscribers'> <span class="text-white"> <i class="ti ti-mail"></i></span></a>
                                            </div>
                                        @endpermission
                                        @permission('contact manage')
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="{{ route('contacts.index', ['business'=>$business->id]) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" title='Contacts'> <span class="text-white"> <i class="ti ti-phone"></i></span></a>
                                            </div>
                                        @endpermission
                                        @permission('business update')
                                            <div class="action-btn bg-info ms-2">
                                                <a href="{{ route('business.manage', $business->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-bs-toggle="tooltip" title='manage Business'> <span class="text-white"> <i class="ti ti-corner-up-left"></i></span></a>
                                            </div>
                                        @endpermission
                                        @permission('business delete')
                                                <div class="action-btn bg-danger ms-2">
                                                    <form method="POST" action="{{route('business.destroy',$business->id)}}" id="user-form-{{$business->id}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="button" class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm" data-bs-toggle="tooltip"
                                                        title='Delete'>
                                                            <span class="text-white"> <i class="ti ti-trash"></i></span>
                                                        </button>
                                                    </form>
                                                </div>
                                        @endpermission
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
    $(document).on('click','.cp_link', function() {
        var value = $(this).attr('data-link');
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(value).select();
        document.execCommand("copy");
        $temp.remove();
        toastrs('Success', '{{ __('Link copied') }}', 'success')
    });
    });
</script>
@endpush