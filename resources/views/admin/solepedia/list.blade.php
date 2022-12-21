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
                                                    <th>City</th>
													<th>Title</th>
													<th>Type</th>
													
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($solepedias as $solepedia)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $solepedia->city->name }}</td>
														<td>{{ $solepedia->title }}</td>
														<td>{{ $solepedia->type }}</td>
														
                                                        <td class="d-flex">
                                                            <a class="btn btn-small green darken-2 mr-2 waves-effect waves-light" href="{{ route('admin.sole_images', ['id' => $solepedia->id]) }}"><i class="material-icons">image</i></a>
                                                            <a class="btn btn-small blue darken-2 mr-2 waves-effect waves-light" href="{{ url('admin/solepedia/'.$solepedia->id.'/edit') }}"><i class="material-icons">edit</i></a>
                                                            <form action="{{ url('admin/solepedia/'.$solepedia->id) }}" name="solepedia{{ $solepedia->id }}form" data-data="{{ $solepedia->title }}" class="delete-form" method="POST">
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
