@extends('layouts.admins.base')

@section('admin-tittle')Cetak Surat @endsection

@push('css')
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{asset('base/assets/css/elements/miscellaneous.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('base/assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('base/plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
    <!--  END CUSTOM STYLE FILE  -->
@endpush
@section('content')
        <div class="page-header">
            <div class="page-title">
                <h3>Cetak Surat {{ $forms->nama_surat }}</h3>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>                            Cetak Surat
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                <div class="widget-content-area br-4">
                    <div class="widget-one">
                        <form class="form-vertical" action="#">

                            {{-- <div class="form-group mb-4">
                                <label class="control-label">Nama Surat</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Surat</div>
                                    </div>
                                    <input type="text" name="email" class="form-control">
                                </div>
                            </div>

                            <div class="alert alert-primary mb-4" role="alert">
                                <strong>Header!</strong></button>
                            </div>
 --}}
                            <div class="form-group mb-4">
                                <p><em>Format Nomor Surat : </em><span class="badge badge-info">FTI/Unsurya/<span id="result"></span>/{{getRomawi(now()->month)}}/{{ now()->year }}</span></p>

                                <label class="control-label">Nomor Surat</label>
                                <input type="number" name="nomor_surat" id="input" class="form-control" autofocus placeholder="01">
                            </div>

                            <div class="form-group mb-4">
                                <label for="tgl_surat">Tanggal Surat</label>
                                <input id="when" class="form-control flatpickr flatpickr-input active @error('tgl_surat') is-invalid @enderror" type="text" name="tgl_surat" placeholder="Select Date..">
                                @error('tgl_surat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="alert alert-primary mb-4" role="alert">
                                <strong>Ditujukan Kepada!</strong></button>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Yth :</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Perusahaan</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="control-label">Tempat</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="alert alert-primary mb-4" role="alert">
                                <strong>Isi Surat!</strong></button>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Nama</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Nim</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="control-label">Fakultas</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group mb-4">
                                <label class="control-label">Program Studi</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="alert alert-primary mb-4" role="alert">
                                <strong>Penanda Tangan!</strong></button>
                            </div>

                            <div class="form-group mb-4">
                                <label class="control-label">Tertanda Atas Nama</label>
                                <select name="" id="" class="form-control">
                                    <option selected>Choose me...</option>
                                    <option>. . .</option>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label class="control-label">Menjabat sebagai</label>
                                <select name="" id="" class="form-control">
                                    <option selected>Choose me...</option>
                                    <option>. . .</option>
                                </select>
                            </div>

                            <button class="btn btn-primary mb-2 mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                 Export Word
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('js-ex')
    <script src="{{asset('base/plugins/flatpickr/flatpickr.js')}}"></script>
@endpush

@push('js-in')

<script>
    var f1 = flatpickr(document.getElementById('when'));
</script>

<script>
    input.oninput = function() {
        result.innerHTML = input.value;
    };
  </script>
@endpush
