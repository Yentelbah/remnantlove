<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class=" modal-title" id="success-header-modalLabel">Update Convert Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>        <div class="modal-body">

            <form action="{{ route('foundation-modules.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="selectedId" name="selectedId">

                <div class="row">
                    <div class="mt-6 col-md-12">
                        <div>
                            <label class="form-label">Module Name</label>
                            <input id="ed_name" name="module_name" type="text" class="form-control @error('module_name') is-invalid @enderror" />
                            @error('module_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-6 col-md-12">
                        <div class="mb-3 form-group">
                            <label for="description"  class="form-label">Description</label>
                            <textarea placeholder="" class="form-control @error('description') is-invalid @enderror" name="description" id="ed_description" rows="3"></textarea>
                            @error('description')
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
