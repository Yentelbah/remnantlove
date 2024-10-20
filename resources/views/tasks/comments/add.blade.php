<div id="commentModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class="modal-title justify-content-center d-flex align-items-center" id="success-header-modalLabel"><iconify-icon icon="solar:chat-line-line-duotone" class="fs-6 text-success me-2"></iconify-icon>Comment on task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form action="{{ route('comment.store') }}" method="POST">
                @csrf
                @method('POST')

                <input type="hidden" id="sta_selectedId" name="selectedId" value="{{ $task->id }}">

                <div class="mb-2 form-group">
                    <label class="form-label">Comment</label>
                    <textarea type="text" name="comment" class="form-control" placeholder="Enter your comment" rows="5" cols="50"></textarea>
                    @error('comment')
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
