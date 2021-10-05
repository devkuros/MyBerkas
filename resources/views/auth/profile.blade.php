@extends('layouts.admins.base')
@section('admin-tittle')Profile User @endsection

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">

        {{-- UPDATE PROFILE --}}
        <div class="widget widget-content-area br-4">
            <div class="widget-one">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h3><strong>Update Profile</strong></h3>
                    </div>
                </div>

                <hr>

                <form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <h5>Change Avatar</h5>
                                <div style="background-color: #1b2e4b;" class="card col-lg-6 col-md-6 text-center">
                                    <div class="card-body">
                                        <img id="avatarView" src="{{ asset('storage/avatar/'.$users->avatar) }}" alt="your avatar"
                                            width="150px" class="rounded">
                                    </div>
                                </div>
                                <input type="file" id="avatarInput" name="avatar"
                                    class="form-control-file mt-4 @error('avatar') is-invalid @enderror" accept="image/*">
                                @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="username">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value="{{ old('username', $users->username) }}" placeholder="Entry new username">
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="name">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input id="name" type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $users->name) }}" placeholder="Entry new name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="email">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $users->email) }}" placeholder="Entry new email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">UPDATE</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">

        {{-- CHANGE PASSWORD --}}
        <div class="widget widget-content-area br-4">
            <div class="widget-one">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h3><strong>Change Password</strong></h3>
                    </div>
                </div>

                <hr>
                <form action="{{ route('users.updatepassword') }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="password">
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input id="current_password" type="password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror" placeholder="Entry current password" autocomplete="current_password">
                            @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input id="password" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" placeholder="Entry new password" autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm New Password</label>
                            <input id="password-confirm" type="password" name="password_confirmation"
                                class="form-control @error('password-confirm') is-invalid @enderror"
                                value="{{ old('password-confirm') }}" placeholder="Entry new password confirm"
                                autocomplete="new-password">
                            @error('password-confirm')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js-in')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#avatarView').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#avatarInput").change(function () {
        readURL(this);
    });

    $(".placeholder").select2({
        placeholder: "Make a Selection",
        allowClear: true
    });

</script>
@endpush

