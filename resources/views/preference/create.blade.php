<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Add New Department</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('department.store') }}" method="POST">
        @csrf
        <div class="row">
          <div class="mb-3 col">
            <label for="name" class="form-label">Department</label>
            <input type="text" hidden name="school_id" id="school_id" value="{{ Auth()->user()->school_id }}">
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Department Name" value="{{ old('name') }}">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

      </div>
      <div class="modal-footer">

        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
      </div>
  </div>
</div>
