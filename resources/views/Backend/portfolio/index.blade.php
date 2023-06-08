@section('title', 'Admin | Tesimonial')
@extends('Backend.Layouts.index')
@section('main_content')


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPortfolio">
    Portfolio Add
</button>

@include("Backend.Portfolio.model")


<div class="card mt-4">
    <div class="card-datatable table-responsive">
        <table class="portfolio_list table border-top" id="portfolioTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Short Content</th>
                    <th>Client Name</th>
                    <th>Client Company</th>
                    <th>Cost</th>
                    <th>Categories</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>
</div>


@endsection


@section('extraJs')

<script src="{{ asset('assets/backend/js/custom/portfolio/portfolio.js') }}"></script>


<script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>

@endsection