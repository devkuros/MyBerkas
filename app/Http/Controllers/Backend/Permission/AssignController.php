<?php

namespace App\Http\Controllers\Backend\Permission;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class AssignController extends Controller
{
    public function create(){

        return view('admins.permissions.assign', [
            'roles' => Role::get(),
            'permissions' => Permission::get()
        ]);
    }

    public function store(){

        request()->validate([
            'role' => 'required',
            'permission' => 'array|required'
        ]);
        $role = Role::find(request('role'));
        $role->givePermissionTo(request('permission'));

        Alert::toast('Assignment Success', 'success')->position('top');
        return back();
    }

    public function edit(Role $role){
        return view('admins.permissions.assignedit', [
            'role' => $role,
            'roles' => Role::get(),
            'permissions' => Permission::get(),
        ]);
    }

    public function update(Role $role){
        request()->validate([
            'role' => 'required',
            'permission' => 'array|required',
        ]);

        $role->syncPermissions(request('permission'));

        Alert::toast('Assignment Sync Success', 'success')->position('top');
        return redirect()->route('assignments.create');
    }
}
