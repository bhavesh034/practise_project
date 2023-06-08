<div class="modal fade" id="addCategories" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>Add Categories</h3>
                </div>
                <form id="portfolioCategories" class="row g-3" onsubmit="return false">
                    @csrf
                    <input type="hidden" id="categories_id" name="categories_id" class="form-control" placeholder="" />

                    <div class="col-12">
                        <label class="form-label" for="product_sold">Categories Name</label>
                        <input type="text" id="categories_name" name="categories_name" class="form-control" placeholder="" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalAddressCountry">Status</label>
                        <select id="status" name="status" class="select2 form-select" data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="1">Active</option>
                            <option value="2">In Active</option>
                        </select>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 mt-3">Submit</button>
                        <button type="reset" class="btn btn-label-secondary btn-reset mt-3" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>