const startDate = document.querySelector('#start_date'),
    endDate = document.querySelector('#end_date');
if (startDate) {
    startDate.flatpickr({
        monthSelectorType: 'static'
    });
}
if (endDate) {
    endDate.flatpickr({
        monthSelectorType: 'static'
    });
}

var myDropzone = "";
$(document).ready(function () {
    var token = $("meta[name='csrf-token']").attr("content");


    var load = $('.portfolio_list').DataTable({

        processing: true,

        serverSide: true,

        ajax: {
            url: BASE_URL + ADMIN + '/portfolio/list',
            type: 'POST',
            data: {
                "_token": token,
            },
        },


        columns: [

            { data: 'name', name: 'name' },

            { data: 'short_content', name: 'short_content' },

            { data: 'client_name', name: 'client_name' },
            { data: 'client_company', name: 'client_company' },
            { data: 'cost', name: 'cost' },
            { data: 'categories', name: 'categories' },
            { data: 'status', name: 'status' },


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

    $("#addPortfolio form").validate({
        rules: {
            name: {
                required: true
            },
            short_content: {
                required: true
            },
            client_name: {
                required: true
            },
            client_company: {
                required: true,

            },
            start_date: {
                required: true,
            },
            end_date: {
                required: true
            },
            cost: {
                required: true,
                number: true
            },
            client_content: {
                required: true
            },
            categories: {
                required: true
            },

        },
        messages: {
            name: {
                required: "Please enter name",
            },
            short_content: {
                required: "Please enter short content",

            },
            client_name: {
                required: "Please enter Client name",
            },
            client_company: {
                required: "Please enter client company",
            },
            start_date: {
                required: "Please enter start date",

            },
            end_date: {
                required: "Please enter end date",
            },
            cost: {
                required: "Please enter cost",
                number: "Please enter number "
            },
            client_content: {
                required: "Please enter client content",
            },
            categories: {
                required: "Please select categories",
            },
        },
        submitHandler: function (form) {

            var data = new FormData(form);

            data.append('image', JSON.stringify(myDropzone.files));
            data.append("content", CKEDITOR.instances["content"].getData());



            $.ajax({
                url: BASE_URL + ADMIN + '/portfolio/insert',
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
                        $('#addPortfolio').modal('toggle');
                        $('#addPortfolio form')[0].reset();
                        var myDropzone = Dropzone.forElement("#dropzone_demo");
                        myDropzone.removeAllFiles(true);
                        load.ajax.reload();
                    }
                }
            });
        }
    });

    $(document).on('click', '#portfolio_edit', function () {
        var id = $(this).data('id');
        $('#addPortfolio').modal('show');

        $.ajax({
            url: BASE_URL + ADMIN + '/portfolio/edit',
            type: 'post',
            data: {
                "_token": token,
                "id": id,
            },
            success: function (data) {
                var data = JSON.parse(data);
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#short_content').val(data.short_content);
                CKEDITOR.instances["content"].setData(data.content);
                $('#client_name').val(data.client_name);
                $('#client_company').val(data.client_company);
                $('#start_date').val(data.start_date);
                $('#end_date').val(data.end_date);
                $('#web_site').val(data.web_site);
                $('#cost').val(data.cost);
                $('#client_content').val(data.client_content);
                $('#categories').val(data.categories);

                if (!data.image_name == "") {

                    var values = "";
                    $.each(data.image_name.split(","), function (i, e) {

                        values += '<div class = "col-2"  style="position:relative; margin: 15px;"><button id="delete_img" data-product = ' + e + ' type="button" class="close delete_img"><span>&times;</span></button><img id = "edit_img" src=' + data.pro_path + '/' + e + ' width="100"  height="100"></div>'
                    });
                    document.getElementById('my_image').innerHTML = values
                }

            },
        })

    })
    $(document).on('click', '#portfolio_delete', function () {
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
                    url: BASE_URL + ADMIN + '/portfolio/delete',
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

    $(document).on('click', '#delete_img', function () {
        var name = $(this).data('product');

        $.ajax({
            url: BASE_URL + ADMIN + '/portfolio/image/delete',
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
                    } else {
                        document.getElementById('my_image').innerHTML = "";
                    }

                }

            },

        })

    })

    $('#addPortfolio').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('#id').val("");
        $('#edit_img').attr('src', '');
        $("#my_image").empty();
        var myDropzone = Dropzone.forElement("#dropzone_demo");
        myDropzone.removeAllFiles(true);
    })






})  