<?php

namespace App\Http\Controllers\Backend\Client;

use App\Http\Controllers\Controller;
use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use File;

class ClientController extends Controller
{
    public function index()
    {
        return view('Backend.Client.index');
    }

    public function save(Request $request)
    {
        $id = $request->id;
        $data['status'] = 0;
        $data['massage'] = "record not submit";

        if ($request->file('client_img')) {
            $file = $request->file('client_img');

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path(CLIENT_IMAGE_PATH), $filename);
            if ($id) {
                $image_path = public_path(CLIENT_IMAGE_PATH) . '/' . $request->img_name;
                @unlink($image_path);
            }
        } else {
            $filename = $request->img_name;
        }

        $datainsert['client_name'] = $request->client_name;
        $datainsert['client_url'] = $request->client_url;
        $datainsert['client_img'] = $filename;

        if ($id) {
            $save = DB::table('clients')->where('id', $id)->update($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Edit successfully";
        } else {
            $save =  DB::table('clients')->insert($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Record successfully";
        }
        return json_encode($data);
    }
    public function list()
    {

        $data = client::select('*');
        return DataTables::of($data)->addIndexColumn()
            ->addColumn('client_img', function ($data) {
                return CLIENT_IMAGE_PATH . '/' . $data->client_img;
            })

            ->addColumn('action', function ($data) {
                $btn = '<button id="client_edit" data-id="' . $data->id . '" class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>';
                $btn .= '<button id="client_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';

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
            $clients_img = client::findOrFail($id);
            $image_path = public_path(CLIENT_IMAGE_PATH) . '/' . $clients_img->client_img;

            if (File::exists($image_path)) {
                unlink($image_path);
            }
            $clients_img->delete();

            $data['status'] = 1;
            $data['massage'] = "record delete successfully";
        }
        return json_encode($data);
    }
    public function get_detail(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $data = DB::table('clients')->where('id', $id)->first();
            $data->pro_path = CLIENT_IMAGE_PATH . $data->client_img;

            return json_encode($data);
        }
    }
}
