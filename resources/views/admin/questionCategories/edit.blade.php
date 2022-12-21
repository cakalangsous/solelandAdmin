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
                                <form action="{{ url('admin/question_categories/'.$question_category->id) }}" id="store_user" enctype="multipart/form-data" method="POST" class="col s12">
                                    @csrf
                                    @method('PUT')
                                    
<div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="name" id="name" value="{{ $question_category->name }}">
                                        <label for="Name">Name *</label>
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
