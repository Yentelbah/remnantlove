@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Record Transaction</title>
@endsection

@section('content')


<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-0 fs-6">Record Transactions</h4>
    <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('finance.index') }}">Finance Records</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">Record Transaction</li>
        </ol>
    </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <form action="{{ route('finance.record') }}" method="POST">
            @csrf

                    <h4 class="mb-3 card-title">Transaction details</h4>
                    <p class="mb-4 card-subtitle">Provide acurate information</p>

                    <div class="row">

                        <div class="mb-3 col-lg-6">
                            <label for="entry_date" class="form-label">Date</label>
                            <input class="form-control" type="date" name="entry_date" id="entry_date" required>
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="account_type" class="form-label">Amount</label>

                            <input name="amount" type="number" id="amount" class="form-control @error('amount') is-invalid @enderror" placeholder="GHS" value="{{ old('amount') }}"/>
                            @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-12">
                            <label for="description" class="form-label">Description:</label>
                            <textarea class="form-control" name="description" id="description" required></textarea>
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="account_type" class="form-label">Debit Account Type</label>
                            <select class="form-select" name="account_type" id="account_type" aria-label="Default select example">
                            <option>Select account type</option>
                                @foreach($accountTypes as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('account_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="account_id" class="form-label">Debit Account</label>
                            <select class="form-select" name="account_id" id="account_id" aria-label="Default select example">
                                <option>Select account</option>
                                @foreach($accounts as $type => $accountsGroup)
                                @foreach($accountsGroup as $account)
                                    <option value="{{ $account->id }}" class="account-option {{ $account->type }}">{{ $account->name }}</option>
                                @endforeach
                                @endforeach
                            </select>
                            @error('account_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="mb-3 col-lg-6">
                            <label for="rec_account_type" class="form-label">Credit Account Type</label>
                            <select class="form-select" name="rec_account_type" id="rec_account_type" aria-label="Default select example">
                            <option>Select account type</option>
                                @foreach($accountTypes as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('rec_account_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="rec_account_id" class="form-label">Credit Account</label>
                            <select class="form-select" name="rec_account_id" id="rec_account_id" aria-label="Default select example">
                                <option>Select account</option>
                                @foreach($accounts as $type => $accountsGroup)
                                @foreach($accountsGroup as $account)
                                    <option value="{{ $account->id }}" class="rec_account-option {{ $account->type }}">{{ $account->name }}</option>
                                @endforeach
                                @endforeach
                            </select>
                            @error('rec_account_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

            <div class="col-12">
                <div class="gap-6 d-flex align-items-center justify-content-end">
                <a href="{{ route('finance.index') }}" class="btn bg-danger-subtle text-danger">Cancel</a>
                <button class="btn btn-primary">Record</button>
                </div>
            </div>
        </form>

    </div>
</div>

    </div>
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('#account_type').on('change', function() {
            var selectedType = $(this).val();
            $('#account_id').val('');
            $('.account-option').hide();
            if (selectedType) {
                $('.account-option.' + selectedType).show();
            }
        });
    });

    $(document).ready(function() {
        $('#rec_account_type').on('change', function() {
            var selectedType = $(this).val();
            $('#rec_account_id').val('');
            $('.rec_account-option').hide();
            if (selectedType) {
                $('.rec_account-option.' + selectedType).show();
            }
        });
    });
</script>

@endsection
