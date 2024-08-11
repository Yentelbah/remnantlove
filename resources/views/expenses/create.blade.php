<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Add New Expense</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('expense.store') }}" method="POST">
        @csrf

        <input type="text" hidden name="school_id" id="school_id" value="{{ Auth()->user()->school_id }}">
        <input type="text" hidden name="user_id" id="user_id" value="{{ Auth()->user()->id }}">

        <div class="row g-2">
            <div class="mb-3 col">
                <label for="payment_date" class="form-label">Date</label>
                <input name="payment_date" type="date" id="payment_date" class="form-control @error('payment_date') is-invalid @enderror" value="{{ old('payment_date', date('Y-m-d')) }}"/>
                @error('payment_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3 col">
                <label for="category" class="form-label">Category </label>
                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                    <option value="">Select category</option>
                    <option value="1" {{ old('category') == '1' ? 'selected' : '' }}>Capital Expense</option>
                    <option value="2" {{ old('category') == '2' ? 'selected' : '' }}>Drawings</option>
                    <option value="3" {{ old('category') == '3' ? 'selected' : '' }}>Operating Expense</option>
                 </select>
                @error('category')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="row g-2">
            <div class="mb-3 col">
                <label for="term" class="form-label">Term</label>
                <select name="term_id" id="term_id" class="form-control @error('term_id') is-invalid @enderror">
                    <option value="">Select term</option>
                    @foreach ($terms as $term)
                        <option value="{{ $term->id }}" @if(old('term_id') == $term->id) selected @endif>
                            {{ $term->name }} {{ $term->stream->name ?? "" }}
                        </option>
                    @endforeach
                </select>
                @error('term_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3 col">
                <label for="academic_year_id" class="form-label">Academic Year</label>
                <select name="academic_year_id" id="academic_year_id" class="form-control @error('academic_year_id') is-invalid @enderror">
                    <option value="">Select year</option>
                    @foreach ($academicYears as $year)
                        <option value="{{ $year->id }}" @if(old('academic_year_id') == $year->id) selected @endif>
                            {{ $year->name }}
                        </option>
                    @endforeach
                </select>
                @error('academic_year_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

        </div>


        <div class="row g-2">

            <div class="mb-3 col">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" placeholder="Expense amount" value="{{ old('amount') }}">
                @error('amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3 col">
                <label for="description" class="form-label">Description</label>
                <input name="description" type="text" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" placeholder="Exprense description"/>

                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
      </div>
  </div>
</div>
</div>
