      <!-- Modal -->
      <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Edit Department</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('department.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="selectedDepartmentId" name="selectedDepartmentId">

                <div class="row">
                  <div class="mb-3 col">
                    <label for="name" class="form-label">Department Name</label>

                    <input type="text" hidden name="school_id" id="school_id" value="{{ Auth()->user()->school_id }}">
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                {{-- <div class="row">
                  <div class="mb-3 col">
                    <label for="email" class="form-label">Email</label>
                    <input name="email"
                      type="email"
                      id="email"
                      class="form-control @error('email') is-invalid @enderror"
                      placeholder="department@mail.com"
                    />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="mb-3 col">
                    <label for="phone" class="form-label">Phone Contact</label>
                    <input name="phone"
                      type="text"
                      id="phone"
                      class="form-control @error('phone') is-invalid @enderror"
                    />
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="mb-3 col">
                    <label for="address" class="form-label">Address</label>
                    <input name="address"
                      type="text"
                      id="address"
                      class="form-control @error('address') is-invalid @enderror"
                    />
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="mb-3 col">
                    <label for="location" class="form-label">Location</label>
                    <input name="location"
                      type="text"
                      id="location"
                      class="form-control @error('location') is-invalid @enderror"
                    />
                    @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div> --}}
            </div>
            <div class="modal-footer">

              <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
            </div>
        </div>
      </div>
