<?php

namespace App\Http\Controllers\Backend\Layanan;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TemplateSurat;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class CetakSuratController extends Controller
{
    public function index(TemplateSurat $tsurat){
        if (request()->ajax()) {
            $tsurat = TemplateSurat::all();

                return DataTables::of($tsurat)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                        <a href="'. URL::to('admin/layanan-surat/form').'/'.$data->slug_template .'" data-toggle="tooltip"
                            class="btn btn-sm btn-info" title="Buat Surat"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                            Buat Surat</a>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admins.layanans.cetaks.index', compact('tsurat'));
    }

    public function form($id){

        $forms = TemplateSurat::where('slug_template', $id)
                                ->where('deleted_at', null)->first();

        if(View::exists('admins.layanans.cetaks.'.$forms->url_format.'')){
            return view('admins.layanans.cetaks.'.$forms->url_format.'', compact('forms'));
        } else {
            return abort('404');
        }

    }
}
