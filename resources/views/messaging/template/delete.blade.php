<div class="modal fade" id="deleteTemplate" tabindex="-1" role="dialog"daria-labelledby="Delete" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Delete Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

        <form action="{{ route('template.delete') }}" method="POST">
          @csrf
          @method('DELETE')

              <input hidden type="text" name="selectedId" class="form-control" id="del_templateId">

              <p>Are you sure you want to delete <strong><span name="name" id="del_template_title"></span></strong>?</p>
              <br>

              <div class="justify-content-end d-flex">
                <button type="button" class="text-white btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="text-white btn btn-danger">Delete</button>
            </div>
        </form>
      </div>

      </div>
  </div>
</div>

