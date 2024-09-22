<div id="ser_editModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class=" modal-title" id="success-header-modalLabel">Update Service Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

            <form action="{{ route('service.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="ser_ed_selectedId" name="selectedId">

                <div class="row">
                    <div class="mt-6 col-md-12">
                    <div class="mb-2 form-group">
                        <label class="form-label">Name</label>
                        <input id="ser_ed_name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="ser_ed_category" class="form-select @error('category') is-invalid @enderror" required>
                            <option value="">Select Category</option>
                            <option value="Sunday">Sunday Services</option>
                            <option value="All Night">All Night Services</option>
                            <option value="Special">Special Services</option>
                            <option value="Other">Other Services</option>
                        </select>
                        @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="service_date" class="form-label">Date</label>
                        <input class="form-control" type="date" name="service_date" id="ser_ed_date">
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
