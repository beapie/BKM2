@extends('layouts.main')

@section('page-title')
    {{ __('Promo Codes') }}
@endsection

@section('page-breadcrumb')
    {{ __('Promo Codes') }}
@endsection

@section('page-action')
<div>
    @permission('promocode create')
    <a data-size="md" data-url="{{ route('promocode.create') }}" data-ajax-popup="true"  data-bs-toggle="tooltip" title="{{__('Create')}}" data-title="{{__('Create Promo Code')}}"  class="btn btn-sm btn-primary">
        <i class="ti ti-plus text-light"></i>
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
                            <th>{{ __('Code') }}</th>
                            <th>{{ __('Discount Percentage') }}</th>
                            <th>{{ __('Flet Rate') }}</th>
                            <th>{{ __('Use Limit') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('End Date') }}</th>
                            <th class="text-end">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promocodes as $index => $promocode)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $promocode->code }}</td>
                                <td>{{ $promocode->discount_percentage }}</td>
                                <td>{{ $promocode->flat_rate }}</td>
                                <td>{{ $promocode->use_limit }}</td>
                                <td>{{ !empty($promocode->start_date) ? $promocode->start_date : '-' }}</td>
                                <td>{{ !empty($promocode->end_date) ? $promocode->end_date : '-' }}</td>
                                <td class="text-end">
                                    @permission('promocode manage')
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="{{ route('promocode.show', $promocode->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center">
                                                <span class="text-white"><i class="ti ti-eye"></i></span>
                                            </a>
                                        </div>
                                    @endpermission
                                    @permission('promocode edit')
                                    <div class="action-btn bg-info ms-2">
                                        <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                            data-url="{{ route('promocode.edit', $promocode->id) }}"
                                            class="dropdown-item" data-ajax-popup="true"
                                            data-title="{{ __('Edit Promo Code') }}" data-bs-toggle="tooltip"
                                            data-bs-original-title="{{ __('Edit') }}">
                                            <span class="text-white"> <i class="ti ti-edit"></i></span></a>
                                    </div>
                                    @endpermission
                                    @permission('promocode delete')
                                    <div class="action-btn bg-danger ms-2">
                                        <form method="GET"
                                            action="{{ route('promocode.delete', $promocode->id) }}"
                                            id="user-form-{{ $promocode->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="button"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center show_confirm"
                                                data-bs-toggle="tooltip" title='Delete'>
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