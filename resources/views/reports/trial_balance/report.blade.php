@extends('layouts.flow')

@section('title')
    <title>FiathFlow -- Report</title>
@endsection

@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-0 fs-6">Trial Balance</h4>
    <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">Trial Balance</li>
        </ol>
    </nav>
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
                                <img src="{{ $church->logo == '' ?  'assets/images/logos/logo.png' : asset('storage/' . $church->logo)}}" width="120px" alt="logo">


                                <div class="">
                                    <h3>{{ $church->name }}</h3>
                                    <p class="ms-1">{{ $church->address }}, {{ $church->city }}, {{ $church->region }}, {{ $church->country }}. <br>
                                    {{ $church->phone }}, {{ $church->email }}, {{ $church->website }}</p>

                                </div>


                            </div>

                            <div class="text-center">
                                <h5 class="text-center fw-bold">
                                    Trial Balance as of {{ $period }}
                                  </h5>

                            </div>

                          </address>
                        </div>

                      </div>
                      <div class="col-md-12">
                        <div class="mt-6 table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Account Name</th>
                                        <th class="text-end">Debit</th>
                                        <th class="text-end">Credit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accounts as $account)
                                        <tr>
                                            <td>{{ $account->name }}</td>
                                            <td class="text-end">{{ number_format($account->total_debit, 2) }}</td>
                                            <td class="text-end">{{ number_format($account->total_credit, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th>Total</th>
                                        <th class="text-end">{{ number_format($totalDebits, 2) }}</th>
                                        <th class="text-end">{{ number_format($totalCredits, 2) }}</th>
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


@endsection

@section('scripts')

<script src="{{ asset('assets/js/apps/invoice.js') }}"></script>
<script src="{{ asset('assets/js/apps/jquery.PrintArea.js') }}"></script>


@endsection
