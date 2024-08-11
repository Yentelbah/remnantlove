@extends('layouts.template')

@section('title')
    <title>Profit and Loss</title>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="page-titles mb-5">
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
                    <h2 class="mb-0 fw-bolder fs-8">Profit and Loss Statement</h2>
            </div>
            <div class="col-lg-4 col-md-6 d-none d-md-flex align-items-center justify-content-end">
                <input class="form-control w-auto bg-primary-subtle border-0" type="date" id="currentDate" value="" name="date">
            </div>

            </div>
        </div>

        <div class="card overflow-hidden invoice-application">

            <div class="d-flex">

              <div class="w-100 w-xs-100 chat-container">
                <div class="invoice-inner-part h-100">
                  <div class="invoiceing-box">
                    <div class="invoice-header d-flex align-items-center justify-content-between border-bottom p-3">
                        <h4 class=" text-uppercase mb-0">Profit and Loss Statement</h4>

                        <div class="text-end">
                            <button class="btn btn-primary btn-default print-page ms-6" type="button">
                            <span><i class="ti ti-printer fs-5"></i> Print </span> </button>
                        </div>
                    </div>
                    <div class="p-3" id="custom-invoice">
                      <div class="invoice-123" id="printableArea">
                        <div class="row pt-3">
                          <div class="col-md-12">
                            <div>
                              <address>
                                <div class="d-flex flex-column flex-sm-row align-items-center justify-content-sm-start mb-4 text-center text-sm-start gap-2">
                                    <img src="{{ asset('assets/images/logos/dql.png') }}" width="180px" alt="logo">

                                    <div class="">
                                        <h3>{{ $company->name }}</h3>
                                        <p class="ms-1">{{ $company->address }}, {{ $company->city }}, {{ $company->region }}, {{ $company->country }}. <br>
                                        {{ $company->phone }}, {{ $company->email }}, {{ $company->website }}</p>

                                    </div>

                                </div>

                                <div class="text-center">
                                    <h5 class="fw-bold text-center">
                                        Profit and Loss Statement as at {{ $period }}
                                      </h5>

                                </div>

                              </address>
                            </div>

                          </div>
                          <div class="col-md-12">
                            <div class="table-responsive mt-6">

                                <table class="table">
                                    <tr>
                                        <th colspan="3"><h5 class="mb-0">Revenue</h5></th>
                                    </tr>

                                        <tr>
                                            <th>Account</th>
                                            <th style="text-align: right">GH₵</th>
                                            <th style="text-align: right">GH₵</th>
                                        </tr>

                                        @foreach ($revenues as $account)
                                        <tr>
                                            <td style="text-align: left">{{ $account->name }}</td>
                                            <td style="text-align: right">{{ number_format($account->total_credit - $account->total_debit, 2) }}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <th>Total</th>
                                            <td></td>
                                            <th style="text-align: right">{{ number_format($totalRevenue,2) }}</th>
                                        </tr>

                                        <th colspan="3"><h5 class="mb-0">Expenses</h5></th>

                                        @foreach ($expenses as $account)
                                        <tr>
                                            <td style="text-align: left">{{ $account->name }}</td>
                                            <td style="text-align: right">{{ number_format($account->total_debit - $account->total_credit, 2) }}</td>
                                            <td></td>

                                        </tr>
                                        @endforeach
                                        <tr>
                                            <th>Total</th>
                                            <td></td>
                                            <th style="text-align: right">{{ number_format($totalExpenses),2 }}</th>
                                        </tr>

                                        <tr>
                                            <th><h5 class="mb-0">
                                                @if ($netIncome > 0)
                                                    Net Profit
                                                @elseif ($netIncome < 0)
                                                    Net Loss
                                                @else
                                                    No Profit
                                                @endif
                                            </h5>
                                            <td></td>
                                            </th>

                                            <th style="text-align: right">{{  number_format($netIncome),2 }}</th>
                                        </tr>

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
