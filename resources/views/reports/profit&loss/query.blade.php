<div class="modal fade" id="profitLossModal" tabindex="-1" role="dialog"daria-labelledby="Edit Group" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Profit and Loss</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form action="{{ route('profit_loss.generate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="date" class="form-label">As at </label>
                        <input name="date" required type="date" id="date" class="form-control @error('date') is-invalid @enderror" placeholder="employee@mail.com"/>
                        @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary" type="submit" >Generate</button>
                            <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
