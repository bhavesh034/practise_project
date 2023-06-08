@section('title', 'Admin | Email To Subscriber')
@extends('Backend.Layouts.index')
@section('main_content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"> Subscriber /</span> Email To Subscriber
    </h4>


    <div class="card mb-4">
        <h5 class="card-header">Email To Subscriber</h5>
        <!-- Account -->
        <hr class="my-0">

        <div class="card-body">
            <form id="formemailtosubscriber" method="POST" action="{{ route('admin.getdata') }}" enctype="multipart/form-data"
                onsubmit="return false">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input class="form-control" type="text" name="title" id="title" placeholder="Enter To Title" />
                </div>

                <div class="form-group">
                    <label for="lastName" class="form-label">Meassage</label>
                    <textarea class="form-control" rows="10" cols="60" ckeditor="true" id="long_text"
                        placeholder="Enter the Description" name="long_text"></textarea>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 sendemail">Send To Mail</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('extraJs')
    <!-- smtp.js -->
    <script src="{{ asset('assets/backend/js/custom/subscriber/emailtosubscriber.js') }}"></script>
    <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('long_text');
    </script>
@endsection
