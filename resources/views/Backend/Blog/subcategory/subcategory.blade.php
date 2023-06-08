@section('title', 'Admin | SubCategory')
@extends('Backend.Layouts.index')
@section('main_content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"> Blog /</span> SubCategory
</h4>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsubcategory">
    SubCategory Add
</button>

<div class="card mt-4">
    <div class="card-datatable table-responsive">
        <table class="dt-blogsubcategory table border-top" id="blogsubcategoryTable">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>SubCategory Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>
</div>
<!-- Modal -->

@include('Backend.Blog.Subcategory.subcategoryModel')
@endsection
@section('extraJs')
<!-- testimonial.js -->
{{-- <script src="{{ asset('assets/backend/js/custom/subcategory.js') }}"></script> --}}
<script src="{{ asset('assets/backend/js/custom/blog/subcategory.js') }}"></script>
@endsection
