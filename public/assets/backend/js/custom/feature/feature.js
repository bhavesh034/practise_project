$(document).ready(function () {
    // List...............................................................
    var token = $("meta[name='csrf-token']").attr("content");
    var load = $(".dt-features").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: admin_url + "/feature/list",
            type: "POST",
            data: {
                _token: token,
            },
        },
        columns: [
            { data: "feature_name", name: "feature_name" },
            { data: "feature_content", name: "feature_content" },
            {
                data: "feature_icon", name: "feature_icon",
                orderable: false, searchable: false,
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
    // Validation...........................................................
    $("#formfeature").validate({
        rules: {
            feature_name: {
                required: true,
            },
            feature_content: {
                required: true,
            },
            feature_icon: {
                required: true,
            },
        },
        messages: {
            feature_name: {
                required: "Please enter feature name name",
            },
            feature_content: {
                required: "Please enter feature content name",
            },
            feature_icon: {
                required: "Please enter feature icon name",
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
                    if ((data.show_home = 1)) {
                        Swal.fire({
                            title: data.massage,
                            text: "You clicked the button!",
                            icon: "success",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                            buttonsStyling: false,
                        });
                        $("#addfeature").modal("toggle");
                        $("#addfeature form")[0].reset();
                        load.ajax.reload();
                    }
                },
            });
        },
    });
    // Set Hiden Value Set.....................................................
    $("#addfeature").on("hidden.bs.modal", function () {
        $(this).find("form").trigger("reset");
        $("#id").val("");
        $("label.error").hide();
        $(".error").removeClass("error");
    });
    // ..................................................................................Delete
    $(document).on("click", "#feature_delete", function () {
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
                    url: admin_url + "/feature/delete",
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
    $(document).on("click", "#feature_edit", function () {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = $(this).data("id");
        $("#addfeature").modal("show");
        $.ajax({
            url: admin_url + "/feature/edit",
            type: "post",
            data: {
                _token: token,
                id: id,
            },
            success: function (data) {
                var data = JSON.parse(data);
                $("#id").val(data.id);
                $("#feature_name").val(data.feature_name);
                $("#feature_content").val(data.feature_content);
                $("#feature_icon").val(data.feature_icon);
            },
        });
    });
});
