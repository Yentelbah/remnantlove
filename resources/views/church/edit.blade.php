      <!-- Modal -->
      <div class="modal fade" id="editComModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Update Church Details</h5>
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
                        <form action="{{ route('church.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="selectedChurchId" value="{{ $church->id }}" name="selectedChurchId">

                            <div class="row">
                              <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Church Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                    id="name" name="name" value="{{ $church->name }}" autofocus />
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>

                              <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{ $church->address }}"/>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>

                              <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input class="form-control @error('city') is-invalid @enderror" type="text" value="{{ $church->city }}" id="city" name="city" />
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>

                              <div class="mb-3 col-md-6">
                                <label for="region" class="form-label">Region</label>
                                <input
                                    type="text"
                                    class="form-control @error('region') is-invalid @enderror"
                                    id="region" value="{{ $church->region }}" name="region"
                                />
                                @error('region')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>

                              <div class="mb-3 col-md-6">
                                <label for="country" class="form-label">Country</label>
                                <input
                                    type="text"
                                    class="form-control @error('country') is-invalid @enderror"
                                    id="country" value="{{ $church->country }}"
                                    name="country"
                                />
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>

                              <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $church->phone }}" />
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>

                              <div class="mb-3 col-md-6">
                                <label for="phone2" class="form-label">Alternate Phone</label>
                                <input type="text" class="form-control @error('phone2') is-invalid @enderror" id="phone2" name="phone2"  value="{{ $church->phone2 }}" />
                                @error('phone2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>

                              <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" value="{{ $church->email }}" />
                                @error('email')
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
