<div class="content-wrapper-before {{ $site_settings->where('setting_name', 'theme_color')->first()->setting_value }}"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <div class="container">
        <div class="row">
            <div class="col s6 m6 l6 animate fadeLeft">
                <div class="row">
                    <div class="col s12">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ $title }}</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            @if (isset($link) && $link!='')
                <div class="col s6 m6 l6 animate fadeRight">
                    <div class="row">
                        <div class="col s12">
                            <a href="{{ $link }}" data-target="add_tag_modal" class="waves-effect waves-light z-depth-4 btn {{ $site_settings->where('setting_name', 'add_btn_bg')->first()->setting_value }} float-right mb-2 {{ $site_settings->where('setting_name', 'add_btn_color')->first()->setting_value }}" {{ isset($data_url)?'data-url="'.$data_url.'"':'' }} style="color:#101010">{{ $button_name }}</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col s12">
                @if (Session::has('message'))
                    <div class="col s12 animated fadeInLeft">
                        <div class="card-alert card green lighten-5">
                            <div class="card-content green-text" id="err-message">
                                <p><strong>Success!</strong></p>
                                <p class="">{{ Session::get('message') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="col s12 animated fadeInLeft">
                        <div class="card-alert card red lighten-5">
                            <div class="card-content red-text" id="err-message">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
