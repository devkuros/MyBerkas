<?php

namespace App\Http\Controllers\Backend\Layanan;

use Illuminate\Support\Str;
use App\Models\TemplateSurat;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\TemplateSuratRequest;

class TemplateSuratController extends Controller
{
    public function index(){
        return view('admins.layanans.templates.index');
    }

    public function store(TemplateSuratRequest $request, TemplateSurat $ts){
        if ($request->file('file_template')) {
            $document = $request->file('file_template');
            $ts['file_template'] = time().'.'. $document->extension();

            $filePath = public_path('/storage/templatesurat');
            $document->move($filePath, $ts['file_template']);
        } else {
            $document = $ts->file_template;
        }

        $ts->kode_template = $request->kode_template;
        $ts->nama_surat = $request->nama_surat;
        $ts->slug_template = Str::slug($ts->nama_surat, '_');
        $ts->ket_template = $request->ket_template;
        if (TemplateSurat::where('slug_template', $ts->slug_template)->exists()) {
            // post with the same slug already exists
            Alert::toast('Data Exist', 'error')->position('top');
            return back();
        }
        $ts->save();

        Alert::toast('Input Template Surat Success', 'success')->position('top');
        return back();
    }
}
