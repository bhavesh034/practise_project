@section('title', 'Admin | Tesimonial')
@extends('Backend.Layouts.index')
@section('main_content')


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduct">
    Product Add
</button>

@include("Backend.Products.Product.model")


<div class="card mt-4">
    <div class="card-datatable table-responsive">
        <table class="produt_list table border-top" id="productTable">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>
</div>


@endsection


@section('extraJs')

<script src="{{ asset('assets/backend/js/custom/product/product.js') }}"></script>

@endsection
