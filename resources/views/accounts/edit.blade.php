      <!-- Modal -->
      <div class="modal fade" id="editAccount_Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Edit Expense</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('account.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="selectedAccountId" name="selectedAccountId">

                <div class="row">
                    <div class="col mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input name="name"
                        type="text"
                        id="account_name"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder=""
                      />
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="col mb-3">
                      <label for="type" class="form-label">Type</label>
                      <select class="form-control" name="type" id="account_type">
                        <option value="">Select acount type</option>
                        <option value="Asset">Asset</option>
                        <option value="Equity">Equity</option>
                        <option value="Expense">Expense</option>
                        <option value="Liability">Liability</option>
                        <option value="Revenue">Revenue</option>
                      </select>

                      @error('type')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
            </div>

            </form>
            </div>
        </div>
      </div>
