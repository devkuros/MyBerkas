<?php

namespace App\Http\Controllers\Backend\Permission;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Role $roles){
        if (request()->ajax()) {
            $roles = Role::latest();

                return DataTables::of($roles)
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
        return view('admins.permissions.role', compact('roles'));
    }

    public function store (Request $request){
        $request->validate([
            'name' => 'required|string',
        ]);

        $roles = Role::updateOrCreate(['id' => $request->id], [
            'name' => $request->name,
          ]);

        return response()->json($roles);
    }

    public function edit($id){
        $decrypt = Crypt::decryptString($id);
        $roles = Role::find($decrypt);

        return response()->json($roles);
    }

    public function destroy($id){
        $decrypt = Crypt::decryptString($id);
        $data = Role::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
