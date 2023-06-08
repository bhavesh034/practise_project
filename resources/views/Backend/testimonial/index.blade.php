@section('title', 'Admin | Tesimonial')
@extends('Backend.Layouts.index')
@section('main_content')


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestimonial">
    Tesimonial Add
</button>


<!-- Modal -->

@include('Backend.Testimonial.model')

<div class="card mt-4">
    <div class="card-datatable table-responsive">
        <table class="dt-responsive table border-top" id="testimonialTable">
            <thead>
                <tr>
                    <th>Clinent Name</th>
                    <th>Company Name</th>
                    <th>Description</th>
                    <th data-orderable="false">Images</th>
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
<script src="{{ asset('assets/backend/js/custom/testimonial/testimonial.js') }}"></script>
@endsection