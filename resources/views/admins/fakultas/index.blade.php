@extends('layouts.admins.base')

@section('admin-tittle')Fakultas Teknologi Industri @endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('base/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('base/plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('base/assets/css/elements/alert.css') }}">
    <link href="{{ asset('base/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('base/assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('base/plugins/sweetalerts/sweetalert2.min.css') }}">
@endpush

@section('content')

    <div class="page-header">
        <div class="page-title">
            <h3>Fakultas Teknologi Industri</h3>
        </div>
    </div>

    <div class="widget-content widget-content-area br-6">
        <table id="dtable" class="table dt-table-hover" style="width:100%">
            <thead>
                <tr>
                    <th class="no-content dt-no-sorting">No</th>
                    <th>Nomor Surat</th>
                    <th>Perihal</th>
                    <th>Kategori Surat</th>
                    <th>File</th>
                    <th>Keterangan</th>
                    <th>Tanggal Surat</th>
                    <th class="no-content dt-no-sorting text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

@endsection
@push('js-ex')
    <script src="{{ asset('base/plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('base/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
@endpush

@push('js-in')
<script>

    $(function () {


        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        var datatable = $('#dtable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                columns: [{
                        "data": 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: "10%",
                        className: 'text-center'
                    },
                    {
                        data: 'nosurat',
                        name: 'nosurat'
                    },
                    {
                        data: 'perihal',
                        name: 'perihal',
                        className: 'text-center'
                    },
                    {
                        data: 'kategori_surat',
                        name: 'kategori_surat',
                    },
                    {
                        data: 'files',
                        name: 'files',
                        url: '{{ url('storage/suratmasuk/') }}'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                    },
                    {
                        data: 'tgl_surat',
                        name: 'tgl_surat',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'

                    },
                ],
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 5,
        });

        $('#createNew').click(function () {
                $('#saveBtn').val("createData");
                $('#id').val('');
                $('#ajaxFrom').trigger("reset");
                $('#titleModal').html("Create Surat");
                $('#ajaxModal').modal('show');
        });

        $('body').on('click', '.editData', function () {
                var id = $(this).data('id');
                $.get(' fakultas/' + id + '/edit', function (data) {
                    $('#titleModal').html("Edit " + data.nosurat);
                    $('#saveBtn').val("editDataa");
                    $('#ajaxModal').modal('show');
                    $('#id').val(data.id);
                    $('#nosurat').val(data.nosurat);
                    $('#perihal').val(data.perihal);
                    $('#kategori_surat').val(data.kategori_surat);
                    $('#files').val(data.files);
                    $('#keterangan').val(data.keterangan);
                    $('#tgl_surat').val(data.tgl_surat);
                })
        });

        $('#ajaxForm').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('masuks.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#ajaxForm').trigger("reset");
                    $("#ajaxModal").modal('hide');
                    var oTable = $('#dtable').dataTable();
                    oTable.fnDraw(false);
                    $("#saveBtn").html('Submit');
                    $("#saveBtn").attr("disabled", false);
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        padding: '2em'
                    });
                    toast({
                        type: 'success',
                        title: data.nosurat + ' data is successfully saved',
                        padding: '2em',
                    })
                },
                error: function (data) {
                    console.log('Error:', data);
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        padding: '6em'
                    });
                    toast({
                        type: 'error',
                        title: ' Surats must be filled',
                        padding: '2em',
                    })
                    $('#saveBtn').html('Save');
                }
            });
        });

        $(document).on('click', '.deleteData', function () {
            data = $(this).attr('id');
            $('#deleteModal').modal('show');
        });

        $('#btnDelete').click(function () {
                $.ajax({
                    url: "fakultas/" + data,
                    type: 'delete',
                    beforeSend: function () {
                        $('#btnDelete').text('Delete');
                    },
                    success: function (data) {
                        setTimeout(function () {
                            $('#deleteModal').modal('hide');
                            var oTable = $('#dtable').dataTable();
                            oTable.fnDraw(false);
                            const toast = swal.mixin({
                                toast: true,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 3000,
                                padding: '2em'
                            });
                            toast({
                                type: 'success',
                                title: ' Surat is successfully delete',
                                padding: '2em',
                            })
                        });

                    }
                })
        })
    });
</script>


@endpush

