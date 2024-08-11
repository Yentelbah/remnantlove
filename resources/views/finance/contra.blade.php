<div id="contraModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="text-white modal-header modal-colored-header bg-success">
            <h5 class="text-white modal-title" id="success-header-modalLabel"></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <h5 class="mb-4">Contra Entry</h5>
            <form action="{{ route('contra.entry') }}" method="POST">
            @csrf

                <div class="mb-3 col">
                    <label for="from" class="form-label">Amount</label>
                    <input type="text" class="form-control" name="amount" id="amount" placeholder="GHs">
                </div>


                <div class="mb-3 col">
                    <label for="from" class="form-label">Move from</label>
                    <select class="form-select" name="from" id="from" required>
                        <option value="cash">Cash</option>
                        <option value="mobile_money">Mobile Money</option>
                        <option value="bank">Bank</option>
                    </select>
                </div>

                <div class="mb-3 col">
                    <label for="to" class="form-label">Move to</label>
                    <select class="form-select" name="to" id="to" required>
                        <option value="cash">Cash</option>
                        <option value="mobile_money">Mobile Money</option>
                        <option value="bank">Bank</option>
                    </select>
                </div>

                <div class="col-12">
                    <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                        <button class="btn btn-success" type="submit" >Save</button>
                        <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
