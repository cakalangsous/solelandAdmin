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
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s10 m6 l6">
                                            <h4 class="mt-0">{{ $title ?? 'Users List' }}</h4>
                                        </div>
                                        @can('add_user')
                                            <div class="col s2 m6 l6">
                                                <a class="btn btn-small waves-effect waves-light right" href="{{ route('admin.users.create') }}">
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
                                                    <th>Role</th>
                                                    <th>Last Login</th>
                                                    <th>Status</th>
                                                    <th>Banned</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td><b>{{ $user->getRoleNames()[0]!=null?$user->getRoleNames()[0]:'' }}</b></td>
                                                        <td>{{ $user->last_login!=null? date('M j, Y H:i:s', strtotime($user->last_login)):'-' }}</td>
                                                        <td>
                                                            <span class="chip green lighten-5">
                                                                <span class="green-text">Active</span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="switch">
                                                                <label for="banned{{ $user->id }}">
                                                                  No
                                                                  <input type="checkbox" {{ $user->banned?'checked':'' }} name="banned" id="banned{{ $user->id }}" class="user-banned" data-user={{ $user->id }} data-name="{{ $user->name }}">
                                                                  <span class="lever"></span>
                                                                  Yes
                                                                </label>
                                                              </div>
                                                        </td>
                                                        <td class="d-flex">
                                                            <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-small blue darken-2 mr-2 waves-effect waves-light"><i class="material-icons">edit</i> <span class="hide-on-small-only">Edit</span></a>
                                                            <form action="/admin/users/{{ $user->id }}" name="user{{ $user->id }}form" data-user="{{ $user->name }}" class="delete-user-form" method="POST">
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
