<li class="{{ $active=='cities'?'active':'' }} bold">
    <a class="waves-effect waves-cyan {{ $active=='cities'?'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value:'' }} " href="{{ route('admin.cities.index') }}">
        <i class="material-icons">assignment</i>
        <span class="menu-title" data-i18n="">Cities</span>
    </a>
</li>

<li class="{{ $active=='solepedia'?'active':'' }} bold">
    <a class="waves-effect waves-cyan {{ $active=='solepedia'?'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value:'' }} " href="{{ route('admin.solepedia.index') }}">
        <i class="material-icons">assignment</i>
        <span class="menu-title" data-i18n="">Solepedia</span>
    </a>
</li>

{{-- <li class="{{ $active=='solepedia_images'?'active':'' }} bold">
    <a class="waves-effect waves-cyan {{ $active=='solepedia_image'?'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value:'' }} " href="{{ route('admin.solepedia_images.index') }}">
        <i class="material-icons">assignment</i>
        <span class="menu-title" data-i18n="">Solepedia Image</span>
    </a>
</li> --}}
