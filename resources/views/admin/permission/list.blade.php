@extends('admin.base_layout')
@section('content')

    <div id="main">
        <div class="row">
            @include('admin.partials.breadcrumbs')
            <div class="col s12 m7">
                <div class="container">
                    
                    <section class="users-list-wrapper section">
                        <div class="users-list-table">
                            <div class="card border-radius-7">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s12">
                                            <h4 class="mt-0">{{ $title ?? 'Permission List' }}</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 mt-3">
                                            <table id="data-table-simple" class="table" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Table Name</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($perms as $perm)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $perm->name }}</td>
                                                            <td>{{ $perm->table_name }}</td>
                                                            <td class="d-flex">
                                                                <a href="/admin/permission/{{ $perm->id }}/edit" class="btn btn-small blue darken-2 mr-2 waves-effect waves-light"><i class="material-icons left">edit</i> <span class="hide-on-small-only">Edit</span></a>
                                                                <form action="/admin/permission/{{ $perm->id }}" name="perm{{ $perm->id }}form" data-perm="{{ $perm->name }}" class="delete-perm-form" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-small waves-effect waves-light red darken-2 delete-btn"><i class="material-icons left">delete</i> <span class="hide-on-small-only">Delete</span></button>
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
                        </div>
                    </section>
                </div>
                <div class="content-overlay"></div>
            </div>

            <div class="col s12 m5">
                <div class="container">
                    <section class="users-list-wrapper section">
                        <div class="users-list-table">
                            <div class="card border-radius-7">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s12">
                                            <h4 class="mt-0">{{ $edit?'Edit':'Add' }} Permission</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <form action="{{ $edit==true ? '/admin/permission/'.$perm_edit->id : route('admin.permission.store') }}" method="POST" class="col s12">
                                            @csrf
                                            @if ($edit)
                                                @method('PUT')
                                            @endif
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="name" type="text" value="{{ $perm_edit->name ?? old('name') }}" name="name">
                                                    <label for="name">Name</label>
                                                    @error('name')
                                                        <small class="errorName">
                                                            <div class="error">{{ $message }}</div>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <select name="table_name" id="table_name">
                                                        <option value="">Please select table</option>
                                                        @foreach ($tables as $table)
                                                            <option value="{{ $table }}" @if (old('table_name', $perm_edit->table_name??'') == $table) selected @endif>{{ $table }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('table_name')
                                                        <small class="errorName">
                                                            <div class="error">{{ $message }}</div>
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button class="btn waves-effect waves-light right gradient-45deg-blue-indigo" type="submit">Submit
                                                        <i class="material-icons right">send</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

        </div>
    </div>

@endsection
