<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>{{ $title ?? '' }} | {{ $site_settings->where('setting_name', 'site_name')->first()->setting_value }}</title>
    <link rel="apple-touch-icon" href="{{ asset($site_settings->where('setting_name', 'favicon')->first()->setting_value) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($site_settings->where('setting_name', 'favicon')->first()->setting_value) }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/vendors.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/data-tables/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/select2/select2-materialize.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/pages/data-tables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/pages/advance-ui-media.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/pages/dashboard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/pages/page-users.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/custom/custom.css') }}">
</head>

<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-modern-menu preload-transitions 2-columns" data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark {{ $site_settings->where('setting_name', 'theme_color')->first()->setting_value }} no-shadow">
                <div class="nav-wrapper">
                    <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
                        <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Explore Materialize" data-search="template-list">
                        <ul class="search-list collection display-none"></ul>
                    </div>
                    <ul class="navbar-list right">
                        {{-- <li class="dropdown-language"><a class="waves-effect waves-block waves-light translation-button" href="#" data-target="translation-dropdown"><span class="flag-icon flag-icon-gb"></span></a></li> --}}
                        <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                        <li class="hide-on-large-only search-input-wrapper"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>
                        {{-- <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons">notifications_none<small class="notification-badge">5</small></i></a></li> --}}
                        <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('assets/admin/default.png') }}" alt="avatar"><i></i></span></a></li>
                    </ul>
                    <!-- translation-button-->
                    <ul class="dropdown-content" id="translation-dropdown">
                        <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="en"><i class="flag-icon flag-icon-gb"></i> English</a></li>
                        <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a></li>
                        <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></li>
                        <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a></li>
                    </ul>
                    <!-- notifications-dropdown-->
                    <ul class="dropdown-content" id="notifications-dropdown">
                        <li>
                            <h6>NOTIFICATIONS<span class="grey badge">5</span></h6>
                        </li>
                        <li class="divider"></li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new order has been placed!</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle teal small">settings</span> Settings updated</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle deep-orange small">today</span> Director meeting started</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle amber small">trending_up</span> Generate monthly report</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
                        </li>
                    </ul>
                    <!-- profile-dropdown-->
                    <ul class="dropdown-content" id="profile-dropdown">
                        <li><a class="grey-text text-darken-1" href="{{ route('admin.users.profile') }}"><i class="material-icons">person_outline</i> Profile</a></li>
                        <li><a class="grey-text text-darken-1" href="{{ route('admin.logout') }}"><i class="material-icons">keyboard_tab</i> Logout</a></li>
                    </ul>
                </div>
                <nav class="display-none search-sm">
                    <div class="nav-wrapper">
                        <form id="navbarForm">
                            <div class="input-field search-input-sm">
                                <input class="search-box-sm mb-0" type="search" required="" id="search" placeholder="Explore Materialize" data-search="template-list">
                                <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                                <ul class="search-list collection search-list-sm display-none"></ul>
                            </div>
                        </form>
                    </div>
                </nav>
            </nav>
        </div>
    </header>
    <ul class="display-none" id="default-search-main">
        <li class="auto-suggestion-title"><a class="collection-item" href="#">
                <h6 class="search-title">FILES</h6>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="{{ asset('assets/admin/images/icon/pdf-image.png') }}" width="24" height="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Two new item submitted</span><small class="grey-text">Marketing Manager</small></div>
                    </div>
                    <div class="status"><small class="grey-text">17kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="{{ asset('assets/admin/images/icon/doc-image.png') }}" width="24" height="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">52 Doc file Generator</span><small class="grey-text">FontEnd Developer</small></div>
                    </div>
                    <div class="status"><small class="grey-text">550kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="{{ asset('assets/admin/images/icon/xls-image.png') }}" width="24" height="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">25 Xls File Uploaded</span><small class="grey-text">Digital Marketing Manager</small></div>
                    </div>
                    <div class="status"><small class="grey-text">20kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="{{ asset('assets/admin/images/icon/jpg-image.png') }}" width="24" height="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Anna Strong</span><small class="grey-text">Web Designer</small></div>
                    </div>
                    <div class="status"><small class="grey-text">37kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion-title"><a class="collection-item" href="#">
                <h6 class="search-title">MEMBERS</h6>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="{{ asset('assets/admin/images/avatar/avatar-7.png') }}" width="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">John Doe</span><small class="grey-text">UI designer</small></div>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="{{ asset('assets/admin/images/avatar/avatar-8.png') }}" width="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Michal Clark</span><small class="grey-text">FontEnd Developer</small></div>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="{{ asset('assets/admin/images/avatar/avatar-10.png') }}" width="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Milena Gibson</span><small class="grey-text">Digital Marketing</small></div>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="{{ asset('assets/admin/images/avatar/avatar-12.png') }}" width="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Anna Strong</span><small class="grey-text">Web Designer</small></div>
                    </div>
                </div>
            </a></li>
    </ul>
    <ul class="display-none" id="page-search-title">
        <li class="auto-suggestion-title"><a class="collection-item" href="#">
                <h6 class="search-title">PAGES</h6>
            </a></li>
    </ul>
    <ul class="display-none" id="search-not-found">
        <li class="auto-suggestion"><a class="collection-item display-flex align-items-center" href="#"><span class="material-icons">error_outline</span><span class="member-info">No results found.</span></a></li>
    </ul>

    @include('admin.partials.aside')
    
    @yield('content')

    <footer class="page-footer footer footer-static footer-light navbar-border navbar-shadow">
        <div class="footer-copyright">
            <div class="container"><span>&copy; 2021 {{ $site_settings->where('setting_name', 'site_name')->first()->setting_value }}. All rights reserved.</span><span class="right hide-on-small-only">Developed by <a href="https://instagram.com/bennykindangen" target="_blank">Benkin</a></span></div>
        </div>
    </footer>

    <script>
        const base_url = "{{ url('/') }}";
        let token = "{{ csrf_token() }}";
        const active = '{{ $active }}';
    </script>

    <script src="{{ asset('assets/admin/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/select2/select2.full.min.js') }}"></script>

    <script src="{{ asset('assets/admin/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/admin/js/search.js') }}"></script>
    {{-- <script src="{{ asset('assets/admin/js/scripts/dashboard-ecommerce.js') }}"></script> --}}
    <script src="{{ asset('assets/admin/js/scripts/advance-ui-media.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts/data-tables.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts/page-users.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts/form-file-uploads.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts/extra-components-sweetalert.js') }}"></script>

    @yield("script")
    
    <script>
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });

        $('.materialboxed').materialbox();
    </script>
    <script src="{{ asset('assets/admin/js/custom/custom-script.js') }}"></script>
</body>

</html>