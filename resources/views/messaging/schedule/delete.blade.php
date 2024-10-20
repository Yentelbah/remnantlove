<div class="modal fade" id="deleteSchedule" tabindex="-1" role="dialog"daria-labelledby="Delete" aria-hidden="true">
  <div class="modal-dialog " role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Delete Confirmation</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('schedule.delete') }}" method="POST">
          @csrf
          @method('DELETE')

              <input hidden type="text" name="selectedId" class="form-control" id="del_sheduledId">

              <p>Are you sure you want to delete <strong><span name="name" id="del_sheduled_title"></span></strong>?</p>
              <br>

              <div class="justify-content-end d-flex">
                <button type="submit" class="text-white btn btn-danger">Yes, Delete</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">No, Cancel</button>
            </div>
        </form>
      </div>

      </div>
  </div>
</div>

