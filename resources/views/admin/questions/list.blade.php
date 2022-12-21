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
                                    <div class="responsive-table mt-3">
                                        <table id="users-list-datatable" class="table" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Category</th>
													<th>City</th>
													<th>Type</th>
													<th>Question</th>
													<th>Reward Exp</th>
													<th>Reward Item</th>
													
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($questions as $questions)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $questions->category->name }}</td>
														<td>{{ $questions->city->name }}</td>
														<td>{{ $questions->type }}</td>
														<td>{{ $questions->question }}</td>
														<td>{{ $questions->reward_exp }}</td>
														<td>{{ $questions->reward_item }}</td>
														
                                                        <td class="d-flex">
                                                            <a class="btn btn-small blue darken-2 mr-2 waves-effect waves-light" href="{{ url('admin/questions/'.$questions->id.'/edit') }}"><i class="material-icons">edit</i></a>
                                                            <form action="{{ url('admin/questions/'.$questions->id) }}" name="questions{{ $questions->id }}form" data-data="{{ $questions->id }}" class="delete-form" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-small waves-effect waves-light red darken-2 delete-btn"><i class="material-icons">delete</i> <span class="hide-on-small-only">Delete</span></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
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
