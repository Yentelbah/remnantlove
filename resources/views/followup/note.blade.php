<div class="modal fade" id="noteModal" tabindex="-1" role="dialog"daria-labelledby="Edit Group" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Follow Up Response</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form action="{{ route('follow-ups.update') }}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" id="fn_selectedId" name="selectedId">

                <div class="row">
                    <div id="custom-sms">

                        <div class="mb-3">

                            <label for="notes" class="form-label" >Response</label>
                            <textarea id="fn_note" class="form-control" name="notes" placeholder="Response" required></textarea>
                        </div>

                    </div>

                </div>
                <div class="col-12">
                    <div class="gap-6 d-flex align-items-center justify-content-end">
                        <button class="btn btn-primary" type="submit" >Save</button>
                        <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
