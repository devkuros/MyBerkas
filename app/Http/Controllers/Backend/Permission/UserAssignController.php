<?php

namespace App\Http\Controllers\Backend\Permission;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class UserAssignController extends Controller
{
    public function create(){
        $roles = Role::get();
        $users = User::has('roles')->paginate(5);
        $noroles = User::paginate(10);
        return view('admins.permissions.users.create', compact('roles', 'users', 'noroles'));
    }

    public function store(){
        $user = User::where('email', request('user_email'))->first();
        $user->assignRole(request('roles'));
        Alert::toast('Add user role Success', 'success')->position('top');
        return back();
    }

    public function edit(User $user){
        return view('admins.permissions.users.sync', [
            'user' => $user,
            'roles' => Role::get(),
            'users' => User::has('roles')->get()
        ]);
    }

    public function update(User $user){
        $user->syncRoles(request('roles'));
        Alert::toast('Sync user role Success', 'success')->position('top');
        return redirect()->route('assign.create');
    }
}
