@extends('layouts.main')

@section('page-title')
    {{ __('Appointments') }}
@endsection
@section('page-breadcrumb')
    {{ __('Appointments') }}
@endsection

@section('page-action')
    <div class="col-auto ps-3 mt-1">
        @permission('appointment create')
        <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md"
            data-title="{{ __('Create New Appointment') }}" data-url="{{ route('appointment.create') }}"
            data-bs-toggle="tooltip" data-bs-original-title="{{ __('Create') }}"><i class="ti ti-plus"></i>
        </a>
        @endpermission
    </div>
@endsection
@push('css')
    <link rel="stylesheet"
        href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        {{ Form::open(['route' => ['appointment.list.index'], 'method' => 'post', 'id' => 'appointment-form']) }}
                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="btn-box">
                                    {!! Form::label('', __('Date'), ['class' => 'form-label']) !!}
                                    {!! Form::date('date', $date, ['class' => 'form-control', 'required' => true]) !!}
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="btn-box">
                                    {!! Form::label('', __('Service'), ['class' => 'form-label']) !!}
                                    {!! Form::select('service', $service, $type, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-auto mt-4">

                                <a href="#" class="btn btn-sm btn-primary"
                                    onclick="document.getElementById('appointment-form').submit(); return false;"
                                    data-bs-toggle="tooltip" title="{{ __('Search') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="{{ route('appointment.index') }}" class="btn btn-sm btn-danger reset"
                                    data-bs-toggle="tooltip" title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off text-white "></i></span>
                                </a>
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="pc-dt-simple">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Duration') }}</th>
                                    <th>{{ __('Customer') }}</th>
                                    <th>{{ __('Staff') }}</th>
                                    <th>{{ __('Service') }}</th>
                                    <th>{{ __('Location') }}</th>
                                    <th>{{ __('Payment') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th class="text-end me-3">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Appointments as $index => $Appointment)
                                    <tr>
                                        <th scope="row">
                                            <a href="#" class="btn btn-sm btn-secondary d-inline-flex align-items-center"
                                                data-url="{{ route('appointment.show', $Appointment->id) }}" data-size="lg"
                                                class="dropdown-item" data-ajax-popup="true"
                                                data-title="{{ __('Appointment Details') }}" data-bs-toggle="tooltip"
                                                data-bs-original-title="{{ __('Appointment Details') }}">
                                                <span class="text-white">{{ App\Models\Appointment::appointmentNumberFormat($Appointment->id,$Appointment->created_by,$Appointment->business_id) }}</span>
                                            </a>
                                        </th>
                                        <td><span class="white-space">{{ $Appointment->date }}</span></td>
                                        <td><span class="white-space">{{ $Appointment->time }}</span></td>
                                        <td>
                                            <span class="white-space">{{ !empty($Appointment->CustomerData) ? $Appointment->CustomerData->name : 'Guest' }}</span>
                                        </td>
                                        <td>
                                            <span class="white-space">{{ !empty($Appointment->StaffData) ? $Appointment->StaffData->name : '-' }}</span>
                                        </td>
                                        <td>
                                            <span class="white-space">{{ !empty($Appointment->ServiceData) ? $Appointment->ServiceData->name : '-' }}</span>
                                        </td>
                                        <td>
                                            <span class="white-space">{{ !empty($Appointment->LocationData) ? $Appointment->LocationData->name : '-' }}</span>
                                        </td>
                                        <td>
                                            <span class="white-space">{{ !empty($Appointment->payment_type) ? $Appointment->payment_type : '-' }}</span>
                                        </td>
                                        <td class="status_badge">
                                            <a href="#" class="btn btn-sm  d-inline-flex align-items-center" 
                                                data-url="{{ route('appointment.status.change', $Appointment->id) }}"
                                                class="dropdown-item" data-ajax-popup="true"
                                                data-title="{{ __('Update Status') }}" data-bs-toggle="tooltip"
                                                data-bs-original-title="{{ __('Update Status') }}">
                                                <span
                                                    class="white-space" style="background-color: #{{ !empty($Appointment->StatusData->status_color) ? $Appointment->StatusData->status_color : '5bc0de' }};">{{ !empty($Appointment->StatusData) ? $Appointment->StatusData->title : 'Pending' }}</span>
                                            </a>
                                        </td>
                                        <td class="text-end">
                                            @permission('appointment edit')
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                    data-url="{{ route('appointment.edit', $Appointment->id) }}"
                                                    class="dropdown-item" data-ajax-popup="true"
                                                    data-title="{{ __('Edit Appointment') }}" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{ __('Edit') }}">
                                                    <span class="text-white"> <i class="ti ti-edit"></i></span></a>
                                            </div>
                                            @endpermission
                                            @permission('appointment delete')
                                            <div class="action-btn bg-danger ms-2">
                                                <form method="POST"
                                                    action="{{ route('appointment.destroy', $Appointment->id) }}"
                                                    id="user-form-{{ $Appointment->id }}">
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

@push('scripts')
<script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
    <script>
        "use strict";
        $(document).on('click', '.reset', function() {
            $("input[name='date']").val('');
        });
    </script>
@endpush
