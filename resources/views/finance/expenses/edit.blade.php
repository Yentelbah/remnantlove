<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class=" modal-title" id="success-header-modalLabel">Record Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="{{ route('expense.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="selectedExpenseId" name="selectedExpenseId">
                    <div class="mb-3">
                        <label for="entry_date" class="form-label">Date</label>
                        <input class="form-control" type="date" name="entry_date" id="ed_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="rec_account_id" class="form-label">Expense Account</label>
                        <select class="form-select" name="rec_account_id" id="ed_rec_account_id" aria-label="Default select example">
                            <option>Select an account</option>
                            @foreach($expenseAccounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                        @error('rec_account_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="account_type" class="form-label">Amount</label>

                        <input name="amount" type="number" id="ed_amount" class="form-control @error('amount') is-invalid @enderror" placeholder="GHS" value="{{ old('amount') }}"/>
                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="account_id" class="form-label">Paid Through</label>
                        <select class="form-select" name="account_id" id="ed_account_id" aria-label="Default select example">
                            <option>Select an account</option>
                            @foreach($assetAccounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                        @error('account_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="ed_description" required></textarea>
                    </div>


                    <div class="col-12">
                        <div class="gap-6 d-flex align-items-center justify-content-end">
                            <a class="btn bg-danger-subtle text-danger" class="btn-close" data-bs-dismiss="modal" >Cancel</a>
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

