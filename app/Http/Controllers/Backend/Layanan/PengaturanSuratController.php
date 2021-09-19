<?php

namespace App\Http\Controllers\Backend\Layanan;

use Illuminate\Http\Request;
use App\Models\TemplateSurat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class PengaturanSuratController extends Controller
{
    public function index(TemplateSurat $ts){
        if (request()->ajax()) {
            $ts = TemplateSurat::all();

                return DataTables::of($ts)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" id="'.Crypt::encryptString($data->id).'"
                            class="btn btn-sm btn-danger deleteData" title="Delete">Delete</a>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admins.layanans.pengaturans.index', compact('ts'));
    }

    public function store(){

    }

    public function destroy($id){
        $decrypt = Crypt::decryptString($id);
        $data = TemplateSurat::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
