@section('title', 'Admin | Subscriber')
@extends('Backend.Layouts.index')
@section('main_content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"> Subscriber /</span> All Subscriber
</h4>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsubscriber">
        Subscriber Add
    </button>


    <!-- Modal -->

    @include('Backend.Subscriber.subscriberModel')

    <div class="card mt-4">
        <div class="card-datatable table-responsive">
            <table class="dt-subscriber table border-top" id="subscriberTable">
                <thead>
                    <tr>
                        {{-- <th>Id</th> --}}
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection
@section('extraJs')
    <script src="{{ asset('assets/backend/js/custom/subscriber/subscriber.js') }}"></script>
@endsection
