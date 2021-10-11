<?php

namespace App\Http\Controllers\Backend;

use App\Models\Devisi;
use App\Http\Controllers\Controller;
use App\Http\Requests\DevisiRequest;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class DevisiController extends Controller
{
    public function index(Devisi $devisis){
        if (request()->ajax()) {
            $devisis = Devisi::latest();

                return DataTables::of($devisis)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.Crypt::encryptString($data->id) .'"
                            class="editData btn btn-sm btn-info" title="Edit">Edit</a>
                        <a href="javascript:void(0)" data-toggle="tooltip" id="'.Crypt::encryptString($data->id).'"
                            class="btn btn-sm btn-danger deleteData" title="Delete">Delete</a>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admins.kategoris.devisi', compact('devisis'));
    }

    public function store(DevisiRequest $request){
        $devisy = Devisi::updateOrCreate(['id' => $request->id], [
            'nama_devisi' => $request->nama_devisi
          ]);

        return response()->json($devisy);
    }

    public function edit($id){
        $decrypt = Crypt::decryptString($id);
        $devisie = Devisi::find($decrypt);

        return response()->json($devisie);
    }

    public function destroy($id){

        $decrypt = Crypt::decryptString($id);
        $data = Devisi::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
