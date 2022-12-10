@extends('admin.base_layout')
@section('content')

    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-blue"></div>
            <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
                
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ $title ?? 'Tables List' }}</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Table Builder</a>
                                </li>
                                <li class="breadcrumb-item active">{{ $title ?? 'Tables List' }}
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            @if (session()->has('success'))
                                <div class="card-alert card border-radius-7 green lighten-5">
                                    <div class="card-content green-text">
                                        <p> <i class="material-icons">check</i> <b>SUCCESS!</b> {{ session('success') }}</p>
                                    </div>
                                    <button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="container">
                    
                    <section class="users-list-wrapper section">
                        <div class="users-list-table">
                            <div class="card border-radius-7">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s10 m6 l6">
                                            <h4 class="mt-0">{{ $title ?? 'Tables List' }}</h4>
                                        </div>
                                        @can('add_user')
                                            <div class="col s2 m6 l6">
                                                <a class="btn btn-small waves-effect waves-light right" href="{{ route('admin.tables.create') }}">
                                                    <i class="material-icons left mr-0">add</i><span class="hide-on-small-only">Add</span>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                    <div class="responsive-table mt-3">
                                        <table id="users-list-datatable" class="table" width="100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tables as $table)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $table }}</td>
                                                        <td>{{ $table }}</td>
                                                        <td class="d-flex">
                                                            <a href="/admin/users/{{ $table }}/edit" class="btn btn-small blue darken-2 mr-2 pl-10 pr-10 waves-effect waves-light"><i class="material-icons">edit</i></a>
                                                            <form action="/admin/users/{{ $table }}" name="user{{ $table }}form" data-user="{{ $table }}" class="delete-user-form" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-small pl-0 pr-0 waves-effect waves-light red darken-2 delete-btn"><i class="material-icons right">delete_</i></button>
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
