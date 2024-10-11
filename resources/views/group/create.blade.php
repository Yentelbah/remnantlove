<div id="createModal" class="modal fade" tabindex="-1" aria-labelledby="success-header-modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Add Group</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="{{ route('group.create') }}" method="POST">
            @csrf
            <div class="mb-3 form-group">
              <label class="form-label" for="name">Name</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="">
              @error('name')
              <small class="invalid-feedback" role="alert">
                {{ $message }}
              </small>
              @enderror
            </div>

            <div class="mb-0 form-group">
              <label class="form-label" for="description">Description</label>
              <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3"></textarea>
              @error('description')
              <small class="invalid-feedback" role="alert">
                {{ $message }}
              </small>
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
