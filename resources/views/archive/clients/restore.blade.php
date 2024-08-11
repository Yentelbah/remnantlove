<div class="modal fade" id="restoreModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Restore Client</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>

      <div class="modal-body">
        <form action="{{ route('client.restore') }}" method="POST">
          @csrf

          <input type="hidden" id="res_client_id" name="selectedClientId">


        <div class="row">
          <div class="col mb-3">
            <p>Are you sure you want to restore the client <strong><span name="fname" id="res_fname"> <span name="lname" id="res_lnames"></span></strong>?</p>
          </div>
        </div>

        <div class="modal_btn">

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Restore</button>

          </div>


      </div>


      </form>
      </div>
  </div>
</div>
