@extends('admin.base_layout')
@section('content')

    <div id="main">
        <div class="row">
            @include('admin.partials.breadcrumbs')
            <div class="col s12">
                <div class="container">
                    <!-- users list start -->
                    <section class="users-list-wrapper section">
                        <div class="users-list-table">
                            <div class="card border-radius-7">
                                <div class="card-content">
                                    <div class="row mb-3">
                                        <div class="col s10 m6 l6">
                                            <h4 class="mt-0">User Profile</h4>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col s12">

                                            <div class="row">
                                                <form class="col s12" method="POST" action="{{ route('admin.users.profile.update') }}" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
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
                                                            <input type="file" name="photo" class="dropify" data-default-file="{{ $user->photo ? asset($user->photo) : asset('admin/default.png') }}" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <input id="first_name" type="text" value="{{ old('name', $user->name) }}" name="name">
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
                                                            <input id="email" type="email" readonly disabled value="{{ $user->email }}">
                                                            <label for="email">Email</label>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col s12">
                                                            <ul class="collapsible collapsible-accordion">
                                                                <li>
                                                                   <div class="collapsible-header"><i class="material-icons">remove_red_eye</i> Change Password</div>
                                                                   <div class="collapsible-body">
                                                                        <small><b>Please leave it empty if you don't want to change your password.</b></small>
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
                                                                   </div>
                                                                </li>
                                                             </ul>
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
