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

            <div class="card">
                <div class="card card-body">
                    <div class="justify-between mb-2 d-flex">
                        <h4 class="mb-0 card-title">Transactions</h4>

                        <div class="ms-auto">
                            <a href="{{ route('finance.entry') }}"  class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1" >Record Transaction</a>

                            <button type="button" class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto" data-bs-target="#contraModal" data-bs-toggle="modal"><i class="ti ti-coin me-1 fs-5"></i>Contra Entery</button>
                        </div>
                    </div>

                    <div class="p-3 table-responsive">
                      <table class="table align-middle search-table text-nowrap" id="table">
                        <thead class="header-item">
                          <th>#</th>
                          <th>Date</th>
                          <th>Description</th>
                          <th>Amount</th>
                          <th><i class="ti ti-dots-vertical fs-6"></i>
                          </th>
                        </thead>
                        <tbody>
                          <!-- start row -->
                          @php $i = 1; @endphp
                          @foreach ($transactions as $item)

                          <tr class="search-items">
                            <th scope="row">{{ $i++ }}</th>
                            <td>
                                <span class="usr-ph-no" data-phone="{{ $item->entry_date }}">{{ $item->entry_date }}</span>
                            </td>
                            <td>
                              <span class="usr-ph-no" data-phone="{{ $item->description }}">{{ $item->description }}</span>
                            </td>
                            <td>
                              <span class="usr-location" data-location="{{ $item->amount }}">{{ $item->amount }}</span>
                            </td>

                            <td>
                                <div class="dropdown dropstart">
                                    <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                      <i class="ti ti-dots-vertical fs-6"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <li>
                                        <a class="gap-3 dropdown-item d-flex align-items-center" href="{{ route('financeShowDetails',['journalID' => $item->id]) }}">
                                          <i class="fs-4 ti ti-eye"></i>View
                                        </a>
                                      </li>

                                    </ul>
                                </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                      <!--MODALS-->

                      @include('finance.contra')


                  </div>
            </div>
        </div>

      </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('#table').DataTable(); // ID From dataTable with Hover
        });
    </script>

@endsection
