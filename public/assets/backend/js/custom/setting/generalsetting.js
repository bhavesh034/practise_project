$(document).ready(function () {
    $("#formlogo").validate({
        rules: {
            logo_img: {
                required: true
            },
        },
        messages: {
            logo_img: {
                required: "Please enter images",
            },
        },
        submitHandler: function (form) {
            var data = new FormData(form);
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
                        console.log(data.massage);
                        Swal.fire({
                            title: data.massage,
                            icon: "success",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                            buttonsStyling: false,
                        });
                        $("#formlogo")[0].reset();
                        $(".header_logo").load(location.href + " .header_logo");
                     
                    }
                },
            });
        },
    });

    // Add favicon Insert................................................
    $("#formfavicon").validate({
        rules: {
            favicon_img: {
                required: true                 
            },
        },
        messages: {
            favicon_img: {
                required: "Please enter images",
            },
        },
        submitHandler: function (form) {
            var data = new FormData(form);
            console.log(data);
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
                            icon: "success",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                            buttonsStyling: false,
                        });
                        $("#formfavicon")[0].reset();
                        $(".favicon_logo").load(location.href + " .favicon_logo");
                    }
                },
            });
        },
    });

    // Topbar Insert.....................................................................................
    $("#formtopbar").validate({
        rules: {
            email: {
                required: true,
            },
            number: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Please enter Email",
            },
            number: {
                required: "Please enter Number",
            },
        },
        submitHandler: function (form) {
            var data = new FormData(form);
            // var token = $("meta[name='csrf-token']").attr("content");
            console.log(data);
            $.ajax({
                url: form.action,
                type: form.method,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
                        $("#formtopbar")[0].reset();
                        // $(".topbardata").load("topbardata");
                        $(".topbardata").load(location.href + " .topbardata");

                        $("#formtopbar").reload();
                    }
                },
            });
        },
    });
    //  Email Insert.....................................................................................
    $("#formsendmail").validate({
        rules: {
            send_email: {
                required: true,
                required: email,
            },
            receive_email: {
                required: true,
                required: email,
            },
        },
        messages: {
            send_email: {
                required: "Please enter Email",
            },
            receive_email: {
                required: "Please enter Number",
            },
        },
        submitHandler: function (form) {
            var data = new FormData(form);
            // var token = $("meta[name='csrf-token']").attr("content");
            console.log(data);
            $.ajax({
                url: form.action,
                type: form.method,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
                        $("#formsendmail")[0].reset();
                        // $(".topbardata").load("topbardata");
                        $(".email").load(location.href + " .email");

                        $("#formsendmail").reload();
                    }
                },
            });
        },
    });
    // Form-color Insert.....................................................................................
    $("#formcolor").validate({
        rules: {
            email: {
                required: true,
            },
            number: {
                required: true,
            },
        },
        messages: {
            email: {
                required: "Please enter Email",
            },
            number: {
                required: "Please enter Number",
            },
        },
        submitHandler: function (form) {
            var data = new FormData(form);
            // var token = $("meta[name='csrf-token']").attr("content");
            console.log(data);
            $.ajax({
                url: form.action,
                type: form.method,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
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
                        $("#formcolor")[0].reset();
                        // $(".topbardata").load("topbardata");
                        $(".favcolor").load(location.href + " .favcolor");

                        $("#formcolor").reload();
                    }
                },
            });
        },
    });
    $("#social_mediaform").validate({
        rules: {
            facebook: {
                url: true
            },
            twiter: {
                url: true
            },
            linkidin: {
                url: true
            },
            Google_plus: {
                url: true
            },
            pinterest: {
                url: true
            },
            youTube: {
                url: true
            },
            instagram: {
                url: true
            },
            flickr: {
                url: true
            },
            reddit: {
                url: true
            },
            snapchat: {
                url: true
            },
            whatsApp: {
                url: true
            },
            quora: {
                url: true
            },
            stumbleupon: {
                url: true
            },
            delicious: {
                url: true
            },
            digg: {
                url: true
            },
        },
        messages: {
            email: {
                url: "Please enter URL",
            },
            twiter: {
                url: "Please enter URL",
            },
            linkidin: {
                url: "Please enter URL",
            },
            Google_plus: {
                url: "Please enter URL",
            },
            pinterest: {
                url: "Please enter URL",
            },
            youTube: {
                url: "Please enter URL",
            },
            instagram: {
                url: "Please enter URL",
            },
            flickr: {
                url: "Please enter URL",
            },
            reddit: {
                url: "Please enter URL",
            },
            snapchat: {
                url: "Please enter URL",
            },
            whatsApp: {
                url: "Please enter URL",
            },
            quora: {
                url: "Please enter URL",
            },
            stumbleupon: {
                url: "Please enter URL",
            },
            delicious: {
                url: "Please enter URL",
            },
            digg: {
                url: "Please enter URL",
            },
        },
        submitHandler: function (form) {
            var data = $("#social_mediaform").serializeArray();
            // var token = $("meta[name='csrf-token']").attr("content");
           
            $.ajax({
                url: BASE_URL + ADMIN + '/social_media/insert',
                type: "post",
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
                        $("#formcolor")[0].reset();
                        // $(".topbardata").load("topbardata");
                        $(".favcolor").load(location.href + " .favcolor");

                        $("#formcolor").reload();
                    }
                },
            });
        },
    });

});
function loadImg(event) {
    document.getElementById("logo_img").style.display = "";
    var output = document.getElementById("logo_img");
    if (!event.target.files[0]) return;
    output.src = URL.createObjectURL(event.target.files[0]);
    console.log(URL.createObjectURL(event.target.files[0]));
    output.onload = function () {
        URL.revokeObjectURL(output.src); // free memory
    };
}
function loadfavicon(event) {
    document.getElementById("favicon_img").style.display = "";
    var output = document.getElementById("favicon_img");
    if (!event.target.files[0]) return;
    output.src = URL.createObjectURL(event.target.files[0]);
    console.log(URL.createObjectURL(event.target.files[0]));
    output.onload = function () {
        URL.revokeObjectURL(output.src); // free memory
    };
}
