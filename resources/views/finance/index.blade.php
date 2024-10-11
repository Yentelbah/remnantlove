@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Financial Records</title>
@endsection

@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-0 fs-6">Finance Records</h4>
    <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">Finance Records</li>
        </ol>
    </nav>
    </div>
</div>

<div class="widget-content searchable-container list">
    <div class="px-2 row ">

        <div class="col-lg-3">
            <div class="overflow-hidden card warning-card text-bg-primary">
                <div class="p-4 card-body">
                  {{-- <div class="mb-7">
                    <i class="ti ti-refresh fs-8 fw-lighter"></i>
                  </div> --}}
                  <p class="mb-0 opacity-50 ">Cash Accounts</p>
                  <h5 class="text-white fw-bold fs-14 text-nowrap">
                    @if(is_numeric($accountBalances['Cash Accounts']))
                        {{ number_format((float) $accountBalances['Cash Accounts'], 1) }}
                    @else
                        0
                    @endif                    <span class="fs-2 fw-light">GH₵</span>
                  </h5>
                </div>
              </div>
        </div>

        <div class="col-lg-3">
            <div class="overflow-hidden card warning-card text-bg-primary">
                <div class="p-4 card-body">
                  {{-- <div class="mb-7">
                    <i class="ti ti-refresh fs-8 fw-lighter"></i>
                  </div> --}}
                  <p class="mb-0 opacity-50 ">Mobil Money Accounts</p>
                  <h5 class="text-white fw-bold fs-14 text-nowrap">
                    @if(is_numeric ($accountBalances['Mobile Money Accounts']))
                        {{ number_format(($accountBalances['Mobile Money Accounts']),1) }}
                    @else
                        0
                    @endif

                    <span class="fs-2 fw-light">GH₵</span>
                  </h5>
                </div>
              </div>
        </div>

        <div class="col-lg-3">
            <div class="overflow-hidden card warning-card text-bg-primary">
                <div class="p-4 card-body">
                  {{-- <div class="mb-7">
                    <i class="ti ti-refresh fs-8 fw-lighter"></i>
                  </div> --}}
                  <p class="mb-0 opacity-50 ">Bank Accounts</p>
                  <h5 class="text-white fw-bold fs-14 text-nowrap">
                    @if(is_numeric ($accountBalances['Bank Accounts']))
                        {{ number_format(($accountBalances['Bank Accounts']),1) }}
                    @else
                        0
                    @endif

                    <span class="fs-2 fw-light">GH₵</span>
                  </h5>
                </div>
              </div>
        </div>

        <div class="col-lg-3">
            <div class="overflow-hidden card warning-card text-bg-success">
                <div class="p-4 card-body">
                  {{-- <div class="mb-7">
                    <i class="ti ti-refresh fs-8 fw-lighter"></i>
                  </div> --}}
                  <h5 class="text-white fw-bold fs-14 text-nowrap">
                    {{ $accountsCount }} <span class="fs-2 fw-light">+</span>
                  </h5>
                  <p class="mb-0 opacity-50 ">Books of Accounts</p>
                </div>
              </div>
        </div>

    </div>
</div>

<div class="widget-content">
    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center ">
                    <div>
                      <h4 class="card-title">Books</h4>
                      <p class="card-subtitle">All the books of accounts</p>
                    </div>
                    <div class="ms-auto">
                      <a class="btn btn-success" href="{{ route('account.index') }}"><i class='bx bx-scan me-1'></i>View</a>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center ">
                    <div>
                      <h4 class="card-title">Transactions</h4>
                      <p class="card-subtitle">Get all recorded transactions</p>
                    </div>
                    <div class="ms-auto">
                      <a class="btn btn-primary" href="{{ route('transactions.index') }}"><i class='bx bx-scan me-1'></i>View</a>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center ">
                    <div>
                      <h4 class="card-title">Revenue</h4>
                      <p class="card-subtitle">Get recorded revenues e.g. sales, offering, danations etc</p>
                    </div>
                    <div class="ms-auto">
                      <a class="btn btn-primary" href="{{ route('revenue.index') }}"><i class='bx bx-scan me-1'></i>View</a>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center ">
                  <div>
                    <h4 class="card-title">Expenses</h4>
                    <p class="card-subtitle">Get all recorded expenses</p>
                  </div>
                  <div class="ms-auto">
                    <a class="btn btn-primary" href="{{ route('expense.index') }}"><i class='bx bx-scan me-1'></i>View</a>
                </div>
                </div>
              </div>
            </div>
        </div>

        {{-- <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center ">
                    <div>
                      <h4 class="card-title">Equity</h4>
                      <p class="card-subtitle">Record all equities</p>
                    </div>
                    <div class="ms-auto">
                        <a class="btn btn-primary" href="{{ route('equity.index') }}"><i class='bx bx-scan me-1'></i>View</a>
                    </div>
                  </div>
                </div>
              </div>
        </div>

        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center ">
                    <div>
                      <h4 class="card-title">Assets</h4>
                      <p class="card-subtitle">Record all asset related transactions</p>
                    </div>
                    <div class="ms-auto">
                      <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logsModal" href="javascript:void(0)"><i class='bx bx-scan me-1'></i>Record</a>
                    </div>
                  </div>
                </div>
              </div>

        </div>

        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center ">
                    <div>
                      <h4 class="card-title">Liability</h4>
                      <p class="card-subtitle">Record all liabilities</p>
                    </div>
                    <div class="ms-auto">
                      <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logsModal" href="javascript:void(0)"><i class='bx bx-scan me-1'></i>Record</a>
                    </div>
                  </div>
                </div>
              </div>

        </div> --}}

    </div>
</div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('#table').DataTable(); // ID From dataTable with Hover
        });
    </script>

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
