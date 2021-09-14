<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Session, Auth};
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            Alert::toast('Login Success', 'success')->position('top');
            return redirect()->intended('admin');
        }

        Alert::toast('Please try again', 'error')->position('top');
        return back()->withErrors([
            'username' => 'Username did not exist'
        ]);
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('sys-admin/login');
    }
}
