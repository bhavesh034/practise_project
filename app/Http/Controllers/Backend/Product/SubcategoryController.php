<?php

namespace App\Http\Controllers\Backend\Product;


use App\Http\Controllers\Controller;

use App\Models\category;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SubcategoryController extends Controller
{
    //
    public function index()
    {
        $categories = category::all();
        // echo '<pre>';
        // print_r($categories);
        // die;
        return view('Backend.Product.Subcategory.subcategory')->with('category_id', $categories);
    }


    public function save(Request $request)
    {
        $id = $request->id;

        $data['status'] = 0;
        $data['massage'] = "! Oops Something Wrong Record Not Insert";

        $datainsert['category_id'] = $request->category_name;
        $datainsert['subcategory_name'] = $request->subcategory_name;
        $datainsert['status'] = $request->status;
        if ($id) {
            $save = DB::table('product_subcategory')->where('id', $id)->update($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Update Record successfully";
        } else {
            $save = DB::table('product_subcategory')->insert($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Record Insert successfully";
        }

        return json_encode($data);
    }

    public function list()
    {

        // $data = DB::table('product_subcategory')
        //     ->join('product_category', 'category_id', 'product_subcategory.category_id')
        //     ->select('product_subcategory.*', 'product_category.category_name')
        //     ->get();
            $data = DB::table('product_subcategory')
            ->join('product_category','product_category.id','product_subcategory.category_id')
            ->select('product_subcategory.*', 'product_category.category_name')
            ->get();
        return Datatables::of($data)
            ->editColumn('categoryname', function ($data) {
                return $data->category_name;
            })
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<button id="subcategory_edit" data-id="' . $data->id . '" class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>';
                $btn .= '<button id="subcategory_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';
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
            $news = subcategory::findOrFail($id);
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
            $data = DB::table('product_subcategory')->where('id', $id)->first();
            // echo '<pre>';
            // print_r($data);
            // die;
            return json_encode($data);
        }
    }
}
