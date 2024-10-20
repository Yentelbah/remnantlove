<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Message</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="mb-3">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Reminder" required>
            </div>

            <div class="mb-3">

                <label for="message">Message</label>
                <textarea style="margin-top: 5px;" class="form-control" id="message" name="body" required></textarea>
            </div>

        </div>
        </div>
      </div>
  </div>
</div>
