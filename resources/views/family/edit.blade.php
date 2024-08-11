<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="text-white modal-header modal-colored-header bg-info">
            <h5 class="text-white modal-title" id="info-header-modalLabel"></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <h5 class="mb-4">Update Family Details</h5>
            <form action="{{ route('family.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input hidden type="text" name="selectedId" class="form-control" id="selectedId">

                <div class="mb-2 form-group">
                  <label class="form-label" for="name">Name</label>
                  <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="editName">
                  @error('name')
                  <small class="invalid-feedback" role="alert">
                    {{ $message }}
                  </small>
                  @enderror
                </div>

                <div class="form-group">
                  <label class="form-label" for="description">Description</label>
                  <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="editDescription" rows="3"></textarea>
                  @error('description')
                  <small class="invalid-feedback" role="alert">
                    {{ $message }}
                  </small>
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
