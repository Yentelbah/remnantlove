@extends('layouts.flow')

@section('title')
    <title>Balance Sheet</title>
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
                        <a class="text-muted text-decoration-none" href="{{ route('report.index') }}">
                            Reports
                        </a>
                        </li>
                    </ol>
                    </nav>
                    <h2 class="mb-0 fw-bolder fs-8">Balance Sheet</h2>
            </div>
            <div class="col-lg-4 col-md-6 d-none d-md-flex align-items-center justify-content-end">
                <input class="w-auto border-0 form-control bg-primary-subtle" type="date" id="currentDate" value="" name="date">
            </div>

            </div>
        </div>

        <div class="overflow-hidden card invoice-application">

            <div class="d-flex">

              <div class="w-100 w-xs-100 chat-container">
                <div class="invoice-inner-part h-100">
                  <div class="invoiceing-box">
                    <div class="p-3 invoice-header d-flex align-items-center justify-content-between border-bottom">
                        <h4 class="mb-0 text-uppercase">Trial Balance</h4>

                        <div class="text-end">
                            <button class="btn btn-primary btn-default print-page ms-6" type="button">
                            <span><i class="ti ti-printer fs-5"></i> Print </span> </button>
                        </div>
                    </div>
                    <div class="p-3" id="custom-invoice">
                      <div class="invoice-123" id="printableArea">
                        <div class="pt-3 row">
                          <div class="col-md-12">
                            <div>
                              <address>
                                <div class="gap-2 mb-4 text-center d-flex flex-column flex-sm-row align-items-center justify-content-sm-start text-sm-start">
                                    <img src="{{ asset('assets/images/logos/logo.png') }}" width="120px" alt="logo">

                                    <div class="">
                                        <h3>{{ $church->name }} - {{ $branch->name }}</h3>
                                        <p class="ms-1">{{ $branch->address }}, {{ $branch->city }}, {{ $branch->region }}, {{ $branch->country }}. <br>
                                        {{ $branch->phone }}, {{ $church->email }}, {{ $church->website }}</p>

                                    </div>


                                </div>

                                <div class="text-center">
                                    <h5 class="text-center fw-bold">
                                        Balance Sheet as at {{ $period }}
                                      </h5>

                                </div>

                              </address>
                            </div>

                          </div>
                          <div class="col-md-12">
                            <div class="mt-6 table-responsive">
                                <h5 class="mb-0">Assets</h5>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Account</th>
                                            <th style="text-align: right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assets as $account)
                                            <tr>
                                                <td style="text-align: left">{{ $account->name }}</td>
                                                <td style="text-align: right">{{ number_format( $account->total_debit - $account->total_credit, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>

                                <h5 class="mb-0">Liabilities</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Account</th>
                                            <th style="text-align: right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($liabilities as $account)
                                            <tr>
                                                <td style="text-align: left">{{ $account->name }}</td>
                                                <td style="text-align: right">{{ number_format( $account->total_credit - $account->total_debit, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>

                                <h5 class="mb-0">Equity</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Account</th>
                                            <th style="text-align: right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($equity as $account)
                                            <tr>
                                                <td style="text-align: left">{{ $account->name }}</td>
                                                <td style="text-align: right">{{ number_format( $account->total_credit - $account->total_debit, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                          </div>


                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

            </div>
        </div>

    </div>


@endsection

@section('scripts')

<script src="{{ asset('assets/js/apps/invoice.js') }}"></script>
<script src="{{ asset('assets/js/apps/jquery.PrintArea.js') }}"></script>

@endsection
