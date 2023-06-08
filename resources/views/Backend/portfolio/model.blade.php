<div class="modal fade" id="addPortfolio" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title">Add Portfolio</h3>
                </div>
                <form id="formPortfolio" class="row g-3" enctype="multipart/form-data" onsubmit="return false">

                    @csrf
                    <input type="hidden" id="id" name="id" class="form-control" placeholder="" />
                    <div class="col-12">
                        <label class="form-label" for="portfolio_name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Please Enter Prduct Name" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="short_content">Short Content</label>
                        <textarea class="form-control" id="short_content" name="short_content"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="product_sold">content</label>
                        <textarea class="form-control" rows="10" cols="60" ckeditor="true" id="content" placeholder="Enter the content" name="content"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">Client Name</label>
                        <input type="text" id="client_name" name="client_name" class="form-control" placeholder="">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_company">Client Company</label>
                        <input type="text" id="client_company" name="client_company" class="form-control" placeholder="">
                    </div>
                    <div class="col-12 mb-4">
                        <label for="flatpickr-date" class="form-label">Start Date</label>
                        <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="start_date" name="start_date" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="end_date">End Date</label>
                        <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="end_date" name="end_date" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="web_site">Web Site</label>
                        <input type="url" id="web_site" name="web_site" class="form-control" placeholder="" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="cost">Cost</label>
                        <input type="text" id="cost" name="cost" class="form-control" placeholder="" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_content">Client Content</label>
                        <input type="text" id="client_content" name="client_content" class="form-control" placeholder="" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalAddressCountry">Categories</label>
                        <select id="categories" name="categories" class="select2 form-select" data-allow-clear="true">
                            <option value="">Select</option>
                            @foreach ($category_id as $key => $category)
                            <option value="{{$category->id}}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="dropzone needsclick" id="dropzone_demo" name="dropzone_demo" style="text-align: center"></div>
                    </div>
                    <div class="row justify-content-center" id="my_image" style="display: flex;">

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