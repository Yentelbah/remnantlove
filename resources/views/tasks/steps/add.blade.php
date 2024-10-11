<div id="stepModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class=" modal-title" id="success-header-modalLabel">Add Task Step</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form action="{{ route('step.store') }}" method="POST">
                @csrf
                @method('POST')

                <input type="hidden" id="sta_selectedId" name="selectedId" value="{{ $task->id }}">

                <!-- Custom Steps (Hidden if template is selected) -->
                <div id="custom-steps" class="mb-3 col">
                    <label for="steps[]" class="form-label">Task Steps</label>
                    <div id="steps-wrapper">
                        <!-- First step and level -->
                        <div class="mb-2 step-input">
                            <input type="text" name="steps[]" class="form-control" placeholder="Step 1">
                        </div>
                    </div>
                    <button type="button" id="add-step" class="mt-2 btn btn-sm btn-secondary">Add Step</button>
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
