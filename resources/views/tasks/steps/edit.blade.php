<div class="modal fade" id="editStepModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Update Step</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{ route('step.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input hidden type="text" id="ed_step_selectedId" name="selectedId">

                <!-- Task Title -->
                <div class="row">

                    <div class="mb-3">
                        <label for="description" class="form-label">Step</label>
                        <input type="text" name="description" id="ed_step_description" class="form-control" required>
                    </div>

                </div>
                <div class="col-12">
                    <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                        <button type="submit" class="btn btn-primary">Update Step</button>
                        <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
        </div>
    </div>
</div>
