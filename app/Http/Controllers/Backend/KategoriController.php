<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index(Category $kategori){
        if (request()->ajax()) {
            $kategori = Category::latest();

                return DataTables::of($kategori)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.Crypt::encryptString($data->id) .'"
                            class="editData btn btn-sm btn-info" title="Edit">Edit</a>
                        <a href="javascript:void(0)" data-toggle="tooltip" id="'.Crypt::encryptString($data->id).'"
                            class="btn btn-sm btn-danger deleteData" title="Delete">Delete</a>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admins.kategoris.index', compact('kategori'));
    }

    public function store(CategoryRequest $request){
        $category = Category::updateOrCreate(['id' => $request->id], [
            'name' => $request->name
          ]);

        return response()->json($category);
    }

    public function edit($id){
        $decrypt = Crypt::decryptString($id);
        $category = Category::find($decrypt);

        return response()->json($category);
    }

    public function destroy($id){

        $decrypt = Crypt::decryptString($id);
        $data = Category::findOrFail($decrypt)->delete();

        return response()->json($data);
    }
}
