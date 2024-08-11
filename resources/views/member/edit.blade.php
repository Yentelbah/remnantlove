    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"daria-labelledby="Edit Group" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="text-white modal-header modal-colored-header bg-primary">
                    <h5 class="text-white modal-title" id="primary-header-modalLabel"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <h5 class="mb-4">Update Member</h5>

                <form action="{{ route('member.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input hidden type="text" name="selectedId" class="form-control" id="selectedId">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="ed_name">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" id="ed_gender" name="gender">
                                    <option value="">Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                              </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label for="name">Date of birth</label>
                                <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" id="ed_dob">
                                @error('dob')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="ed_phone">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                              </div>
                        </div>
                    </div>


                    <div class="mb-3 form-group">
                        <label for="address">Address</label>
                        <textarea placeholder="Postal address and House number" class="form-control @error('address') is-invalid @enderror" name="address" id="ed_address" rows="3"></textarea>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 form-group">
                                <label for="location">Location</label>
                                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" id="ed_location" placeholder="">
                                @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="ed_email" placeholder="">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary" type="submit" >Save</button>
                            <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
