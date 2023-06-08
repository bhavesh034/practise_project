<?php

namespace App\Http\Controllers\Backend\Blog;
use App\Http\Controllers\Controller;
use App\Models\blog;
use App\Models\blogcategory;
use App\Models\blogsubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    //
    public function index()
    {
        $categories = blogcategory::all();
        $subcategories = blogsubcategory::all();
        return view('Backend.Blog.blog')->with(compact('categories','subcategories'));
    }

    public function save(Request $request)
    {
        $id = $request->id;
        $data['status'] = 0;
        $data['massage'] = "! Oops Something Wrong Record Not Insert";

        $datainsert['blog_title'] = $request->blog_title;
        $datainsert['slug'] = $request->slug;
        $datainsert['long_text'] = $request->long_text;
        $datainsert['category_id'] = $request->category_name;
        $datainsert['subcategory_id'] = $request->subcategory_name;
        if ($id) {
            $save = DB::table('blogs')->where('id', $id)->update($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Update Record successfully";
        } else {
            $save = DB::table('blogs')->insert($datainsert);
            $data['status'] = 1;
            $data['massage'] = "Record Insert successfully";
        }

        return json_encode($data);
    }
    public function list()
    {

        // $data = blog::select('*');
        $data = DB::table('blogs')->select('blogs.*', 'blog_category.category_name','blog_subcategory.subcategory_name')
            ->join('blog_category', 'blog_category.id', 'blogs.category_id')
            ->join('blog_subcategory', 'blog_subcategory.id', 'blogs.subcategory_id')
            ->get();
            return Datatables::of($data)
            ->editColumn('categoryname', function ($data) {
                return $data->category_name;
            })
            ->editColumn('subcategoryname', function ($data) {
                return $data->subcategory_name;
            })
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<button id="blog_edit" data-id="' . $data->id . '" class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>';
                $btn .= '<button id="blog_delete" data-id="' . $data->id . '" class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>';
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
            $news = blog::findOrFail($id);
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
            $data = DB::table('blogs')->where('id', $id)->first();
            return json_encode($data);
        }
    }
}
