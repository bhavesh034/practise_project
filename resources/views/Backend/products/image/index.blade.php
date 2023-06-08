@section('title', 'Admin | Tesimonial')
@extends('Backend.Layouts.index')
@section('main_content')
<input value="{{ $product_id }}" id="product_id" type="hidden">

<a href="{{route('admin.products')}}" class="btn btn-danger">
    Back
</a>


<button type="button" id="addImage" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#imageAdd">
    Add Image
</button>

@include("Backend.Products.Image.model")

<div class="card mt-4">
    <div class="card-datatable table-responsive">
        <table class=" table border-top" id="imageTable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>
</div>


@endsection


@section('extraJs')

<script src="{{ asset('assets/backend/js/custom/product/productImage.js') }}"></script>

@endsection
