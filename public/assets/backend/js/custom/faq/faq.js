$(document).ready(function () {
    var token = $("meta[name='csrf-token']").attr("content");
    var load = $(".dt-faq").DataTable({
        processing: true,
        serverSide: true,
        // ajax: "bloglist",
        ajax: {
            url: admin_url + "/faq/list",
            type: "POST",
            data: {
                _token: token,
            },
        },
        columns: [
            { data: "faq_title", name: "faq_title" },
            { data: "content", name: "content" },
            {
                data: "show_home", name: "show_home",
                render: function (data, type, full, meta) {
                    if (data == 1) {
                        return "Yes";
                    } else {
                        return "No";
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
    // Validation...........................................................
    $("#addfaq form").validate({
        rules: {
            faq_title: {
                required: true,
            },
            content: {
                required: true,
            },
            show_home: {
                required: true,
            },
        },
        messages: {
            faq_title: {
                required: "Please enter faq_title name",
            },
            content: {
                required: "Please enter content name",
            },
            show_home: {
                required: "Please enter show_home name",
            },
        },
        submitHandler: function (form) {
            var data = new FormData(form);
            data.append("content", CKEDITOR.instances["content"].getData());
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
                        $("#addfaq").modal("toggle");
                        $("#addfaq form")[0].reset();
                        load.ajax.reload();
                    }
                },
            });
        },
    });
    // reset hide
    $("#addfaq").on("hidden.bs.modal", function () {
        $(this).find("form").trigger("reset");
        $("#id").val("");
        // $("#long_text").val("");
        CKEDITOR.instances["content"].setData("");
        $("label.error").hide();
        $(".error").removeClass("error");
    });
    // ..................................................................................Delete
    $(document).on("click", "#faq_delete", function () {
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
                    url: admin_url + "/faq/delete",
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
    $(document).on("click", "#faq_edit", function () {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = $(this).data("id");
        $("#addfaq").modal("show");
        $.ajax({
            url: admin_url + "/faq/edit",
            type: "post",
            data: {
                _token: token,
                id: id,
            },
            success: function (data) {
                var data = JSON.parse(data);
                $("#id").val(data.id);
                $("#faq_title").val(data.faq_title);
                CKEDITOR.instances["content"].setData(data.content);
                $("#show_home").val(data.show_home);
            },
        });
    });
});
