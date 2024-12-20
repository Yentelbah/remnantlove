@extends('layouts.main')

@section('title')
    <title>Dashboard</title>
@endsection


@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="row">
            <div class="mb-4 col-lg-12 order-0">
                <div class="card">
                    <div class="d-flex align-items-center row">
                        <div class="col-sm-4">
                            <div class="card-body">
                                <h4 class="card-title text-primary">Welcome!</h4>
                                <h3 class="mb-4">
                                    {{ $company->company_name ?? '' }}</h3>
                                <a href="{{ route('company.index') }}" class="btn btn-sm btn-outline-primary">View
                                    Profile</a>
                            </div>
                        </div>
                        <div class="text-center col-sm-4 text-sm-left">
                            <div class="px-0 pb-0 card-body px-md-4 d-flex align-items-center justify-content-center">
                                @if ($company && $company->photo)
                                    <img src="{{ asset('storage/' . $company->photo) }}" alt="logo"
                                        class="rounded d-block" height="100" width="100" id="photo">
                                @endif
                            </div>
                        </div>


                        <div class="text-center col-sm-4 text-sm-left">
                            <div class="px-0 pb-0 card-body px-md-4 d-flex align-items-top justify-content-center">
                                <img src="{{ asset('backend/assets/img/mannequin.png') }}" height="120"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-1 col-lg-12 md-4">
                <div class="row">
                    <div class="mb-4 col-lg-3 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div style="color:#20d920 ; background-color: #a5f3d869; padding: 5px 8px; border-radius: 4px;"
                                        class="flex-shrink-0 avatar">
                                        <i class="rounded menu-icon tf-icons bx bx-shopping-bag"></i>
                                    </div>
                                </div>

                                <span>Sales Today</span>
                                <h3 class="mb-1 card-title">GH₵ {{ number_format($sales['today'], 1) }}</h3>
                                <small
                                    class="{{ $sales['percentageIncreaseDay'] >= 0.1 ? 'text-success fw-semibold' : 'text-danger fw-semibold' }}">
                                    <i
                                        class="{{ $sales['percentageIncreaseDay'] >= 0.1 ? 'bx bx-up-arrow-alt' : 'bx bx-down-arrow-alt' }}"></i>
                                    @if ($sales['percentageIncreaseDay'] !== null)
                                        {{ number_format($sales['percentageIncreaseDay'], 2) }}%
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 col-lg-3 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div style="color:#20d920 ; background-color: #a5f3d869; padding: 5px 8px; border-radius: 4px;"
                                        class="flex-shrink-0 avatar">
                                        <i class="rounded menu-icon tf-icons bx bx-shopping-bag"></i>
                                    </div>
                                </div>
                                <span>Sales This Month</span>
                                <h3 class="mb-1 card-title text-nowrap">GH₵ {{ number_format($sales['month'], 1) }}</h3>
                                <small
                                    class="{{ $sales['percentageIncreaseMonth'] >= 0.1 ? 'text-success fw-semibold' : 'text-danger fw-semibold' }}">
                                    <i
                                        class="{{ $sales['percentageIncreaseMonth'] >= 0.1 ? 'bx bx-up-arrow-alt' : 'bx bx-down-arrow-alt' }}"></i>
                                    @if ($sales['percentageIncreaseMonth'] !== null)
                                        {{ number_format($sales['percentageIncreaseMonth'], 2) }}%
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 col-lg-3 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div style="color:#20d920 ; background-color: #a5f3d869; padding: 5px 8px; border-radius: 4px;"
                                        class="flex-shrink-0 avatar">

                                        <i class="rounded menu-icon tf-icons bx bx-shopping-bag"></i>
                                    </div>

                                </div>
                                <span class="mb-1 d-block">Sales This Year</span>
                                <h3 class="mb-1 card-title text-nowrap">GH₵ {{ number_format($sales['year'], 1) }}</h3>
                                <small
                                    class="{{ $sales['percentageIncreaseYear'] >= 0.1 ? 'text-success fw-semibold' : 'text-danger fw-semibold' }}">
                                    <i
                                        class="{{ $sales['percentageIncreaseYear'] >= 0.1 ? 'bx bx-up-arrow-alt' : 'bx bx-down-arrow-alt' }}"></i>
                                    @if ($sales['percentageIncreaseYear'] !== null)
                                        {{ number_format($sales['percentageIncreaseYear'], 2) }}%
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 col-lg-3 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div style="font-size: 1.6rem; color:#20d920" class="danger">
                                    <i class="rounded menu-icon tf-icons bx bx-chart"></i>

                                    <span>Growth</span>
                                </div>

                                <br>Today
                                <small
                                    class="{{ $sales['percentageIncreaseDay'] >= 0.1 ? 'text-success fw-semibold' : 'text-danger fw-semibold' }}">
                                    <i
                                        class="{{ $sales['percentageIncreaseDay'] >= 0.1 ? 'bx bx-up-arrow-alt' : 'bx bx-down-arrow-alt' }}"></i>
                                    @if ($sales['percentageIncreaseDay'] !== null)
                                        {{ number_format($sales['percentageIncreaseDay'], 2) }}%
                                    @endif
                                </small>

                                <br>Month
                                <small
                                    class="{{ $sales['percentageIncreaseMonth'] >= 0.1 ? 'text-success fw-semibold' : 'text-danger fw-semibold' }}">
                                    <i
                                        class="{{ $sales['percentageIncreaseMonth'] >= 0.1 ? 'bx bx-up-arrow-alt' : 'bx bx-down-arrow-alt' }}"></i>
                                    @if ($sales['percentageIncreaseMonth'] !== null)
                                        {{ number_format($sales['percentageIncreaseMonth'], 2) }}%
                                    @endif
                                </small>
                                <br>Year
                                <small
                                    class="{{ $sales['percentageIncreaseYear'] >= 0.1 ? 'text-success fw-semibold' : 'text-danger fw-semibold' }}">
                                    <i
                                        class="{{ $sales['percentageIncreaseYear'] >= 0.1 ? 'bx bx-up-arrow-alt' : 'bx bx-down-arrow-alt' }}"></i>
                                    @if ($sales['percentageIncreaseYear'] !== null)
                                        {{ number_format($sales['percentageIncreaseYear'], 2) }}%
                                    @endif

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- <div class="row">

        <div class="col-md-12">
            <div class="row">
                <div class="mb-4 col-md-6 col-lg-4">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon danger d-flex align-items-start justify-content-center">
                        <i class="rounded menu-icon tf-icons bx bxs-briefcase" style="font-size: 48px" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                        <p class="stat-cards-info__num">{{ number_format($jobOrders[0]),0 }}</p>
                        <p class="stat-cards-info__title">Jobs Orders</p>
                        </div>
                    </article>
                </div>

                <div class="mb-4 col-md-6 col-lg-4">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon primary d-flex align-items-start justify-content-center">
                        <i class="rounded menu-icon tf-icons bx bx-male" style="font-size: 48px" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                        <p class="stat-cards-info__num">{{ number_format($jobOrders[1]),0 }}</p>
                        <p class="stat-cards-info__title">Order wears</p>
                        </div>
                    </article>
                </div>

                <div class="mb-4 col-md-6 col-lg-4">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon primary d-flex align-items-start justify-content-center">
                        <i class="rounded menu-icon tf-icons bx bx-male" style="font-size: 48px" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                        <p class="stat-cards-info__num">{{ number_format($jobOrders[1]),0 }}</p>
                        <p class="stat-cards-info__title">Order wears</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div> --}}


        <div class="row">

            <div class="col-md-12">
                <div class="row">
                    <div class="mb-4 col-md-6 col-lg-3">
                        <article class="stat-cards-item">
                            <div class="stat-cards-icon primary d-flex align-items-start justify-content-center">
                                <i class="rounded menu-icon tf-icons bx bxs-briefcase" style="font-size: 48px"
                                    aria-hidden="true"></i>
                            </div>
                            <div class="stat-cards-info">
                                <p class="stat-cards-info__num">{{ number_format($jobOrders[0], 0) }}</p>
                                <p class="stat-cards-info__title">Jobs Orders</p>
                            </div>
                        </article>
                    </div>

                    <div class="mb-4 col-md-6 col-lg-3">
                        <article class="stat-cards-item">
                            <div class="stat-cards-icon primary d-flex align-items-start justify-content-center">
                                <i class="rounded menu-icon tf-icons bx bx-male" style="font-size: 48px"
                                    aria-hidden="true"></i>
                                {{-- <i class="rounded menu-icon tf-icons bx bx-female"></i> --}}
                            </div>
                            <div class="stat-cards-info">
                                <p class="stat-cards-info__num">{{ number_format($jobOrders[1], 0) }}</p>
                                <p class="stat-cards-info__title">Order wears</p>
                            </div>
                        </article>
                    </div>

                    <div class="mb-4 col-md-6 col-lg-3">
                        <article class="stat-cards-item">
                            <div class="stat-cards-icon warning d-flex align-items-start justify-content-center">
                                <i class="rounded menu-icon tf-icons bx bxs-cabinet" style="font-size: 48px"
                                    aria-hidden="true"></i>
                                {{-- <i class="rounded menu-icon tf-icons bx bx-female"></i> --}}
                            </div>
                            <div class="stat-cards-info">
                                <p class="stat-cards-info__num">{{ number_format($jobOrders[2], 0) }}</p>
                                <p class="stat-cards-info__title">Complted Orders</p>
                            </div>
                        </article>
                    </div>

                    <div class="mb-4 col-md-6 col-lg-3">
                        <article class="stat-cards-item">
                            <div class="stat-cards-icon warning d-flex align-items-start justify-content-center">
                                <i class="rounded menu-icon tf-icons bx bxs-t-shirt" style="font-size: 48px"
                                    aria-hidden="true"></i>
                                {{-- <i class="rounded menu-icon tf-icons bx bx-female"></i> --}}
                            </div>
                            <div class="stat-cards-info">
                                <p class="stat-cards-info__num">{{ number_format($jobOrders[3], 0) }}</p>
                                <p class="stat-cards-info__title">Wears Produced</p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Top Wears Statistics -->
            <div class="mb-4 col-md-6 col-lg-4 col-xl-4 order-0">
                <div class="card h-100">
                    <div class="pb-0 card-header d-flex align-items-center justify-content-between">
                        <div class="mb-0 card-title">
                            <h5 class="m-0 me-2 ">Top Orders</h5>
                            <small class="text-muted">GH₵ {{ number_format($totalWears[1], 1) }} Total Orders</small>
                        </div>
                    </div>
                    <br>
                    <div class="card-body">

                        <ul class="p-0 m-0">
                            @foreach ($topProducingWears as $wears)
                                <li class="pb-1 mb-4 d-flex">
                                    <div class="flex-shrink-0 avatar me-3">
                                        <span class="rounded avatar-initial bg-label-success"><i
                                                class="menu-icon tf-icons bx bxs-purchase-tag "></i></span>
                                    </div>

                                    <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $wears->item->name }}</h6>
                                            <small class="text-muted">GH₵ {{ $wears->total_amount_ordered }}</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $wears->quantity_ordered }}</small>
                                        </div>

                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <br>


                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="gap-1 d-flex flex-column align-items-start">
                                <p style="margin: 0;">Total number of wears ordered</p>
                                <h3 class="mb-2">{{ number_format($totalWears[0], 0) }} Wears</h3>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!--/ Top Selling Statistics -->

            {{-- <!-- Top Customer Statistics -->
      <div class="mb-4 col-md-6 col-lg-4 col-xl-4 order-0">
        <div class="card h-100">
          <div class="pb-0 card-header d-flex align-items-center justify-content-between">
            <div class="mb-0 card-title">
              <h5 class="m-0 me-2">Top Customers</h5>
              <small class="text-muted">GH₵ {{ number_format($sales['year'], 1) }} Total Sales</small>
            </div>
          </div>
          <br>
          <div class="card-body">

            <ul class="p-0 m-0">

              @foreach ($topCustomers as $customer)

              <li class="pb-1 mb-4 d-flex">
                <div class="flex-shrink-0 avatar me-3">
                  <span class="rounded avatar-initial bg-label-success">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                  </span>


                </div>
                <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
                  <div class="me-2">
                    <h6 class="mb-0">{{ $customer->customer->name }}</h6>
                    <small class="text-muted">{{ $customer->customer->customer_number }}</small>
                  </div>
                  <div class="user-progress">
                    <small class="fw-semibold">GH₵{{ number_format($customer->total_purchases,2) }}</small>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
            <br>
            <div class="mb-3 d-flex justify-content-between align-items-center">
              <div class="gap-1 d-flex flex-column align-items-center">
                <p style="margin: 0;">Total number of customers</p>
                <h3 class="mb-2">{{ number_format($totalCustomers),0 }} Customers</h3>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!--/ Top Customer Statistics --> --}}

            <!-- Top Selling Statistics -->
            <div class="mb-4 col-md-6 col-lg-4 col-xl-4 order-0">
                <div class="card h-100">
                    <div class="pb-0 card-header d-flex align-items-center justify-content-between">
                        <div class="mb-0 card-title">
                            <h5 class="m-0 me-2 ">Top Products</h5>
                            <small class="text-muted">GH₵ {{ number_format($totalItems[1], 1) }} Total Sales</small>
                        </div>
                    </div>
                    <br>
                    <div class="card-body">

                        <ul class="p-0 m-0">
                            @foreach ($bestSellingProducts as $product)
                                <li class="pb-1 mb-4 d-flex">
                                    <div class="flex-shrink-0 avatar me-3">
                                        <span class="rounded avatar-initial bg-label-primary"><i
                                                class="menu-icon tf-icons bx bx-cart-alt "></i></span>
                                    </div>

                                    <div class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $product->product->name }}</h6>
                                            <small class="text-muted">GH₵ {{ $product->total_amount_sold }}</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $product->total_sold }}</small>
                                        </div>

                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <br>


                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="gap-1 d-flex flex-column align-items-start">
                                <p style="margin: 0;">Total number of items sold</p>
                                <h3 class="mb-2">{{ number_format($totalItems[0], 0) }} Products</h3>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!--/ Top Selling Statistics -->

            <!-- User Logs -->
            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Manager')
                <div class="order-2 mb-4 col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="m-0 card-title me-2">User Logs</h5>
                            <div class="dropdown">
                                <button class="p-0 btn" type="button" id="transactionID" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                    <a class="dropdown-item" href="{{ route('log.index') }}">All Logs</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Get Report</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="p-0 m-0">

                                @foreach ($userLogs as $log)
                                    <li class="pb-1 mb-4 d-flex">
                                        <div
                                            class="flex-wrap gap-2 d-flex w-100 align-items-center justify-content-between">
                                            <div class="me-2">
                                                <small class="mb-1 text-muted d-block">{{ $log->user->name }}</small>
                                                <h6 class="mb-0" style="">Performed a {{ $log->action }} Action
                                                </h6>
                                            </div>
                                            <div class="gap-1 user-progress d-flex align-items-center">
                                                <h6 class="mb-0" style="font-size: 12px">
                                                    {{ $log->created_at->format('Y-m-d') }}</h6>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <!--/ User Logs -->

        </div>
    </div>


@endsection

@section('scripts')
@endsection
