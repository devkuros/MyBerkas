<?php

namespace App\Http\Controllers\Backend\Fakultas;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class FakultasController extends Controller
{
    public function index(SuratMasuk $surat){
        if (request()->ajax()) {
            $surat = SuratMasuk::latest();

                return DataTables::of($surat)
                ->addIndexColumn()
                ->editColumn('files', function($data) {
                    return
                    '<a href="'.asset('storage/suratmasuk').'/'.$data->files.'">Pdf</a>';
                })
                ->addColumn('action', function ($data) {
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.Crypt::encryptString($data->id) .'"
                            class="editData btn btn-sm btn-info" title="Edit"><i class="far fa-edit"></i></a>
                        <a href="javascript:void(0)" data-toggle="tooltip" id="'.Crypt::encryptString($data->id).'"
                            class="btn btn-sm btn-danger deleteData" title="Delete"><i class="far fa-trash-alt"></i></a>
                    ';
                })
                ->rawColumns(['action','files'])
                ->make();
        }

        return view('admins.fakultas.index', compact('surat'));
    }
}
