<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('finance.delete') }}" method="POST">
          @csrf
          @method('DELETE')

          <input type="hidden" id="del_employeeID" value="{{ $journalEntry->id }}" name="journalID">


        <div class="row">
          <div class="mb-3 col">
            <p>Are you sure you want to delete <strong><span name="name" id="del_name">{{ $journalEntry->description }}</span></strong>?</p>
          </div>
        </div>

        <div class="modal_btn">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
      </div>
      </form>
      </div>
  </div>
</div>
