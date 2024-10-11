@extends('layouts.flow')

@section('title')
  <title>FaithFlow -- Admin Dashboard</title>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12 col-xl-12">
      <div class="card">
        <div class="card-body position-relative">
          <div>
            <h3 class="mb-3 card-title ">{{ $greeting[0] }},</h3>
            <h3 class="mb-3 card-title ">{{ Auth()->user()->name }},</h3>
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
    {{-- <div class="col-lg-12 col-xl-6">
      <div class="row">
        @foreach ($financeStats as $groupName => $balance)
        <div class="col-sm-4">
          <div class="overflow-hidden card warning-card text-bg-primary">
            <div class="p-4 card-body">
              <div class="mb-6">
                <i class="ti ti-brand-producthunt fs-8 fw-lighter"></i>
              </div>
              <h5 class="text-white fw-bold fs-14 text-nowrap">
                {{ number_format(($balance*-1), 2) }} <span class="fs-1 fw-light"></span>
              </h5>
              <p class="mb-0 opacity-50 fs-2">{{ $groupName }}</p>
            </div>
          </div>
        </div>
        @endforeach


        <div class="col-sm-4">
          <div class="overflow-hidden card danger-card text-bg-primary">
            <div class="p-4 card-body">
              <div class="mb-7">
                <i class="ti ti-report-money fs-8 fw-lighter"></i>
              </div>
              <h5 class="text-white fw-bold fs-14">
                356 <span class="fs-2 fw-light">+8%</span>
              </h5>
              <p class="mb-0 opacity-50">Refunds</p>
            </div>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="overflow-hidden card info-card text-bg-primary">
            <div class="p-4 card-body">
              <div class="mb-7">
                <i class="ti ti-currency-dollar fs-8 fw-lighter"></i>
              </div>
              <h5 class="text-white fw-bold fs-14 text-nowrap">
                $235.8K <span class="fs-2 fw-light">-3%</span>
              </h5>
              <p class="mb-0 opacity-50">Earnings</p>
            </div>
          </div>
        </div>
      </div>
    </div> --}}


    {{-- MEMBERSHIP --}}
    <div class="col-lg-6">

        <div class="row">
            <div class="col-sm-12">
                <div class="overflow-hidden shadow-none card info-card bg-primary-subtle">
                <div class="p-4 card-body">
                    <h5 class=" fw-bold fs-14 text-nowrap">
                        {{ $memberCount }}
                        <span class="fs-2 fw-light"></span>
                    </h5>
                    <p class="mb-0 opacity-50">Total Membership</p>
                </div>
                </div>
            </div>

            @foreach($memberCountGender as $member)
            <div class="col-sm-6">
                <div class="overflow-hidden shadow-none card info-card bg-primary-subtle">
                <div class="p-4 card-body">
                    <h5 class=" fw-bold fs-14 text-nowrap">
                        {{ $member->count_18_and_above }}  <span class="fs-2 fw-light"></span>
                    </h5>
                    <p class="mb-0 opacity-50">{{ $member->gender }} Above 18</p>
                </div>
                </div>
            </div>
            @endforeach

            @foreach($memberCountGender as $member)
            <div class="col-sm-6">
                <div class="overflow-hidden shadow-none card info-card bg-primary-subtle">
                <div class="p-4 card-body">
                    <h5 class=" fw-bold fs-14 text-nowrap">
                        {{ $member->count_below_18 }} <span class="fs-2 fw-light"></span>
                    </h5>
                    <p class="mb-0 opacity-50">{{ $member->gender }} Below 18</p>
                </div>
                </div>
            </div>
            @endforeach

            {{-- <div class="col-sm-6">
                <div class="overflow-hidden shadow-none card info-card bg-primary-subtle">
                <div class="p-4 card-body">
                    <h5 class=" fw-bold fs-14 text-nowrap">
                    {{ $leaderCount }} <span class="fs-2 fw-light"></span>
                    </h5>
                    <p class="mb-0 opacity-50">Leaders</p>
                </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="overflow-hidden shadow-none card info-card bg-primary-subtle">
                <div class="p-4 card-body">
                    <h5 class=" fw-bold fs-14 text-nowrap">
                    {{ $staffCount }} <span class="fs-2 fw-light"></span>
                    </h5>
                    <p class="mb-0 opacity-50">Staff</p>
                </div>
                </div>
            </div> --}}


        </div>
    </div>

    <div class="col-lg-6">
    <div class="card">
        <div class="card-body">

        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 card-title">Membership Distribution</h4>
            <div class="dropdown">
            <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                <i class="ti ti-dots-vertical fs-7 d-block"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li>
                <a class="dropdown-item" href="{{ route('member.index') }}">Members</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('pastor.index') }}">Pastors</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('leader.index') }}">Leaders</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('staff.index') }}">Staff</a>
                </li>

            </ul>
            </div>
        </div>

        <div class="mt-2 d-flex align-items-center">
            <div class="d-sm-flex d-block align-items-center justify-content-center">
                <div id="member_dist" class="mx-n6"></div>

                <div class="ms-xxl-4">
                    <div class="mb-4 d-flex align-items-baseline">
                        <div>
                            <i class="ti ti-circle text-primary me-2 fs-5"></i>
                        </div>

                        <div>
                            <h5 class="mb-0">{{ $memberCount }} <span class="fs-2 fw-light text-success"></span>
                            </h5>
                            <p class="mb-0 fs-3">Members</p>
                        </div>

                    </div>

                    <div class="mb-4 d-flex align-items-baseline">
                    <div>
                        <i class="ti ti-circle text-danger me-2 fs-5"></i>
                    </div>

                    <div>
                        <h5 class="mb-0">{{ $pastorCount }}</h5>
                        <p class="mb-0 fs-3">Pastors</p>
                    </div>
                    </div>

                    <div class="mb-4 d-flex align-items-baseline">
                    <div>
                        <i class="ti ti-circle text-warning me-2 fs-5"></i>
                    </div>

                    <div>
                        <h5 class="mb-0">{{ $leaderCount }}</h5>
                        <p class="mb-0 fs-3">Leaders</p>
                    </div>
                    </div>

                    <div class="d-flex align-items-baseline">
                        <div>
                        <i class="ti ti-circle text-success me-2 fs-5"></i>
                        </div>
                        <div>
                        <h5 class="mb-0">{{ $staffCount }}</h5>
                        <p class="mb-0 fs-3">Staff</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        </div>
        </div>
    </div>

    {{-- REVENUE AND EXPENSES --}}
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="mb-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 card-title">Revenue & Expenses</h4>

            <div class="dropdown">
              <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                <i class="ti ti-dots-vertical fs-7 d-block"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li>
                  <a class="dropdown-item" href="{{ route('finance.index') }}">More Details</a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('report.index') }}">Generat Reports</a>
                </li>
              </ul>
            </div>
          </div>

          <div class="row align-items-center">
            <div class="col-md-9 d-flex flex-column">
              <div id="finance" class="profit-chart mx-n6"></div>
            </div>

            <div class="col-md-3">
              <div>
                <div class="pb-3 mb-4 d-flex">
                  <div class="p-2 bg-primary-subtle text-primary rounded-circle me-3 round-40 hstack justify-content-center">
                    <iconify-icon icon="solar:document-text-linear" class="fs-6"></iconify-icon>
                  </div>

                  <div>
                    <h5 class="mb-0 fs-5">GHC {{ number_format(($totalRevenue*-1), 2) }}</h5>
                    <p class="mb-0 fs-3">Total Revenue This Year</p>
                  </div>
                </div>

                <div class="pb-3 mb-4 d-flex">
                    <div class="p-2 bg-info-subtle text-info rounded-circle me-3 round-40 hstack justify-content-center">
                        <iconify-icon icon="solar:quit-full-screen-circle-linear" class="fs-6"></iconify-icon>
                    </div>

                    <div>
                      <h5 class="mb-0 fs-5">
                        GHC {{ number_format($totalExpenses, 2) }} <span class="fs-2 fw-light"></span>
                        <span class="fs-2 fw-light text-success"></span>
                      </h5>
                      <p class="mb-0 fs-3">Total Expenses This Year</p>
                    </div>
                  </div>


                <div>
                  <a href="{{ route('report.index') }}" class="btn btn-primary rounded-pill">
                    Get Financial Reports
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <div class="mb-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 card-title">Product Sales</h4>

            <div class="dropdown">
              <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                <i class="ti ti-dots-vertical fs-7 d-block"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li>
                  <a class="dropdown-item" href="javascript:void(0)">Action</a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                </li>
              </ul>
            </div>
          </div>
          <div id="test"></div>

          <div class="mt-3 d-flex align-items-center">
            <div class="rounded-3 bg-primary-subtle me-3 round-40 d-flex align-items-center justify-content-center">
              <img src="../assets/images/svgs/icon-user.svg" alt="spike-img" class="img-fluid">
            </div>
            <div>
              <div class="d-flex align-items-center">
                <h5 class="mb-0 fs-4">36,436</h5>
                <span class="border badge rounded-pill bg-success-subtle text-success border-success ms-1">+12%</span>
              </div>
              <p class="mb-0">New Customer</p>
            </div>
          </div>

        </div>
      </div>
    </div> --}}

    {{-- ATTENDANCE --}}
    <div class="col-lg-12">
        <div class="row">
          @foreach($statistics as $category => $stat)
          <div class="col-sm-3">
            <div class="overflow-hidden card info-card text-bg-primary">
                <div class="p-4 card-body">
                <h5 class="text-white fw-bold fs-14 text-nowrap">
                    {{ $stat['last_attendance'] }}
                    @if (is_null($stat['percentage_change']))
                    <span class="fs-2 fw-light">NA</span>
                    @elseif ($stat['percentage_change'] <= 0)
                        <span class="fs-2 fw-light">{{ number_format($stat['percentage_change'], 2) }}%</span>
                    @else
                        <span class="fs-2 fw-light">{{ number_format($stat['percentage_change'], 2) }}%</span>
                    @endif
                </h5>
                <p class="mb-0 opacity-50 ">{{ $category }} Attendance</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
    </div>

    {{-- VISITORS --}}
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="mb-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 card-title">Recent Visitors</h4>

            <div class="dropdown">
              <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                <i class="ti ti-dots-vertical fs-7 d-block"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li>
                  <a class="dropdown-item" href="{{ route('visitors.index') }}">All Visitors</a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('visitors.create') }}">Add Visitor</a>
                </li>

              </ul>
            </div>
          </div>

          <div class="table-responsive" data-simplebar>
            <table class="table mb-1 align-middle table-borderless text-nowrap">
              <thead>
                <tr>
                  <th scope="col">Profile</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Location</th>
                  <th scope="col">Date Visited</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($visitors as $visitor)
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="me-3">
                        <img src="../assets/images/profile/visitor.png" width="50" class="rounded-circle" alt="spike-img" />
                      </div>

                      <div>
                        <h6 class="mb-1 fw-bolder">{{ $visitor->name }}</h6>
                        <p class="mb-0 fs-3">Visitor</p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="mb-0 fs-3 fw-normal">{{ $visitor->phone }}</p>
                  </td>
                  <td>
                    <p class="mb-0 fs-3">
                      {{ $visitor->location }}
                    </p>
                  </td>

                  <td class="px-0">{{ formatShortDates($visitor->date_visited) }}</td>

                </tr>
                @empty
                    <tr>
                        <td><p>No visitors recorded</p></td>
                    </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

        {{-- Reminders  --}}

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                <div class="">
                    <h4 class="mb-0 card-title">Reminders</h4>

                    <div class="table-responsive">
                        <table class="table mb-1 align-middle table-borderless text-nowrap">
                          <thead>
                            <tr>
                                <th>Member Name</th>
                                <th>Birthday</th>                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($birthdayCelebrants as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->dob)->format('l, j') }}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td><p>No visitors recorded</p></td>
                                </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Tasks --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 card-title">Pending tasks</h4>
                    <div class="dropdown">
                    <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                        <i class="ti ti-dots-vertical fs-7 d-block"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li>
                        <a class="dropdown-item" href="{{ route('tasks.index') }}">View all</a>
                        </li>
                    </ul>
                    </div>
                </div>

            </div>
            </div>
        </div>

</div>

@endsection

@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                // Here you'll need to dynamically populate events from your database
                // You can fetch events from your Laravel backend using AJAX or directly pass them as JSON
                @foreach($events as $event)
                    {
                        title: '{{ $event->title }}',
                        start: '{{ $event->start_datetime }}',
                        end: '{{ $event->end_datetime }}',
                        color: 'orange',
                        // Add more event properties as needed
                    },
                @endforeach

                @foreach($projects as $event)
                    {
                        title: '{{ $event->name }}',
                        start: '{{ $event->start_date }}',
                        end: '{{ $event->end_date }}',
                        color: 'blue',
                        // Add more event properties as needed
                    },
                @endforeach
            ]
        });
        calendar.render();
    });
</script>

<script>

    // =====================================
    // Grade End
    // =====================================
    var member_dist = {
        series: [{{ $memberCount }}, {{ $pastorCount }}, {{ $leaderCount }}, {{ $staffCount }}],
        labels: ["Members", "Pastors", "Leaders", "Staff"],
        chart: {
            height: 250,
            type: "donut",
            fontFamily: "inherit",
            foreColor: "#c6d1e9",
        },

        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
        },

        colors: ["var(--bs-primary)", "var(--bs-warning)", "var(--bs-danger)", "var(--bs-success)"],
        dataLabels: {
            enabled: false,
        },

        grid: {
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0,
            },
        },

        legend: {
            show: false,
        },

        stroke: {
            show: false,
        },

        plotOptions: {
            pie: {
                donut: {
                    size: "75%",
                    background: "none",
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontSize: "18px",
                            color: undefined,
                            offsetY: 5,
                        },
                        value: {
                            show: false,
                            color: "#98aab4",
                        },
                    },
                },
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#member_dist"), member_dist);
    chart.render();

</script>

<script>
    var finance = {
        series: [
            {
                name: "Revenue",
                data: {!! $revenue !!},
            },
            {
                name: "Expense",
                data: {!! $expense !!},
            },
        ],
        colors: ["var(--bs-primary)", "var(--bs-secondary)"],
        chart: {
            type: "bar",
            fontFamily: "inherit",
            foreColor: "#adb0bb",
            width: "100%",
            height: 300,
            stacked: true,
            toolbar: {
                show: !1,
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "27%",
                borderRadius: 6,
            },
        },
        dataLabels: {
            enabled: false,
        },
        grid: {
            borderColor: "var(--bs-border-color)",
            padding: { top: 0, bottom: -8, left: 20, right: 20 },
        },
        tooltip: {
            theme: "dark",
        },
        toolbar: {
            show: false,
        },
        xaxis: {
            categories: {!! $months !!},
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        legend: {
            show: false,
        },
        fill: {
            opacity: 1,
        },
    };

    var chart = new ApexCharts(document.querySelector("#finance"), finance);
    chart.render();
</script>

@endsection



