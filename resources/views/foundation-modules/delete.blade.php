<div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-header modal-colored-header">
            <h5 class=" modal-title" id="success-header-modalLabel">Delete Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('foundation-modules.destroy') }}" method="POST">
          @csrf
          @method('DELETE')

              <input hidden type="text" name="selectedId" class="form-control" id="del_selectedId">

              <p>Are you sure you want to delete the module '<strong><span name="name" id="del_name"></span></strong>'?</p>

              <div class="col-12">
                <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                  <button class="btn btn-danger" type="submit">Yes</button>
                  <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">No</button>
                </div>
            </div>
      </form>
      </div>
      </div>
      </div>
  </div>


