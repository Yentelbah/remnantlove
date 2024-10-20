<div class="modal fade" id="editCommentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Update Comment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{ route('comment.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input hidden type="text" id="ed_comment_selectedId" name="selectedId">

                <div class="mb-2 form-group">
                    <label class="form-label">Comment</label>
                    <textarea type="text" name="comment" class="form-control" id="ed_comment" placeholder="Enter your comment" rows="5" cols="50"></textarea>
                    @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                        <button type="submit" class="btn btn-primary">Update Comment</button>
                        <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
        </div>
    </div>
</div>
