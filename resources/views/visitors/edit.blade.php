<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="text-white modal-header modal-colored-header bg-info">
            <h5 class="text-white modal-title" id="info-header-modalLabel"></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <h5 class="mb-4">Update Facility</h5>
                <form action="{{ route('facility.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input hidden type="text" name="selectedId" class="form-control" id="selectedId">

                    <div class="mb-3 form-group">
                      <label class="form-label" for="name">Name</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="ed_name">
                      @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="mb-3 form-group">
                      <label class="form-label" for="description">Description</label>
                      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="ed_description" rows="3"></textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label class="form-label" for="date_acquired">Date acquired</label>
                        <input type="date" name="date_acquired" class="form-control @error('date_acquired') is-invalid @enderror" id="ed_date_acquired">
                        @error('date_acquired')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary" type="submit" >Save</button>
                            <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>

            </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
