@section('title', 'Admin | FAQ')
@extends('Backend.Layouts.index')
@section('main_content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"> FAQ </span>
    </h4>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addfaq">
        Add Faq
    </button>
    <!-- Modal -->

    @include('Backend.Faq.model')

    <div class="card mt-4">
        <div class="card-datatable table-responsive">
            <table class="dt-faq table border-top" id="faqTable">
                <thead>
                    <tr>
                        <th>FAQ TITLE</th>
                        <th>FAQ CONTENT</th>
                        <th>SHOW HOME</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection
@section('extraJs')
    <script src="{{ asset('assets/backend/js/custom/faq/faq.js') }}"></script>
    <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
