<div id="assignModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class=" modal-title" id="success-header-modalLabel">Assign User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form action="{{ route('tasks.addAssignees', $task->id ) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="assignees" class="form-label">Select User</label>
                    <select class="form-select" id="assignees" name="assignees[]" multiple required>
                        @foreach($availableUsers as $user) <!-- Assuming you have a $users variable passed to the view -->
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <small>Hold down the Ctrl or Command button for multiple selection.</small>
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

