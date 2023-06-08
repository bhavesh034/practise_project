@section('title', 'Admin | FEATURES')
@extends('Backend.Layouts.index')
@section('main_content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"> FEATURES </span>
    </h4>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addfeature">
        Add Features
    </button>
    <!-- Modal -->

    @include('Backend.Features.model')

    <div class="card mt-4">
        <div class="card-datatable table-responsive">
            <table class="dt-features table border-top" id="featuresTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Content</th>
                        <th>icone</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection
@section('extraJs')
    <script src="{{ asset('assets/backend/js/custom/feature/feature.js') }}"></script>
@endsection
