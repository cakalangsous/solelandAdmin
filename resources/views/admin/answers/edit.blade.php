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
                                <form action="{{ url('admin/answers/'.$answer->id) }}" id="store_user" enctype="multipart/form-data" method="POST" class="col s12">
                                    @csrf
                                    @method('PUT')
                                    
<div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="question_id" id="question_id" value="{{ $answer->question_id }}">
                                        <label for="Question Id">Question Id *</label>
                                    </div>
                                </div>

<div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="answer" id="answer" value="{{ $answer->answer }}">
                                        <label for="Answer">Answer *</label>
                                    </div>
                                </div>

<div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="isCorrect" id="isCorrect" value="{{ $answer->isCorrect }}">
                                        <label for="IsCorrect">IsCorrect *</label>
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
