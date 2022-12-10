@extends('admin.base_layout')
@section('content')

    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-blue"></div>
            @include('admin.partials.breadcrumbs')
            
            
            <div class="col s12">
                <div class="container">
                    
                    <section class="users-list-wrapper section">
                        <div class="users-list-table">
                            <div class="card border-radius-7">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s12">
                                            <h4 class="mt-0">{{ $title ?? 'Access' }}</h4>
                                        </div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col s12 mb-3">
                                            <ul class="tabs">
                                                @foreach ($roles as $role)
                                                    <li class="tab col m3"><a class="active"
                                                            data-role="{{ $role->id }}"
                                                            href="#tab{{ $role->id }}">{{ $role->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @foreach ($roles as $role)
                                            <div id="tab{{ $role->id }}" class="col s12">
    
                                                <div class="flex-center access_loader">
                                                    <div class="preloader-wrapper small active">
                                                        <div class="spinner-layer spinner-blue">
                                                            <div class="circle-clipper left">
                                                              <div class="circle"></div>
                                                            </div><div class="gap-patch">
                                                              <div class="circle"></div>
                                                            </div><div class="circle-clipper right">
                                                              <div class="circle"></div>
                                                            </div>
                                                          </div>
                                                        <div class="spinner-layer spinner-red">
                                                            <div class="circle-clipper left">
                                                                <div class="circle"></div>
                                                            </div>
                                                            <div class="gap-patch">
                                                                <div class="circle"></div>
                                                            </div>
                                                            <div class="circle-clipper right">
                                                                <div class="circle"></div>
                                                            </div>
                                                        </div>
    
                                                        <div class="spinner-layer spinner-yellow">
                                                            <div class="circle-clipper left">
                                                                <div class="circle"></div>
                                                            </div>
                                                            <div class="gap-patch">
                                                                <div class="circle"></div>
                                                            </div>
                                                            <div class="circle-clipper right">
                                                                <div class="circle"></div>
                                                            </div>
                                                        </div>
    
                                                        <div class="spinner-layer spinner-green">
                                                            <div class="circle-clipper left">
                                                                <div class="circle"></div>
                                                            </div>
                                                            <div class="gap-patch">
                                                                <div class="circle"></div>
                                                            </div>
                                                            <div class="circle-clipper right">
                                                                <div class="circle"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <form action="/admin/access/{{ $role->id }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <table class="stripped hide checkbox-table" id="role{{ $role->id }}_perms"></table>
                                                    <div class="row mt-5 form-control">
                                                        <div class="col">
                                                            <button class="btn btn-small waves-effect waves-light"><i class="material-icons left">save</i> Save</button>
                                                        </div>
                                                    </div>
                                                </form>
    
                                            </div>
                                        @endforeach
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
