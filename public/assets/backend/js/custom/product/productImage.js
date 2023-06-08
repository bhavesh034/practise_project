var myDropzone = "";

$(document).ready(function () {

    var product_id = $("#product_id").val();
    var token = $("meta[name='csrf-token']").attr("content");
    var load = $('#imageTable').DataTable({

        processing: true,
        serverSide: true,
        ajax: {
            url: BASE_URL + ADMIN + '/product/image/list',
            type: 'POST',
            data: {
                "_token": token,
                "id": product_id,
            },
        },
        columns: [
            {
                data: 'image', name: 'image', orderable: false, searchable: false,

            },
            { data: 'action', name: 'action', orderable: false, searchable: false },

        ]

    });

    $(document).on('click', '#image_delete', function () {
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
                    url: BASE_URL + ADMIN + '/product/image/view/delete',
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

    $("#imageAdd").submit(function (e) {
        var image = JSON.stringify(myDropzone.files);
        var token = $("meta[name='csrf-token']").attr("content");
        var id = $("#product_id").val();

        $.ajax({
            url: BASE_URL + ADMIN + '/product/image/view/insert',
            type: 'post',
            data: {
                "_token": token,
                "id": id,
                "image": image
            },
            success: function (data) {
                var data = JSON.parse(data);

                if (data.status = 1) {
                    Swal.fire({
                        title: data.massage,
                        icon: 'success',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    $('#imageAdd').modal('toggle');
                    var myDropzone = Dropzone.forElement("#dropzone_demo");
                    myDropzone.removeAllFiles(true);
                    load.ajax.reload();
                }
            },
        })



    })
})