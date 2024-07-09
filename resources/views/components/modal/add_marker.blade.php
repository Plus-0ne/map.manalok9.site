<div class="modal fade" id="modalNewMarker" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Add new marker
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="latitude" class="form-label">
                                    Latitude
                                </label>
                                <input id="latitude" type="text" class="form-control" readonly/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="longitude" class="form-label">
                                    Longitude
                                </label>
                                <input id="longitude" type="text" class="form-control" readonly/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="location" class="form-label">
                                    Location
                                </label>
                                <input id="location" type="text" class="form-control"/>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="description" class="form-label">
                                    Description
                                </label>
                                <textarea id="description" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="file_image" class="form-label">Choose image</label>
                                <input id="file_image" type="file" class="form-control"/>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="submitNewMarker" type="button" class="btn btn-primary">
                    <span class="mdi mdi-plus"></span> Add marker
                </button>
            </div>
        </div>
    </div>
</div>
