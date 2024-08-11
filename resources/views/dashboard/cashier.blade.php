@extends('layouts.main')

@section('title')
  <title>Dashboard</title>
@endsection


@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-center row">
                    <div class="col-sm-12">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Welcome!</h4>
                        <p>Accounting mastery unfolds in every entry, a testament to the casheir's precision and financial expertise.</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 md-4 order-1">
            <div class="row">
              <div class="col-lg-4 col-md-12 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div  style="color:#20d920 ; background-color: #a5f3d869; padding: 5px 8px; border-radius: 4px;" class="avatar flex-shrink-0">
                        <i class="menu-icon tf-icons bx bx-shopping-bag rounded"></i>
                      </div>
                    </div>

                    <span>Sales Today</span>
                    <h3 class="card-title mb-1">GH₵ {{ number_format($sales['today'], 1) }}</h3>
                    <small class="{{ ($sales['percentageIncreaseDay'] >= 0.1) ? 'text-success fw-semibold' : 'text-danger fw-semibold' }}">
                      <i class="{{ ($sales['percentageIncreaseDay'] >= 0.1) ? 'bx bx-up-arrow-alt' : 'bx bx-down-arrow-alt' }}"></i>
                      @if($sales['percentageIncreaseDay'] !== null)
                        {{ number_format($sales['percentageIncreaseDay'], 2) }}%
                      @endif
                    </small>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-12 col-lg-4 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div  style="color:#20d920 ; background-color: #a5f3d869; padding: 5px 8px; border-radius: 4px;" class="avatar flex-shrink-0">
                        <i class="menu-icon tf-icons bx bx-shopping-bag rounded"></i>
                      </div>
                    </div>
                    <span>Sales This Month</span>
                    <h3 class="card-title text-nowrap mb-1">GH₵ {{ number_format($sales['month'], 1) }}</h3>
                    <small class="{{ ($sales['percentageIncreaseMonth'] >= 0.1) ? 'text-success fw-semibold' : 'text-danger fw-semibold' }}">
                      <i class="{{ ($sales['percentageIncreaseMonth'] >= 0.1) ? 'bx bx-up-arrow-alt' : 'bx bx-down-arrow-alt' }}"></i>
                      @if($sales['percentageIncreaseMonth'] !== null)
                        {{ number_format($sales['percentageIncreaseMonth'], 2) }}%
                      @endif
                    </small>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-12 col-lg-4 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div style="color:#20d920 ; background-color: #a5f3d869; padding: 5px 8px; border-radius: 4px;" class="avatar flex-shrink-0">

                        <i class="menu-icon tf-icons bx bx-shopping-bag rounded"></i>
                      </div>

                    </div>
                    <span class="d-block mb-1">Sales This Year</span>
                    <h3 class="card-title text-nowrap mb-1">GH₵ {{ number_format($sales['year'], 1) }}</h3>
                    <small class="{{ ($sales['percentageIncreaseYear'] >= 0.1) ? 'text-success fw-semibold' : 'text-danger fw-semibold' }}">
                      <i class="{{ ($sales['percentageIncreaseYear'] >= 0.1) ? 'bx bx-up-arrow-alt' : 'bx bx-down-arrow-alt' }}"></i>
                      @if($sales['percentageIncreaseYear'] !== null)
                        {{ number_format($sales['percentageIncreaseYear'], 2) }}%
                      @endif
                    </small>
                  </div>
                </div>
              </div>

            </div>
          </div>

    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="row">
                <div class="mb-4 col-md-6 col-lg-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon primary d-flex align-items-start justify-content-center">
                        <i class="rounded menu-icon tf-icons bx bxs-briefcase" style="font-size: 48px" aria-hidden="true"></i>
                        </div>
                        <div class="stat-cards-info">
                        <p class="stat-cards-info__num">{{ number_format($jobOrders[0]),0 }}</p>
                        <p class="stat-cards-info__title">Jobs Orders</p>
                        </div>
                    </article>
                </div>

                <div class="mb-4 col-md-6 col-lg-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon primary d-flex align-items-start justify-content-center">
                        <i class="rounded menu-icon tf-icons bx bx-male" style="font-size: 48px" aria-hidden="true"></i>
                        {{-- <i class="rounded menu-icon tf-icons bx bx-female"></i> --}}
                        </div>
                        <div class="stat-cards-info">
                        <p class="stat-cards-info__num">{{ number_format($jobOrders[1]),0 }}</p>
                        <p class="stat-cards-info__title">Order wears</p>
                        </div>
                    </article>
                </div>

                <div class="mb-4 col-md-6 col-lg-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon warning d-flex align-items-start justify-content-center">
                        <i class="rounded menu-icon tf-icons bx bxs-cabinet" style="font-size: 48px" aria-hidden="true"></i>
                        {{-- <i class="rounded menu-icon tf-icons bx bx-female"></i> --}}
                        </div>
                        <div class="stat-cards-info">
                        <p class="stat-cards-info__num">{{ number_format($jobOrders[2]),0 }}</p>
                        <p class="stat-cards-info__title">Complted Orders</p>
                        </div>
                    </article>
                </div>

                <div class="mb-4 col-md-6 col-lg-3">
                    <article class="stat-cards-item">
                        <div class="stat-cards-icon warning d-flex align-items-start justify-content-center">
                        <i class="rounded menu-icon tf-icons bx bxs-t-shirt" style="font-size: 48px" aria-hidden="true"></i>
                        {{-- <i class="rounded menu-icon tf-icons bx bx-female"></i> --}}
                        </div>
                        <div class="stat-cards-info">
                        <p class="stat-cards-info__num">{{ number_format($jobOrders[3]),0 }}</p>
                        <p class="stat-cards-info__title">Wears Produced</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>


  </div>


@endsection

@section('scripts')


@endsection
