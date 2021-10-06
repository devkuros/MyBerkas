@extends('layouts.admins.base')

@section('admin-tittle')Tambah Pejabat @endsection

@section('content')

<div class="page-header">
    <div class="page-title">
        <h3>Tambah Pejabat</h3>
    </div>
</div>

<div class="row layout-top-spacing">
<div class="col-lg-12 col-12  layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <a href="{{route('admin.pejabat')}}"><h4><< Back</h4></a>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <form method="POST" action="{{route('store.pejabat')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group mb-4">
                    <label for="pejabat">Nama Pejabat</label>
                    <input type="text" value="{{ old('pejabat') }}" class="form-control @error('pejabat') is-invalid @enderror" name="pejabat" id="pejabat" autofocus placeholder="John Doe">
                    @error('pejabat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="jabatan">Jabatan</label>
                    <select class="custom-select mb-4 @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan">
                        <option selected disabled>Open this select menu</option>

                        @foreach ($jabatans as $jabatan)
                            <option value="{{$jabatan->id}}">{{$jabatan->nama_jabatan}}</option>
                        @endforeach

                    </select>
                    @error('jabatan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <input type="submit" name="time" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
</div>
@endsection
