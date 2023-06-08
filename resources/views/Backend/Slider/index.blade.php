@section('title', 'Admin | Tesimonial')
@extends('Backend.Layouts.index')
@section('main_content')


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSlider">
    Slider Add
</button>

@include("Backend.Slider.model")


<div class="card mt-4">
    <div class="card-datatable table-responsive">
        <table class="slider_list table border-top" id="sliderTable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>PHOTO</th>
                    <th>HEADING</th>
                    <th>BUTTON 1 TEXT</th>
                    <th>BUTTON 1 URL</th>
                    <th>BUTTON 2 TEXT</th>
                    <th>BUTTON 2 URL</th>
                    <th>POSITION</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>
</div>


@endsection


@section('extraJs')

<script src="{{ asset('assets/backend/js/custom/slider/slider.js') }}"></script>

@endsection
