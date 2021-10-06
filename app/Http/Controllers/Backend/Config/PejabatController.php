<?php

namespace App\Http\Controllers\Backend\Config;

use App\Models\{Jabatan, Pejabat};
use App\Http\Controllers\Controller;
use App\Http\Requests\PejabatRequest;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PejabatController extends Controller
{
    public function index(Pejabat $pejabats){
        if (request()->ajax()) {
            $pejabats = Pejabat::join('jabatans', 'pejabats.jabatan_id', '=', 'jabatans.id')
                            ->select(['pejabats.id', 'pejabats.nama_pejabat', 'pejabats.foto_pejabat', 'jabatans.nama_jabatan']);

                return DataTables::of($pejabats)
                ->addIndexColumn()
                ->editColumn('foto', function($data) {
                    return
                    '<img alt="logo" src="'. asset('storage/foto/pejabat').'/'.$data->foto_pejabat .'">';
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

        return view('admins.configs.pejabat', compact('pejabats'));
    }

    public function tambahPejabat(){
        $jabatans = Jabatan::all();
        return view('admins.configs.tambahpejabat', compact('jabatans'));
    }

    public function store(PejabatRequest $request){
        Pejabat::updateOrCreate(
            ['jabatan_id' => $request->jabatan],
            [
                'nama_pejabat' => $request->pejabat
            ]);

        Alert::toast('Input Pejabat Success', 'success')->position('top');
        return back();
    }

    public function destroy($id){
        $decrypt = Crypt::decryptString($id);
        $data = Pejabat::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
