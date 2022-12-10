<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Admin Login - {{ $site_settings->where('setting_name', 'site_name')->first()->setting_value }}</title>
    <link rel="apple-touch-icon" href="{{ asset('storage/'.$site_settings->where('setting_name', 'favicon')->first()->setting_value) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/'.$site_settings->where('setting_name', 'favicon')->first()->setting_value) }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/themes/vertical-dark-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/themes/vertical-dark-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/pages/login.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/custom/custom.css') }}">
</head>

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu preload-transitions 1-column blank-page blank-page" data-open="click" data-menu="vertical-dark-menu" data-col="1-column" style="background-image: url({{ asset('storage/'.$site_settings->where('setting_name', 'login_bg')->first()->setting_value) }}); background-repeat: no-repeat; background-size: cover;">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="login-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                        <div class="row">
                            <div class="input-field col s12 d-flex justify-content-center">
                                <img src="{{ asset('storage/'.$site_settings->where('setting_name', 'logo_big')->first()->setting_value) }}" width="150" alt="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field mt-0 col s12">
                                <h5 class="ml-4">Sign In {{ $site_settings->where('setting_name', 'site_name')->first()->setting_value }}</h5>
                            </div>
                        </div>
                        <form class="login-form" method="post" action="{{ route('login') }}">
                            @csrf
                            @error('login')
                                <div class="card-alert card red lighten-5">
                                    <div class="card-content red-text">
                                      <p>{{ $message }}</p>
                                    </div>
                                    <button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                            @enderror
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i>
                                    <input id="email" class="validate" type="email" name="email" value="{{ old('email') }}" autofocus>
                                    <label for="email" class="center-align">Email</label>
                                    @error('email')
                                        <small class="ml-10">
                                            <div class="error ml-8">{{ $message }}</div>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input id="password" class="validate" type="password" name="password">
                                    <label for="password">Password</label>
                                    @error('password')
                                        <small class="ml-10">
                                            <div class="error ml-8">{{ $message }}</div>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12 ml-2 mt-1">
                                    <p>
                                        <label>
                                            <input type="checkbox" name="remember" />
                                            <span>Remember Me</span>
                                        </label>
                                    </p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="input-field col s12">
                                    <button type="submit" class="btn waves-effect waves-light border-round {{ $site_settings->where('setting_name', 'theme_color')->first()->setting_value }} col s12">Login</button>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="input-field col s12">
                                    <p class="margin center-align medium-small"><a href="user-forgot-password.html">Forgot password ?</a></p>
                                </div>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>

    <script src="{{ asset('assets/admin/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/admin/js/search.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts/ui-alerts.js') }}"></script>
    <script src="{{ asset('assets/admin/js/custom/custom-script.js') }}"></script>
</body>

</html>