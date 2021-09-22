<?php

namespace App\Http\Controllers\Backend\Layanan;

use App\Models\DetailSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{URL, Crypt};
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ArsipController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $details = DetailSurat::all();

                return DataTables::of($details)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                        <a href="'. URL::to('storage/suratjadi').'/'.$data->file_detail .'" data-toggle="tooltip"
                            class="btn btn-sm btn-info" title="Export Word">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                            </a>

                        <a href="javascript:void(0)" data-toggle="tooltip" id="'.Crypt::encryptString($data->id).'"
                            class="btn btn-sm btn-danger deleteData" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </a>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admins.layanans.arsips.index');
    }

    public function destroy($id){
        $decrypt = Crypt::decryptString($id);
        $data = DetailSurat::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
