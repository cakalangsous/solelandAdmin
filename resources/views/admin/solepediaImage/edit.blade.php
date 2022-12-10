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
                                <form action="{{ url('admin/solepedia_image/'.$solepedia_image->id) }}" id="store_user" enctype="multipart/form-data" method="POST" class="col s12">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row">
                                        <div class="input-field">
                                            <select name="solepedia_id" class="select2 browser-default">
                                                <option value="">-- Select Solepedia --</option>
                                                @foreach ($solepedia as $s)
                                                    <option value="{{ $s->id }}" {{ $s->id == $solepedia_image->solepedia_id ? "selected" : "" }}>{{ $s->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row section">
                                        <div class="input-field">
                                            <p>Image</p>
                                            <span class="helper-text" data-error="wrong" data-success="right">Max Size : 1MB</span>
                                            @error('image')
                                                <small class="errorName">
                                                    <div class="error">{{ $message }}</div>
                                                </small>
                                            @enderror
                                        </div>
                                        <input type="file" name="image" class="dropify" data-default-file="{{ asset('storage/'. $solepedia_image->image) }}" />
                                    </div>

                                    
                                    <div class="row mt-10">
                                        <div class="input-field">
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
