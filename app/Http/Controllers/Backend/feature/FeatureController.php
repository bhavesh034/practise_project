<?php

namespace App\Http\Controllers\Backend\Feature;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FeatureController extends Controller
{
    public function index()
    {
        return view('Backend.Features.index');
    }

    // Insert............................................................................................

    public function save(Request $request)
    {
        $id = $request->id;
        $data['status'] = 0;
        $data['massage'] = "! Oops Something Wrong Record Not Insert";

        $datainsert['feature_name'] = $request->feature_name;
        $datainsert['feature_content'] = $request->feature_content;
        $datainsert['feature_icon'] = $request->feature_icon;
        if ($id) {
            $save = DB::table('features')->where('id', $id)->update($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Update Record successfully";
        } else {
            $save = DB::table('features')->insert($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Record Insert successfully";
        }
        return json_encode($data);
    }

    // Feature List...........................................................................................
    public function list()
    {
        $data = Feature::select('*');
        return DataTables::of($data)->addIndexColumn()
            ->addColumn('feature_icon', function ($data) {
                $icon = "<i class='$data->feature_icon'></i>";
                return $icon;
            })
            ->addColumn('action', function ($data) {
                $btn = '<button id="feature_edit" data-id="' . $data->id . '" class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>';
                $btn .= '<button id="feature_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';
                return $btn;
            })
            ->rawColumns(['feature_icon','action'])
            ->make(true);
    }
    // Features Delete.........................................................................................
    public function delete(Request $request)
    {
        $id = $request->id;
        $data['status'] = 0;
        $data['massage'] = "record not delete";
        if ($id) {
            $news = Feature::findOrFail($id);
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
            $data = DB::table('features')->where('id', $id)->first();
            return json_encode($data);
        }
    }
}
