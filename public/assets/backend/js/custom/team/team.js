$(document).ready(function () {
    // List
    var token = $("meta[name='csrf-token']").attr("content");
    var load = $(".dt-team").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:admin_url + "/team/list",
            type: "POST",
            data: {
                _token: token,
            },
        },
        columns: [
            { data: "name", name: "name" },

            { data: "designation", name: "designation" },

            { data: "detail", name: "detail" },

            {
                data: "img",
                name: "img",
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
    // Team Insert.............................................................
    $("#addmember form").validate({
        rules: {
            name: {
                required: true,
            },
            designation: {
                required: true,
            },
            detail: {
                required: true,
            },
            email: {
                required: true,
            },
            phone: {
                required: true,
            },
            file: {
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
            name: {
                required: "Please enter client name",
            },
            designation: {
                required: "Please enter designation name",
            },
            detail: {
                required: "Please enter detail ",
            },
            email: {
                required: "Please enter email",
            },
            phone: {
                required: "Please enter phone",
            },
            file: {
                required: "Please enter images",
            },
        },
        submitHandler: function (form) {
            var data = new FormData(form);
            console.log(data);
            data.append("file", $("#file")[0].files[0]);
            data.append("detail", CKEDITOR.instances["detail"].getData());
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
                        $("#addmember").modal("toggle");
                        $("#addmember form")[0].reset();
                        $("#my_image").attr("src", "");
                        load.ajax.reload();
                    }
                },
            });
        },
    });
    // Set Hiden Value Set.....................................................
    $("#addmember").on("hidden.bs.modal", function () {
        $(this).find("form").trigger("reset");
        $("#id").val("");
        $("#img_name").val("");

        $("#my_image").hide();

        $("#my_image").attr("src", "");
        CKEDITOR.instances["detail"].setData("");

        $("label.error").hide();
        $(".error").removeClass("error");
    });

    // Team Delete.............................................................
    $(document).on("click", "#team_delete", function () {
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
                    url: admin_url +"/team/delete",
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
    // Team Edit.............................................................
    $(document).on("click", "#team_edit", function () {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = $(this).data("id");
        $("#addmember").modal("show");
        document.getElementById("my_image").style.display = "";

        $.ajax({
            url:admin_url + "/team/edit",
            type: "post",
            data: {
                _token: token,
                id: id,
            },
            success: function (data) {
                var data = JSON.parse(data);
                $("#id").val(data.id);
                $("#name").val(data.name);
                $("#designation").val(data.designation);
                // $("#detail").val(data.detail);
                CKEDITOR.instances["detail"].setData(data.detail);
                $("#facebook").val(data.facebook);
                $("#twitter").val(data.twitter);
                $("#linkedin").val(data.linkedin);
                $("#googlsplus").val(data.googlsplus);
                $("#flickr").val(data.flickr);
                $("#instagram").val(data.instagram);
                $("#email").val(data.email);
                $("#phone").val(data.phone);
                $("#website").val(data.website);
                $("#img_name").val(data.img);
                // $('#file').text(data.img);

                $("#my_image").attr("src",  data.pro_path);
            },
        });
    });
});
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
