<?php

namespace App\Http\Controllers\Backend\Slider;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use DB;
use DataTables;
use File;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return view('Backend.Slider.index');
    }
    public function save(Request $request)
    {
        $id = $request->id;
        $data['status'] = 0;
        $data['massage'] = "record not submit";

        if ($request->file('file')) {
            $file = $request->file('file');

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path(SLIDER_IMAGE_PATH), $filename);

            if ($id) {
                $image_path = public_path(SLIDER_IMAGE_PATH) . '/' . $request->img_name;
                @unlink($image_path);
            }
        } else {
            $filename = $request->img_name;
        }

        $datainsert['heading'] = $request->heading;
        $datainsert['content'] = $request->content;
        $datainsert['button1_text'] = $request->button1_text;
        $datainsert['button1_url'] = $request->button1_url;
        $datainsert['button2_text'] = $request->button2_text;
        $datainsert['button2_url'] = $request->button2_url;
        $datainsert['position'] = $request->position;
        $datainsert['img'] = $filename;


        if ($id) {
            $save = Slider::where('id', $id)->update($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Edit successfully";
        } else {
            $save = Slider::insert($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Record successfully";
        }

        return json_encode($data);
    }
    public function list()
    {
        $data = Slider::select('*');
        return datatables::of($data)->addIndexColumn()
            ->addColumn('img', function ($data) {
                return   SLIDER_IMAGE_PATH . '/' . $data->img;
            })

            ->addColumn('action', function ($data) {
                $btn = '<button id="slider_edit" data-id="' . $data->id . '" class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>';
                $btn .= '<button id="slider_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';

                return $btn;
            })
            ->rawColumns(['action', 'img'])
            ->make(true);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $data['status'] = 0;
        $data['massage'] = "record not delete";
        if ($id) {
            $sliderdata = Slider::findOrFail($id);
            $image_path = public_path(SLIDER_IMAGE_PATH) . '/' . $sliderdata->img;

            if (File::exists($image_path)) {
                unlink($image_path);
            }
            $sliderdata->delete();

            $data['status'] = 1;
            $data['massage'] = "record delete successfully";
        }
        return json_encode($data);
    }
    public function get_detail(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $data = Slider::where('id', $id)->first();
            $data->pro_path = SLIDER_IMAGE_PATH . $data->img;
            return json_encode($data);
        }
    }
}

