@extends('layouts.admins.base')

@section('admin-tittle')Input Surat Masuk @endsection

@push('css')
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{asset('base/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/select2/select2.min.css')}}">
    <link href="{{asset('base/plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
    <!--  END CUSTOM STYLE FILE  -->
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
                                <h4>Surat Masuk</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('masuks.store') }}">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-4">
                                <label for="nosurat">Nomor Surat</label>
                                <input type="text" value="{{ old('nosurat') }}" class="form-control @error('nosurat') is-invalid @enderror" id="nosurat" name="nosurat" placeholder="Nomor Surat" autofocus>
                                @error('nosurat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="perihal">Perihal Surat</label>
                                <input type="text" value="{{ old('perihal') }}" class="form-control @error('perihal') is-invalid @enderror" id="perihal" name="perihal" placeholder="Perihal Surat" autofocus>
                                @error('perihal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="kategori_surat">Category</label>
                                <select class="form-control cate @error('kategori_surat') is-invalid @enderror" name="kategori_surat">
                                    <option selected disabled>Choose Category</option>
                                    @foreach ($categoris as $c)
                                        <option value="{{ $c->name }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_surat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="devisi">Devisi</label>
                                <select class="form-control cate @error('devisi') is-invalid @enderror" name="devisi">
                                    <option selected disabled>Choose Devisi</option>
                                    @foreach ($devisis as $dev)
                                        <option value="{{ $dev->nama_devisi }}">{{ $dev->nama_devisi }}</option>
                                    @endforeach
                                </select>
                                @error('devisi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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

                            <div class="form-group mb-4">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                            </div>

                            <div class="form-group custom-file mb-4">
                                <label class="custom-file-label" for="files">Choose file</label>
                                <input type="file" class="form-group custom-file-input @error('files') is-invalid @enderror" name="files" id="files" accept=".pdf">
                                @error('files')
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

    </div>
@endsection

@push('js-ex')
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="{{asset('base/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('base/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('base/plugins/select2/custom-select2.js')}}"></script>
    <script src="{{asset('base/plugins/flatpickr/flatpickr.js')}}"></script>
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
@endpush

@push('js-in')

<script>
    var ss = $(".cate").select2({
    tags: true,
    });
</script>

<script>
    var f2 = flatpickr(document.getElementById('when'), {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    });
</script>

@endpush
