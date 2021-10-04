<?php

namespace App\Http\Controllers\Backend\Config;

use App\Models\Jabatan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(Jabatan $jabat){
        if (request()->ajax()) {
            $jabat = Jabatan::latest();

                return DataTables::of($jabat)
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
        return view('admins.configs.jabatan', compact('jabat'));
    }

    public function store (Request $request){
        $request->validate([
            'name' => 'required|string',
        ]);

        $roles = Jabatan::updateOrCreate(['id' => $request->id], [
            'nama_jabatan' => $request->name,
          ]);

        return response()->json($roles);
    }

    public function edit($id){
        $decrypt = Crypt::decryptString($id);
        $roles = Jabatan::find($decrypt);

        return response()->json($roles);
    }

    public function destroy($id){
        $decrypt = Crypt::decryptString($id);
        $data = Jabatan::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
