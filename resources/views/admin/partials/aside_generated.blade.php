@can('cities_view')
    <li class="{{ $active=='cities'?'active':'' }} bold">
        <a class="waves-effect waves-cyan {{ $active=='cities'?'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value:'' }} " href="{{ route('admin.cities.index') }}">
            <i class="material-icons">assignment</i>
            <span class="menu-title" data-i18n="">Cities</span>
        </a>
    </li>
@endcan

@can('solepedia_view')
<li class="{{ $active=='solepedia'?'active':'' }} bold">
    <a class="waves-effect waves-cyan {{ $active=='solepedia'?'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value:'' }} " href="{{ route('admin.solepedia.index') }}">
        <i class="material-icons">assignment</i>
        <span class="menu-title" data-i18n="">Solepedia</span>
    </a>
</li>
@endcan

{{-- <li class="{{ $active=='solepedia_images'?'active':'' }} bold">
    <a class="waves-effect waves-cyan {{ $active=='solepedia_image'?'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value:'' }} " href="{{ route('admin.solepedia_images.index') }}">
        <i class="material-icons">assignment</i>
        <span class="menu-title" data-i18n="">Solepedia Image</span>
    </a>
</li> --}}

{{-- <li class="{{ $active=='answers'?'active':'' }} bold">
    <a class="waves-effect waves-cyan {{ $active=='answers'?'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value:'' }} " href="{{ route('admin.answers.index') }}">
        <i class="material-icons">assignment</i>
        <span class="menu-title" data-i18n="">Answers</span>
    </a>
</li> --}}
<li class="{{ $parent == 'quiz' ? 'active' : '' }} bold">
    <a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)">
        <i class="material-icons">question_answer</i><span class="menu-title" data-i18n="Templates">Quiz</span>
    </a>
    <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
            <li>
                <a class="waves-effect waves-cyan {{ $active == 'add_questions' ? 'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value : '' }}" href="{{ route('admin.questions.create') }}">
                    <i class="material-icons">radio_button_unchecked</i><span>Add Question</span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-cyan {{ $active=='question_categories'?'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value:'' }} " href="{{ route('admin.question_categories.index') }}">
                    <i class="material-icons">radio_button_unchecked</i>
                    <span class="menu-title" data-i18n="">Question Categories</span>
                </a>
            </li>
            
            <li>
                <a class="waves-effect waves-cyan {{ $active=='questions'?'active '.$site_settings->where('setting_name', 'theme_color')->first()->setting_value:'' }} " href="{{ route('admin.questions.index') }}">
                    <i class="material-icons">radio_button_unchecked</i>
                    <span class="menu-title" data-i18n="">Questions</span>
                </a>
            </li>
    </div>
</li>

