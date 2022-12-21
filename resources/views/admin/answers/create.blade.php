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
                                <form action="{{ route('admin.answers.store') }}" id="store_user" enctype="multipart/form-data" method="POST" class="col s12">
                                    @csrf
                                <div class="row">
                                    <div class="input-field">
                                        <select name="question_id" class="select2 browser-default">
                                            <option value="">-- Select Question --</option>
                                            @foreach ($questions as $q)
                                                <option value="{{ $q->id }}">{{ $q->question }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="answer" id="answer">
                                        <label for="Answer">Answer *</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="isCorrect" id="isCorrect">
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
