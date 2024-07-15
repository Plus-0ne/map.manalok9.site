$(function() {
    let admins = new DataTable('#admins',{
        responsive: true
    });

    /**
     * On button click show admin modal form
     * @param {any} '#btnShowAdminForm'
     * @returns {any}
     */
    $('#btnShowAdminForm').on('click', function () {
        $('#modalAdminForm').modal('toggle');
    });

    /**
     * Submit admin form details
     * @param {any} '#btnSubmitAdminForm'
     * @returns {any}
     */
    $('#btnSubmitAdminForm').on('click', function () {
        let swalText = "Do you want to create this admin ?";
        let swalIcon = "info";
        let confirmBtnText = "Create";
        let cancelBtnText = "Cancel";

        swalConfirmation(swalText, swalIcon, confirmBtnText, cancelBtnText).then((result) => {
            if (result.isConfirmed) {
                const fd = new FormData();

                fd.append('last_name', $('#last_name').val());
                fd.append('first_name', $('#first_name').val());
                fd.append('middle_name', $('#middle_name').val());
                fd.append('email_address', $('#email_address').val());
                fd.append('password', $('#password').val());
                fd.append('verify_password', $('#verify_password').val());

                $.ajax({
                    url: window.urlBase + "/admin/admins/create",
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
                            swalPrompt(sText,sIcon).then((result) => {
                                if (result.isConfirmed && res.status == 'success') {
                                    window.location.reload();
                                }
                            });
                        }
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

    /**
     * Delete admin
     * @param {any} '#btnDeleteAdmin'
     * @returns {any}
     */
    $('.btnDeleteAdmin').on('click', function () {
        let swalText = "Do you want to delete this admin ?";
        let swalIcon = "info";
        let confirmBtnText = "Delete";
        let cancelBtnText = "Cancel";

        swalConfirmation(swalText, swalIcon, confirmBtnText, cancelBtnText).then((result) => {
            if (result.isConfirmed) {

                const fd = new FormData();
                const uuid = $(this).attr('data-uuid');
                const rowIndex = $(this).closest('tr');

                fd.append('uuid', uuid);

                $.ajax({
                    url: window.urlBase + "/admin/admins/delete",
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
                            swalPrompt(sText,sIcon).then((result) => {
                                if (result.isConfirmed && res.status == 'success') {
                                    admins.row(rowIndex).remove().draw(false);
                                }
                            });
                        }

                    }
                });
            }
        });
    });
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
     * Swal prompts
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
});
