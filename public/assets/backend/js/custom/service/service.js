$(document).ready(function () {
    var token = $("meta[name='csrf-token']").attr("content");
    var load = $(".dt-responsive").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: BASE_URL + ADMIN + '/service/list',
            type: 'POST',
            data: {
                "_token": token
            }
        },

        columns: [
            { data: "id", name: "id" },

            { data: "name", name: "name" },

            {
                data: "img",
                name: "img",
                render: function (data, type, full, meta) {
                    console.log(data);
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


    $("#addService form").validate({
        rules: {
            name: {
                required: true
            },
            short_description: {
                required: true
            },
            description: {
                required: true
            },
            file: {
                required: function (element) {
                    var valu = $("#img_name").val();
                    if (valu == "") {
                        return true;
                    } else {
                        return false;
                    }
                },
            }

        },
        messages: {
            name: {
                required: "Please enter name",
            },
            short_description: {
                required: "Please enter Short Description",
            },
            description: {
                required: "Please enter Description",
            },
            file: {
                required: "Please select image",
            }
        },
        submitHandler: function (form) {

            var data = new FormData(form);
           
            data.append("description", CKEDITOR.instances["description"].getData());
           
            data.append("file", $("#file")[0].files[0]);        
          

            $.ajax({
                url: BASE_URL + ADMIN + '/service/insert',
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: data,
                success: function (data) {
             
                 
                    if (data.status = 1) {
                        Swal.fire({
                            title: data.massage,
                            icon: 'success',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                        load.ajax.reload();
                        $('#addService').modal('toggle');
                        $('#addService form')[0].reset();
                    }
                }
            });
        }
    });
    $("#addService").on("hidden.bs.modal", function () {
        $(this).find("form").trigger("reset");
        $("#id").val("");
        $("#img_name").val("");

        $("#my_image").hide();
        CKEDITOR.instances["description"].setData("");
        $("#my_image").attr("src", "");
        $("label.error").hide();
        $(".error").removeClass("error");
    });

    $(document).on("click", "#service_delete", function () {
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
                    url: BASE_URL + ADMIN + '/service/delete',
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
                            customClass: {
                                confirmButton: "btn btn-success",
                            },
                        });
                    },
                });
            }
        });
    });

    $(document).on("click", "#service_edit", function () {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = $(this).data("id");
        $("#addService").modal("show");
        document.getElementById("my_image").style.display = "";

        $.ajax({
            url: BASE_URL + ADMIN + '/service/edit',
            type: 'post',
            data: {
                _token: token,
                id: id,
            },
            success: function (data) {
                var data = JSON.parse(data);
                console.log(data);

                $("#id").val(data.id);
                $("#name").val(data.name);
                $("#short_description").val(data.short_description);
                CKEDITOR.instances["description"].setData(data.description);
                $("#img_name").val(data.image_name);

                $("#my_image").attr("src", data.pro_path);

            },
        });
    });

})
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