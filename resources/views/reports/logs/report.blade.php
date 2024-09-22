@extends('layouts.flow')

@section('title')
    <title>Log Report</title>
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
                    <h2 class="mb-0 fw-bolder fs-8">User Logs</h2>
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
                        <h4 class="mb-0 text-uppercase">User Logs</h4>

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
                                        <h3>{{ $church->name }} - {{ $branch->name }}</h3>
                                        <p class="ms-1">{{ $church->address }}, {{ $church->city }}, {{ $church->region }}, {{ $church->country }}. <br>
                                        {{ $church->phone }}, {{ $church->email }}, {{ $church->website }}</p>

                                    </div>


                                </div>

                                <div class="text-center">
                                    <h5 class="text-center fw-bold">
                                        User Log Report from {{ $startDate }} to {{ $endDate }}
                                    </h5>

                                </div>

                              </address>
                            </div>

                          </div>
                          <div class="col-md-12">

                            <div class="row">

                                <div class="mb-4 col-lg-3 col-md-6 col-6">
                                    <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                        </div>
                                        <span class="mb-1 fw-semibold d-block">Total Logs</span>
                                        <h3 class="mb-2 card-title">{{ number_format(($totalLogs ?? 0)) }}</h3>
                                        {{-- <small class="text-success fw-semibold"></i>100%</small> --}}
                                    </div>
                                    </div>
                                </div>

                                @foreach ($users as $user)

                                <div class="mb-4 col-lg-3 col-md-6 col-6">
                                    <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                        </div>
                                        <span class="mb-1 fw-semibold d-block">Logs by {{ $user->name }}</span>
                                        <h3 class="mb-2 card-title">{{ number_format(($logsByUser[$user->id] ?? 0)) }}</h3>
                                    </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="mt-6 table-responsive">
                                <table class="table table-hover" id="table">
                                <thead>
                                    <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                    <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php    $i = 1;     @endphp    @foreach ($logs as $log)
                                    <tr>
                                        <td scope="row">{{$i++}}</td>
                                        <td>{{ $log->created_at }}</td>
                                        <td>{{ $log->action }}</td>
                                        <td>{{ $log->description }}</td>
                                        <!-- Add more columns as needed -->
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

{{-- <script>
    $(document).ready(function () {
        $('#table').DataTable(); // ID From dataTable with Hover
    });
</script> --}}

<script src="{{ asset('assets/js/apps/invoice.js') }}"></script>
<script src="{{ asset('assets/js/apps/jquery.PrintArea.js') }}"></script>

@endsection
