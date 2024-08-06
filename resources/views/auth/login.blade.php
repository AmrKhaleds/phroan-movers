<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@lang('back.AppName') | @lang('back.login')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('acp/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{url('acp/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{url('acp/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{url('acp/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <style>
        body{
            background-image: url({{ asset('acp/images/login.jpeg') }});
            width: 100%;
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="authentication-bg">
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <a href="index.html" class="mb-5 d-block auth-logo">
                        <img src="{{url('acp/images/logo-dark.png')}}" alt="" height="22" class="logo logo-dark">
                        <img src="{{url('acp/images/logo-light.png')}}" alt="" height="22" class="logo logo-light">
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            <h5 class="text-primary">@lang('back.welcome_back') !</h5>
                            <p class="text-muted">@lang('back.login')  @lang('back.AppName').</p>
                        </div>
                        <div class="p-2 mt-4">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="username">@lang('back.email')</label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="float-end">
                                        <a href="auth-recoverpw.html" class="text-muted">@lang('back.forgot_password')?</a>
                                    </div>
                                    <label class="form-label" for="userpassword">@lang('back.password')</label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        @lang('back.remember_me')
                                    </label>
                                </div>

                                <div class="mt-3 text-end">
                                    <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">@lang('back.login')</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

                <div class="mt-5 text-center">
                    <p>© <script>document.write(new Date().getFullYear())</script> Minible. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                </div>

            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>

<!-- JAVASCRIPT -->
<script src="{{url('acp/libs/jquery/jquery.min.js')}}"></script>
<script src="{{url('acp/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('acp/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{url('acp/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{url('acp/libs/node-waves/waves.min.js')}}"></script>
<script src="{{url('acp/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{url('acp/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>

<!-- App js -->
<script src="{{url('acp/js/app.js')}}"></script>

</body>
</html>

