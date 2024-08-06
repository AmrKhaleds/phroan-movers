<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="direction: rtl">
<head>

    <meta charset="utf-8"/>
    <title>@yield('title') | @lang('back.AppName')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('acp/images/favicon.ico')}}">
@yield('css')
<!-- Bootstrap Css -->
    <link href="{{url('acp/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{url('acp/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{url('acp/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400&display=swap" rel="stylesheet">

    <style>

        li a {
            color: black !important;
        }
        li {
            color: black !important;
        }

        .parsley-errors-list > li {
            color: red !important;
        }
        .parsley-error{
            border-color: red !important;
        }
    </style>
</head>


<body data-layout="horizontal" data-topbar="colored" data-layout-size="boxed">

<!-- <body data-layout="horizontal" data-topbar="colored"> -->

<!-- Begin page -->
<div id="layout-wrapper">


    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{route('home')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{getSetting('logo')->value}}" alt="" height="22">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{getSetting('logo')->value}}" alt="" height="20">
                                </span>
                    </a>

                    <a href="{{route('home')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{getSetting('logo')->value}}" alt="" height="50">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{getSetting('logo')->value}}" alt="" height="60">
                                </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

            </div>

            <div class="d-flex">
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{getFile(Auth::user()->employee->photo)}}"
                             alt="Header Avatar">
                        <span
                                class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{ Auth::user()->name }}</span>
                        <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="{{ route('employees.profile')}}"><i
                                    class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
                                    class="align-middle">@lang('back.profile')</span></a>
                        {{--   <a class="dropdown-item" href="#"><i
                                  class="uil uil-wallet font-size-18 align-middle me-1 text-muted"></i> <span
                                  class="align-middle">My Wallet</span></a>
                          <a class="dropdown-item d-block" href="#"><i
                                  class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i> <span
                                  class="align-middle">Settings</span> <span
                                  class="badge bg-soft-success rounded-pill mt-1 ms-2">03</span></a>
                          --}}
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"><i
                                    class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span
                                    class="align-middle">@lang('back.logout')</span></a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>

                {{--  <div class="dropdown d-inline-block">
                      <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                          <i class="uil-cog"></i>
                      </button>
                  </div>--}}

            </div>
        </div>

        <div class="container-fluid">
            <div class="topnav">

                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}">
                                    <i class="uil-home-alt me-2"></i> @lang('back.dashborad')
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="uil-apps me-2"></i>@lang('back.bookings') <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="{{route('bookings.create')}}" class="dropdown-item">حجز اوردر جديد</a>
                                    <a href="{{route('bookings.index')}}" class="dropdown-item">اوردرات حجزتها</a>

                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="uil-apps me-2"></i>@lang('back.trakings') <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="{{route('trakings.calender')}}" class="dropdown-item">@lang('back.calender')</a>
                                    <a href="{{route('trakings.index')}}" class="dropdown-item">@lang('back.trakings')</a>

                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="uil-apps me-2"></i>@lang('back.HR') <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="{{route('categories.index')}}" class="dropdown-item">@lang('back.categories')</a>
                                    <a href="{{route('workers.index')}}" class="dropdown-item">@lang('back.workers')</a>
                                    <a href="{{route('employees.index')}}" class="dropdown-item">@lang('back.employees')</a>

                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="uil-apps me-2"></i>@lang('back.CARS') <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="{{route('vehicles.index')}}" class="dropdown-item">@lang('back.vehicles')</a>
                                    <a href="{{route('maintenances.index')}}" class="dropdown-item">@lang('back.periodic_maintenance')</a>

                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="uil-apps me-2"></i>@lang('back.settings') <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="{{route('knows.index')}}" class="dropdown-item">@lang('back.knows')</a>
                                    <a href="{{route('receivedphones.index')}}" class="dropdown-item">@lang('back.received_by_phone')</a>
                                    <a href="{{route('setting_km.create')}}" class="dropdown-item">@lang('back.settings') @lang('back.pricing')</a>
                                    <a href="{{route('setting.create')}}" class="dropdown-item">@lang('back.general') @lang('back.settings')</a>
                                    <a href="{{url('pharon.pdf')}}" class="dropdown-item" target="_blank">سكربت تدريب فرعون</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('companies.index')}}">
                                    <i class="uil-building me-2"></i> @lang('back.companies')
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="uil-apps me-2"></i>@lang('back.report') <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="{{route('report.tracking')}}" class="dropdown-item">@lang('back.report_tracking')</a>
                                </div>
                            </li>
{{--
                            <li class="nav-item">
                                <a class="nav-link" target="_blank" href="{{url('2.pdf')}}">
                                    <i class="uil-home-alt me-2"></i> @lang('back.license')
                                </a>
                            </li>--}}

                        </ul>
                    </div>
                </nav>
            </div>
        </div>


    </header>


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">


                @yield('content')


            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script>
                        © {{getSetting('name')->value}}.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Crafted with <i class="mdi mdi-heart text-danger"></i> by
                            <a href="https://h-mokhtar.com/" target="_blank" class="text-reset">Hossam Mokhtar</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
{{--

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">

        <div class="rightbar-title d-flex align-items-center px-3 py-4">

            <h5 class="m-0 me-2">Settings</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>


        <!-- Settings -->
        <hr class="mt-0"/>
        <h6 class="text-center mb-0">Choose Layouts</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="assets/images/layouts/layout-1.jpg" class="img-thumbnail" alt="layout images">
            </div>
            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked/>
                <label class="form-check-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="assets/images/layouts/layout-2.jpg" class="img-thumbnail" alt="layout images">
            </div>
            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch"/>
                <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
            </div>

            <div class="mb-2">
                <img src="assets/images/layouts/layout-3.jpg" class="img-thumbnail" alt="layout images">
            </div>
            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch"/>
                <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
            </div>

            <div class="mb-2">
                <img src="assets/images/layouts/layout-4.jpg" class="img-thumbnail" alt="layout images">
            </div>
            <div class="form-check form-switch mb-5">
                <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">
                <label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
            </div>


        </div>

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

--}}
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="{{url('acp/libs/jquery/jquery.min.js')}}"></script>
<script type='text/javascript'
        src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script src="{{url('acp/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('acp/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{url('acp/libs/parsleyjs/parsley.min.js')}}"></script>

@yield('js')
<script src="{{url('acp/libs/simplebar/simplebar.min.js')}}"></script>
{{--<script src="{{url('acp/libs/node-waves/waves.min.js')}}"></script>--}}
<script src="{{url('acp/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{url('acp/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{url('acp/js/pages/form-validation.init.js')}}"></script>

<!-- App js -->
<script src="{{url('acp/js/app.js')}}"></script>

</body>

</html>
