<div id="progressModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class=" modal-title" id="success-header-modalLabel">Student Module Progress</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form action="{{ route('foundation-school-modules.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="mod_selectedId" name="selectedId">
                <input type="hidden" id="mod_student" name="student_id">

                <div class="row">
                    <div class="col-md-12">

                        <div class="mb-3 form-group">
                            <h5><span name="name" id="mod_name"></span></strong></label></h5>
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">What is the current level of progress attained ?</label>

                            <div class="form-check">
                                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="not_started" value="Not Started">
                                <label class="form-check-label" for="not_started">Not Started</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="in_progress" value="In Progress">
                                <label class="form-check-label" for="in_progress">In Progress</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="missed" value="Missed">
                                <label class="form-check-label" for="missed">Missed</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="completed" value="Completed">
                                <label class="form-check-label" for="completed">Completed</label>
                            </div>

                            @error('status')
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
