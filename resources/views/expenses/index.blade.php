
@extends('layouts.main')

@section('title')
    <title>Expenses</title>
@endsection

@section('content')

<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4 fw-bold"><span class="text-muted fw-light">Accounts /</span> Expenses</h4>

    <div class="card">


            <form class="" action="{{ route('expense.index') }}" method="GET">

                <div class="py-3 card-body d-flex justify-content-between align-items-center">

                    <div class="mb-3 col">
                        <label for="term" class="form-label">Term</label>
                        <select name="term_id" id="term_id" class="form-control @error('term_id') is-invalid @enderror">
                            <option value="">All terms</option>
                            @foreach ($terms as $term)
                                <option value="{{ $term->id }}" @if(old('term') == $term->id) selected @endif>
                                    {{ $term->name }} {{ $term->stream->name ?? "" }}
                                </option>
                            @endforeach
                        </select>
                        @error('term_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div> &nbsp;

                    <div class="mb-3 col">
                        <label for="acadmic_year_id" class="form-label">Academic Year</label>
                        <select name="acadmic_year_id" id="acadmic_year_id" class="form-control @error('acadmic_year_id') is-invalid @enderror">
                            <option value="">All academic years</option>
                            @foreach ($academicYears as $year)
                                <option value="{{ $year->id }}" @if(old('acadmic_year_id') == $year->id) selected @endif>
                                    {{ $year->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('acadmic_year_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div> &nbsp;

                    <div class="mb-3 col">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}" />
                    </div>&nbsp;

                    <div class="mb-3 col">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}" />
                    </div>&nbsp;

                <div style=" padding-left: 10px; padding-top: 15px;">
                    <button class="btn btn-success" type="submit"><i class='bx bx-search-alt'></i></button>
                </div>
            </div>
        </form>

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Expenses</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            Add Expense
            </button>
        </div>


        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                <thead>
                    <tr class="text-nowrap">
                    <th>#</th>
                    <th>Date</th>
                    <th>Serial Number</th>
                    <th>Term</th>
                    <th>Year</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th style="text-align: center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp

                    @forelse ($expenses as $expense)
                    <tr>
                        <td scope="row">{{ $i++ }}</td>
                        <td>{{ \Carbon\Carbon::parse($expense->payment_date)->format('d/m/y') }}</td>
                        <td>{{ $expense->serial_no }}</td>
                        <td>{{ $expense->term->name}}</td>
                        <td>{{ $expense->academic_year->name }}</td>
                        <td>{{ $expense->category == 1?'Capital Expense' : ($expense->category == 2 ? 'Drawings' : 'Operating Expense')}}</td>
                        <td>{{ $expense->description }}</td>
                        <td>{{ $expense->amount }}</td>

                        <td style="text-align: center">

                            <button type="button" value="{{ $expense->id }}" class="btn btn-sm rounded-pill btn-icon btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openEditModal('{{ $expense->id }}')">
                                <span class="tf-icons bx bx-edit-alt"></span>
                            </button>

                            @if( $role == "Administrator" || $role =="Proprietor" ||  $role== "Manager" || $role== "Accountant" )
                                @if ($expense->is_deleted == 1)
                                    @elseif($expense->is_deleted == 0)
                                    <button type="button" value="{{ $expense->id }}" class="btn btn-sm rounded-pill btn-icon btn-outline-primary" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="openDeleteModal('{{ $expense->id }}')">
                                        <span class="tf-icons bx bx-trash"></span>
                                    </button>
                                @endif
                            @endif

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">No expenses recorded.</td>
                    </tr>
                    @endforelse
                </tbody>

                </table>
            </div>

        </div>
        <!--MODALS-->
        @include('accounts.expenses.edit')

        @include('accounts.expenses.delete')

        @include('accounts.expenses.create')
    </div>
    <div style="margin-top: 20px;">
        @include('layouts.partials.pagination', ['paginator' => $expenses])
    </div>

</div>

@endsection

@section('scripts')

    <script>
        function openEditModal(expenseId) {
            $.ajax({
                url: '/expense/' + expenseId + '/details', // Replace with the appropriate route for fetching expense details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched expense details
                    $('#edterm_id').val(response.term_id);
                    $('#academic_year_id').val(response.academic_year_id);
                    $('#payment_date').val(response.payment_date);

                    $('#description').val(response.description);
                    $('#amount').val(response.amount);
                    $('#selectedExpenseId').val(response.id);

                  // Set the selected category without clearing existing options
                    var selectCategory = $('#category');
                    selectCategory.val(response.category);

                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>


    <script>
        function openDeleteModal(expenseId) {
            $.ajax({
                url: '/expense/' + expenseId + '/details', // Replace with the appropriate route for fetching expense details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched expense details

                    $('#del_name').text(response.description);

                    $('#del_selectedExpenseId').val(response.id);

                    // Set the selected category without clearing existing options
                    var selectCategory = $('#select_category');
                    selectCategory.val(response.category_id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

    <script>
        function openRestoreModal(expense) {
            $.ajax({
                url: '/expense/' + expense + '/details', // Replace with the appropriate route for fetching expense details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched expense details

                    $('#res_name').text(response.name);

                    $('#res_selectedExpenseId').val(response.id);

                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

@endsection
