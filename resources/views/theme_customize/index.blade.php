@extends('layouts.main')

@section('page-title')
    {{__('Theme Customize')}}
@endsection

@section('page-breadcrumb')
    {{ __('Theme Customize') }},
    {{ $id }}
@endsection

@section('page-action')
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/brands.min.css') }}">
@endpush


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="section-title">{{ $id }}</h2>
                        <p class="section-lead">
                            {{ __('Organize and adjust all settings about') }} {{ $id }}.
                        </p>
                    </div>
                </div>
             
                <div class="row">
                    @foreach ($theme_json as $json_settings)
                        <div class="col-lg-4 col-md-6 col-12 large-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-icon text-white mb-3">
                                        <div class="bg-primary d-inline-block p-3 rounded-2">
                                            <i class="{{ $json_settings['icon'] }}"></i>
                                        </div>
                                    </div>
                                    <h4>{{ $json_settings['title'] }}</h4>
                                    <p>{{ $json_settings['detail'] }}</p>
                                    @permission('theme edit')
                                        <div>
                                            <a href="{{ route('customize.edit', [$id, $json_settings['slug'], $json_settings['sections'][0]['slug']]) }}"
                                                class="card-btn text-primary">{{ __('Change Setting') }} <i class="fas fa-chevron-right"></i></a>
                                        </div>
                                    @endpermission
                                </div>
                            </div>
                        </div>
                    @endforeach
                   
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 large-card blog-testi-card">
                        <div class="card">
                            <div class="card-icon text-white bg-primary">
                                <i class="ti ti-vocabulary"></i>
                        </div>
                                <div class="card-body">
                                <h4>{{ __('Blog Section') }}</h4>
                                <p>{{ __('Blog section settings such as, banner, product display, content and so on.') }}</p>
                                @permission('blog manage')
                                    <div>
                                        <a href="{{ route('blog.manage',$id) }}"
                                            class="card-btn text-primary">{{ __('Change Setting') }} <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                @endpermission
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 large-card blog-testi-card">
                        <div class="card">
                                <div class="card-icon text-white bg-primary">
                                        <i class="ti ti-stars"></i>
                                </div>
                                <div class="card-body">
                                <h4>{{ __('Testimonial Section') }}</h4>
                                <p>{{ __('Testimonial section settings such as, banner, product display, content and so on.') }}</p>
                                @permission('testimonial manage')
                                    <div>
                                        <a href="{{ route('testimonial.manage',$id) }}"
                                            class="card-btn text-primary">{{ __('Change Setting') }} <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                @endpermission
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection

@push('scripts')
@endpush
