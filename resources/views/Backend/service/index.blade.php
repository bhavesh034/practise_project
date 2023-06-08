@section('title', 'Admin | Tesimonial')
@extends('Backend.Layouts.index')
@section('main_content')


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addService">
    Service Add
</button>


<!-- Modal -->

@include('Backend.Service.model')

<div class="card mt-4">
    <div class="card-datatable table-responsive">
        <table class="dt-responsive table border-top" id="serviceTable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th data-orderable="false">Images</th>
                    <th>Action</th>                  
                </tr>
            </thead>

        </table>
    </div>
</div>

@endsection
@section('extraJs')
<!-- service.js -->

<script src="{{ asset('assets/backend/js/custom/service/service.js') }}"></script>

<script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>

@endsection