@extends('layouts.flow')

@section('title')
    <title>Journal Entry Details</title>
@endsection

@section('content')
<div class="container-fluid">
    <div class="mb-5 page-titles">
      <div class="row">
        <div class="col-lg-8 col-md-6 col-12 align-self-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">
                      <i class="ti ti-home fs-5"></i>
                    </a>
                  </li>

                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{ route('finance.index') }}">
                      Financial Records
                    </a>
                  </li>

                  <li class="breadcrumb-item" aria-current="page">Journal Entry Details</li>
                </ol>
              </nav>
              <h2 class="mb-0 fw-bolder fs-8">Journal Entry Details</h2>
        </div>
        <div class="col-lg-4 col-md-6 d-none d-md-flex align-items-center justify-content-end">
            <input class="w-auto border-0 form-control bg-primary-subtle" type="date" id="currentDate" value="" name="date">
        </div>

      </div>
    </div>


    <div class="gap-2 mb-4 text-center d-flex flex-column flex-sm-row align-items-center justify-content-sm-between text-sm-start">
      <div class="mb-2 mb-sm-0">
        <h4 class="mb-1">
            Journal Entry ID: {{ $journalEntry->id }}
        </h4>
        <p class="mb-0">
            {{ $journalEntry->date }}
            {{ $journalEntry->description }}
        </p>
      </div>
      @if (Auth::user()->role == 1 || Auth::user()->role == 2 )

      <div class="d-flex justify-content-center">
        <button type="button" value="{{ $journalEntry->id }}" class="bg-danger-subtle btn me-2 text-danger d-flex align-items-center" data-bs-target="#deleteModal" data-bs-toggle="modal" onclick="openDeleteModal('{{ $journalEntry->id }}')"><i class="ti ti-trash me-1 fs-5"></i> Delete Journal Entry</button>
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

</div>

@endsection

@section('scripts')

<script>
    function openEditModal(clientId) {
        $.ajax({
            url: '/client/' + clientId + '/details', // Replace with the appropriate route for fetching client details
            type: 'GET',
            success: function(response) {
                // Update the modal content with the fetched client details
                $('#fname').val(response.fname);
                $('#lname').val(response.lname);
                $('#dob').val(response.dob);
                $('#gender').val(response.gender);
                $('#marital_status').val(response.marital_status);
                $('#email').val(response.email);
                $('#occupation').val(response.occupation);
                $('#employee_id').val(response.employee_id);
                $('#gh_id').val(response.gh_id);
                $('#phone').val(response.phone);
                $('#phone2').val(response.phone2);
                $('#address').val(response.address);
                $('#city').val(response.city);
                $('#region').val(response.region);
                $('#clientID').val(response.id);
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
