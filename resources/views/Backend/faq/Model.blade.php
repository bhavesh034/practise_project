<div class="modal fade" id="addfaq" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title">Add Team Member</h3>
                </div>
                <form id="formfaq"class="row g-3" method="post" action="{{ route('admin.faq-insert') }}"
                    enctype="multipart/form-data" onsubmit="return false">
                    @csrf
                    <input type="hidden" id="id" name="id" class="form-control" placeholder="" />
                    <div class="col-12">
                        <label class="form-label" for="client_name">FAQ Title:</label>
                        <input type="text" id="faq_title" name="faq_title" class="form-control"
                            placeholder="Please FAQ title" />
                    </div>
                    <div class="col-12">
                        <label for="long_text">Faq-Content</label>
                        <textarea class="form-control" rows="10" cols="60" ckeditor="true" id="content"
                            placeholder="Enter the Description" name="content"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalAddressCountry">Show Home</label>
                        <select id="show_home" name="show_home" class="select2 form-select" data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
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
