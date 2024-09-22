<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
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
                    <div class="mt-6 col-md-12">
                    <div class="mb-2 form-group">
                        <label class="form-label">Name</label>
                        <input id="ed_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>

                    <div class="mt-6 col-md-12">
                        <div class="mb-2 form-group">
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
                    </div>

                    <div class="mt-6 col-md-12">
                        <div class="mb-2 form-group">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="ed_phone">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 col-md-12">
                        <div class="mb-2 form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="ed_email" placeholder="">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="mt-6 col-md-12">
                        <div class="form-group">
                        <label class="form-label">Location</label>
                        <input id="ed_location" name="location" type="text" class="form-control  @error('location') is-invalid @enderror" />
                        @error('location')
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
