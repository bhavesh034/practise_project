<div class="modal fade" id="addTestimonial" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title">Add Testimonial</h3>
                </div>
                <form id="formTestmonial" class="row g-3" enctype="multipart/form-data" onsubmit="return false">

                    @csrf
                    <input type="hidden" id="id" name="id" class="form-control" placeholder="" />


                    <div class="col-12">
                        <label class="form-label" for="client_name">Client Name</label>
                        <input type="text" id="client_name" name="client_name" class="form-control"
                            placeholder="Please Enter Client Name" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">Company Name</label>
                        <input type="text" id="company_name" name="company_name" class="form-control"
                            placeholder="Please Enter Company Name" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="modalAddressCountry">Status</label>
                        <select id="status" name="status" class="select2 form-select" data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="1">Active</option>
                            <option value="2">In Active</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="file">Company Images</label>
                        <input class="form-control" type="file" id="file" name="file" value=""
                            onchange="loadImg(event)">
                        <input class="form-control" type="hidden" id="img_name" name="img_name" value="">
                    </div>
                    <div class="col-12">
                        <img id="my_image" name="file" src="" style="display:none" class=""
                            alt="" width="100" height="100" />
                    </div>
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
