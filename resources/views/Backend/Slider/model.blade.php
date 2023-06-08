<div class="modal fade" id="addSlider" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title">Add Slider</h3>
                </div>
                <form id="formProduct" class="row g-3" enctype="multipart/form-data" onsubmit="return false">

                    @csrf
                    <input type="hidden" id="id" name="id" class="form-control" placeholder="" />


                    
                    <div class="col-12">
                        <label class="form-label"  for="heading">Heading</label>
                        <input type="text" id="heading" name="heading" class="form-control" placeholder="Please enter heading" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="Content">Content</label>
                        <textarea class="form-control" id="content" name="content"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="Button1">Button 1 Text</label>
                        <input type="text" id="button1_text" name="button1_text" class="form-control" placeholder="" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="Button1">Button 1 URL</label>
                        <input type="text" id="button1_url" name="button1_url" class="form-control" placeholder="" />
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="Button2">Button 2 Text</label>
                        <input type="text" id="button2_text" name="button2_text" class="form-control" placeholder="" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="Button2">Button 2 URL</label>
                        <input type="text" id="button2_url" name="button2_url" class="form-control" placeholder="" />
                    </div>
                   

                    <div class="col-12">
                        <label class="form-label" for="modalAddressCountry">Status</label>
                        <select id="position" name="position" class="select2 form-select" data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="file">Photo</label>
                        <input class="form-control" type="file" id="file" name="file" value="" onchange="loadImg(event)">
                        <input class="form-control" type="hidden" id="img_name" name="img_name" value="">
                    </div>
                    <div class="col-12">
                        <img id="my_image" name="file" src="" style="display:none" class="" alt="" width="100" height="100" />
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" id="submit_form" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
                <!-- <form action="/upload" class="dropzone needsclick" id="dropzone_demo">

                </form> -->
            </div>
        </div>
    </div>
</div>