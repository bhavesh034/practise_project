$(document).ready(function () {
    var token = $("meta[name='csrf-token']").attr("content");

    var load = $('.portfolioCategories').DataTable({

        processing: true,
        serverSide: true,
        ajax: {
            url: BASE_URL + ADMIN + '/portfolio-categories/list',
            type: 'POST',
            data: {
                "_token": token,
            },
        },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]

    });



    $("#addCategories form").validate({
        rules: {
            categories_name: {
                required: true
            },
            status: {
                required: true
            }

        },
        messages: {
            categories_name: {
                required: "Please enter product name",
            },
            status: {
                required: "Please enter status",
            }
        },
        submitHandler: function (form) {

            var data = $("#portfolioCategories").serializeArray();

            $.ajax({
                url: BASE_URL + ADMIN + '/portfolio-categories/insert',
                type: "post",
                data: data,
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
                        load.ajax.reload();
                        $('#addCategories').modal('toggle');
                        $('#addCategories form')[0].reset();
                    }
                }
            });
        }
    });
    $(document).on('click', "#categories_edit",function () {
        var id = $(this).data('id');
        $('#addCategories').modal('show');

        $.ajax({
            url: BASE_URL + ADMIN + '/portfolio-categories/edit',
            type: 'post',
            data: {
                "_token": token,
                "id": id,
            },
            success: function (data) {
                var data = JSON.parse(data);
                $("#categories_id").val(data.id);
                $("#categories_name").val(data.name);
                $("#status").val(data.status);

            }
        })
    });

    $(document).on('click', "#categories_delete",function () {
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
                    url: BASE_URL + ADMIN + '/portfolio-categories/delete',
                    type: "post",
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

    $('#addCategories').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('#id').val("");
   
    })
})