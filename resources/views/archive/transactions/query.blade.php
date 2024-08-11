<div class="modal fade" id="profitLossModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Profit and Loss</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('profit_loss.generate') }}" method="POST">
        @csrf

        <div class="col mb-3">
            <label for="date" class="form-label">Date</label>
            <input name="date" required type="date" id="date" class="form-control @error('date') is-invalid @enderror" placeholder="employee@mail.com"/>
            @error('date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

            <div class="modal_btn">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal" >Cancel</button>

                <button type="submit" class="btn btn-primary">Generate</button>
            </div>
      </div>

      </form>
      </div>
  </div>
</div>
