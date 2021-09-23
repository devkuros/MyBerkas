<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\{Auth, Crypt};

class UserController extends Controller
{
    public function index(){
        $users = Auth::user();
        if (request()->ajax()) {
            $users = User::all();

                return DataTables::of($users)
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
        return view('admins.users.index', compact('users'));
    }

    public function store(UserRequest $request){
        $users = User::updateOrCreate(['id' => $request->id], [
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
          ]);

        return response()->json($users);
    }

    public function edit($id){
        $decrypt = Crypt::decryptString($id);
        $getuser = User::find($decrypt);

        return response()->json($getuser);
    }

    public function destroy($id){

        $decrypt = Crypt::decryptString($id);
        $data = User::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
