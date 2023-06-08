<?php

namespace App\Http\Controllers\Backend\Portfolio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PortfolioCategories;
use App\Models\Portfolio;
use App\Models\Portfolio_image;
// use DB;
// use DataTables;
use File;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PortfolioController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategories::all();
        return view("Backend/Portfolio/index")->with('category_id', $categories);
    }
    public function save(Request $request)
    {

        $data['status'] = 0;
        $data['massage'] = "record not submit";
        $id = $request->id;


        $datainsert['name'] = $request->name;
        $datainsert['short_content'] = $request->short_content;
        $datainsert['content'] = $request->content;
        $datainsert['client_name'] = $request->client_name;
        $datainsert['client_company'] = $request->client_company;
        $datainsert['start_date'] = $request->start_date;
        $datainsert['end_date'] = $request->end_date;
        $datainsert['web_site'] = $request->web_site;
        $datainsert['cost'] = $request->cost;
        $datainsert['client_content'] = $request->client_content;
        $datainsert['categories'] = $request->categories;

        if ($id && $id != '') {
            $results = DB::table('portfolio')->where('id', $id)->update($datainsert);
                $data['status'] = 1;
                $data['massage'] = "Update successfully";
        }else{
            $id = Portfolio::insertGetId($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Portfolio Add successfully";
        }

        if ($id) {
            if (!$request->image == "") {

                $image = json_decode($request->image);

                foreach ($image as $key => $value) {
                    $dataImage = array();
                    $extension = explode('/', mime_content_type($value->dataURL))[1];
                    $filename = date('YmdHi') . "_"  . $request->name . "_" . rand(10, 10000) . "." . $extension;
                    file_put_contents(public_path(PORTFOLIO_IMAGE_PATH) . $filename, file_get_contents($value->dataURL));

                    $dataImage['name'] = $filename;
                    $dataImage['portfolio_id'] = $id;

                    portfolio_image::insert($dataImage);
                }
            }
        }

        return json_encode($data);
    }

    public function list()
    {
        // $data = Portfolio::select('*');
        $data =  DB::table('portfolio')
            ->select('portfolio.*', 'portfolio_categories.name AS categories', 'portfolio_categories.status AS status')
            ->leftJoin('portfolio_categories', 'portfolio.categories', 'portfolio_categories.id')
            ->get();
        return DataTables::of($data)->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    return 'Active';
                } else {
                    return 'In Active';
                }
            })
            ->addColumn('action', function ($data) {
                $btn = '<button id="portfolio_edit" data-id="' . $data->id . '" class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>';
                $btn .= '<button id="portfolio_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';

                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
    public function delete(Request $request)
    {
        $data['status'] = 0;
        $data['massage'] = "record not delete";
        $id = $request->id;
        if ($id) {

            $image_path_delete = DB::table('portfolio_image')->where('portfolio_id', $id)->get();
            foreach ($image_path_delete as $key => $value) {

                $image_path = public_path(PORTFOLIO_IMAGE_PATH . $value->name);
                if (File::exists($image_path)) {
                    unlink($image_path);
                }
            }
            $delete = Portfolio::where('id', $id)->delete();
            $image_delete = portfolio_image::where('portfolio_id', $id)->delete();

            $data['status'] = 1;
            $data['massage'] = "record delete successfully";
        }

        return json_encode($data);
    }
    public function get_detail(Request $request)
    {
        $id = $request->id;
        if ($id) {
            DB::statement("SET SQL_MODE=''");
            $data =  DB::table('portfolio')
                ->select('portfolio.*', DB::raw("group_concat(portfolio_image.name) as image_name"))
                ->leftJoin('portfolio_image', 'portfolio.id', 'portfolio_image.portfolio_id')
                ->where('portfolio.id', $id)
                ->groupBy('portfolio.id')
                ->first();


            $data->pro_path = PORTFOLIO_IMAGE_PATH;

            return json_encode($data);
        }
    }
    public function image_delete(Request $request)
    {
        $data['status'] = 0;
        $data['massage'] = "Image not delete";
        if ($request->img_name) {
            $save =  DB::table('portfolio_image')->where('name', $request->img_name)->first();
            $delete_img =  DB::table('portfolio_image')->where('name', $request->img_name)->delete();

            $image_path = public_path(PORTFOLIO_IMAGE_PATH . $request->img_name);
            if (File::exists($image_path)) {
                unlink($image_path);
            }
            $data['image_name'] = DB::table('portfolio_image')->select(DB::raw("group_concat(portfolio_image.name) as image_name"))->where('portfolio_id', $save->portfolio_id)->first();

            $data['pro_path'] = PORTFOLIO_IMAGE_PATH;


            $data['status'] = 1;
            $data['massage'] = "Image delete successfully";
        }
        return json_encode($data);
    }
}
