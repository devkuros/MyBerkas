<?php

namespace App\Http\Controllers\Backend;

use App\Models\{Category,
    Devisi,
    SuratMasuk
};
use App\Http\Controllers\Controller;
use App\Http\Requests\SuratMasukRequest;
use RealRashid\SweetAlert\Facades\Alert;

class SuratMasukController extends Controller
{
    public function index(){
        $categoris = Category::all();
        $devisis = Devisi::all();
        return view('admins.surats.masuks.index', compact('categoris', 'devisis'));
    }

    public function store(SuratMasukRequest $request, SuratMasuk $surat){

        if ($request->file('files')) {
            $img = $request->file('files');
            $surat['files'] = time().'-'. $img->getClientOriginalName();

            $filePath = public_path('/storage/suratmasuk');
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
        $surat->tgl_surat = $request->tgl_surat;
        $surat->save();

        // $surat->save([
        //     'nosurat' => $request->nosurat,
        //     'perihal' => $request->perihal,
        //     'kategori_surat' => $request->kategori_surat,
        //     'keterangan' => $request->keterangan,
        //     'files' => $surat['files'],
        //     'tgl_surat' => $request->tgl_surat
        // ]);

        Alert::toast('Input Surat Success', 'success')->position('top');
        return back();

    }
}
