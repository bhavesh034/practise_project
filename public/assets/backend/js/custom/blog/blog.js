$(document).ready(function () {
    var token = $("meta[name='csrf-token']").attr("content");
    var load = $(".dt-blog").DataTable({
        processing: true,
        serverSide: true,
        // ajax: "bloglist",
        ajax: {
            url:admin_url + "/blog/list",
            type: "POST",
            data: {
                _token: token,
            },
        },
        columns: [
            { data: "blog_title", name: "blog_title" },
            { data: "slug", name: "slug" },
            { data: "long_text", name: "long_text" },
            { data: "category_name", name: "category_name" },
            { data: "subcategory_name", name: "subcategory_name" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
    // Validation...........................................................
    $("#addcategory form").validate({
        rules: {
            blog_title: {
                required: true,
            },
            long_text: {
                required: true,
            },
            category_name: {
                required: true,
            },
            subcategory_name: {
                required: true,
            },
        },
        messages: {
            blog_title: {
                required: "Please enter blog_name name",
            },
            long_text: {
                required: "Please enter long_text name",
            },
            category_name: {
                required: "Please enter category name",
            },
            subcategory_name: {
                required: "Please enter subcategory_name",
            },
        },
        submitHandler: function (form) {
            var data = new FormData(form);
            data.append("long_text", CKEDITOR.instances["long_text"].getData());
            console.log(data);
            $.ajax({
                url: form.action,
                type: form.method,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                data: data,
                success: function (data) {
                    if ((data.status = 1)) {
                        Swal.fire({
                            title: data.massage,
                            text: "You clicked the button!",
                            icon: "success",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                            buttonsStyling: false,
                        });
                        $("#addcategory").modal("toggle");
                        $("#addcategory form")[0].reset();
                        load.ajax.reload();
                    }
                },
            });
        },
    });
    // reset hide
    $("#addcategory").on("hidden.bs.modal", function () {
        $(this).find("form").trigger("reset");
        $("#id").val("");
        // $("#long_text").val("");
        CKEDITOR.instances["long_text"].setData("");
        $("label.error").hide();
        $(".error").removeClass("error");
    });
    // ..................................................................................Delete
    $(document).on("click", "#blog_delete", function () {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = $(this).data("id");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            customClass: {
                confirmButton: "btn btn-primary me-3",
                cancelButton: "btn btn-label-secondary",
            },
            buttonsStyling: false,
        }).then(function (data) {
            if (data.value) {
                $.ajax({
                    url: admin_url +"/blog/delete",
                    type: "post",
                    data: {
                        _token: token,
                        id: id,
                    },
                    success: function (data) {
                        load.ajax.reload();
                        Swal.fire({
                            icon: "success",
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            customClass: {
                                confirmButton: "btn btn-success",
                            },
                        });
                    },
                });
            }
        });
    });
    // Edit............................................................................................
    $(document).on("click", "#blog_edit", function () {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = $(this).data("id");
        $("#addcategory").modal("show");
        $.ajax({
            url:admin_url + "/blog/edit",
            type: "post",
            data: {
                _token: token,
                id: id,
            },
            success: function (data) {
                var data = JSON.parse(data);
                $("#id").val(data.id);
                $("#blog_title").val(data.blog_title);
                $("#slug").val(data.slug);
                console.log(data.long_text);
                CKEDITOR.instances["long_text"].setData(data.long_text);
                $("#category_name").val(data.category_id);
                $("#subcategory_name").val(data.subcategory_id);
            },
        });
    });
});
function listingslug(event) {
    var key = $("#blog_title").val();

    var key = key.replace(/[^a-zA-Z 0-9-]+/g, "");
    var key = key.replace(/ /g, "-");

    $("#slug").val(key);
}
