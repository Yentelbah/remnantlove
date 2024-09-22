<div id="serviceModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class=" modal-title" id="success-header-modalLabel">Add Church Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

        <div class="modal-body">

            <form action="{{ route('church_service.store') }}" method="POST">
            @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Service Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="" required>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category" id="category" class="form-select" required>
                        <option value="">Select Category</option>
                        <option value="Sunday">Sunday Services</option>
                        <option value="All Night">All Night Services</option>
                        <option value="Special">Special Services</option>
                        <option value="Other">Other Services</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="service_date" class="form-label">Date</label>
                    <input class="form-control" type="date" name="service_date" id="service_date" required>
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
