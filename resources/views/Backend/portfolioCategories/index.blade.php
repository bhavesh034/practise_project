@section('title', 'Admin | Tesimonial')
@extends('Backend.Layouts.index')
@section('main_content')


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategories">
Categories Add
</button>

@include("Backend.PortfolioCategories.model")


<div class="card mt-4">
    <div class="card-datatable table-responsive">
        <table class="portfolioCategories table border-top" id="portfolioCategories">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>
</div>


@endsection


@section('extraJs')

<script src="{{ asset('assets/backend/js/custom/portfolioCategories/portfolioCategories.js') }}"></script>

@endsection