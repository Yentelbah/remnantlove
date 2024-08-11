<div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="text-white modal-header modal-colored-header bg-danger">
          <h4 class="text-white modal-title" id="danger-header-modalLabel"></h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h5 class="mb-4">Delete Confirmation</h5>

          <form action="{{ route('group.delete') }}" method="POST">
            @csrf
            @method('DELETE')

                <input hidden type="text" name="selectedId" class="form-control" id="del_selectedId">

                <p>Are you sure you want to delete <strong><span name="name" id="del_name"></span></strong>?</p>

                <div class="col-12">
                    <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                      <button class="btn btn-danger" type="submit" >Delete</button>
                      <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
