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
                                <form action="{{ route('admin.solepedia.store') }}" id="store_user" enctype="multipart/form-data" method="POST" class="col s12">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field">
                                            <select name="city_id" class="select2 browser-default">
                                                <option value="">-- Select City --</option>
                                                @foreach ($cities as $c)
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field">
                                            <input type="text" required name="title" id="title">
                                            <label for="Title">Title *</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="type">Type</label>
                                        <div class="input-field d-flex">
                                            <p class="mr-5">
                                                <label>
                                                  <input class="with-gap" name="type" value="book" type="radio" checked />
                                                  <span>Book</span>
                                                </label>
                                            </p>
    
                                            <p class="mr-5">
                                                <label>
                                                  <input class="with-gap" name="type" value="komik" type="radio" />
                                                  <span>Komik</span>
                                                </label>
                                            </p>

                                            <p>
                                                <label>
                                                  <input class="with-gap" name="type" value="video" type="radio" />
                                                  <span>Video</span>
                                                </label>
                                            </p>
                                        </div>
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
