<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\SuratKeluarRequest;
use App\Models\{Category, Devisi, SuratKeluar};

class SuratKeluarController extends Controller
{
    public function index(){
        $categoris = Category::all();
        $devisis = Devisi::all();
        return view('admins.surats.keluars.index', compact('categoris', 'devisis'));
    }

    public function store(SuratKeluarRequest $request, SuratKeluar $surat){

        if ($request->file('files')) {
            $img = $request->file('files');
            $surat['files'] = time().'.'. $img->extension();

            $filePath = public_path('/storage/suratkeluar');
            $img->move($filePath, $surat['files']);
        } else {
            $img = $surat->files;
        }

        $surat->nosurat = $request->nosurat;
        $surat->perihal = $request->perihal;
        $surat->kategori_surat = $request->kategori_surat;
        $surat->keterangan = $request->keterangan;
        $surat->files = $surat['files'];
        $surat->devisi = $request->devisi;
        $surat->tgl_surat_keluar = $request->tgl_surat_keluar;
        $surat->save();

        // $surat->save([
        //     'nosurat' => $request->nosurat,
        //     'perihal' => $request->perihal,
        //     'kategori_surat' => $request->kategori_surat,
        //     'keterangan' => $request->keterangan,
        //     'files' => $surat['files'],
        //     'tgl_surat' => $request->tgl_surat
        // ]);

        Alert::toast('Input Surat Keluar Success', 'success')->position('top');
        return back();

    }
}
