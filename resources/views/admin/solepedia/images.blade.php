@extends('admin.base_layout')
@section('content')
    <div id="main">
        <div class="row">
            @include('admin.partials.breadcrumbs')
            <div class="col m8 s12 animated fadeInLeft">
                <div class="card card-default">
                    <div class="card-content animate fadeUp">
                        <h3 class="card-title">{{ $title }} Form</h3>
                        <div class="row">
                            <div class="col s12">
                                <form action="{{ route('admin.solepedia_images.store') }}" id="store_user" enctype="multipart/form-data" method="POST" class="col s12">
                                    @csrf
                                    <input type="hidden" name="solepedia_id" value="{{ $solepedia->id }}">
                                    <div class="row section">
                                        <div class="input-field">
                                            <p>Content</p>
                                            {{-- <span class="helper-text" data-error="wrong" data-success="right">Max Size : 1MB</span> --}}
                                            @error('logo_big')
                                                <small class="errorName">
                                                    <div class="error">{{ $message }}</div>
                                                </small>
                                            @enderror
                                        </div>
                                        <input type="file" name="content" class="dropify" />
                                    </div>

                                    
                                    <div class="row mt-10">
                                        <div class="input-field">
                                            <a class="btn btn-small amber darken-2 mr-2 waves-effect waves-light" href="{{ route('admin.sole_images', ['id' => $solepedia->id]) }}">
                                                Back
                                            </a>
        									<button class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4">
        										Submit
                                                <i class="material-icons right">send</i>
        									</button>
        								</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
