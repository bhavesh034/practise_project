@section('title', 'Admin | Tesimonial')
@extends('Backend.Layouts.index')
@section('main_content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Global Settings /</span> SMTP
</h4>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <!-- <i class='bx bx-envelope'></i> -->
            <!-- <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-envelope"></i> SMTP</a></li> -->
            <!-- <li class="nav-item"><a class="nav-link" href=""><i class="bx bx-lock-alt me-1"></i> Gateway</a></li> -->
        </ul>
        <div class="card mb-4">
            <h5 class="card-header">SMTP Details</h5>
            <!-- Account -->
            <hr class="my-0">

            <div class="card-body">
                <form id="formSMTPSettings"  onsubmit="return false">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="smtp_host" class="form-label">SMTP Host</label>
                            <input class="form-control" type="text" id="smtp_host" name="smtp_host" value="{{isset(get_option('smtp_host')->value) ? get_option('smtp_host')->value : ''}}" autofocus />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Port</label>
                            <input class="form-control" type="text" name="port" id="port" value="{{isset(get_option('port')->value) ? get_option('port')->value : ''}}" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Encryption</label>
                            <!-- <input class="form-control" type="text" id="encryption" name="encryption" value="" placeholder="" /> -->
                            <select id="encryption" name="encryption" class="select2 form-select">
                                <option value="none <?php isset(get_option('encryption')->value) ? get_option('encryption')->value : '' ?>">None</option>
                                <option value="ssl <?php isset(get_option('encryption')->value) ? get_option('encryption')->value : '' ?>">SSL</option>
                                <option value="tls <?php isset(get_option('encryption')->value) ? get_option('encryption')->value : '' ?>">TLS</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{isset(get_option('username')->value) ? get_option('username')->value : ''}}" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">Email From Address</label>

                            <input type="email" id="emailAddress" name="emailAddress" value="{{isset(get_option('emailAddress')->value) ? get_option('emailAddress')->value : ''}}" class="form-control" placeholder="" />

                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Password</label>
                            <input type="password" class="form-control" id="Password" value="" name="password" placeholder="" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Sender Name</label>
                            <input class="form-control" type="text" id="senderName" name="senderName" placeholder="" value="{{isset(get_option('senderName')->value) ? get_option('senderName')->value : ''}}" />
                        </div>
                        <!-- <div class="mt-4 col-md-6">
                <button type="submit" name="test" class="btn btn-primary col-md-6">Send Test Mail</button>
            </div> -->

                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
        <div class="card">
            <h5 class="card-header">Send test mail</h5>
            <div class="card-body">

                <form id="formTestMail"  onsubmit="return false">
                    @csrf
                    <div class="form-check mb-3">
                        <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Email</label>
                            <input class="form-control" type="text" id="testmail" name="testMail" placeholder="" value="" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <button type="submit" class="btn btn-primary">Send test mail</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('extraJs')
<!-- smtp.js -->
<script src="{{ asset('assets/backend/js/custom/smtp.js') }}"></script>
@endsection