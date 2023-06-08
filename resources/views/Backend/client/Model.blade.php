<div class="modal fade" id="addclient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title">Add Client Information</h3>
                </div>
                <form id="formclient"class="row g-3" method="post" action="{{ route('admin.client-insert') }}"
                    enctype="multipart/form-data" onsubmit="return false">
                    @csrf
                    <input type="hidden" id="id" name="id" class="form-control" placeholder="" />
                    <div class="col-12">
                        <label class="form-label" for="client_name">Client:</label>
                        <input type="text" id="client_name" name="client_name" class="form-control"
                            placeholder="Please Client Name" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">URl</label>
                        <input type="url" id="client_url" name="client_url" class="form-control"
                            placeholder="Please Client Url ">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="file">Images</label>
                        <input class="form-control" type="file" id="client_img" name="client_img" value=""
                            onchange="loadImg(event)">
                        <input class="form-control" type="hidden" id="img_name" name="img_name" value="">
                    </div>
                    <div class="col-12">
                        <img id="my_image" name="file" src="" style="display:none" class=""
                            alt="" width="100" height="100" />
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
