$(function() {
    function swalConfirmation(swalText,swalIcon,confirmBtnText,cancelBtnText) {
        return Swal.fire({
            icon: swalIcon,
            text: swalText,
            confirmButtonText: confirmBtnText,
            cancelButtonText: cancelBtnText,
            showCancelButton: true,
            heightAuto: false,
        });
    }

    function swalPrompt(sText,sIcon) {
        return Swal.fire({
            text: sText,
            icon: sIcon,
            confirmButtonText: 'Ok',
            heightAuto: false,
        });
    }

    /**
     * Update admin name
     * @param {any} '#btnSubmitNameUpdate'
     * @returns {any}
     */
    $('#btnSubmitNameUpdate').on('click', function () {
        let swalText = "Do you want to update details ?";
        let swalIcon = "info";
        let confirmBtnText = "Update";
        let cancelBtnText = "Cancel";
        swalConfirmation(swalText,swalIcon,confirmBtnText,cancelBtnText).then((result) => {
            if (result.isConfirmed) {
                const fd = new FormData();

                fd.append('last_name' ,$('#last_name').val());
                fd.append('first_name' ,$('#first_name').val());
                fd.append('middle_name' ,$('#middle_name').val());

                $.ajax({
                    type: "POST",
                    url: window.urlBase + "/admin/account/name/update",
                    data: fd,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        const res = response;

                        console.log(res);

                        let sText = res.message;
                        let sIcon = res.status;
                        swalPrompt(sText, sIcon).then((result) => {
                            if (result.isConfirmed) {
                                if (res.status !== undefined && res.status == 'success') {

                                    window.location.reload();
                                }
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
            }
        });

    });

    $('#btnSubmitPasswordUpdate').on('click', function () {
        let swalText = "Do you want to change your password ?";
        let swalIcon = "info";
        let confirmBtnText = "Change";
        let cancelBtnText = "Cancel";
        swalConfirmation(swalText,swalIcon,confirmBtnText,cancelBtnText).then((result) => {
            if (result.isConfirmed) {
                const fd = new FormData();

                fd.append("cPassword", $("#cPassword").val());
                fd.append("nPassword", $("#nPassword").val());
                fd.append("vPassword", $("#vPassword").val());

                $.ajax({
                    type: "POST",
                    url: window.urlBase + "/admin/account/password/update",
                    data: fd,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        const res = response;

                        console.log(res);

                        let sText = res.message;
                        let sIcon = res.status;
                        swalPrompt(sText, sIcon).then((result) => {
                            if (result.isConfirmed) {
                                if (
                                    res.status !== undefined &&
                                    res.status == "success"
                                ) {
                                    window.location.reload();
                                }
                            }
                        });
                    },
                    error: function (error) {
                        const response = JSON.parse(error.responseText);
                        let sText = response.message;
                        let sIcon = "error";
                        swalPrompt(sText, sIcon);
                    },
                });
            }
        });
    });
});
