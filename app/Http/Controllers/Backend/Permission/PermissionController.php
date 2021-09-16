<?php

namespace App\Http\Controllers\Backend\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index(Permission $permissions){
        if (request()->ajax()) {
            $permissions = Permission::latest();

                return DataTables::of($permissions)
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
        return view('admins.permissions.permission', compact('permissions'));
    }

    public function store (Request $request){
        $request->validate([
            'name' => 'required|string',
        ]);

        $permissions = Permission::updateOrCreate(['id' => $request->id], [
            'name' => $request->name,
          ]);

        return response()->json($permissions);
    }

    public function edit($id){
        $decrypt = Crypt::decryptString($id);
        $permissions = Permission::find($decrypt);

        return response()->json($permissions);
    }

    public function destroy($id){
        $decrypt = Crypt::decryptString($id);
        $data = Permission::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
