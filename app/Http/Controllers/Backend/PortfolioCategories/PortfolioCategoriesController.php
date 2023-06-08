<?php

namespace App\Http\Controllers\Backend\PortfolioCategories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PortfolioCategories;
use DataTables;

class PortfolioCategoriesController extends Controller
{
    public function index()
    {
        return view("Backend.PortfolioCategories.index");
    }
    public function save(Request $request)
    {
        $data['status'] = 0;
        $data['massage'] = 'Recortd not submit';
        $id = $request->categories_id;
    

        if ($request->categories_name) {
            $datainsert['name'] = $request->categories_name;
            $datainsert['status'] = $request->status;
            if ($id) {
                $save = PortfolioCategories::where("id" , $id)->update($datainsert);
             
                $data['status'] = 1;
                $data['massage'] = 'Categories Update Successfully';
            } else {
                $save = PortfolioCategories::insert($datainsert);
                $data['status'] = 1;
                $data['massage'] = 'Categories Add Successfully';
            }
        }
        return json_encode($data);
    }
    public function list()
    {

        $data = PortfolioCategories::select('*');
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    return 'Active';
                } else {
                    return 'In Active';
                }
            })
            ->addColumn('action', function ($data) {
                $btn = '<button id="categories_edit" data-id="' . $data->id . '" class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>';
                $btn .= '<button id="categories_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';

                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
    public function delete(Request $request)
    {
        $data['status'] = 0;
        $data['massage'] = 'Categories Not Delete';
        $id = $request->id;
        if ($id) {
            $delete = PortfolioCategories::where('id', $id)->delete();
            $data['status'] = 1;
            $data['massage'] = 'Categories Delete successfully';
        }
        return json_encode($data);
    }
    public function get_detail(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $edit = PortfolioCategories::select('*')->where('id', $id)->first();
            return json_encode($edit);
        }
    }
}
