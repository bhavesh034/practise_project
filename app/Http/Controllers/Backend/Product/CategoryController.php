<?php

namespace App\Http\Controllers\Backend\Product;


use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use DataTables;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    //
    public function index()
    {
        return view('Backend.Product.Category.category');
    }

    public function save(Request $request)
    {
        $id = $request->id;
        $data['status'] = 0;
        $data['massage'] = "! Oops Something Wrong Record Not Insert";

        $datainsert['category_name'] = $request->category_name;
        $datainsert['status'] = $request->status;
        if ($id) {
            $save = DB::table('product_category')->where('id', $id)->update($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Update Record successfully";
        } else {
            $save = DB::table('product_category')->insert($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Record Insert successfully";
        }

        return json_encode($data);
    }
    public function list()
    {

        $data = category::select('*');
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<button id="category_edit" data-id="' . $data->id . '" class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>';
                $btn .= '<button id="category_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $data['status'] = 0;
        $data['massage'] = "record not delete";
        if ($id) {
            $news = category::findOrFail($id);
            $news->delete();
            $data['status'] = 1;
            $data['massage'] = "record delete successfully";
        }
        return json_encode($data);
    }
    public function get_detail(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $data = DB::table('product_category')->where('id', $id)->first();
            return json_encode($data);
        }
    }
}
