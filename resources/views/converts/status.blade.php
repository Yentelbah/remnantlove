<div id="statusModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class=" modal-title" id="success-header-modalLabel">Update Convert Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form action="{{ route('converts.status') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="sta_selectedId" name="selectedId">

                <div class="row">

                    <div class="col-md-12">

                        <div class="mb-3">
                            <label class="form-label">What is the current status of <strong><span name="name" id="sta_name"></span></strong>?</label>

                            <div>
                                <input type="radio" id="custom-bulk" name="status" value="Pending">
                                <label for="custom">Pending</label>
                            </div>

                            <div>
                                <input type="radio" id="custom-bulk" name="status" value="Joined">
                                <label for="custom">Joined</label>
                            </div>
                            <div>
                                <input type="radio" id="custom-bulk" name="status" value="Not Interested">
                                <label for="custom">Not Interested</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                        <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" >Save</button>
                    </div>
                </div>
            </form>
        </div>


        </div>
    </div>
</div>
