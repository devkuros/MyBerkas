@extends('layouts.admins.base')

@section('admin-tittle')Template Surat @endsection

@push('css')
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{asset('base/assets/css/elements/miscellaneous.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('base/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
@endpush
@section('content')
        <div class="page-header">
            <div class="page-title">
                <h3>Template Surat</h3>
            </div>

            <div class="breadcrumb-four">
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                            Layanan Surat
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                            Template Surat
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="row">

            <div id="flHorizontalForm" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form method="POST" enctype="multipart/form-data" action="{{route('template.store')}}">
                            @csrf
                            @method('POST')
                            <div class="form-group row mb-4">
                                <label for="kode_template" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kode Surat</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="text" class="form-control @error('kode_template') is-invalid @enderror" name="kode_template" id="kode_template" placeholder="Input Kode Surat">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="nama_surat" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Nama Surat</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Surat</div>
                                        </div>
                                        <input type="text" name="nama_surat" id="nama_surat" class="form-control @error('nama_surat') is-invalid @enderror">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label" for="file_template">Upload Template Surat</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <input type="file" class="form-control @error('file_template') is-invalid @enderror" name="file_template" id="file_template" accept=".docx">
                                </div>
                                    @error('file_template')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label" for="ket_template">Keterangan</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <textarea class="form-control @error('ket_template') is-invalid @enderror" id="ket_template" name="ket_template" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

@endsection
