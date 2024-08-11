      <!-- Modal -->
      <div class="modal fade" id="purchaseModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Top up SMS credits</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('purchase.credits') }}" method="POST">
                @csrf

                <div class="col">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <select name="amount" class="form-control @error('amount') is-invalid @enderror" id="">
                            <option value="">Select amount</option>
                            {{-- <option value="1">GH₵ 50</option> --}}
                            <option value="2">GH₵ 100</option>
                            <option value="3">GH₵ 200</option>
                            <option value="4">GH₵ 500</option>
                            <option value="5">GH₵ 1000</option>
                        </select>
                        <p>**Pay selected amount to 0545055050 and provide the Transaction ID</p>

                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="momo_trans_id" class="form-label">Transaction ID</label>
                        <input type="text" class="form-control @error('momo_trans_id') is-invalid @enderror" placeholder="Momo transaction ID" name="momo_trans_id">
                        @error('momo_trans_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <label for="momo_trans_id" class="form-label">Available Offers</label>

                    <div class="row">

                        <div class="col-md-3">
                            <h4>GH₵ 100</h4>
                            <p>2830 credits</p>
                        </div>

                        <div class="col-md-3">
                            <h4>GH₵ 200</h4>
                            <p>5850 credits</p>
                        </div>

                        <div class="col-md-3">
                            <h4>GH₵ 500</h4>
                            <p>14645 credits</p>
                        </div>

                        <div class="col-md-3">
                            <h4>GH₵ 1,000</h4>
                            <p>32714 credits</p>
                        </div>
                    </div>

                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Top up</button>
                </div>
            </div>
            </form>
            </div>
        </div>
      </div>
    </div>
