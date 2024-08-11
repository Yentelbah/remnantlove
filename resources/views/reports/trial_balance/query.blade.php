
<div class="modal fade" id="trialBalanceModal" tabindex="-1" role="dialog"daria-labelledby="Edit Group" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="text-white modal-header modal-colored-header bg-primary">
                <h5 class="text-white modal-title" id="primary-header-modalLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="mb-4">Trial Balance</h5>


                <form action="{{ route('trial_balanec.generate') }}" method="POST">
                    @csrf

                    <div class="mb-3 col">
                        <label for="date" class="form-label">Date</label>
                        <input name="date" type="date" id="date" required class="form-control @error('date') is-invalid @enderror" placeholder="employee@mail.com" />
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

