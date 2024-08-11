<div class="modal fade" id="approveModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Approve Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('employee.apporve') }}" method="POST">
          @csrf

          <input type="text" hidden name="selectedEmployeeId" id="app_employeeID">

        <div class="row">
          <div class="col mb-3">
            <p>You are about to approve the deletion of a employee. Do you want to proceed? </p>
          </div>
        </div>

        <div class="modal_btn">
            <button type="button" class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Yes</button>
          </div>
      </div>
      </form>
      </div>
  </div>
</div>
