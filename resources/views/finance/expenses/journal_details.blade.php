@extends('layouts.flow')

@section('title')
    <title>Expense Entry Details</title>
@endsection

@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-0 fs-6">{{ $journalEntry->description }}</h4>
    <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('finance.index') }}">Finance</a>
        </li>
        <li class="breadcrumb-item">
            <a class="text-muted text-decoration-none" href="{{ route('expense.index') }}">
              Expenses
            </a>
        </li>
            <li class="breadcrumb-item" aria-current="page">Details</li>
        </ol>
    </nav>
    </div>
</div>

<div class="container-fluid">

    <div class="gap-2 mb-4 text-center d-flex flex-column flex-sm-row align-items-center justify-content-sm-between text-sm-start">
      <div class="mb-2 mb-sm-0">

        <p class="mb-0">
            Journal Entry ID: {{ $journalEntry->id }} <br> Date: {{ $journalEntry->entry_date }}

        </p>
      </div>

      @if (Auth::user()->churchRole->role_id == 1 || Auth::user()->churchRole->role_id == 2 )

      <div class="d-flex justify-content-center">
        <button type="button" value="{{ $journalEntry->id }}" class="bg-primary-subtle btn me-2 text-primary d-flex align-items-center" data-bs-target="#editModal" data-bs-toggle="modal" onclick="openEditModal('{{ $journalEntry->id }}')"><i class="ti ti-edit me-1 fs-5"></i> Edit Entry</button>

        <button type="button" value="{{ $journalEntry->id }}" class="bg-danger-subtle btn me-2 text-danger d-flex align-items-center" data-bs-target="#deleteModal" data-bs-toggle="modal" onclick="openDeleteModal('{{ $journalEntry->id }}')"><i class="ti ti-trash me-1 fs-5"></i> Delete Entry</button>
      </div>

      @endif
    </div>

    <div class="row">
        <!-- Client Content -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="card-title">Ledger Entries</h4>
                        <p class="mb-4 card-subtitle"></p>
                        <div class="mt-4 table-responsive">
                            <table class="table align-middle search-table text-nowrap" id="multi_col_order">

                            <thead>
                            <tr>
                                <th scope="col" class="px-0 text-muted">#</th>
                                <th scope="col" class="px-0 text-muted">Account</th>
                                <th scope="col" class="px-0 text-muted">Debit</th>
                                <th scope="col" class="px-0 text-muted">Credit</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp

                                @forelse($journalEntry->ledgerEntries as $ledgerEntry)
                                <tr>
                                    <th class="px-0" scope="row">{{ $i++ }}</th>
                                    <td class="px-0"><h6 class="mb-0">{{ $ledgerEntry->account->name }}</h6></td>
                                    <td class="px-0">{{ number_format($ledgerEntry->debit, 2) }}</td>
                                    <td class="px-0">{{ number_format($ledgerEntry->credit, 2) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">No ledgers found.</td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--/ Client Content -->
    </div>


    <!-- Modal -->
    @include('finance.delete')
    @include('finance.expenses.edit')

    </div>

@endsection

@section('scripts')
<script>
    function openEditModal(id) {
        $.ajax({
            url: '/expense/' + id + '/details',
            type: 'GET',
            success: function(response) {
                // Assuming ledgerEntries has debit and credit entries
                let debitEntry = null;
                let creditEntry = null;

                // Loop through the ledger entries to find debit and credit
                response.ledger_entries.forEach(function(entry) {
                    if (entry.debit === response.amount) {
                        debitEntry = entry;
                    }
                    if (entry.credit === response.amount) {
                        creditEntry = entry;
                    }
                });

                // Populate modal fields with the response data
                $('#ed_date').val(response.entry_date);
                $('#ed_reference').val(response.reference);
                $('#ed_description').val(response.description);
                $('#ed_amount').val(response.amount);
                $('#selectedExpenseId').val(response.id);

                // Set the debit account to ed_rec_account_id (Expense Account)
                if (debitEntry) {
                    $('#ed_rec_account_id').val(debitEntry.account_id);
                }

                // Set the credit account to ed_account_id (Paid Through)
                if (creditEntry) {
                    $('#ed_account_id').val(creditEntry.account_id);
                }
            },
            error: function(xhr) {
                // Handle error case
                console.log(xhr);
            }
        });
    }

    function openDeleteModal(clientId) {
        $.ajax({
            url: '/client/' + clientId + '/details', // Replace with the appropriate route for fetching client details
            type: 'GET',
            success: function(response) {
                // Update the modal content with the fetched client details

                $('#del_fname').text(response.fname);
                $('#del_lname').text(response.lname);

                $('#del_clientID').val(response.id);

            },
            error: function(xhr) {
                // Handle error case
                console.log(xhr);
            }
        });
    }
</script>

<script>
    document.getElementById('uploadImage').addEventListener('change', function () {
        // Check if a file is selected
        if (this.files.length > 0) {
            // Submit the form when a file is selected
            this.parentElement.submit();
        }
    });
  </script>

@endsection
