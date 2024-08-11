<div class="modal fade" id="editModal" tabindex="-1" role="dialog"daria-labelledby="Edit Group" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="text-white modal-header modal-colored-header bg-primary">
                <h5 class="text-white modal-title" id="primary-header-modalLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <h5 class="mb-4">Update Project</h5>

                <form action="{{ route('project.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input hidden type="text" name="selectedId" class="form-control" id="selectedId">

                    <div class="mb-3 form-group">
                      <label class="form-label" for="name">Name</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="editName">
                      @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="mb-3 form-group">
                      <label class="form-label" for="description">Description</label>
                      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="editDescription" rows="3"></textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-3 form-group">
                        <label class="form-label" for="start_date">Start</label>
                        <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" id="editStart">
                        @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label class="form-label" for="end_date">End</label>
                        <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" id="editEnd">
                        @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
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
        </div>
    </div>
