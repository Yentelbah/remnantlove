<div id="revokePosition" class="modal fade" tabindex="-1" aria-labelledby="success-header-modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Revoke Leadership</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

          <form action="{{ route('group.leader.revoke') }}" method="POST">
            @csrf
                <input hidden type="text" name="selectedId" class="form-control" id="revoke_selectedId">
                <input hidden type="text" name="GroupId" value="{{ $group->id }}">

                <div class="mb-3 form-group">
                  <label class="form-label" for="name">Leader Name</label>
                  <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="revoke_name">
                  @error('name')
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
