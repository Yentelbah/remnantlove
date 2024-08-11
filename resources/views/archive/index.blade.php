
@extends('layouts.flow')


@section('title')
    <title>FaithFlow -- Archives</title>
@endsection

@section('content')
<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Archives</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Archives</li>
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
                              <h4 class="card-title">Members</h4>
                              <p class="card-subtitle">Find deleted employees</p>
                            </div>
                            <div class="ms-auto">
                              <a class="btn btn-primary" href="{{ route('archive.employees') }}"><i class='bx bx-scan me-1'></i>Open Archive</a>
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
                              <h4 class="card-title">Clients</h4>
                              <p class="card-subtitle">Find deleted clients.</p>
                            </div>
                            <div class="ms-auto">
                              <a class="btn btn-primary" href="{{ route('archive.clients') }}"><i class='bx bx-scan me-1'></i>Open Archive</a>
                            </div>
                          </div>
                        </div>
                    </div>

                </div> --}}
                <div class="col-lg-6">

                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center ">
                          <div>
                            <h4 class="card-title">User Profiles</h4>
                            <p class="card-subtitle">Find deleted user profiles. </p>
                          </div>
                          <div class="ms-auto">
                            <a class="btn btn-primary" href="{{ route('archive.users') }}"><i class='bx bx-scan me-1'></i>Open Archive</a>
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
                              <p class="card-subtitle">FInd deleted financial records. </p>
                            </div>
                            <div class="ms-auto">
                              <a class="btn btn-primary" href="javascript:void(0)"><i class='bx bx-scan me-1'></i>Open Archive</a>
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
