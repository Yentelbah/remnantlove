      <!-- Modal -->
      <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Update Branch Details</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('branch.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="selectedId" name="selectedId">

                            <div class="row">
                              <div class="mb-3">
                                <label for="name" class="form-label">Branch Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                    id="name" name="name" autofocus />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>

                              <div class="mb-3 col-md-6">
                                <label class="form-label" for="pastor_id">Branch Pastor</label>
                                <select class="form-select" id="pastor_id" name="pastor_id">
                                    <option value="">Select Pastor</option>
                                    @foreach ($pastors as $result)
                                    <option value="{{ $result->id }}">{{ $result->member->name }}</option>
                                    @endforeach
                                </select>
                              </div>

                              <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address"/>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>

                              <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input class="form-control @error('city') is-invalid @enderror" type="text" id="city" name="city" />
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>

                              <div class="mb-3 col-md-6">
                                <label for="region" class="form-label">Region</label>
                                <input type="text" class="form-control @error('region') is-invalid @enderror" id="region" name="region"/>
                                @error('region')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>

                              <div class="mb-3 col-md-6">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror" id="country"
                                    name="country" />
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>

                              <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" />
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>

                              <div class="mb-3 col-md-6">
                                <label for="phone2" class="form-label">Alternate Phone</label>
                                <input type="text" class="form-control @error('phone2') is-invalid @enderror" id="phone2" name="phone2" />
                                @error('phone2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>


                              <div class="mb-3 col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select type="text" class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="main">Main</option>
                                    <option value="sub">Sub</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>

                            </div>
                          </div>
                        </div>
                    <div class="modal_btn">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
      </div>
