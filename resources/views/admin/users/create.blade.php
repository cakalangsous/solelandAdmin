@extends('admin.base_layout')
@section('content')

    <div id="main">
        <div class="row">
            @include('admin.partials.breadcrumbs')
            <div class="col s12 m8 l7">
                <div class="container">

                    <section class="users-list-wrapper section">
                        <div class="users-list-table">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row mb-3">
                                        <div class="col s10 m6 l6">
                                            <h4 class="mt-0">{{ $title ?? 'Users Add' }}</h4>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col s12">

                                            <div class="row">
                                                <form class="col s12" method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <input id="first_name" type="text" value="{{ old('name') }}" name="name">
                                                            <label for="first_name">Name</label>
                                                            @error('name')
                                                                <small class="errorName">
                                                                    <div class="error">{{ $message }}</div>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <input id="email" type="email" value="{{ old('email') }}" name="email">
                                                            <label for="email">Email</label>
                                                            @error('email')
                                                                <small class="errorName">
                                                                    <div class="error">{{ $message }}</div>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <input id="password" type="password" name="password">
                                                            <label for="password">Password</label>
                                                            @error('password')
                                                                <small class="errorName">
                                                                    <div class="error">{{ $message }}</div>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <input id="c_password" type="password" name="password_confirmation">
                                                            <label for="c_password">Confirm Password</label>
                                                            @error('password_confirmation')
                                                                <small class="errorName">
                                                                    <div class="error">{{ $message }}</div>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <select name="role" id="role">
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role->id }}" @if (old('role') == $role->id) selected @endif>{{ $role->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('role')
                                                                <small class="errorName">
                                                                    <div class="error">{{ $message }}</div>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row section">
                                                        <div class="input-field col s12">
                                                            <p>Photo</p>
                                                            <span class="helper-text" data-error="wrong" data-success="right">Max Size : 2MB</span>
                                                            @error('photo')
                                                                <small class="errorName">
                                                                    <div class="error">{{ $message }}</div>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                        <div class="col s12">
                                                            <input type="file" name="photo" class="dropify" data-default-file="{{ asset('admin/default.png') }}" />
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
                            </div>
                        </div>
                    </section>
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>

@endsection
