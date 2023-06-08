<?php

namespace App\Http\Controllers\Backend\Faq;

use App\Http\Controllers\Controller;
use App\Models\faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    public function index()
    {
        return view('Backend.Faq.index');
    }

    public function save(Request $request)
    {
        $id = $request->id;
        $data['status'] = 0;
        $data['massage'] = "! Oops Something Wrong Record Not Insert";

        $datainsert['faq_title'] = $request->faq_title;
        $datainsert['content'] = $request->content;
        $datainsert['show_home'] = $request->show_home;
        if ($id) {
            $save = DB::table('faq')->where('id', $id)->update($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Update Record successfully";
        } else {
            $save = DB::table('faq')->insert($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Record Insert successfully";
        }

        return json_encode($data);
    }
    public function list()
    {
        $data = faq::select('*');
        // echo '<pre>';
        // print_r($data);
        // die;
        return datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<button id="faq_edit" data-id="' . $data->id . '" class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>';
                $btn .= '<button id="faq_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';
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
            $news = faq::findOrFail($id);
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
            $data = DB::table('faq')->where('id', $id)->first();
            return json_encode($data);
        }
    }
}
