<div class="modal fade" id="addcategory" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title">Add Category</h3>
                </div>
                <form id="formcategory" class="row g-3" method="post" action="{{route('admin.category_insert')}}" enctype="multipart/form-data" onsubmit="return false">

                    @csrf
                    <input type="hidden" id="id" name="id" class="form-control" placeholder="" />
                    <div class="col-12">
                        <label class="form-label" for="client_name">Category Name</label>
                        <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Please Enter Category Name" />
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
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
