<div class="modal fade" id="addService" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title">Add Service</h3>
                </div>
                <form id="formservice" class="row g-3" enctype="multipart/form-data" onsubmit="return false">

                    @csrf
                    <input type="hidden" id="id" name="id" class="form-control" placeholder="" />
                    <div class="col-12">
                        <label class="form-label" for="portfolio_name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Please Enter Prduct Name" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="short_description">Short Description</label>
                        <textarea class="form-control" id="short_description" name="short_description"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="product_sold">Description</label>
                        <textarea class="form-control" rows="10" cols="60" ckeditor="true" id="description" placeholder="Enter the content" name="description"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="portfolio_name">Photo</label>
                        <input type="file" id="file" name="file" class="form-control" placeholder="Please Enter Prduct Name" onchange="loadImg(event)" />
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
            </div>
        </div>
    </div>
</div>