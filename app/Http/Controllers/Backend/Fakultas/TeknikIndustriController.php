<?php

namespace App\Http\Controllers\Backend\Fakultas;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
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
                    '<a href="'.asset('storage/suratmasuk').'/'.$data->files.'">Pdf</a>';
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

        return view('admins.industris.index');
    }

    public function destroy($id){
        $decrypt = Crypt::decryptString($id);
        $data = SuratMasuk::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
