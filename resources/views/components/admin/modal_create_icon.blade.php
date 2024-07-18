<div class="modal fade" id="modalIconForm" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Create new icon
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">
                                    Title
                                </label>
                                <input id="title" type="text" class="form-control"/>
                                <small id="helpId" class="form-text text-muted">Enter icon title</small>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="file" class="form-label">Choose file</label>
                                <input id="file" type="file" class="form-control" accept=".png,.PNG"/>
                                <div id="fileHelpId" class="form-text">Accepted format : PNG</div>
                            </div>

                        </div>

                        <div class="col-12 col-lg-6 text-center">
                            <img id="imagePreview" class="img-fluid" src="https://archive.org/download/placeholder-image/placeholder-image.jpg" alt="">
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnSubmitIcon" type="button" class="btn btn-primary">
                    <span class="mdi mdi-upload"></span> Upload
                </button>
            </div>
        </div>
    </div>
</div>
