<?php

namespace App\Http\Controllers\Backend\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index(){
        return view('admins.fakultas.index');
    }
}
