<div class="modal fade" id="addProduct" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title">Add Product</h3>
                </div>
                <form id="formProduct" class="row g-3" method="post" action="{{route('admin.product.insert')}}" enctype="multipart/form-data" onsubmit="return false">

                    @csrf
                    <input type="hidden" id="id" name="id" class="form-control" placeholder="" />


                    <div class="col-12">
                        <label class="form-label" for="product_name">Product Name</label>
                        <input type="text" id="product_name" onkeyup="listingslug(event)" name="product_name" class="form-control" placeholder="Please Enter Prduct Name" />
                    </div>
                    <div class="col-12">
                        <label class="form-label"  for="product_sluge">Product Sluge</label>
                        <input type="text" id="slug" onkeyup="sluglisting(event)" name="slug" class="form-control" placeholder="" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="product_sold">sold Bye</label>
                        <input type="text" id="sold" name="sold" class="form-control" placeholder="" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">Instructions</label>
                        <textarea class="form-control" id="instructions" name="instructions"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="product_sold">Price</label>
                        <input type="text" id="price" name="price" class="form-control" placeholder="" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="product_sold">Stock</label>
                        <input type="text" id="stock" name="stock" class="form-control" placeholder="" />
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
                        <div class="dropzone needsclick" id="dropzone_demo" name = "dropzone_demo"  style="text-align: center"></div>
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
                <!-- <form action="/upload" class="dropzone needsclick" id="dropzone_demo">

                </form> -->
            </div>
        </div>
    </div>
</div>