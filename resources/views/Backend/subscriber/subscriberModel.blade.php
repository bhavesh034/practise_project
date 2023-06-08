<div class="modal fade" id="addsubscriber" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title">Add Email</h3>
                </div>
                <form id="formsubscriber" class="row g-3" method="post" action="{{route('admin.subscriber-insert')}}" enctype="multipart/form-data" onsubmit="return false">

                    @csrf
                    <input type="hidden" id="id" name="id" value="" />
                    <div class="col-12">
                        <label class="form-label" for="client_name">Subscriber Email</label>
                        <input type="text" id="email" name="email"  class="form-control" placeholder="Please Enter email Name" />
                        <div id="email-error-div">
                            <label for="email" class="error"></label>
                        </div>
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
