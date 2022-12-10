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
                                <form action="{{ url('admin/solepedia/'.$solepedium->id) }}" id="store_user" enctype="multipart/form-data" method="POST" class="col s12">
                                    @csrf
                                    @method('PUT')
                                    
<div class="row">
                                    <div class="input-field">
                                        <select name="city_id" class="select2 browser-default">
                                            <option value="">-- Select City --</option>
                                            @foreach ($cities as $c)
                                                <option value="{{ $c->id }}" {{ $c->id == $solepedium->city_id ? "selected" : "" }}>{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

<div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="title" id="title" value="{{ $solepedium->title }}">
                                        <label for="Title">Title *</label>
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
