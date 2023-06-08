@section('title', 'Admin | BlogCategory')
@extends('Backend.Layouts.index')
@section('main_content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"> Blog /</span> Category
</h4>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcategory">
    Blog Category Add
</button>

<!-- Modal -->

@include('Backend.Blog.Category.categoryModel')

<div class="card mt-4">
    <div class="card-datatable table-responsive">
        <table class="dt-category table border-top" id="categoryTable">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@section('extraJs')
<!-- testimonial.js -->
<script src="{{ asset('assets/backend/js/custom/blog/category.js') }}"></script>
@endsection
