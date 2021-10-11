<?php

namespace App\Http\Controllers\Backend\Config;

use App\Models\FormatSurat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class AdminConfigController extends Controller
{
    public function index(FormatSurat $formsurats){
        if (request()->ajax()) {
            $formsurats = FormatSurat::latest();

                return DataTables::of($formsurats)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                    <a href="javascript:void(0)" data-toggle="tooltip" id="'.Crypt::encryptString($data->id).'"
                    class="btn btn-sm btn-danger deleteData" title="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </a>                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admins.configs.formatsurat', compact('formsurats'));
    }

    public function store (Request $request){
        $request->validate([
            'kode_format' => 'required|string',
            'nama_format' => 'required|string',
            'file_format' => 'required|max:2048|mimes:docx,doc',
        ]);

        if($request->hasFile('file_format')){
            $document = $request->file('file_format');
            $docname = time().'-'. $document->getClientOriginalName();

            $filepath = public_path('/storage/templatesurat/');
            $document->move($filepath, $docname);
        } else {
            $document = $request->file_format;
        }

        $fsurats = FormatSurat::updateOrCreate(['id' => $request->id], [
            'kode_format' => $request->kode_format,
            'nama_format' => $request->nama_format,
            'file_format' => $docname,
            'url_format' => Str::slug($request->nama_format, '_')
          ]);

        return response()->json($fsurats);
    }

    public function edit($id){
        $decrypt = Crypt::decryptString($id);
        $roles = FormatSurat::find($decrypt);

        return response()->json($roles);
    }

    public function destroy($id){
        $decrypt = Crypt::decryptString($id);
        $data = FormatSurat::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
