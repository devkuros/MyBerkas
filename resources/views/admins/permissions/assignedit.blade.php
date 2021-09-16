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
                    <form method="POST" action="{{ route('assignments.sync', $role) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label for="role">Role</label>
                            <select class="form-control cate @error('role') is-invalid @enderror" name="role">
                                <option selected disabled>Choose Role</option>
                                @foreach ($roles as $item)
                                    <option {{ $role->id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
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
                                    <option {{ $role->permissions()->find($permission->id) ? "selected" : "" }} value="{{ $permission->id }}">{{ $permission->name }}</option>
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
