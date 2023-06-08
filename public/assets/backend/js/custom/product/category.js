$(document).ready(function () {
    var token = $("meta[name='csrf-token']").attr("content");
    var load = $(".dt-category").DataTable({
        processing: true,
        serverSide: true,
        // "searching": true,
        // searchable: true,
        ajax: {
            url: admin_url + "/product/category/list",
            type: 'POST',
            data: {
                "_token": token
            }
        },
        columns: [
            { data: "category_name", name: "category_name" },
            {
                data: "status",
                name: "status",
                render: function (data, type, full, meta) {
                    if (data == 1) {
                        return "Active";
                    } else {
                        return "In Active";
                    }
                },
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
    // $('.dt-category input[type=search]').on( 'keyup click', function () {
    //       .column('1')
    //       .search( "^" + this.value, true, false, true )
    //       .draw();
    //   });
    // Validation...........................................................
    $("#addcategory form").validate({
        rules: {
            category_name: {
                required: true,
            },
            status: {
                required: true,
            },
        },
        messages: {
            category_name: {
                required: "Please enter category name",
            },
            status: {
                required: "Please enter status",
            },
        },
        submitHandler: function (form) {
            var data = new FormData(form);
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
    $("#addcategory").on("hidden.bs.modal", function () {
        $(this).find("form").trigger("reset");
        $("#id").val("");
        $("label.error").hide();
        $(".error").removeClass("error");
    });
    // ..................................................................................Delete
    $(document).on("click", "#category_delete", function () {
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
                    url: admin_url + "/product/category/delete",
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
    $(document).on("click", "#category_edit", function () {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = $(this).data("id");
        $("#addcategory").modal("show");
        $.ajax({
            url: admin_url + "/product/category/edit",
            type: "post",
            data: {
                _token: token,
                id: id,
            },
            success: function (data) {
                var data = JSON.parse(data);
                $("#id").val(data.id);
                $("#category_name").val(data.category_name);
                $("#status").val(data.status);
            },
        });
    });
});
