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
                                <form action="{{ route('admin.questions.store') }}" id="store_user" enctype="multipart/form-data" method="POST" class="col s12">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field">
                                            <select name="category_id" class="select2 browser-default">
                                                <option value="">-- Select Category --</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}" {{ $c->id == $question->category_id ? "selected" : "" }}>{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field">
                                            <select name="city_id" class="select2 browser-default">
                                                <option value="">-- Select City --</option>
                                                @foreach ($cities as $c)
                                                    <option value="{{ $c->id }}" {{ $c->id == $question->city_id ? "selected" : "" }} >{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field d-flex">
                                            <p class="mr-5">
                                                <label>
                                                <input class="with-gap" name="type" value="multiple_choice" type="radio" {{ $question->type == "multiple_choice" ? "checked" : "" }} />
                                                <span>Multiple Choice</span>
                                                </label>
                                            </p>

                                            <p>
                                                <label>
                                                <input class="with-gap" name="type" value="fill_blank" type="radio" {{ $question->type == "fill_blank" ? "checked" : "" }} />
                                                <span>Fill Blanks</span>
                                                </label>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field">
                                            <input type="text" value="{{ $question->question }}" required name="question" id="question">
                                            <label for="Question">Question *</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field">
                                            <input type="text" value="{{ $question->reward_exp }}" name="reward_exp" id="reward_exp">
                                            <label for="Reward Exp">Reward Exp </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field">
                                            <input type="text" value="{{ $question->reward_item }}" name="reward_item" id="reward_item">
                                            <label for="Reward Item">Reward Item </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <h3 class="card-title mt-5">Answer</h3>
                                    </div>
                                    <div class="row {{ $question->type != "multiple_choice" ? "hide" : "" }}" id="multiple_choice">
                                        @for ($i = 0; $i < count($answer); $i++)
                                            <div class="mb-5">
                                                <b>Answer {{ $i + 1 }}</b>
                                                <div class="input-field">
                                                    <input type="text" value="{{ $answer[$i]->answer }}" {{ $question->type != "multiple_choice" ? "disabled" : "" }} required name="answer[]" id="answer{{ $i + 1 }}">
                                                    <label for="Answer">Answer {{ $i + 1 }}</label>
                                                </div>
                                                <label for="isCorrect">Is Correct</label>
                                                <div class="input-field d-flex">
                                                    <p class="mr-5">
                                                        <label>
                                                        <input class="with-gap" name="isCorrect{{ $i + 1 }}" value="1" type="radio" {{ $answer[$i]->isCorrect ? "checked" : "" }} />
                                                        <span>Yes</span>
                                                        </label>
                                                    </p>
        
                                                    <p>
                                                        <label>
                                                        <input class="with-gap" name="isCorrect{{ $i + 1 }}" value="0" type="radio" {{ $answer[$i]->isCorrect ? "checked" : "" }} />
                                                        <span>No</span>
                                                        </label>
                                                    </p>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>

                                    <div class="row {{ $question->type != "fill_blank" ? "hide" : "" }}" id="fill_blanks">
                                        <div class="input-field">
                                            <input type="text" name="answer" value="{{ $answer[0]->answer }}" {{ $question->type != "fill_blank" ? "disabled" : "" }} id="answer">
                                            <label for="answer">Answer </label>
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

@section("script")
    <script>
        $("input[name=type]").change(function() {
            const chosenType = $(this).val()
            if (chosenType == "fill_blank") {
                $("#fill_blanks").removeClass("hide");
                $("#fill_blanks input").removeAttr("disabled");
                $("#multiple_choice").addClass("hide")
                $("#multiple_choice input").attr("disabled")
            }
            
            if (chosenType == "multiple_choice") {
                $("#fill_blanks").addClass("hide");
                $("#fill_blanks input").attr("disabled")
                $("#multiple_choice").removeClass("hide")
                $("#multiple_choice input").removeAttr("disabled");
            }
        })
    </script>
@endsection
