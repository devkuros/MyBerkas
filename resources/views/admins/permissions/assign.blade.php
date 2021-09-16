@extends('layouts.admins.base')

@section('admin-tittle')Assignment @endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('base/assets/css/elements/alert.css') }}">
<link href="{{ asset('base/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('base/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('base/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('base/plugins/sweetalerts/sweetalert2.min.css') }}">
@endpush

@section('content')

<div class="page-header">
    <div class="page-title">
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-12  layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Add Assignments</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form method="POST" action="{{ route('assignments.create') }}">
                        @csrf
                        @method('POST')

                        <div class="form-group mb-4">
                            <label for="role">Role</label>
                            <select class="form-control cate @error('role') is-invalid @enderror" name="role">
                                <option selected disabled>Choose Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="permission">Permission</label>
                            <select class="form-control tagging cate @error('permission') is-invalid @enderror" name="permission[]" multiple="multiple">
                                <option selected disabled>Choose Permission</option>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                            @error('permission')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget widget-content-area br-4">
            <div class="widget-one">

                <table id="dtable" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Roles</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $index => $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ implode(', ', $role->getPermissionNames()->toArray()) }}</td>
                                <td><a href="{{ route('assignments.sync', $role)}}"  class="btn btn-warning mb-2 mr-2 rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js-ex')
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="{{asset('base/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('base/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('base/plugins/select2/custom-select2.js')}}"></script>
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
@endpush

@push('js-in')

    <script>
        var ss = $(".cate").select2({
        tags: true,
        });
    </script>

@endpush
