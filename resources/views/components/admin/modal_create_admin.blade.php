<div class="modal fade" id="modalAdminForm" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Create admin
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last name</label>
                                <input id="last_name" type="text" class="form-control"/>
                                <small id="helpId" class="form-text text-muted">Enter last name</small>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First name</label>
                                <input id="first_name" type="text" class="form-control"/>
                                <small id="helpId" class="form-text text-muted">Enter first name</small>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="middle_name" class="form-label">Middle name</label>
                                <input id="middle_name" type="text" class="form-control"/>
                                <small id="helpId" class="form-text text-muted">Enter middle name / initial</small>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="email_address" class="form-label">Email address</label>
                                <input id="email_address" type="email" class="form-control"/>
                                <small id="helpId" class="form-text text-muted">Enter email address</small>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control"/>
                                <small id="helpId" class="form-text text-muted">Enter password</small>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="verify_password" class="form-label">Verify password</label>
                                <input id="verify_password" type="password" class="form-control"/>
                                <small id="helpId" class="form-text text-muted">Verify your password</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnSubmitAdminForm" type="button" class="btn btn-primary">
                    <span class="mdi mdi-plus"></span> Create
                </button>
            </div>
        </div>
    </div>
</div>
