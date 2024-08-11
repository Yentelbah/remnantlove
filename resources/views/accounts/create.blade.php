      <!-- Modal -->
      <div class="modal fade" id="createAccount_Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Add Account</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body">
            <form action="{{ route('account.store') }}" method="POST">
                @csrf

              <div class="row">
                <div class="col mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input name="name"
                    type="text"
                    id="name"
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
                  <select class="form-control" name="type" id="type">
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
                <button type="submit" class="btn btn-primary">Save</button>
              </div>


            </div>
            </form>
            </div>
        </div>
      </div>
