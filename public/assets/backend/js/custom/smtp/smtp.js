$(document).ready(function () {
    $("#formSMTPSettings").validate({
        rules: {
            smtp_host: {
                required: true,
            },
            port: {
                required: true,
            },
            username: {
                required: true,
            },
            emailAddress: {
                required: true,
            },
            password: {
                required: true,
            },
            senderName: {
                required: true,
            },
        },
        messages: {
            smtp_host: {
                required: "Please enter Smtp host",
            },
            port: {
                required: "Please enter Port",
            },
            username: {
                required: "Please enter Username",
            },
            emailAddress: {
                required: "Please enter Email",
            },
            password: {
                required: "Please enter Password",
            },
            senderName: {
                required: "Please Sender Name",
            },
        },
        submitHandler: function (form) {
            // var data = new FormData(form);
            var data = $(form).serializeArray();
            $.ajax({
                url: BASE_URL + ADMIN + '/smtp/insert',
                type: "post",
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

    $("#formTestMail").validate({
        rules: {
            testMail: {
                required: true,
            },
        },
        messages: {
            testMail: {
                required: "Please enter Email",
            },
        },
        submitHandler: function (form) {
            var data = $(form).serializeArray();
            $.ajax({
                url: BASE_URL + ADMIN + '/smtp/mail',
                type: "post",
                data: data,
                success: function (data) {
                    var data = JSON.parse(data);
                    console.log(data.status);

                    if (data.status == 1) {
                        $("#testmail").val("");

                        Swal.fire({
                            title: data.massage,
                            text: "You clicked the button!",
                            icon: "success",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                            buttonsStyling: false,
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: data.massage,
                            icon: "error",
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
