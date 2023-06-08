$(document).ready(function () {
    var token = $("meta[name='csrf-token']").attr("content");
    var load = $(".dt-responsive").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : BASE_URL + ADMIN + '/testimonial/list',
            type: 'POST',
            data: {
                "_token": token
            }
        },



        columns: [
            { data: "client_name", name: "client_name" },

            { data: "company_name", name: "company_name" },

            { data: "description", name: "description" },

            {
                data: "img",
                name: "img",
                render: function (data, type, full, meta) {
                    return '<img src="' + data + '" height="50"/>';
                },
            },
            {
                data: "Status",
                name: "Status",
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

    $("#addTestimonial form").validate({
        rules: {
            client_name: {
                required: true,
            },
            company_name: {
                required: true,
            },
            description: {
                required: true,
            },
            status: {
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
            client_name: {
                required: "Please enter client name",
            },
            company_name: {
                required: "Please enter company name",
            },
            description: {
                required: "Please enter description name",
            },
            status: {
                required: "Please enter status",
            },
            file: {
                required: "Please enter images",
            },
        },
        submitHandler: function (form) {
            var data = new FormData(form);
            // console.log(data);

            data.append("file", $("#file")[0].files[0]);
            $.ajax({
                url: BASE_URL + ADMIN + '/testimonial/insert',
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                data: data,
                success: function (data) {
                    if ((data.status = 1)) {
                        Swal.fire({
                            title: data.massage,
                            icon: 'success',
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                            buttonsStyling: false,
                        });
                        $("#addTestimonial").modal("toggle");
                        $("#addTestimonial form")[0].reset();
                        $("#my_image").attr("src", "");
                        load.ajax.reload();
                    }
                },
            });
        },
    });
    $("#addTestimonial").on("hidden.bs.modal", function () {
        $(this).find("form").trigger("reset");
        $("#id").val("");
        $("#img_name").val("");

        $("#my_image").hide();

        $("#my_image").attr("src", "");
        $("label.error").hide();
        $(".error").removeClass("error");
    });

    $(document).on("click", "#testimonial_delete", function () {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = $(this).data("id");
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
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
                    url: "testimonial_delete",
                    url: BASE_URL + ADMIN + '/testimonial/delete',
                    type: 'post',
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

    $(document).on("click", "#testimonial_edit", function () {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = $(this).data("id");
        $("#addTestimonial").modal("show");
        document.getElementById("my_image").style.display = "";

        $.ajax({
            url: BASE_URL + ADMIN + '/testimonial/edit',
            type: 'post',
            data: {
                _token: token,
                id: id,
            },
            success: function (data) {
                var data = JSON.parse(data);
                console.log(data.pro_path);

                $("#id").val(data.id);
                $("#client_name").val(data.client_name);
                $("#company_name").val(data.company_name);
                $("#description").val(data.description);
                $("#status").val(data.Status);
                $("#img_name").val(data.img);
                // $('#file').text(data.img);

                $("#my_image").attr("src", data.pro_path);

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
