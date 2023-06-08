$(document).ready(function () {
    let token = $("meta[name='csrf-token']").attr("content");
    var load = $(".dt-subscriber").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:admin_url + "/subscriber/list",
            type: "POST",
            data: {
                _token: token,
            },
        },
        // ajax: "blogcategorylist",

        columns: [
            { data: "email", name: "email" },
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
    // INSERT DATA............................................................................................
    var fs = $("#addsubscriber form").validate({
        // focusCleanup: true,
        ignore: ".ignore",
        rules: {
            email: {
                required: true,
                email: true,
                remote: function () {
                    return {
                        url: "checkemail",
                        type: "post",
                        data: {
                            _token: token,
                            email: $("input[email='email']").val(),
                            id: function () {
                                return $("input[name='id']").val();
                            },
                        },
                        // dataFilter: function (data) {
                        //     var json = JSON.parse(data);
                        //     if (json.exists == "1") {
                        //         return '"' + "Email address already in use" + '"';
                        //     } else {
                        //         return "true";
                        //     }
                        // },
                    };
                },
            },
            status: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Please enter email",
                remote: "Email address already in use!",
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
                        reset();
                        // $("#addsubscriber").modal("toggle");
                        // $("#addsubscriber form")[0].reset();
                        // $("#addsubscriber form")[0].reset();
                        load.ajax.reload();
                    }
                },
            });
        },
    });
    $("#addsubscriber").on("hidden.bs.modal", function () {
        $("#formsubscriber").validate().resetForm();
        $("#id").val("");
        $("#formsubscriber").trigger("reset");
        fs.resetForm();
    });
    // ..................................................................................Delete
    $(document).on("click", "#subscriber_delete", function () {
        // var token = $("meta[name='csrf-token']").attr("content");
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
                    url:admin_url + "/subscriber/delete",
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
    // Edit .....................................
    $(document).on("click", "#subscriber_edit", function () {
        // var token = $("meta[name='csrf-token']").attr("content");
        var id = $(this).data("id");
        $("#addsubscriber").modal("show");
        $.ajax({
            url:admin_url + "/subscriber/edit",
            type: "post",
            data: {
                _token: token,
                id: id,
            },
            success: function (data) {
                var data = JSON.parse(data);
                $("#id").val(data.id);
                $("#email").val(data.email);
                $("#status").val(data.status);
            },
        });
    });
});
// */.....................Reset........................\*
function reset() {
    $("#addsubscriber form")[0].reset();
    $("#addsubscriber").modal("show");
    $("#addsubscriber").modal("hide");
    $("#addsubscriber").modal("toggle");
}
