<div class="modal fade" id="senderIdModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">SenderID <strong><span id="serial_number"></span></strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('sms.senderID') }}" method="POST">
        @csrf

            <div class="mb-3 col">

                <p>Your approved SMS SenderID is <strong>{{ $credits->senderID }}</strong></p>

                <label for="sender_id" class="form-label">Update</label>
                <input name="sender_id" type="text" id="sender_id" class="form-control @error('sender_id') is-invalid @enderror"
                    placeholder="New SenderID"
                />
                @error('sender_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="justify-content-end d-flex">
                <button type="submit" class="btn btn-primary">Send Request</button>
            </div>
        </form>
        </div>
      </div>
  </div>
</div>
