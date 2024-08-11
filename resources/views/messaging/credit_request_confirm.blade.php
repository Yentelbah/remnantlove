<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Confirm Credit Purchase <strong><span id="serial_number"></span></strong></h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('sms.credits.confirm') }}" method="POST">
        @csrf

            <div class="mb-3 col">
                <label for="code" class="form-label">Enter Confirmation Code Sent to You</label>
                <input name="code" type="code" id="code" class="form-control @error('code') is-invalid @enderror"
                    placeholder="Confirm code" value="{{ old('code') }}"
                />
                @error('code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="justify-content-end d-flex">
                <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
        </form>
        </div>
      </div>
  </div>
</div>
