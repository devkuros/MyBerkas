<?php

namespace App\Http\Controllers\Backend\Fakultas;

use App\Models\{SuratMasuk, SuratKeluar};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class FakultasController extends Controller
{
    public function index(SuratMasuk $surat){
        if (request()->ajax()) {
            $surat = SuratMasuk::latest()->where('devisi', 'Fakultas Teknologi Industri');

                return DataTables::of($surat)
                ->addIndexColumn()
                ->editColumn('files', function($data) {
                    return
                    '<a href="'. asset('storage/suratmasuk').'/'.$data->files .'" class="badge badge-info">Pdf</a>';
                })
                ->addColumn('action', function ($data) {
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" id="'.Crypt::encryptString($data->id).'"
                            class="btn btn-sm btn-danger deleteData" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </a>
                    ';
                })
                ->rawColumns(['action','files'])
                ->make();
        }

        return view('admins.fakultas.masuks.index', compact('surat'));
    }

    public function keluar(SuratKeluar $getsuratkeluar){
        if (request()->ajax()) {
            $getsuratkeluar = SuratKeluar::latest()->where('devisi', 'Fakultas Teknologi Industri');

                return DataTables::of($getsuratkeluar)
                ->addIndexColumn()
                ->editColumn('files', function($data) {
                    return
                    '<a href="'. asset('storage/suratkeluar').'/'.$data->files .'" class="badge badge-info">Pdf</a>';
                })
                ->addColumn('action', function ($data) {
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" id="'.Crypt::encryptString($data->id).'"
                            class="btn btn-sm btn-danger deleteData" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </a>
                    ';
                })
                ->rawColumns(['action','files'])
                ->make();
        }

        return view('admins.fakultas.keluars.index', compact('getsuratkeluar'));
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
