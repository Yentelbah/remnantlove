<div class="modal fade" id="createModal" tabindex="-1" role="dialog"daria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Add Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

            <form action="{{ route('member.create') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="gender">Gender</label>
                        <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                            <option value="">Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="name">Date of birth</label>
                        <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" id="dob">
                        @error('dob')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label" for="occupation">Occupation</label>
                        <input class="form-control  @error('occupation') is-invalid @enderror" name="occupation" id="le_occupation">
                        @error('occupation')
                        <small class="invalid-feedback" role="alert">
                        {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="email">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label" for="preferred_contact">Preferred Contact</label>
                        <select class="form-control @error('preferred_contact') is-invalid @enderror" id="preferred_contact" name="preferred_contact">
                            <option value="">Select</option>
                            <option value="Email">Email</option>
                            <option value="Phone">Phone</option>
                            <option value="Text">Text Message</option>
                        </select>
                        @error('preferred_contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label" for="best_time">Best Time to Ring</label>
                        <input type="text" name="best_time" class="form-control  @error('best_time') is-invalid @enderror" placeholder="Morning 8:00am" id="best_time">
                        @error('best_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="location">Location</label>
                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" id="location" placeholder="">
                        @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="address">Address</label>
                        <textarea placeholder="Postal address and House number" class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="3"></textarea>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                      <button class="btn btn-success" type="submit" >Save</button>
                      <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>

        </div>

        </div>
    </div>
</div>
