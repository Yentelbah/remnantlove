      <!-- Modal -->
      <div class="modal fade" id="restoreUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Confirm Data Restore</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('user.restore') }}" method="POST">
                @csrf

                <input type="hidden" id="res_selectedUserId" name="selectedUserId">


              <div class="row">
                <div class="col mb-3">
                  <p>Are you sure you want to restore <strong><span name="name" id="user_res_name"></span></strong> ?</p>
                </div>
              </div>

              <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Restore</button>
              </div>
            </div>

            </form>
            </div>
        </div>
      </div>
