      <!-- Modal -->
      <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Edit User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('user.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="text" hidden id="selectedUserId" name="selectedUserId">

                <div class="row">
                  <div class="col mb-3">
                    <label for="user_name" class="form-label">User Name</label>
                    <input name="name" type="text" id="ed_user_name" class="form-control @error('user_name') is-invalid @enderror"
                      placeholder="User Name" />
                    @error('user_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                  {{-- <div class="col mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" id="ed_email" class="form-control @error('email') is-invalid @enderror"
                      placeholder="employee@mail.com" />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div> --}}

                  <div class="col mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="user_role" class="form-control @error('role') is-invalid @enderror">
                        <option value="">Select Role</option>
                        @foreach ($roles as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach

                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </select>
                  </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
            </div>

            </form>
            </div>
        </div>
      </div>
