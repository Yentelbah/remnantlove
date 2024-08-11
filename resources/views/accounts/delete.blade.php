      <!-- Modal -->
      <div class="modal fade" id="deleteAccount_Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Confirm Deletion</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('account.delete') }}" method="POST">
                @csrf
                @method('DELETE')

                <input type="hidden" id="del_account_Id" name="selectedAccountId">


              <div class="row">
                <div class="col mb-3">
                  <p>Are you sure you want to delete <strong><span name="name" id="del_account_name"></span></strong> method from the system?</p>
                </div>
              </div>
              <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
            </div>

            </form>
            </div>
        </div>
      </div>
