<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\{ChangePasswordRequest, ProfileRequest};
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\{Auth, Hash};

class ProfileController extends Controller
{
    public function index(){
        $users = Auth::user();
        return view('auth.profile', compact('users'));
    }

    public function update(ProfileRequest $request, $id){

        $user = Auth::user($id);

        if($request->hasFile('avatar')){

            $image = $request->file('avatar');
            $user['avatar'] = time().'-'. $image->getClientOriginalName();

            $filepath = public_path('/storage/avatar');
            $image->move($filepath, $user['avatar']);
        } else {
            $image = $user->avatar;
        }

        $user = User::find(Auth::user()->id)->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $user['avatar']
        ]);

        Alert::toast('Update Profile Success', 'success')->position('top');
        return back();
    }

    public function updatepassword(ChangePasswordRequest $request){
        $request->user()->update([
            'password' => Hash::make($request->get('password'))
        ]);

        Alert::toast('Update Password Success', 'success')->position('top');
        return back();
    }
}
