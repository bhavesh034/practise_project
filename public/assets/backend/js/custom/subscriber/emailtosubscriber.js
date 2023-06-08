$(document).ready(function () {
    $("#formemailtosubscriber").validate({
        rules: {
            title: {
                required: true,
            },
            long_text: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "Please enter title",
            },
            long_text: {
                required: "Please Sender long_text",
            },
        },
        submitHandler: function (form) {
            var data = new FormData(form);
            data.append("long_text", CKEDITOR.instances["long_text"].getData());
            // var data = $(form).serializeArray();
            console.log(data);
            $.ajax({
                url:form.action,
                type: form.method,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                data: data,
                success: function (data) {
                    var data = JSON.parse(data);
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
                    }
                },
            });
        },
    });
});
