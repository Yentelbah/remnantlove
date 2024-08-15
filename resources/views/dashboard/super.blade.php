@extends('layouts.flow')

@section('title')
  <title>FaithFlow -- System Dashboard</title>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12 col-xl-12">
      <div class="card">
        <div class="card-body position-relative">
          <div>
            <h3 class="mb-3 card-title ">{{ $greeting[0] }} {{ Auth()->user()->name }},</h3>
            <p class="pb-0 mb-0 card-subtitle fs-3 col-lg-7 col-md-7 col-sm-7">{{ $greeting[1] }}</p>
          </div>
          <div class="school-img d-none d-sm-block">
            <img src="../assets/images/backgrounds/school.png" class="img-fluid" alt="spike-img" />
          </div>

          <div class="text-center d-sm-none d-block">
            <img src="../assets/images/backgrounds/school.png" class="img-fluid" alt="spike-img" />
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-xl-12">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="overflow-hidden shadow-none card info-card bg-primary-subtle">
                <div class="p-4 card-body">
                    <h5 class=" fw-bold fs-14 text-nowrap">
                       1223 <span class="fs-2 fw-light"></span>
                    </h5>
                    <p class="mb-0 opacity-50"> Above 18</p>
                </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="overflow-hidden shadow-none card info-card bg-primary-subtle">
                <div class="p-4 card-body">
                    <h5 class=" fw-bold fs-14 text-nowrap">
                       1223 <span class="fs-2 fw-light"></span>
                    </h5>
                    <p class="mb-0 opacity-50"> Above 18</p>
                </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="overflow-hidden shadow-none card info-card bg-primary-subtle">
                <div class="p-4 card-body">
                    <h5 class=" fw-bold fs-14 text-nowrap">
                       1223 <span class="fs-2 fw-light"></span>
                    </h5>
                    <p class="mb-0 opacity-50"> Above 18</p>
                </div>
                </div>
            </div>


            <div class="col-lg-3 col-sm-6">
                <div class="overflow-hidden shadow-none card info-card bg-primary-subtle">
                <div class="p-4 card-body">
                    <h5 class=" fw-bold fs-14 text-nowrap">
                        1323 <span class="fs-2 fw-light"></span>
                    </h5>
                    <p class="mb-0 opacity-50"> Below 18</p>
                </div>
                </div>
            </div>


        </div>
    </div>

    {{-- New churches --}}
    <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="mb-4 d-flex justify-content-between align-items-center">
              <h4 class="mb-0 card-title">Recent Organisations</h4>

              <div class="dropdown">
                <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                  <i class="ti ti-dots-vertical fs-7 d-block"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                  <li>
                    <a class="dropdown-item" href="{{ route('client.index') }}">View All</a>
                  </li>

                </ul>
              </div>
            </div>

            <div class="table-responsive" data-simplebar>
              <table class="table mb-1 align-middle table-borderless text-nowrap">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Location</th>
                    <th scope="col">Date Created</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($organisations as $result)
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div>
                          <h6 class="mb-1 fw-bolder">{{ $result->name }}</h6>
                      </div>
                    </td>
                    <td>
                      <p class="mb-0 fs-3 fw-normal">{{ $result->phone }}</p>
                    </td>
                    <td>
                      <p class="mb-0 fs-3">
                        {{ $result->city }}
                      </p>
                    </td>

                    <td class="px-0">{{ formatShortDates($result->created_at) }}</td>

                  </tr>
                  @empty
                      <tr>
                          <td><p>No organisations</p></td>
                      </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

</div>

@endsection

@section('scripts')


@endsection



