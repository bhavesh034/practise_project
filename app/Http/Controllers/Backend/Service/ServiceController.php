<?php

namespace App\Http\Controllers\Backend\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Service;
use File;

class ServiceController extends Controller
{
    public function index()
    {
        return view('Backend/Service/index');
    }
    public function save(Request $request)
    {
        
        $data['status'] = 0;
        $data['massage'] = "record not submit";
        $id = $request->id;

        if ($request->file('file')) {
            $file = $request->file('file');

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path(SERVICE_IMAGE_PATH), $filename);

            if ($id) {
                $image_path = public_path(SERVICE_IMAGE_PATH) . '/' . $request->img_name;
                @unlink($image_path);
            }
        } else {
            $filename = $request->img_name;
        }

        $datainsert['name'] = $request->name;
        $datainsert['short_description'] = $request->short_description;
        $datainsert['description'] = $request->description;
        $datainsert['image_name'] = $filename;
       

        if ($id) {
            $save = Service::where('id' , $id)->update($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Edit successfully";
        } else {
            $save = Service::insert($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Record successfully";
        }
        return json_encode($data);
    }
    public function list()
    {
        $data = Service::select('*');
        return datatables::of($data)->addIndexColumn()
            ->addColumn('img', function ($data) {
                return   SERVICE_IMAGE_PATH .'/'. $data->image_name;

            })

            ->addColumn('action', function ($data) {
                $btn = '<button id="service_edit" data-id="' . $data->id . '" class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>';
                $btn .= '<button id="service_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';

                return $btn;
            })
            ->rawColumns(['action','img'])
            ->make(true);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $data['status'] = 0;
        $data['massage'] = "record not delete";
        if ($id) {
        $news = Service::findOrFail($id);
        $image_path =public_path(SERVICE_IMAGE_PATH).'/'.$news->image_name;

        if (File::exists($image_path)) {
            unlink($image_path);
        }
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
            $data = DB::table('service')->where('id', $id)->first();
            $data->pro_path = SERVICE_IMAGE_PATH . $data->image_name;
            return json_encode($data);
        }
    }
}
