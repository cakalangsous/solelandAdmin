@extends('admin.base_layout')
@section('content')

    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-blue"></div>
            <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">

                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ $title ?? 'Table Add' }}</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Table Builder</a>
                                </li>
                                <li class="breadcrumb-item active">{{ $title ?? 'Table Add' }}
                                </li>
                            </ol>
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
                                            <h4 class="mt-0">{{ $title ?? 'Table Add' }}</h4>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col s12">

                                            <div class="row">
                                                <form class="col s12" method="POST" action="{{ route('admin.tables.store') }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="input-field col s12 m6 l5">
                                                            <input id="table_name" type="text" value="{{ old('name') }}" name="table_name">
                                                            <label for="table_name">Table Name</label>
                                                            @error('table_name')
                                                                <small class="errorName">
                                                                    <div class="error">{{ $message }}</div>
                                                                </small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="input-field col s12 m6 l2">
                                                            <div class="row mb-2">
                                                                <div class="col s12">
                                                                    <label for="field_name">Timestamps</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col s12">
                                                                    <div class="switch">
                                                                        <label>
                                                                          No
                                                                          <input type="checkbox" name="timestamps" checked>
                                                                          <span class="lever"></span>
                                                                          Yes
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-field col s12 m6 l2">
                                                            <div class="row mb-2">
                                                                <div class="col s12">
                                                                    <label for="field_name">Soft Delete</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col s12">
                                                                    <div class="switch">
                                                                        <label>
                                                                          No
                                                                          <input type="checkbox" name="soft_deletes">
                                                                          <span class="lever"></span>
                                                                          Yes
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="input-field col s12 m4 l3">
                                                            <input type="text" value="id" name="field_name[]">
                                                            <label>Field Name</label>
                                                        </div>

                                                        <div class="input-field col s12 m4 l2">
                                                            <select class="select2" name="data_type[]">
                                                                <option value="">Data Type</option>
                                                                <option value="rectangle">Rectangle</option>
                                                                <option value="rombo">Rombo</option>
                                                                <option value="romboid">Romboid</option>
                                                                <option value="trapeze">Trapeze</option>
                                                                <option value="traible">Triangle</option>
                                                                <option value="polygon">Polygon</option>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col s12 m2 l2">
                                                            <input type="number" name="length[]">
                                                            <label class="right">Length</label>
                                                        </div>

                                                        <div class="input-field col s12 m2 l2">
                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" name="primary_key" checked="checked" />
                                                                    <span>Primary Key</span>
                                                                </label>
                                                            </p>
                                                        </div>

                                                    </div>

                                                    <div id="new_field_wrapper"></div>

                                                    <div class="row mt-3">
                                                        <div class="input-field col s12">
                                                            <a href="javascript:void(0)" class="btn w-100 flex-center waves-effect waves-light center green darken-2 add_btn">
                                                                <i class="material-icons mr-1">add</i> <span> Add Field</span>
                                                            </a>
                                                        </div>
                                                        <div class="col s12">
                                                            <hr />
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <button class="btn waves-effect waves-light left gradient-45deg-blue-indigo" type="submit">Submit
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
