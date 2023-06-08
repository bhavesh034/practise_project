<div class="modal fade" id="addfeature" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title">Add Feature Information</h3>
                </div>
            <form id="formfeature"class="row g-3" method="post" action="{{ route('admin.feature-insert') }}"
                    enctype="multipart/form-data" onsubmit="return false">
                    @csrf
                    <input type="hidden" id="id" name="id" class="form-control" placeholder="" />
                    <div class="col-12">
                        <label class="form-label" for="client_name">Name:</label>
                        <input type="text" id="feature_name" name="feature_name" class="form-control"
                            placeholder="Enter Name" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">Content</label>
                        <textarea class="form-control" id="feature_content" name="feature_content"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">icon</label>
                        <input type="text" id="feature_icon" name="feature_icon" class="form-control"
                            placeholder="Enter Icon" />
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
