<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="text-white modal-header modal-colored-header bg-info">
            <h5 class="text-white modal-title" id="info-header-modalLabel"></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <h5 class="mb-4">Update Vistor</h5>
                <form action="{{ route('visitor.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input hidden type="text" name="selectedId" class="form-control" id="selectedId">

                    <div class="mb-3 form-group">
                      <label class="form-label" for="name">Name</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="ed_name">
                      @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
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

                    <div class="mb-3 form-group">
                        <label class="form-label" for="phone">Phone</label>
                        <input class="form-control  @error('phone') is-invalid @enderror" name="phone" id="ed_phone">
                        @error('phone')
                        <small class="invalid-feedback" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label class="form-label" for="date_visited">Date Visited</label>
                        <input type="date" name="date_visited" class="form-control  @error('name') is-invalid @enderror" id="ed_date_visited">
                        @error('date_visited')
                        <small class="invalid-feedback" role="alert">
                        {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label class="form-label" for="location">Location</label>
                        <input class="form-control  @error('location') is-invalid @enderror" name="location" id="ed_location">
                        @error('location')
                        <small class="invalid-feedback" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
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
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
