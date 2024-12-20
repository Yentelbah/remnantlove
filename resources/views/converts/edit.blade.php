<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class=" modal-title" id="success-header-modalLabel">Update Convert Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <form action="{{ route('converts.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="ed_selectedId" name="selectedId">

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Name</label>
                        <input id="ed_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="gender">Gender</label>
                        <select class="form-control @error('gender') is-invalid @enderror" id="ed_gender" name="gender">
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
                        <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" id="ed_dob">
                        @error('dob')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="occupation">Occupation</label>
                        <input class="form-control  @error('occupation') is-invalid @enderror" name="occupation" id="ed_occupation">
                        @error('occupation')
                        <small class="invalid-feedback" role="alert">
                        {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="ed_phone">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2 col-md-6">
                        <label class="form-label" for="email">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="ed_email" placeholder="">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label" for="preferred_contact">Preferred Contact</label>
                        <select class="form-control @error('preferred_contact') is-invalid @enderror" id="ed_preferred_contact" name="preferred_contact">
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
                        <input type="text" name="best_time" class="form-control  @error('best_time') is-invalid @enderror" placeholder="Morning 8:00am" id="ed_best_time">
                        @error('best_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Location</label>
                        <input id="ed_location" name="location" type="text" class="form-control  @error('location') is-invalid @enderror" />
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="shepherd">Leader</label>
                        <select class="form-select" name="shepherd_id" id="ed_shepherd" required>
                            <option value="">Select member</option>
                            @foreach ($members as $result)
                                <option value="{{ $result->id }}">{{ $result->name }} ({{ $result->member_number }})</option>
                            @endforeach
                        </select>
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
