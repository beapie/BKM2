@extends('layouts.main')

@section('page-title')
    {{ __('Custom Status') }}
@endsection
@section('page-breadcrumb')
{{ __('Custom Status') }}
@endsection



@section('page-action')
<div>
    @permission('status create')
        <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md"
            data-title="{{ __('Create New Status') }}" data-url="{{ route('custom-status.create') }}" data-bs-toggle="tooltip"
            data-bs-original-title="{{ __('Create') }}">
            <i class="ti ti-plus"></i>
        </a>
    @endpermission
</div>

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
                            @foreach($statuses as $status)
                                <tr>
                                    <th scope="row">{{$status->id}}</th>
                                    <td class="status_badge"><span class="white-space" style="background-color: #{{!empty($status->status_color) ?  $status->status_color : '5bc0de' }};">{{$status->title}} </span></td>
                                    <td class="text-end">
                                        @permission('status update')
                                        <div class="action-btn bg-info ms-2">
                                            <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                data-url="{{ route('custom-status.edit', $status->id) }}"
                                                class="dropdown-item" data-ajax-popup="true"
                                                data-title="{{ __('Edit Status') }}" data-bs-toggle="tooltip"
                                                data-bs-original-title="{{ __('Edit') }}">
                                                <span class="text-white"> <i class="ti ti-edit"></i></span></a>
                                        </div>
                                        @endpermission
                                        @permission('status delete')
                                                <div class="action-btn bg-danger ms-2">
                                                    <form method="POST" action="{{route('custom-status.destroy',$status->id)}}" id="user-form-{{$status->id}}">
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
<script src="{{ asset('js/jscolor.js') }}"></script>
@endpush