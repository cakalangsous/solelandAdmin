@extends('admin.base_layout')
@section('content')

    <div id="main">
        <div class="row">
            @include('admin.partials.breadcrumbs')
            <div class="col s12">
                <div class="container">
                    <section class="users-list-wrapper section">
                        <div class="users-list-table">
                            <div class="card border-radius-7">
                                <div class="card-content animate fadeUp">
                                    <div class="row">
                                        <div class="col s12">
                                            <h4 class="mt-0">{{ $title }}</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12">
                                            <form action="{{ route('admin.site_settings.save') }}" id="update_settings" enctype="multipart/form-data" method="POST" class="col s12">
                                                @csrf
                                                @method('PUT')

                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input id="site_name" type="text" value="{{ $site_settings->where('setting_name', 'site_name')->first()->setting_value }}" name="site_name">
                                                        <label for="site_name">Site Name</label>
                                                        @error('site_name')
                                                            <small class="errorName">
                                                                <div class="error">{{ $message }}</div>
                                                            </small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row section">
                                                    <div class="input-field col s12">
                                                        <p>Favicon</p>
                                                        <span class="helper-text" data-error="wrong" data-success="right">Max Size : 1MB</span>
                                                        @error('favicon')
                                                            <small class="errorName">
                                                                <div class="error">{{ $message }}</div>
                                                            </small>
                                                        @enderror
                                                    </div>
                                                    <div class="col s12">
                                                        <input type="file" name="favicon" class="dropify" data-default-file="{{ asset('storage/'.$site_settings->where('setting_name', 'favicon')->first()->setting_value) }}" />
                                                    </div>
                                                </div>

                                                <div class="row section">
                                                    <div class="input-field col s12">
                                                        <p>Logo Small</p>
                                                        <span class="helper-text" data-error="wrong" data-success="right">Max Size : 1MB</span>
                                                        @error('logo_small')
                                                            <small class="errorName">
                                                                <div class="error">{{ $message }}</div>
                                                            </small>
                                                        @enderror
                                                    </div>
                                                    <div class="col s12">
                                                        <input type="file" name="logo_small" class="dropify" data-default-file="{{ asset('storage/'.$site_settings->where('setting_name', 'logo_small')->first()->setting_value) }}" />
                                                    </div>
                                                </div>

                                                <div class="row section">
                                                    <div class="input-field col s12">
                                                        <p>Logo Big</p>
                                                        <span class="helper-text" data-error="wrong" data-success="right">Max Size : 1MB</span>
                                                        @error('logo_big')
                                                            <small class="errorName">
                                                                <div class="error">{{ $message }}</div>
                                                            </small>
                                                        @enderror
                                                    </div>
                                                    <div class="col s12">
                                                        <input type="file" name="logo_big" class="dropify" data-default-file="{{ asset('storage/'.$site_settings->where('setting_name', 'logo_big')->first()->setting_value) }}" />
                                                    </div>
                                                </div>

                                                <div class="row section">
                                                    <div class="input-field col s12">
                                                        <p>Login Background</p>
                                                        <span class="helper-text" data-error="wrong" data-success="right">Max Size : 1MB</span>
                                                        @error('login_bg')
                                                            <small class="errorName">
                                                                <div class="error">{{ $message }}</div>
                                                            </small>
                                                        @enderror
                                                    </div>
                                                    <div class="col s12">
                                                        <input type="file" name="login_bg" class="dropify" data-default-file="{{ asset('storage/'.$site_settings->where('setting_name', 'login_bg')->first()->setting_value) }}" />
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input id="theme_color" type="text" value="{{ $site_settings->where('setting_name', 'theme_color')->first()->setting_value }}" name="theme_color">
                                                        <label for="theme_color">Theme Color</label>
                                                        @error('theme_color')
                                                            <small class="errorName">
                                                                <div class="error">{{ $message }}</div>
                                                            </small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input id="add_btn_bg" type="text" value="{{ $site_settings->where('setting_name', 'add_btn_bg')->first()->setting_value }}" name="add_btn_bg">
                                                        <label for="add_btn_bg">Add button bg color</label>
                                                        @error('add_btn_bg')
                                                            <small class="errorName">
                                                                <div class="error">{{ $message }}</div>
                                                            </small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input id="add_btn_color" type="text" value="{{ $site_settings->where('setting_name', 'add_btn_color')->first()->setting_value }}" name="add_btn_color">
                                                        <label for="add_btn_color">Add button text color</label>
                                                        @error('add_btn_color')
                                                            <small class="errorName">
                                                                <div class="error">{{ $message }}</div>
                                                            </small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <a href="https://pixinvent.com/materialize-material-design-admin-template/html/ltr/vertical-modern-menu-template/css-color.html" target="_blank">Checkout the color referrence page</a>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <button class="btn waves-effect waves-light right gradient-45deg-blue-indigo" type="submit">Save
                                                            <i class="material-icons right">send</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- <div class="responsive-table mt-3">
                                        <table id="users-list-datatable" class="table" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>setting_name</th>
													<th>setting_value</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($site_settings as $site_settings)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $site_settings->setting_name }}</td>
														<td>{{ $site_settings->setting_value }}</td>
                                                        <td class="d-flex">
                                                            <a class="btn btn-small blue darken-2 mr-2 waves-effect waves-light" href="{{ url('admin/site_settings/'.$site_settings->id.'/edit') }}"><i class="material-icons">edit</i></a>
                                                            <form action="{{ url('admin/site_settings/'.$site_settings->id) }}" name="site_settings{{ $site_settings->id }}form" data-data="{{ $site_settings->id }}" class="delete-form" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-small waves-effect waves-light red darken-2 delete-btn"><i class="material-icons">delete</i> <span class="hide-on-small-only">Delete</span></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div> --}}
                                    
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>

@endsection
