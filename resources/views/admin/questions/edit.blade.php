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
                                <form action="{{ url('admin/questions/'.$question->id) }}" id="store_user" enctype="multipart/form-data" method="POST" class="col s12">
                                    @csrf
                                    @method('PUT')
                                    
<div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="category_id" id="category_id" value="{{ $question->category_id }}">
                                        <label for="Category Id">Category Id *</label>
                                    </div>
                                </div>

<div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="city_id" id="city_id" value="{{ $question->city_id }}">
                                        <label for="City Id">City Id *</label>
                                    </div>
                                </div>

<div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="type" id="type" value="{{ $question->type }}">
                                        <label for="Type">Type *</label>
                                    </div>
                                </div>

<div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="question" id="question" value="{{ $question->question }}">
                                        <label for="Question">Question *</label>
                                    </div>
                                </div>

<div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="reward_exp" id="reward_exp" value="{{ $question->reward_exp }}">
                                        <label for="Reward Exp">Reward Exp *</label>
                                    </div>
                                </div>

<div class="row">
                                    <div class="input-field">
                                        <input type="text" required name="reward_item" id="reward_item" value="{{ $question->reward_item }}">
                                        <label for="Reward Item">Reward Item *</label>
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
