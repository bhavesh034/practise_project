<div class="modal fade" id="addmember" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title"><i class='bx bx-user-plus'> Add Team Member</i></h3>
                </div>
                <form id="formTeam" class="row g-3" method="post" action="{{ route('admin.team-insert') }}"
                    enctype="multipart/form-data" onsubmit="return false">

                    @csrf
                    <input type="hidden" id="id" name="id" class="form-control" placeholder="" />

                    <div class="col-12">
                        <label class="form-label" for="client_name">Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="Please Enter Client Name" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">Designation</label>
                        <input type="text" id="designation" name="designation" class="form-control"
                            placeholder="Please Enter Your Team Member Designation" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">Detail</label>
                        <textarea class="form-control" rows="10" cols="60" ckeditor="true" id="detail"
                            placeholder="Enter the Detail" name="detail"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="file">Images</label>
                        <input class="form-control" type="file" id="file" name="file" value=""
                            onchange="loadImg(event)">
                        <input class="form-control" type="hidden" id="img_name" name="img_name" value="">
                    </div>
                    <div class="col-12">
                        <img id="my_image" name="file" src="" style="display:none" class=""
                            alt="" width="100" height="100" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="Please Enter Team Member Email">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">Phone</label>
                        <input type="mobile" id="phone" name="phone" class="form-control"
                            placeholder="Please Enter Team Member Phone">
                    </div>
                    {{-- Social Media  --}}
                    <div class="col-12">
                        <label class="form-label bx bxl-facebook" for="client_name"> Facebook</label>
                        <input type="url" id="facebook" name="facebook" class="form-control"
                            placeholder="Please Enter Your Team Member Facebook Url ">
                    </div>
                    <div class="col-12">
                        <label class="form-label bx bxl-twitter" for="client_name"> Twitter</label>
                        <input type="url" id="twitter" name="twitter" class="form-control"
                            placeholder="Please Enter Your Team Member Twitter Url">
                    </div>
                    <div class="col-12">
                        <label class="form-label bx bxl-linkedin" for="client_name"> Linkedin</label>
                        <input type="url" id="linkedin" name="linkedin" class="form-control"
                            placeholder="Please Enter Your Team Member Linkedin Url">
                    </div>
                    <div class="col-12">
                        <label class="form-label bx bxl-google-plus " for="client_name"> Googls Plus</label>
                        <input type="url" id="googlsplus" name="googlsplus" class="form-control"
                            placeholder="Please Enter Your Team Member Googlsplus Url">
                    </div>
                    <div class="col-12">
                        <label class="form-label bx bxl-flickr" for="client_name"> Flickr</label>
                        <input type="url" id="flickr" name="flickr" class="form-control"
                            placeholder="Please Enter Your Team Member Flickr Url">
                    </div>
                    <div class="col-12">
                        <label class="form-label bx bxl-instagram" for="client_name"> Instagram</label>
                        <input type="url" id="instagram" name="instagram" class="form-control"
                            placeholder="Please Enter Team Member Instagram Url">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">Website</label>
                        <input type="url" id="website" name="website" class="form-control"
                            placeholder="Please Enter Team Member Website Url">
                    </div>
                    {{-- <hr> --}}
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
