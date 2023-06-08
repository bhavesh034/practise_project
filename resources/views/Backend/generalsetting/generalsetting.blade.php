@section('title', 'Admin | General Setting')
@extends('Backend.Layouts.index')
@section('main_content')

<div class="col-xl-6">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Global Settings /</span> General Setting
    </h4>
    <div class="nav-align-left mb-5">
        <ul class="nav nav-pills me-4" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#settting_logo" aria-controls="settting_logo" aria-selected="true">
                    Logo
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#settting_favicon" aria-controls="settting_favicon" aria-selected="false">
                    Favicon
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#settting_topbar" aria-controls="settting_topbar" aria-selected="false">
                    Top Bar
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#settting_sendemail" aria-controls="settting_sendemail" aria-selected="false">
                    Email
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#settting_color" aria-controls="settting_color" aria-selected="false">
                    Color
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#social_media" aria-controls="social_media" aria-selected="false">
                    Social Media
                </button>
            </li>
        </ul>
        <div class="tab-content">
            {{-- Logo --}}
            <div class="tab-pane fade show active" id="settting_logo" role="tabpanel">
                <form id="formlogo" method="POST" action="{{ route('admin.logo-insert') }}" onsubmit="return false">
                    @csrf
                    <div class="form-group">
                        <div class="col-12 header_logo ">
                            <label class="form-label" for="file">Company Logo</label>
                            <img src="{{ url('assets/backend/upload/logo/' . $logo) }}" name="file" class="navbar-brand" />
                        </div>
                        <label class="form-label" for="file">Update Logo</label>
                        <input class="form-control" type="file" id="logo_img" name="logo_img" value="" onchange="loadImg(event)">
                        <input class="form-control" type="hidden" id="img_name" name="img_name" value="{{isset(get_option('logo')->value) ? get_option('logo')->value : ''}}">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update Log</button>
                </form>
            </div>
            {{-- Favicon Image --}}
            <div class="tab-pane fade" id="settting_favicon" role="tabpanel">
                <form id="formfavicon" method="POST" action="{{ route('admin.favicon-insert') }}" onsubmit="return false">
                    @csrf
                    <div class="form-group">
                        <div class="col-12 favicon_logo ">
                            <label class="form-label" for="file">Favicon Logo</label>
                            <img src="{{ url('assets/backend/upload/favicon/' . $favicon) }}" name="file" class="navbar-brand" />
                        </div>
                        <label class="form-label" for="file">Update Logo</label>
                        <input class="form-control" type="file" id="favicon_img" name="favicon_img" value="" onchange="loadfavicon(event)">
                        <input class="form-control" type="hidden" id="favicon_name" name="favicon_name" value="{{isset(get_option('favicon')->value) ? get_option('favicon')->value : ''}}">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update Log</button>
                </form>
            </div>
            {{-- Top Bar --}}
            <div class="tab-pane fade " id="settting_topbar" role="tabpanel">
                <form id="formtopbar" method="POST" action="{{ route('admin.topbar-insert') }}" onsubmit="return false">
                    @csrf
                    <div class="form-group col-xl-12 topbardata">
                        <label class="form-label" for="client_name">Top Bar Email</label>
                        <input type="text" id="email" name="email" class="form-control" value="{{isset(get_option('email')->value) ? get_option('email')->value : ''}}" /><br>
                        <label class="form-label" for="client_name">Top Bar Phone Number</label>
                        <input type="text" id="number" name="number" class="form-control" value="{{isset(get_option('number')->value) ? get_option('number')->value : ''}}" />
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                </form>
            </div>
            {{-- Send Email --}}
            <div class="tab-pane fade " id="settting_sendemail" role="tabpanel">
                <form id="formsendmail" method="POST" action="{{ route('admin.email-insert') }}" onsubmit="return false">
                    {{-- @csrf --}}
                    <div class="form-group email">
                        <label class="form-label">Send Email</label>
                        <input type="text" id="send_email" name="send_email" class="form-control" value="{{isset(get_option('send_email')->value) ? get_option('send_email')->value : ''}}" /><br>
                        <label class="form-label">Receive Email</label>
                        <input type="text" id="receive_email" name="receive_email" class="form-control" value="{{isset(get_option('receive_email')->value) ? get_option('receive_email')->value : ''}}" />
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                </form>
            </div>
            {{-- Color --}}
            <div class="tab-pane fade pickr " id="settting_color" role="tabpanel">
                <form id="formcolor" method="POST" action="{{ route('admin.color-insert') }}" onsubmit="return false">
                    {{-- @csrf --}}
                    <div class="form-group col-xl-12 favcolor">
                        <label class="form-label" for="client_name">Color</label>
                        <input type="color" id="favcolor" name="favcolor" class="form-control" value="{{isset(get_option('logo')->value) ? get_option('logo')->value : ''}}" /><br>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                </form>
            </div>
            {{--social media--}}
            <div class="tab-pane fade " id="social_media" role="tabpanel">
                <form id="social_mediaform" onsubmit="return false">
                    {{-- @csrf --}}
                    @csrf
                    <div class="form-group email">
                        <label class="form-label">Facebook</label>
                        <input type="url" id="facebook" name="facebook" class="form-control" value="{{isset(get_option('facebook')->value) ? get_option('facebook')->value : ''}}" /><br>

                        <label class="form-label">Twiter</label>
                        <input type="url" id="twiter" name="twiter" class="form-control" value="{{isset(get_option('twiter')->value) ? get_option('twiter')->value : ''}}" /><br>

                        <label class="form-label">Linkidin</label>
                        <input type="url" id="linkidin" name="linkidin" class="form-control" value="{{isset(get_option('linkidin')->value) ? get_option('linkidin')->value : ''}}" /><br>

                        <label class="form-label">Google Plus</label>
                        <input type="url" id="Google_plus" name="Google_plus" class="form-control" value="{{isset(get_option('Google_plus')->value) ? get_option('Google_plus')->value : ''}}" /><br>

                        <label class="form-label">Pinterest</label>
                        <input type="url" id="pinterest" name="pinterest" class="form-control" value="{{isset(get_option('pinterest')->value) ? get_option('pinterest')->value : ''}}" /><br>
                        
                        <label class="form-label">youTube</label>
                        <input type="url" id="youTube" name="youTube" class="form-control" value="{{isset(get_option('youTube')->value) ? get_option('youTube')->value : ''}}" /><br>

                        <label class="form-label">Linkidin</label>
                        <input type="url" id="linkidin" name="linkidin" class="form-control" value="{{isset(get_option('linkidin')->value) ? get_option('linkidin')->value : ''}}" /><br>

                        <label class="form-label">Instagram</label>
                        <input type="url" id="instagram" name="instagram" class="form-control" value="{{isset(get_option('instagram')->value) ? get_option('instagram')->value : ''}}" /><br>

                        <label class="form-label">Flickr</label>
                        <input type="url" id="flickr" name="flickr" class="form-control" value="{{isset(get_option('flickr')->value) ? get_option('flickr')->value : ''}}" /><br>

                        <label class="form-label">Reddit</label>
                        <input type="url" id="reddit" name="reddit" class="form-control" value="{{isset(get_option('reddit')->value) ? get_option('reddit')->value : ''}}" /><br>

                        <label class="form-label">Snapchat</label>
                        <input type="url" id="snapchat" name="snapchat" class="form-control" value="{{isset(get_option('snapchat')->value) ? get_option('snapchat')->value : ''}}" /><br>
                        <label class="form-label">whatsApp</label>
                        <input type="url" id="whatsApp" name="whatsApp" class="form-control" value="{{isset(get_option('whatsApp')->value) ? get_option('whatsApp')->value : ''}}" /><br>

                        <label class="form-label">Quora</label>
                        <input type="url" id="quora" name="quora" class="form-control" value="{{isset(get_option('quora')->value) ? get_option('quora')->value : ''}}" /><br>

                        <label class="form-label">Stumbleupon</label>
                        <input type="url" id="stumbleupon" name="stumbleupon" class="form-control" value="{{isset(get_option('stumbleupon')->value) ? get_option('stumbleupon')->value : ''}}" /><br>

                        <label class="form-label">Delicious</label>
                        <input type="url" id="delicious" name="delicious" class="form-control" value="{{isset(get_option('delicious')->value) ? get_option('delicious')->value : ''}}" /><br>

                        <label class="form-label">Digg</label>
                        <input type="url" id="digg" name="digg" class="form-control" value="{{isset(get_option('delicious')->value) ? get_option('delicious')->value : ''}}" />
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extraJs')
<!-- testimonial.js -->
<script src="{{ asset('assets/backend/js/custom/setting/generalsetting.js') }}"></script>
@endsection