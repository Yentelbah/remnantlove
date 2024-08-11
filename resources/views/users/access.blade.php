<div class="modal fade" id="accessModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Restore User Access</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('user.restore.account') }}" method="POST">
          @csrf

          <input type="hidden" id="acc_selectedUserId" name="selectedUserId">

        <div class="row">
          <div class="mb-3 col">
            <p>Are you sure you want to restore the access of <strong><span name="name" id="acc_user_name"></span></strong>?
          </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Restore</button>
          </div>
      </div>

      </form>
      </div>
  </div>
</div>
