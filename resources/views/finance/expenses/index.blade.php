@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Expenses</title>
@endsection

@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-0 fs-6">Expenses</h4>
    <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('finance.index') }}">Finance</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">Expenses</li>
        </ol>
    </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="mb-2 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 card-title">Expenses</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#expenseModal">
            Record Expense
            </button>
        </div>

            {{-- <form class="" action="{{ route('expense.index') }}" method="GET">

                <div class="py-3 card-body d-flex justify-content-between align-items-center">

                    <div class="col-auto d-flex justify-content-between align-items-center">
                        <label for="start_date" class="col-auto form-label me-2 card-title">Filter Expenses By Date</label>
                    </div>

                    <div class="col-auto d-flex justify-content-between align-items-center">
                        <label for="start_date" class="col-auto form-label me-2">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="col-auto form-control" value="{{ $startDate }}" />
                    </div>

                    <div class="col-auto d-flex justify-content-between align-items-center">
                        <label for="end_date" class="col-auto form-label me-2">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="col-auto form-control" value="{{ $endDate }}" />
                    </div>

                    <div class="col-auto">
                        <button class="btn" type="submit"> <i class="py-2 text-sucess ti ti-search fs-5 me-2"></i></button>
                    </div>

            </div>
            </form> --}}

        <div class="p-3 table-responsive">
            <table class="table align-middle search-table text-nowrap" id="table">
                <thead class="header-item">
                    <th>#</th>
                    <th>Date</th>
                    <th>Description</th>
                    {{-- <th>Expense Account</th>
                    <th>Paid Through</th> --}}
                    <th>Reference</th>
                    <th>Amount</th>
                    <th style="text-align: center">Actions</th>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp

                @foreach($journalEntry as $entry)

                    <tr>

                        <td scope="row">{{ $i++ }}</td>
                        <td>{{ \Carbon\Carbon::parse($entry->entry_date)->format('d/m/y') }}</td>
                        <td>{{ $entry->description }}</td>
                        {{-- @foreach($entry->ledgerEntries as $ledgerEntry)
                        <td>{{ $ledgerEntry->account->name }}</td>
                        @endforeach --}}
                        <td>{{ $entry->paid_through }}</td>
                        <td>{{ $entry->amount }}</td>

                        <td class="text-center">
                            <div class="dropdown">
                                <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                                  <i class="ti ti-dots-vertical fs-4 d-block"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">

                                    <li>
                                        <a class="gap-3 dropdown-item d-flex align-items-center" href="{{ route('expenseShowDetails',['journalID' => $entry->id]) }}">
                                            <i class="fs-4 ti ti-eye"></i>View
                                        </a>
                                    </li>

                                  <li>
                                        <a class="gap-3 dropdown-item d-flex align-items-center" href="javascript:void(0)" class="dropdown-item" value="{{ $entry->id }}" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openEditModal('{{ $entry->id }}')"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                  </li>
                                  {{-- <li>
                                        <a class="gap-3 dropdown-item d-flex align-items-center" href="javascript:void(0)" class="dropdown-item" value="{{ $entry->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="openDeleteModal('{{ $entry->id }}')"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                  </li> --}}

                                </ul>
                              </div>
                            </div>
                        </td>


                    </tr>
                    @endforeach
                </tbody>

                </table>
            </div>

        </div>
        <!--MODALS-->


        @include('finance.expenses.create')
        @include('finance.expenses.edit')

    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
        $('#table').DataTable(); // ID From dataTable with Hover
        });
    </script>

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
    </script>


@endsection
