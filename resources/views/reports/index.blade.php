
@extends('layouts.flow')


@section('title')
    <title>FaithFlow -- Reports</title>
@endsection


@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Reports</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Reports</li>
        </ol>
      </nav>
    </div>
  </div>


    <div class="widget-content">
        <div class="card-body">
            <div class="row">

                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                          <div class="d-flex align-items-center ">
                            <div>
                              <h4 class="card-title">Trial Balance</h4>
                              <p class="card-subtitle">Get balances of all ledgers</p>
                            </div>
                            <div class="ms-auto">
                              <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#trialBalanceModal" href="javascript:void(0)"><i class='bx bx-scan me-1'></i>Generate</a>
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
                              <h4 class="card-title">Balance Sheet</h4>
                              <p class="card-subtitle">Get a snapshot of a company's financial position</p>
                            </div>
                            <div class="ms-auto">
                              <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#balanceSheetModal" href="javascript:void(0)"><i class='bx bx-scan me-1'></i>Generate</a>
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
                            <h4 class="card-title">Profit & Loss</h4>
                            <p class="card-subtitle">Know your profitability, and overall financial performance</p>
                          </div>
                          <div class="ms-auto">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profitLossModal" href="javascript:void(0)"><i class='bx bx-scan me-1'></i>Generate</a>
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
                              <h4 class="card-title">User Logs</h4>
                              <p class="card-subtitle">Know the activities and actions performed by users </p>
                            </div>
                            <div class="ms-auto">
                              <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logsModal" href="javascript:void(0)"><i class='bx bx-scan me-1'></i>Generate</a>
                            </div>
                          </div>
                        </div>
                      </div>

                </div>

            </div>
        </div>
    </div>
</div>
@include('reports.balance_sheet.query')
@include('reports.trial_balance.query')
@include('reports.profit&loss.query')
@include('reports.logs.query')

@endsection


@section('scripts')

@endsection
