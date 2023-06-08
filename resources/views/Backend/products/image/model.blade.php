<div class="modal fade" id="imageAdd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title">Add Image</h3>
                </div>
                <form id="imageAdd" class="row g-3" method="post" action="{{route('admin.product.insert')}}" enctype="multipart/form-data" onsubmit="return false">

                    @csrf                   
                    <div class="col-12">
                        <div class="dropzone needsclick" id="dropzone_demo" name = "dropzone_demo"  style="text-align: center"></div>
                    </div>
                    <div class="col-12" id="my_image" style="display: flex;">
                      
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