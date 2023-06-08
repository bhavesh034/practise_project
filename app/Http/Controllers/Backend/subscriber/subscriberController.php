<?php

namespace App\Http\Controllers\Backend\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SubscriberController extends Controller
{
    public function index()
    {
        return view('Backend.Subscriber.subscriber');
    }
    public function save(Request $request)
    {
        $id = $request->id;
        $data['status'] = 0;
        $data['massage'] = "! Oops Something Wrong Record Not Insert";

        $datainsert['email'] = $request->email;
        $datainsert['status'] = $request->status;
        if ($id) {
            $save = DB::table('subscribers')->where('id', $id)->update($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Update Record successfully";
        } else {
            $save = DB::table('subscribers')->insert($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Record Insert successfully";
        }
        return json_encode($data);
    }
    public function list()
    {
        $data = Subscriber::select('*')->get();

        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<button id="subscriber_edit" data-id="' . $data->id . '" class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>';
                $btn .= '<button id="subscriber_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';

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
            $news = subscriber::findOrFail($id);
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
            $data = DB::table('subscribers')->where('id', $id)->first();
            return json_encode($data);
        }
    }
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $id = $request->input('id');
        if ($id != '') {
            echo 'true';
            exit;
            // return response()->json(array("exists" => false));
        } else {
            $isExists = subscriber::where('email', $email)->count();
            if ($isExists > 0) {
                echo 'false';
                exit;
                // return response()->json(array("exists" => true));
            } else {
                echo 'true';
                exit;
                // return response()->json(array("exists" => false));
            }
        }



        // $userID = $request->id;
        // if ($userID) {
        //   $userEmail = subscriber::where(['email' => $request->email])->where('id', '!=', $userID)->first();
        //   if (!empty($userEmail)) {
        //     return response()->json(true);
        //   } else {
        //     return response()->json(false);
        //   }
        // } else {
        //   $userEmail = subscriber::where(['email' => $request->email])->first();
        //   if (!empty($userEmail)) {
        //     return response()->json(true);
        //   } else {
        //     return response()->json(false);
        //   }
        // }
    }
}
