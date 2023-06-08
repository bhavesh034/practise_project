<?php

namespace App\Http\Controllers\Backend\Team;

use App\Http\Controllers\Controller;
use App\Models\team;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class TeamController extends Controller
{
    public function index()
    {
        return view('Backend.Team.team');
    }
    public function save(Request $request)
    {
        $id = $request->id;
        $data['status'] = 0;
        $data['massage'] = "record not submit";

        if ($request->file('file')) {
            $file = $request->file('file');

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path(TEAM_IMAGE_PATH), $filename);
            if ($id) {
                $image_path = public_path(TEAM_IMAGE_PATH) . '/' . $request->img_name;
                @unlink($image_path);
            }
        } else {
            $filename = $request->img_name;
        }

        $datainsert['name'] = $request->name;
        $datainsert['designation'] = $request->designation;
        $datainsert['detail'] = $request->detail;
        $datainsert['facebook'] = $request->facebook;
        $datainsert['twitter'] = $request->twitter;
        $datainsert['linkedin'] = $request->linkedin;
        $datainsert['googlsplus'] = $request->googlsplus;
        $datainsert['flickr'] = $request->flickr;
        $datainsert['instagram'] = $request->instagram;
        $datainsert['email'] = $request->email;
        $datainsert['phone'] = $request->phone;
        $datainsert['website'] = $request->website;
        $datainsert['img'] = $filename;

        if ($id) {
            $save = DB::table('teams')->where('id', $id)->update($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Edit successfully";
        } else {
            $save =  DB::table('teams')->insert($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Record successfully";
        }
        // echo '<pre>';
        // print_r($data);
        // die;
        return json_encode($data);
    }
    public function list()
    {

        $data = team::select('*');
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('img', function ($data) {
                return TEAM_IMAGE_PATH . '/' . $data->img;
            })

            ->addColumn('action', function ($data) {
                $btn = '<button id="team_edit" data-id="' . $data->id . '" class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>';
                $btn .= '<button id="team_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';

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
            $news = team::findOrFail($id);
            $image_path = public_path(TEAM_IMAGE_PATH) . '/' . $news->img;

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
            $data = DB::table('teams')->where('id', $id)->first();
            $data->pro_path = TEAM_IMAGE_PATH . $data->img;

            return json_encode($data);
        }
    }
}
