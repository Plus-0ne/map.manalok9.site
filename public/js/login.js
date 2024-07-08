$(function () {

    function swalPrompt(sText,sIcon) {
        return Swal.fire({
            text: sText,
            icon: sIcon,
            confirmButtonText: 'Ok',
            heightAuto: false,
        });
    }


    $('#submitCredentials').on('click', function () {
        const fd = new FormData();

        fd.append('email_address',$('#email_address').val());
        fd.append('password',$('#password').val());

        $.ajax({
            url: window.urlBase + "/admin/validation",
            type: "post",
            data: fd,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                const res = response;

                console.log(res);

                let sText = res.message;
                let sIcon = res.status;
                swalPrompt(sText, sIcon).then((result) => {
                    if (res.status == 'success') {
                        window.location.href = window.urlBase;
                    } else {
                        $('#password').val("")
                    }
                });

            },
            error: function (error) {
                const response = JSON.parse(error.responseText);
                let sText = response.message;
                let sIcon = 'error';
                swalPrompt(sText, sIcon);
            }
        });
    });
});
