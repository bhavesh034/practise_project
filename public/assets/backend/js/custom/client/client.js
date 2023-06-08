$(document).ready(function () {
    // CLIENT LIST...................................................................................................
    var token = $("meta[name='csrf-token']").attr("content");
    var load = $(".dt-client").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: admin_url + "/client/list",
            type: "POST",
            data: {
                _token: token,
            },
        },
        columns: [
            { data: "client_name", name: "client_name" },

            { data: "client_url", name: "client_url" },

            {
                data: "client_img",
                name: "client_img",
                orderable: false, searchable: false,
                render: function (data, type, full, meta) {
                    return '<img src="' + data + '" height="50"/>';
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
    // CLIENT INSERT...................................................................................................
    $("#formclient").validate({
        rules: {
            client_name: {
                required: true,
            },
            client_url: {
                required: true,
            },
            client_img: {
                required: function (element) {
                    var valu = $("#img_name").val();
                    console.log(valu);
                    if (valu == "") {
                        return true;
                    } else {
                        return false;
                    }
                },
            },
        },
        messages: {
            client_name: {
                required: "Please enter client Name",
            },
            client_url: {
                required: "Please enter client Url",
            },
            client_img: {
                required: "Please enter Client Images",
            },
        },
        submitHandler: function (form) {
            var data = new FormData(form);
            console.log(data);
            data.append("client_img", $("#client_img")[0].files[0]);
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
                        $("#addclient").modal("toggle");
                        $("#addclient form")[0].reset();
                        $("#my_image").attr("src", "");
                        load.ajax.reload();
                    }
                },
            });
        },
    });
    // Set Hiden Value Set.....................................................
    $("#addclient").on("hidden.bs.modal", function () {
        $(this).find("form").trigger("reset");
        $("#id").val("");
        $("#img_name").val("");
        $("#my_image").hide();
        $("#my_image").attr("src", "");
        $("label.error").hide();
        $(".error").removeClass("error");
    });
    // Client Delete.............................................................
    $(document).on("click", "#client_delete", function () {
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
                    url: admin_url + "/client/delete",
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
    // Client Edit.............................................................
    $(document).on("click", "#client_edit", function () {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = $(this).data("id");
        $("#addclient").modal("show");
        document.getElementById("my_image").style.display = "";
        $.ajax({
            url: admin_url + "/client/edit",
            type: "post",
            data: {
                _token: token,
                id: id,
            },
            success: function (data) {
                var data = JSON.parse(data);
                $("#id").val(data.id);
                $("#client_name").val(data.client_name);
                $("#client_url").val(data.client_url);
                $("#img_name").val(data.client_img);
                // $('#file').text(data.img);
                $("#my_image").attr("src", data.pro_path);
            },
        });
    });
});
//Load-Image.........................................................................................................
function loadImg(event) {
    document.getElementById("my_image").style.display = "";
    var output = document.getElementById("my_image");
    if (!event.target.files[0]) return;
    output.src = URL.createObjectURL(event.target.files[0]);
    console.log(URL.createObjectURL(event.target.files[0]));
    output.onload = function () {
        URL.revokeObjectURL(output.src); // free memory
    };
}
