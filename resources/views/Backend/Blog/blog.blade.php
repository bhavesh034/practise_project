@section('title', 'Admin | Blog')
@extends('Backend.Layouts.index')
@section('main_content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"> Blog </span>
    </h4>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcategory">
        Blog Add
    </button>



    <!-- Modal -->

    @include('Backend.Blog.blogModel')

    <div class="card mt-4">
        <div class="card-datatable table-responsive">
            <table class="dt-blog table border-top" id="blogTable">
                <thead>
                    <tr>
                        <th>Blog Title</th>
                        <th>Slug</th>
                        <th>Body</th>
                        <th>Blog-Category</th>
                        <th>Blog-Subcategory</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection
@section('extraJs')
    <!-- testimonial.js -->
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
 --}}
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script> --}}
    <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('long_text');
    </script>
    <script src="{{ asset('assets/backend/js/custom/blog/blog.js') }}"></script>
@endsection
