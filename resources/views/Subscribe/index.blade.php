@extends('layouts.main')

@section('page-title')
    {{ __('Subscribers') }}
@endsection
@section('page-breadcrumb')
    {{ $business->name }},
    {{ __('Subscribers') }}
@endsection

@section('page-action')
@endsection

@section('content')
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="pc-dt-simple">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Email') }}</th>
                                    <th class="text-end me-3">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Subscribes as $key => $Subscribe)
                                <tr>
                                        <td><span class="white-space">{{ ++$key }}</span></td>
                                        <td><span class="white-space">{{ $Subscribe->email }}</span></td>
                                        <td class="text-end">
                                            @permission('subscriber delete')
                                            <div class="action-btn bg-danger ms-2">
                                                <form method="POST"
                                                    action="{{ route('subscribes.destroy', $Subscribe->id) }}"
                                                    id="user-form-{{ $Subscribe->id }}">
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
    <!-- [ Main Content ] end -->

@endsection

