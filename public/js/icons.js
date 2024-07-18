$(function() {

    /**
     * Swal confirmation
     * @param {any} swalText
     * @param {any} swalIcon
     * @param {any} confirmBtnText
     * @param {any} cancelBtnText
     * @returns {any}
     */
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

    /**
     * Swal prompt
     * @param {any} sText
     * @param {any} sIcon
     * @returns {any}
     */
    function swalPrompt(sText,sIcon) {
        return Swal.fire({
            text: sText,
            icon: sIcon,
            confirmButtonText: 'Ok',
            heightAuto: false,
        });
    }

    /**
     * Onclick show modal
     * @param {any} '#btnShowIconForm'
     * @returns {any}
     */
    $('#btnShowIconForm').on('click', function () {
        $('#modalIconForm').modal('toggle');
    });

    /**
     * On file input change preview image
     * @param {any} '#file'
     * @returns {any}
     */
    $('#file').on('change', function (e) {
        let thisFile = this;
        let imgPreview = $('#imagePreview');

        if (thisFile.files && thisFile.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                imgPreview.attr('src',e.target.result);
            }
            reader.readAsDataURL(thisFile.files[0]);
        }

        imgPreview.attr('src','https://archive.org/download/placeholder-image/placeholder-image.jpg');
    });

    /**
     * On modal create icon hidden return image src to original image
     * @param {any} '#modalIconForm'
     * @returns {any}
     */
    $('#modalIconForm').on('hidden.bs.modal', function () {
        $('#imagePreview').attr('src','https://archive.org/download/placeholder-image/placeholder-image.jpg');
    });


    /**
     * Submit new icon
     * @param {any} '#btnSubmitIcon'
     * @returns {any}
     */
    $('#btnSubmitIcon').on('click', function () {
        let swalText = "Do you want to create this marker icon ?";
        let swalIcon = "info";
        let confirmBtnText = "Create";
        let cancelBtnText = "Cancel";

        const thisBtn = $(this);
        const title = $('#title').val();
        const file = $('#file')[0].files;

        thisBtn.prop('disabled',true);

        swalConfirmation(swalText, swalIcon, confirmBtnText, cancelBtnText).then((result) => {
            if (result.isConfirmed) {
                const fd = new FormData();

                fd.append('title', title);
                fd.append('file', file[0]);

                $.ajax({
                    url: window.urlBase + "/admin/icons/create",
                    type: "post",
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

                        if (res.status != undefined) {
                            let sText = res.message;
                            let sIcon = res.status;
                            swalPrompt(sText, sIcon).then((result) => {
                                if (res.status == 'success') {
                                    window.location.reload();
                                }
                            });
                        }
                    },
                    error: function (error) {
                        const response = JSON.parse(error.responseText);
                        let sText = response.message;
                        let sIcon = "error";
                        swalPrompt(sText, sIcon);
                    },
                    complete: function() {
                        thisBtn.prop('disabled',false);
                    }
                });
            }

            if (result.isDismissed) {
                thisBtn.prop('disabled',false);
            }
        });
    });

    $('.removeIcon').on('click', function () {
        let swalText = "Do you want to remove this marker icon ?";
        let swalIcon = "info";
        let confirmBtnText = "Remove";
        let cancelBtnText = "Cancel";

        swalConfirmation(swalText, swalIcon, confirmBtnText, cancelBtnText).then((result) => {
            if (result.isConfirmed) {
                const fd = new FormData();

                const uuid = $(this).attr('data-uuid');

                fd.append('uuid',uuid);

                $.ajax({
                    url: window.urlBase + "/admin/icons/remove",
                    type: "post",
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

                        if (res.status !== undefined) {
                            let sText = res.message;
                            let sIcon = res.status;
                            swalPrompt(sText, sIcon).then((result) => {
                                if (result.isConfirmed && res.status == 'success') {
                                    window.location.reload();
                                }
                            });
                        }
                    },
                    error: function (error) {
                        const response = JSON.parse(error.responseText);
                        let sText = response.message;
                        let sIcon = "error";
                        swalPrompt(sText, sIcon);
                    }
                });
            }
        });
    });
});
