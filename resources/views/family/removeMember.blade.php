<div id="removeModal" class="modal fade" tabindex="-1" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Remove From Family</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

          <form action="{{ route('family.member.remove') }}" method="POST">
            @csrf

                <input hidden type="text" name="members" class="form-control" id="remove_selectedId">
                <input hidden type="text" name="familyID" value="{{ $thisFamily->id }}">

                <p>Are you sure you want to remove <strong><span name="name" id="remove_name"></span></strong> from this family?</p>

                <div class="col-12">
                    <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                      <button class="btn btn-danger" type="submit" >Yes</button>
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
