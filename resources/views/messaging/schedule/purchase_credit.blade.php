      <!-- Modal -->
      <div class="modal fade" id="purchaseModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                            <option value="1">GH₵ 50</option>
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

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Top up</button>
                    </div>

                    <label for="momo_trans_id" class="form-label">Available Offers</label>

                        <table class="table table-striped" >
                            <tr>
                                <th>Amount</th>
                                <th>Credits</th>
                            </tr>
                            <tr>
                                <td>GH₵ 50</td>
                                <td>1428 credits</td>
                            </tr>
                            <tr>
                                <td>GH₵ 100</td>
                                <td>3030 credits</td>
                            </tr>
                            <tr>
                                <td>GH₵ 200</td>
                                <td>6450 credits</td>
                            </tr>
                            <tr>
                                <td>GH₵ 500</td>
                                <td>17241 credits</td>
                            </tr>
                            <tr>
                                <td>GH₵ 1,000</td>
                                <td>35714 credits</td>
                            </tr>
                        </table>
                    </label>
                </div>

            </div>
            </form>
            </div>
        </div>
      </div>
    </div>
