$(document).ready(function () {
    var token = $("meta[name='csrf-token']").attr("content");
    var load = $(".slider_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: BASE_URL + ADMIN + '/slider/list',
            type: 'POST',
            data: {
                "_token": token
            }
        },

        columns: [
            { data: "id", name: "id" },
            {
                data: "img",
                name: "img",
                orderable: false,
                searchable: false,
                render: function (data, type, full, meta) {
                    return '<img src="' + data + '" height="50"/>';
                },
            },

            { data: "heading", name: "heading" },

            { data: "button1_text", name: "button1_text" },

            { data: "button1_url", name: "button1_url" },

            { data: "button2_text", name: "button2_text" },
            
            { data: "button2_url", name: "button2_url" },

            { data: "position", name: "position" },           
       
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });


    $("#addSlider form").validate({
        rules: {
            file: {
                required: function (element) {
                    var valu = $("#img_name").val();
                    if (valu == "") {
                        return true;
                    } else {
                        return false;
                    }
                },
            },
            heading: {
                required: true
            },
            content: {
                required: true
            },        
            status: {
                required: true
            },
            button1_url: {
                url: true
            },
            button2_url: {
                url: true
            }           

        },
        messages: {
            file: {
                required: "Please Select image",
            },
            heading: {
                required: "Please enter heading",

            },
            content: {
                required: "Please enter content",
            },           
            status: {
                required: "Please enter status",
            },
            button1_url: {
                url: "Please enter valid url",
            },
            button2_url: {
                url: "Please enter valid url",
            } 
        },
        submitHandler: function (form) {

            var data = new FormData(form);
            data.append("file", $("#file")[0].files[0]);
            
            $.ajax({
                url: BASE_URL + ADMIN + '/slider/save',
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
                        $('#addSlider').modal('toggle');
                        $('#addSlider form')[0].reset();
                        load.ajax.reload();
                    }
                }
            });
        }
    });

    $(document).on("click", "#slider_delete", function () {
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
                    url: BASE_URL + ADMIN + '/slider/delete',
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

    $(document).on("click", "#slider_edit", function () {
        var id = $(this).data("id");
        $("#addSlider").modal("show");
        document.getElementById("my_image").style.display = "";

        $.ajax({
            url: BASE_URL + ADMIN + '/slider/edit',
            type: 'post',
            data: {
                _token: token,
                id: id,
            },
            success: function (data) {
                var data = JSON.parse(data);
               

                $("#id").val(data.id);
                $("#heading").val(data.heading);
                $("#content").val(data.content);
                $("#button1_text").val(data.button1_text);
                $("#button1_url").val(data.button1_url);
                $("#button2_text").val(data.button2_text);
                $("#button2_url").val(data.button2_url);
                $("#position").val(data.position);
                $("#img_name").val(data.img);
                $("#my_image").attr("src", data.pro_path);

            },
        });
    });

    $("#addSlider").on("hidden.bs.modal", function () {
        $(this).find("form").trigger("reset");
        $("#id").val("");
        $("#img_name").val("");

        $("#my_image").hide();

        $("#my_image").attr("src", "");
        $("label.error").hide();
        $(".error").removeClass("error");
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