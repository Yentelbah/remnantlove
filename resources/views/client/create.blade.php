<div id="createModal" class="modal fade" tabindex="-1" aria-labelledby="success-header-modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="text-white modal-header modal-colored-header bg-success">
          <h5 class="text-white modal-title" id="success-header-modalLabel"></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h5 class="mb-4">Add Equipment</h5>

            <form action="{{ route('equipment.create') }}" method="POST">
                @csrf
                <div class="mb-3 form-group">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <label class="form-label" for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3"></textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <label class="form-label" for="date_acquired">Date acquired</label>
                    <input type="date" name="date_acquired" class="form-control @error('date_acquired') is-invalid @enderror" id="date_acquired">
                    @error('date_acquired')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                      <button class="btn btn-success" type="submit" >Save</button>
                      <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
              </form>
            </div>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
