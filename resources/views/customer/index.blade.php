@extends('layouts.main')

@section('page-title')
    {{ __('Customers') }}
@endsection
@section('page-breadcrumb')
    {{ __('Customers') }}
@endsection
@section('page-action')
    <div>
        @permission('customer create')
            <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md"
                data-title="{{ __('Create New Customer') }}" data-url="{{ route('customer.create') }}" data-bs-toggle="tooltip"
                data-bs-original-title="{{ __('Create') }}">
                <i class="ti ti-plus"></i>
            </a>
        @endpermission
    </div>
@endsection
@section('content')
    <!-- [ Main Content ] start -->
    <div class="row">
        <div id="loading-bar-spinner" class="spinner"><div class="spinner-icon"></div></div>
        @foreach ($customers as $customer)
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary p-2 px-3 rounded">{{ __('Customer') }}</span>
                        </div>
                        <div class="card-header-right">
                                <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="true">
                                            <i class="feather icon-more-vertical"></i>
                                        </button>
                                    <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end">
                                        @permission('customer edit')
                                            <a data-url="{{ route('customer.edit', $customer->id) }}" class="dropdown-item"
                                                data-ajax-popup="true" data-title="{{ __('Update Customer') }}"
                                                data-toggle="tooltip" data-original-title="{{ __('Edit') }}">
                                                <i class="ti ti-pencil"></i>
                                                <span>{{ __('Edit') }}</span>
                                            </a>
                                        @endpermission
                                        @permission('customer delete')
                                            {{ Form::open(['route' => ['customer.destroy', $customer->id], 'class' => 'm-0']) }}
                                            @method('DELETE')
                                            <a href="#!" class="dropdown-item bs-pass-para show_confirm" aria-label="Delete"
                                                data-confirm="{{ __('Are You Sure?') }}"
                                                data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                data-confirm-yes="delete-form-{{ $customer->id }}">
                                                <i class="ti ti-trash"></i>
                                                <span>{{ __('Delete') }}</span>
                                            </a>
                                            {{ Form::close() }}
                                        @endpermission
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card-body  text-center">
                        <img src="{{ check_file($customer->customer->avatar) ? get_file($customer->customer->avatar) : get_file('uploads/users-avatar/avatar.png') }}"
                            alt="user-image" class="img-fluid rounded-circle" width="120px">
                        <h4 class="mt-2">{{ $customer->name }}</h4>
                        <small>{{ $customer->customer->email }}</small>
                    </div>
                </div>
            </div>
        @endforeach

        @auth('web')
            @permission('customer create')
                <div class="col-md-3 All">
                    <a href="#" class="btn-addnew-project cust-padding" data-ajax-popup="true" data-size="md"
                        data-title="{{ __('Create New Customer') }}" data-url="{{ route('customer.create') }}">
                        <div class="bg-primary proj-add-icon">
                            <i class="ti ti-plus my-2"></i>
                        </div>
                        <h6 class="mt-4 mb-2">{{ __('New Customer') }}</h6>
                        <p class="text-muted text-center">{{ __('Click here to Create New Customer') }}</p>
                    </a>
                </div>
            @endpermission
        @endauth
        
    </div>
    <!-- [ Main Content ] end -->

@endsection

