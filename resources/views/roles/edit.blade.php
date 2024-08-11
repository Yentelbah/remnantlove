      <!-- Modal -->
      <div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Edit Role</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('role.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="selectedRoleId" name="selectedRoleId">

                <div class="row">
                    <div class="col mb-3">
                      <label for="name" class="form-label">Role Name</label>
                      <input name="name" type="text" id="role_name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Role Name" />
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="col mb-3">
                      <label for="description" class="form-label">Description</label>
                      <input name="description" type="text" id="role_description" class ="form-control @error('description') is-invalid @enderror" placeholder="Describe the role"/>
                      @error('description')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col mb-3">
                    <label for="role_id" class="form-label">Level</label>
                    <select name="role_id" id="role_role_id" class="form-control @error('role_id') is-invalid @enderror">
                      <option value="">Select role level</option>
                        @foreach ($defaultRoles as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
            </div>

            </form>
            </div>
        </div>
      </div>
