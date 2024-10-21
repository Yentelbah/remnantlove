<div class="modal fade" id="createModal" tabindex="-1" role="dialog"daria-labelledby="Edit Group" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Add New Convert</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form action="{{ route('converts.store') }}" method="POST" class="tab-wizard wizard-circle">
                    @csrf

                        <div class="mx-auto row d-flex">
                            <!-- Input fields -->
                            <div class="order-2 col-lg-8 col-12 order-lg-1">

                                <div class="mb-3 form-group">
                                    <label class="form-label" for="name">Name</label>
                                    <input class="form-control  @error('name') is-invalid @enderror" name="name" id="le_name">
                                    @error('name')
                                    <small class="invalid-feedback" role="alert">
                                      {{ $message }}
                                    </small>
                                    @enderror
                                </div>

                                <div class="mb-3 form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                        <option value="">Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input class="form-control  @error('phone') is-invalid @enderror" name="phone" id="le_phone">
                                    @error('phone')
                                    <small class="invalid-feedback" role="alert">
                                      {{ $message }}
                                    </small>
                                    @enderror
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="le_email">
                                    @error('email')
                                    <small class="invalid-feedback" role="alert">
                                      {{ $message }}
                                    </small>
                                    @enderror
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label" for="location">Location</label>
                                    <input class="form-control  @error('location') is-invalid @enderror" name="location" id="le_location">
                                    @error('location')
                                    <small class="invalid-feedback" role="alert">
                                      {{ $message }}
                                    </small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="emailAddress1">Leader</label>
                                    <select class="form-select" id="existingMemberSelect" name="shepherd_id" required>
                                        <option value="">Select member</option>
                                        @foreach ($members as $result)
                                            <option value="{{ $result->id }}">{{ $result->name }} ({{ $result->member_number }})</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>

                            <!-- Image -->
                            <div class="order-1 col-lg-4 col-12 d-flex justify-content-center order-lg-2">
                                <img src="../assets/images/backgrounds/convert.svg" alt="" class="img-fluid" width="100%">
                            </div>


                        </div>



                    </section>


                      <div class="col-12">
                        <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                          <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                          <button class="btn btn-success" type="submit">Save</button>
                        </div>
                    </div>
                    </section>
                  </form>

            </div>
        </div>
    </div>
</div>
