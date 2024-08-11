<div class="modal fade" id="revokeUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Confirm Account Block</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('user.block') }}" method="POST">
          @csrf

          <input type="hidden" id="rev_selectedUserId" name="selectedUserId">

        <div class="row">
          <div class="mb-3 col">
            <p>Are you sure you want to block <strong><span name="name" id="rev_user_name"></span></strong>?
          </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Block</button>
          </div>
      </div>

      </form>
      </div>
  </div>
</div>
