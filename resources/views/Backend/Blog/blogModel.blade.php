<div class="modal fade" id="addcategory" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title">Add Category</h3>
                </div>
                <form id="formblog" class="row g-3" method="post" action="{{ route('admin.blog_insert') }}"
                    enctype="multipart/form-data" onsubmit="return false">

                    @csrf
                    <input type="hidden" id="id" name="id" class="form-control" placeholder="" />
                    <div class="col-12">
                        <label class="form-label" for="client_name">Blog Name</label>
                        <input type="text" id="blog_title" name="blog_title" class="form-control"
                            onkeyup="listingslug(event)" placeholder="Please Enter blog Name" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control"
                            placeholder="Please Enter slug Name" />
                    </div>
                    <div class="col-12">
                        <label for="long_text">Long-Text</label>
                        <textarea class="form-control" rows="10"  cols="60" ckeditor="true" id="long_text" placeholder="Enter the Description" name="long_text"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">Category Name</label>
                        <select id="category_name" name="category_name" class="select2 form-select"
                            data-allow-clear="true">
                            <option value="">Select</option>
                            @foreach ($categories as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="client_name">SubCategory Name</label>
                        <select id="subcategory_name" name="subcategory_name" class="select2 form-select"
                            data-allow-clear="true">
                            <option value="">Select</option>
                            @foreach ($subcategories as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->subcategory_name }}</option>
                            @endforeach
                        </select>
                    </div>
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
