<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Product;
use App\Models\ProductImage;

use File;

class ProductsController extends Controller
{
    public function index()
    {

        return view("Backend.Products.Product.index");
    }
    public function save(Request $request)
    {



        $data['status'] = 0;
        $data['massage'] = "record not submit";
        $id = $request->id;


        if ($request->product_name) {
            $datainsert['product_name'] = $request->product_name;
            $datainsert['slug'] = $request->slug;
            $datainsert['sold'] = $request->sold;
            $datainsert['instructions'] = $request->instructions;
            $datainsert['price'] = $request->price;
            $datainsert['stock'] = $request->stock;
            $datainsert['status'] = $request->status;
            $save_id = "";
            if ($id && $id != '') {
                $results = DB::table('products')->where('id', $id)->update($datainsert);
                $data['status'] = 1;
                $data['massage'] = "Update successfully";
            } else {
                $id =  DB::table('products')->insertGetId($datainsert);
                $data['status'] = 1;
                $data['massage'] = "Product Add successfully";
            }



            if ($id) {
                if (!$request->image == "") {

                    $image = json_decode($request->image);

                    foreach ($image as $key => $value) {
                        $dataImage = array();
                        $extension = explode('/', mime_content_type($value->dataURL))[1];
                        $filename = date('YmdHi') . "_"  . $request->slug . "_" . rand(10, 10000) . "." . $extension;
                        file_put_contents(public_path(PRODUCT_IMAGE_PATH) . $filename, file_get_contents($value->dataURL));

                        $dataImage['image_name'] = $filename;
                        $dataImage['products_id'] = $id;
                        DB::table('product_image')->insert($dataImage);
                    }
                }
            }
        }
        return json_encode($data);
    }
    public function list(Request $request)
    {

        $data = product::select('*');
   
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    return 'Active';
                } else {
                    return 'In Active';
                }
            })
            ->addColumn('img', function ($data) {
                $img_url = url('/admin/product/image/view/' . $data->id . '');
                return '<a href = "' . $img_url . '" id="image_view" class="btn btn-sm btn-icon"><i class="bx bx-show mx-1"></i></a>';
            })
            ->addColumn('action', function ($data) {
                $btn = '<button id="product_edit" data-id="' . $data->id . '" class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>';
                $btn .= '<button id="product_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';

                return $btn;
            })
            ->rawColumns(['action', 'img', 'status'])
            ->make(true);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $data['status'] = 0;
        $data['massage'] = "record not delete";
        if ($id) {
            $product_img = DB::table('product_image')->where('products_id', $id)->get();

            foreach ($product_img as $key => $value) {
                $image_path = public_path(PRODUCT_IMAGE_PATH . $value->image_name);
                if (File::exists($image_path)) {
                    unlink($image_path);
                }
            }
            $product = DB::table('products')->where('id', $id)->delete();
            $product = DB::table('product_image')->where('products_id', $id)->delete();


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
            $data =  DB::table('products')
                ->select('products.*', DB::raw("group_concat(product_image.image_name) as image_name"))
                ->leftJoin('product_image', 'products.id', 'product_image.products_id')
                ->where('products.id', $id)
                ->groupBy('products.id')
                ->first();


            $data->pro_path = PRODUCT_IMAGE_PATH;

            return json_encode($data);
        }
    }
    public function image_delete(Request $request)
    {
        $data['status'] = 0;
        $data['massage'] = "Image not delete";
        if ($request->img_name) {
            $save =  DB::table('product_image')->where('image_name', $request->img_name)->first();
            $delete_img =  DB::table('product_image')->where('image_name', $request->img_name)->delete();

            $image_path = public_path(PRODUCT_IMAGE_PATH . $request->img_name);
            if (File::exists($image_path)) {
                unlink($image_path);
            }
            $data['image_name'] = $product = DB::table('product_image')->select(DB::raw("group_concat(product_image.image_name) as image_name"))->where('products_id', $save->products_id)->first();

            $data['pro_path'] = PRODUCT_IMAGE_PATH;


            $data['status'] = 1;
            $data['massage'] = "Image delete successfully";
        }
        return json_encode($data);
    }
    public function image_view($id)
    {
        if ($id) {
            return view("Backend.products.image.index", ["product_id" => $id]);
        }
    }
}
