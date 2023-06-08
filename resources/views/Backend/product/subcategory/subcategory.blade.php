@section('title', 'Admin | SubCategory')
@extends('Backend.Layouts.index')
@section('main_content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"> Product /</span> SubCategory
</h4>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsubcategory">
    SubCategory Add
</button>



<?php
    // echo '<pre>';
    // print_r($category_id);
    // die;
?>
<div class="card mt-4">
    <div class="card-datatable table-responsive">
        <table class="dt-subcategory table border-top" id="subcategoryTable">
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

@include('Backend.Product.Subcategory.subcategoryModel')
@endsection
@section('extraJs')
<!-- testimonial.js -->
<script src="{{ asset('assets/backend/js/custom/product/subcategory.js') }}"></script>
@endsection
