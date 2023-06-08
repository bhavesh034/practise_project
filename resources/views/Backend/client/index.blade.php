@section('title', 'Admin | CLIENT')
@extends('Backend.Layouts.index')
@section('main_content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"> Client </span>
    </h4>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addclient">
        Add Client
    </button>
    <!-- Modal -->

    @include('Backend.Client.model')

    <div class="card mt-4">
        <div class="card-datatable table-responsive">
            <table class="dt-client table border-top" id="clientTable">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>URl</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection
@section('extraJs')
    <script src="{{ asset('assets/backend/js/custom/client/client.js') }}"></script>
@endsection
