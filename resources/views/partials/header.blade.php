<header
    class="dash-header {{ empty($company_settings['site_transparent']) || $company_settings['site_transparent'] == 'on' ? 'transprent-bg' : '' }} ">
    <div class="header-wrapper">
        <div class="me-auto dash-mob-drp">
            <ul class="list-unstyled">
                <li class="dash-h-item mob-hamburger">
                    <a href="#!" class="dash-head-link" id="mobile-collapse">
                        <div class="hamburger hamburger--arrowturn">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                </li>

                <li class="dropdown dash-h-item drp-company">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false"aria-expanded="false">
                        @if (!empty(Auth::user()->avatar))
                            <span class="theme-avtar">
                                <img alt="#"
                                    src="{{ check_file(Auth::user()->avatar) ? get_file(Auth::user()->avatar) : '' }}"
                                    class="img-fluid rounded-circle w-100">
                            </span>
                        @else
                            <span class="theme-avtar">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        @endif
                        <span class="hide-mob ms-2">{{ Auth::user()->name }}</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">
                        @permission('user profile manage')
                            <a href="{{ route('profile') }}" class="dropdown-item">
                                <i class="ti ti-user"></i>
                                <span>{{ __('Profile') }}</span>
                            </a>
                        @endpermission
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                            class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>

            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
                @impersonating($guard = null)
                    <li class="dropdown dash-h-item drp-company">
                        <a class="btn btn-danger btn-sm me-3" href="{{ route('exit.company') }}"><i class="ti ti-ban"></i>
                            {{ __('Exit Company Login') }}
                        </a>
                    </li>
                @endImpersonating
                @permission('business create')
                    @if (PlanCheck('Business', Auth::user()->id) == true)
                        <li class="dash-h-item">
                            <a href="#!" class="dash-head-link dropdown-toggle arrow-none me-0 cust-btn"
                                data-url="{{ route('business.create') }}" data-ajax-popup="true" data-size="xl"
                                data-title="{{ __('Create New Business') }}">
                                <i class="ti ti-circle-plus"></i>
                                <span class="hide-mob">{{ __('Create Business') }}</span>
                            </a>
                        </li>
                    @endif
                @endpermission
                @permission('business manage')
                    <li class="dropdown dash-h-item drp-language">
                        <a class="dash-head-link dropdown-toggle arrow-none me-0 cust-btn" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false"
                            data-bs-placement="bottom" data-bs-original-title="Select your bussiness">
                            <i class="ti ti-apps"></i>
                            <span class="hide-mob">{{ Auth::user()->ActiveBusinessName() }}</span>
                            <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end" style="">
                            @foreach (getBusiness() as $business)
                                @if ($business->id == getActiveBusiness())
                                    <div class="d-flex justify-content-between bd-highlight">
                                        <a href=" # " class="dropdown-item ">
                                            <i class="ti ti-checks text-primary"></i>
                                            <span>{{ $business->name }}</span>
                                            @if ($business->created_by == Auth::user()->id)
                                                <span class="badge bg-dark">
                                                    {{ Auth::user()->roles->first()->name }}</span>
                                            @else
                                                <span class="badge bg-dark"> {{ __('Shared') }}</span>
                                            @endif
                                        </a>
                                        @if ($business->created_by == Auth::user()->id)
                                            @permission('business edit')
                                                <div class="action-btn mt-2">
                                                    <a data-url="{{ route('business.edit', $business->id) }}"
                                                        class="mx-3 btn" data-ajax-popup="true"
                                                        data-title="{{ __('Edit Business Name') }}" data-toggle="tooltip"
                                                        data-original-title="{{ __('Edit') }}">
                                                        <i class="ti ti-pencil text-success"></i>
                                                    </a>
                                                </div>
                                            @endpermission
                                        @endif
                                    </div>
                                @else
                                @php
                                    $route = ($business->is_disable == 1) ?  route('business.change', $business->id) : '#';
                                @endphp
                                    <div class="d-flex justify-content-between bd-highlight">

                                    <a href="{{ $route }}" class="dropdown-item">
                                        <span>{{ $business->name }}</span>
                                        @if ($business->created_by == Auth::user()->id)
                                            <span class="badge bg-dark"> {{ Auth::user()->roles->first()->name }}</span>
                                        @else
                                            <span class="badge bg-dark"> {{ __('Shared') }}</span>
                                        @endif
                                    </a>
                                    @if ($business->is_disable == 0)
                                            <div class="action-btn mt-2">
                                                <i class="ti ti-lock"></i>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                            @if (getBusiness()->count() > 1)
                                @permission('business delete')
                                    <hr class="dropdown-divider" />
                                    <form id="remove-workspace-form"
                                        action="{{ route('business.destroy', getActiveBusiness()) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#!" class="dropdown-item remove_workspace">
                                            <i class="ti ti-circle-x"></i>
                                            <span>{{ __('Remove') }}</span> <br>
                                            <small class="text-danger">{{ __('Active Business Will Consider') }}</small>
                                        </a>
                                    </form>
                                @endpermission
                            @endif
                        </div>
                    </li>
                @endpermission

                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-world nocolor"></i>
                        <span class="drp-text hide-mob">{{ Str::upper(getActiveLanguage()) }}</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">

                        @foreach (languages() as $key => $language)
                            <a href="{{ route('lang.change', $key) }}"
                                class="dropdown-item @if ($key == getActiveLanguage()) text-danger @endif">
                                <span>{{ Str::ucfirst($language) }}</span>
                            </a>
                        @endforeach
                        @if (Auth::user()->type == 'super admin')
                            @permission('language create')
                                <a href="#" data-url="{{ route('create.language') }}"
                                    class="dropdown-item border-top pt-3 text-primary" data-ajax-popup="true"
                                    data-title="{{ __('Create New Language') }}">
                                    <span>{{ __('Create Language') }}</span>
                                </a>
                            @endpermission
                            @permission('language manage')
                                <a href="{{ route('lang.index', [Auth::user()->lang]) }}"
                                    class="dropdown-item  pt-3 text-primary">
                                    <span>{{ __('Manage Languages') }}</span>
                                </a>
                            @endpermission
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
