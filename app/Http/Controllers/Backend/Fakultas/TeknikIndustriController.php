<?php

namespace App\Http\Controllers\Backend\Fakultas;

use App\Models\{SuratMasuk, SuratKeluar};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class TeknikIndustriController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $surat = SuratMasuk::latest()->where('devisi', 'Teknik Industri');

                return DataTables::of($surat)
                ->addIndexColumn()
                ->editColumn('files', function($data) {
                    return
                    '<a href="'.asset('storage/suratmasuk').'/'.$data->files.'" class="badge badge-info">Pdf</a>';
                })
                ->addColumn('action', function ($data) {
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" id="'.Crypt::encryptString($data->id).'"
                            class="btn btn-sm btn-danger deleteData" title="Delete">Delete</a>
                    ';
                })
                ->rawColumns(['action','files'])
                ->make();
        }

        return view('admins.industris.masuks.index');
    }

    public function keluar(SuratKeluar $getsuratkeluar){
        if (request()->ajax()) {
            $getsuratkeluar = SuratKeluar::latest()->where('devisi', 'Teknik Industri');

                return DataTables::of($getsuratkeluar)
                ->addIndexColumn()
                ->editColumn('files', function($data) {
                    return
                    '<a href="'. asset('storage/suratkeluar').'/'.$data->files .'" class="badge badge-info">Pdf</a>';
                })
                ->addColumn('action', function ($data) {
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" id="'.Crypt::encryptString($data->id).'"
                            class="btn btn-sm btn-danger deleteData" title="Delete">Delete</a>
                    ';
                })
                ->rawColumns(['action','files'])
                ->make();
        }

        return view('admins.industris.keluars.index', compact('getsuratkeluar'));
    }

    public function destroy($id){
        $decrypt = Crypt::decryptString($id);
        $data = SuratMasuk::findOrFail($decrypt)->delete();

        return response()->json($data);
    }

    public function hapusKeluar($id){
        $decrypt = Crypt::decryptString($id);
        $data = SuratKeluar::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
