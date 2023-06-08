<?php

namespace App\Http\Controllers\Backend\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use DB;
use DataTables;
use File;


class ProductImageController extends Controller
{
    public function list(Request $request)
    {
        if ($request->id) {
            $data = $data = ProductImage::select('*')->where('products_id', $request->id);
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('image', function ($data) {
                    // $path =  asset('assets/backend/libs/dropzone/' . $data->image_name);
                    $path =  PRODUCT_IMAGE_PATH .'/'. $data->image_name;
                

                    return "<img src =" . $path . " width='100'   height='100' />";
                })
                ->addColumn('action', function ($data) {
                    return  '<button id="image_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
    }

    public function delete(Request $request)
    {
        $data['status'] = 0;
        $data['massage'] = "Image not delete";
        if ($request->id) {
            $save = DB::table('product_image')->where('id', $request->id)->first();

            $delete_img = DB::table('product_image')->where('id', $request->id)->delete();

            $image_path = public_path(PRODUCT_IMAGE_PATH . $save->image_name);
         


            if (File::exists($image_path)) {
                unlink($image_path);
            }

            $data['status'] = 1;
            $data['massage'] = "Image delete successfully";
        }


        return json_encode($data);
    }

    public function save(Request $request)
    {
        $data['status'] = 0;
        $data['massage'] = "record not submit";
        $id = $request->id;
     
        if (!$request->image == "") {

            $image = json_decode($request->image);

            foreach ($image as $key => $value) {
                $dataImage = array();
                $extension = explode('/', mime_content_type($value->dataURL))[1];
                $filename = date('YmdHi') . rand(10, 10000) . "." . $extension;
                file_put_contents(public_path(PRODUCT_IMAGE_PATH) . $filename, file_get_contents($value->dataURL));

                $dataImage['image_name'] = $filename;
                $dataImage['products_id'] = $id;
                DB::table('product_image')->insert($dataImage);
            }
            $data['status'] = 1;
            $data['massage'] = "Product Image Add successfully";
        }
     
        return json_encode($data);
    }
}
