<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          @csrf
          @method('DELETE')

          <input type="hidden" id="del_selectedDepartmentId" name="selectedDepartmentId">
          <input type="text" hidden name="school_id" id="school_id" value="{{ Auth()->user()->school_id }}">

            <div class="row">
                <div class="mb-3 col">
                    <p>Are you sure you want to delete <strong><span name="name" id="del_name"></span></strong> from the system?</p>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, don't delete</button>
                    <button type="submit" class="btn btn-danger">Yes, delete</button>
                </div>
            </div>
        </form>
      </div>
  </div>
</div>
</div>
