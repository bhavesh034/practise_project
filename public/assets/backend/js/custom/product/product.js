var myDropzone = "";
$(document).ready(function () {

    var load = $('.produt_list').DataTable({

        processing: true,

        serverSide: true,

        ajax: "product/list",


        columns: [

            { data: 'product_name', name: 'product_name' },

            { data: 'price', name: 'price' },

            { data: 'stock', name: 'stock' },
            {
                data: 'status', name: 'status'        
            },
            { data: 'img', name: 'img', orderable: false, searchable: false },


            { data: 'action', name: 'action', orderable: false, searchable: false },

        ]

    });

    const previewTemplate = `<div class="dz-preview dz-file-preview">
    <div class="dz-details">
      <div class="dz-thumbnail">
        <img data-dz-thumbnail>
        <span class="dz-nopreview">No preview</span>
        <div class="dz-success-mark"></div>
        <div class="dz-error-mark"></div>
        <div class="dz-error-message"><span data-dz-errormessage></span></div>
        <div class="progress">
          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
        </div>
      </div>
      <div class="dz-filename" data-dz-name></div>
      <div class="dz-size" data-dz-size></div>
    </div>
    </div>`;


    myDropzone = new Dropzone("div#dropzone_demo", {
        url: "/upload",
        previewTemplate: previewTemplate,
        parallelUploads: 1,
        maxFilesize: 5,
        addRemoveLinks: true,

    })
    $("#addProduct form").validate({
        rules: {
            product_name: {
                required: true
            },
            slug: {
                required: true
            },
            sold: {
                required: true
            },
            instructions: {
                required: true
            },
            price: {
                required: true,
                number: true
            },
            stock: {
                required: true,
                number: true
            },
            status: {
                required: true
            }

        },
        messages: {
            product_name: {
                required: "Please enter product name",
            },
            slug: {
                required: "Please enter company name",

            },
            sold: {
                required: "Please enter sold",
            },
            instructions: {
                required: "Please enter instructions",
            },
            price: {
                required: "Please enter price",
                number: "Please only number"
            },
            stock: {
                required: "Please enter stock",
                number: "Please only number"

            },
            status: {
                required: "Please enter status",
            }
        },
        submitHandler: function (form) {

            var data = new FormData(form);

            data.append('image', JSON.stringify(myDropzone.files));



            $.ajax({
                url: form.action,
                type: form.method,
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
                        $('#addProduct').modal('toggle');
                        $('#addProduct form')[0].reset();
                        var myDropzone = Dropzone.forElement("#dropzone_demo");
                        myDropzone.removeAllFiles(true);
                        load.ajax.reload();
                    }
                }
            });
        }
    });


    $(document).on('click', '#product_delete', function () {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            customClass: {
                confirmButton: 'btn btn-primary me-3',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then(function (data) {
            if (data.value) {
                $.ajax({
                    url: "product/delete",
                    type: 'post',
                    data: {
                        "_token": token,
                        "id": id,
                    },
                    success: function (data) {
                        load.ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    },
                })
            }
        });


    })

    $(document).on('click', '#product_edit', function () {
        var token = $("meta[name='csrf-token']").attr("content");
        var id = $(this).data('id');
        $('#addProduct').modal('show');

        $.ajax({
            url: "product/edit",
            type: 'post',
            data: {
                "_token": token,
                "id": id,
            },
            success: function (data) {

                var data = JSON.parse(data);



                $("#id").val(data.id);
                $("#product_name").val(data.product_name);
                $("#slug").val(data.slug);
                $("#sold").val(data.sold);
                $("#instructions").val(data.instructions);
                $("#price").val(data.price);
                $('#stock').val(data.stock);
                $('#status').val(data.status);

                if (!data.image_name == "") {

                    var values = "";
                    $.each(data.image_name.split(","), function (i, e) {

                        values += '<div class = "col-2"  style="position:relative; margin: 15px;"><button id="delete_img" data-product = ' + e + ' type="button" class="close delete_img"><span>&times;</span></button><img id = "edit_img" src=' + data.pro_path + '/' + e + ' width="100"  height="100"></div>'
                    });
                    document.getElementById('my_image').innerHTML = values
                }


            },

        })
    });
    $(document).on('click', '#delete_img', function () {
        var name = $(this).data('product');
        console.log(name);
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: BASE_URL + ADMIN + '/product/image/delete',
            type: 'post',
            data: {
                "_token": token,
                "img_name": name,
            },
            success: function (data) {
                var data = JSON.parse(data);
                if (data.status == 1) {
                    if (!data.image_name.image_name == "") {
                        var values = "";
                        $.each(data.image_name.image_name.split(","), function (i, e) {
                            values += '<div class = "col-2" style="position:relative; margin: 15px;"><button id="delete_img" data-product = ' + e + ' type="button" class="close delete_img"><span>&times;</span></button><img src=' + data.pro_path + '/' + e + ' width="100"  height="100"></div>'
                        });
                        document.getElementById('my_image').innerHTML = values
                    }else{
                        document.getElementById('my_image').innerHTML = "";
                    }


                }

            },

        })

    })



    $('#addProduct').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('#id').val("");
        $('#edit_img').attr('src', '');
        $("#my_image").empty();
        var myDropzone = Dropzone.forElement("#dropzone_demo");
        myDropzone.removeAllFiles(true);
    })





    'use strict';
    (function () {



        // Multiple Dropzone
        // // --------------------------------------------------------------------
        const dropzoneMulti = new Dropzone('#dropzone_demo', {


            addRemoveLinks: true
        });

    })
})





function listingslug(event) {
    var key = $("#product_name").val();
    var Text = key.toLowerCase()

    var key = Text.replace(/[^a-zA-Z 0-9-]+/g, "");
    var key = key.replace(/ /g, "-");

    $("#slug").val(key);
}
function sluglisting(event) {
    var text = $("#slug").val();
    var Text = text.toLowerCase();
    $("#slug").val(Text);

}









