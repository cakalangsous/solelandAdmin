<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-modern sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{ route('admin.dashboard') }}"><img class="hide-on-med-and-down " src="{{ asset('storage/'.$site_settings->where('setting_name', 'logo_small')->first()->setting_value) }}" alt="materialize logo" /><img class="show-on-medium-and-down hide-on-med-and-up" src="{{ asset('storage/'.$site_settings->where('setting_name', 'logo_small')->first()->setting_value) }}" alt="materialize logo" /><span class="logo-text hide-on-med-and-down">{{ $site_settings->where('setting_name', 'site_name')->first()->setting_value }}</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="{{ $active == 'dashboard' ? 'active' : '' }} bold">
            <a class="waves-effect waves-cyan {{ $active == 'dashboard' ? 'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="material-icons">settings_input_svideo</i><span class="menu-title">Dashboard</span>
            </a>
        </li>
        
        @include('admin.partials.aside_generated')

        <li class="navigation-header"><a class="navigation-header-text">Auth & Settings </a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        
        @canany(['roles_view', 'permissions_view', 'users_view', 'access_view'])
            <li class="{{ $parent == 'auth' ? 'active' : '' }} bold">
                <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)">
                    <i class="material-icons">lock</i><span class="menu-title" data-i18n="Templates">Auth</span>
                </a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        @can('roles_view')
                            <li>
                                <a class="waves-effect waves-cyan {{ $active == 'roles' ? 'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value : '' }}" href="{{ route('admin.roles.index') }}">
                                    <i class="material-icons">radio_button_unchecked</i><span>Roles</span>
                                </a>
                            </li>
                        @endcan

                        @can('permissions_view')
                            <li>
                                <a class="waves-effect waves-cyan {{ $active == 'permission' ? 'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value : '' }}" href="{{ route('admin.permission.index') }}">
                                    <i class="material-icons">radio_button_unchecked</i><span>Permission</span>
                                </a>
                            </li>
                        @endcan

                        @can('users_view')
                            <li>
                                <a class="waves-effect waves-cyan {{ $active == 'user' ? 'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value : '' }}" href="{{ route('admin.users.index') }}">
                                    <i class="material-icons">radio_button_unchecked</i><span>Users</span>
                                </a>
                            </li>
                        @endcan

                        @can('access_view')
                            <li>
                                <a class="waves-effect waves-cyan {{ $active == 'access' ? 'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value : '' }}" href="{{ route('admin.access.index') }}">
                                    <i class="material-icons">radio_button_unchecked</i><span>Access</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        <li class="{{ $active=='site_settings'?'active':'' }} bold">
            <a class="waves-effect waves-cyan {{ $active=='site_settings'?'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value:'' }} " href="{{ route('admin.site_settings.index') }}">
                <i class="material-icons">settings</i>
                <span class="menu-title" data-i18n="">Site Settings</span>
            </a>
        </li>

        {{-- @hasrole('Developer')
            <li class="navigation-header mt-8 mb-4"><a class="navigation-header-text">Developer Menu</a><i class="navigation-header-icon material-icons">more_horiz</i>
            </li>

            <li class="{{ $active == 'table_builder' ? 'active' : '' }} bold">
                <a class="waves-effect waves-cyan {{ $active == 'table_builder' ? 'active' : '' }}" href="{{ route('admin.tables.index') }}">
                    <i class="material-icons">storage</i><span class="menu-title">Table Builder</span>
                </a>
            </li>
            
        @endhasrole --}}
    </ul>
    <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>