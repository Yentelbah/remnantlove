@extends('layouts.flow')

@section('title')
     <title>FaithFLow -- Foundation School</title>
@endsection


@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Student Profile</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('foundation-school.index') }}">Foundation School</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Student Profile</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="overflow-hidden position-relative">
    {{-- <div class="overflow-hidden position-relative rounded-3">
      <img src="../assets/images/backgrounds/profilebg-2.jpg" alt="spike-img" class="w-100">
    </div> --}}
    <div class="card">
      <div class="pb-0 mb-4 card-body ">
        <div class="text-center d-md-flex align-items-center justify-content-between text-md-start">
          <div class="d-md-flex align-items-center">
            <div class="rounded-circle position-relative mb-9 mb-md-0 d-inline-block">

              <img src="{{ $foundationSchool->convert->member->photo == '' ?  '../assets/images/profile/user-1.jpg' : asset('storage/' .$foundationSchool->convert->member->photo) }}" alt="spike-img" class="img-fluid rounded-circle preview" width="100" height="100">

              <span class="bottom-0 p-1 text-white border border-white text-bg-primary rounded-circle d-flex align-items-center justify-content-center position-absolute end-0">
                <i class="ti ti-plus"  value="{{ $foundationSchool->id }}" data-bs-toggle="modal" data-bs-target="#imageModal" id="#modalCenter"></i>
              </span>
            </div>
            <div class="ms-0 ms-md-3 mb-9 mb-md-0">
              <div class="mb-1 d-flex align-items-center justify-content-center justify-content-md-start">
                <h4 class="mb-0 me-7 fs-7">{{ $foundationSchool->convert->name }}</h4>
                <span class="border badge fs-2 fw-bold rounded-pill bg-primary-subtle text-primary border-primary">Foundation School Student</span>
              </div>
              <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                <span class="p-1 bg-primary rounded-circle"></span>
                <h6 class="mb-0 ms-2">{{ $foundationSchool->progress_status }}</h6>
              </div>
            </div>
          </div>
        </div>

        @include('foundation.uploadImage')

      </div>
    </div>
  </div>

  <div class="mx-10 tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
      <div class="row">
        <div class="col-lg-4">
          <div class="card ">
            <div class="p-4 card-body">
              <h4 class="fs-6 mb-9">About Student</h4>
              {{-- <p class="mb-0 pb-9 text-dark">Biography</p> --}}
              <div class="py-9 border-top">
                {{-- <h5 class="mb-9">Contact</h5> --}}

                <div class="d-flex align-items-center mb-9">
                  <div class="bg-primary-subtle text-primary fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ti ti-calendar"></i>
                  </div>
                  <div class="ms-6">
                    <h6 class="mb-1">Enrollled</h6>
                    <p class="mb-0">{{ formatShortDates($foundationSchool->enrollment_date) }}</p>

                  </div>
                </div>

                {{-- <div class="d-flex align-items-center mb-9">
                    <div class="bg-primary-subtle text-primary fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ti ti-calendar"></i>
                    </div>
                    <div class="ms-6">
                      <h6 class="mb-1">Attendance</h6>
                      <p class="mb-0">{{ $foundationSchool->attendance === null ? 'Not Started' : $foundationSchool->attendance }}</p>
                    </div>
                </div> --}}

                <div class="d-flex align-items-center mb-9">
                    <div class="bg-primary-subtle text-primary fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ti ti-list"></i>
                    </div>
                    <div class="ms-6">
                      <h6 class="mb-1">Notes</h6>
                      <p class="mb-0">{{ $foundationSchool->notes === null ? 'No Detail' : $foundationSchool->notes }}</p>
                    </div>
                </div>

              </div>

            </div>
          </div>
        </div>

        <div class="col-lg-8">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item me-2" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                  Foundation Modules
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                  Statistics
                </button>
              </li>
            </ul>

            <div class="mt-4 card">
              <div class="card-body">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="pb-3 mb-4 border-bottom">
                      <h4 class="mb-0 card-title">Foundation Modules</h4>
                    </div>
                    <div class="overflow-x-auto table-responsive">
                      <table class="table align-middle text-nowrap">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">Module</th>
                            <th scope="col">Progress</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody class="border-top">
                            @foreach ($foundationSchool->foundationSchoolModules as $key => $student_module)
                          <tr>
                            <td>
                              <p class="mb-0 fw-normal fs-3 text-dark">
                                @if ($student_module->progress_status == 'In Progress' )
                                <i class="ti ti-circle-check fs-5 me-2 text-warning"></i>
                                @elseif ($student_module->progress_status == 'Missed')
                                <i class="ti ti-circle-x fs-5 me-2 text-danger"></i>
                                @elseif ($student_module->progress_status == 'Completed')
                                <i class="ti ti-circle-check fs-5 me-2 text-success"></i>
                                @elseif ($student_module->progress_status == 'Not Started')
                                <i class="ti ti-circle fs-5 me-2 text-primary"></i>
                                @endif
                              </p>
                            </td>
                            <td>
                              <p class="mb-0 text-dark fw-normal">
                                {{ $student_module->module->module_name }}
                              </p>
                            </td>
                            <td>
                                @if ($student_module->progress_status == 'In Progress' )
                                <p class="mb-0 fw-bold text-warning">{{ $student_module->progress_status }}</p>
                                @elseif ($student_module->progress_status == 'Missed')
                                <p class="mb-0 fw-bold text-danger">{{ $student_module->progress_status }}</p>
                                @elseif ($student_module->progress_status == 'Completed')
                                <p class="mb-0 fw-bold text-success">{{ $student_module->progress_status }}</p>
                                @elseif ($student_module->progress_status == 'Not Started')
                                <p class="mb-0 fw-bold text-primary">{{ $student_module->progress_status }}</p>
                                @endif
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                                        <i class="ti ti-dots-vertical fs-4 d-block"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <!-- Use $student_module->id to get the foundation_school_modules id -->
                                            <a href="javascript:void(0)" class="dropdown-item" value="{{ $student_module->id }}" data-bs-toggle="modal" data-bs-target="#progressModal" id="#modalCenter" onclick="openProgressModal('{{ $student_module->id }}')">
                                                Status
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
                  </div>

                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="pb-3 mb-4 border-bottom">
                      <h4 class="mb-0 card-title">Statistics</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="">Modules</h5>

                            <ul class="my-4 g-2">
                                <li class="mb-2 align-middle">
                                    <i class="ti ti-circle fs-5 me-2 text-primary"></i>
                                    Not Started: {{ $notStartedModules }}
                                </li>

                                <li class="mb-2 align-middle">
                                    <i class="ti ti-circle-x fs-5 me-2 text-danger"></i>
                                    Missed: {{ $missedModules }}
                                </li>

                              <li class="mb-2 align-middle">
                                <i class="ti ti-circle-check fs-5 me-2 text-warning"></i>
                                In Progress: {{ $inProgressModules }}
                              </li>

                              <li class="mb-2 align-middle">
                                <i class="ti ti-circle-check fs-5 me-2 text-success"></i>
                                Completed: {{ $completedModules }}
                              </li>
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <div id="studentProgressChart" class="mx-n6"></div>
                        </div>

                    </div>


                    <div class="mb-1 d-flex justify-content-between align-items-center">
                      <span>Progress</span>
                      <span>{{ $progressPercentage }}% Completed</span>
                    </div>
                    <div class="mb-1 progress bg-primary-subtle">
                        <!-- Inject progress percentage dynamically into the width -->
                        <div class="progress-bar text-bg-primary" role="progressbar" style="width: {{ $progressPercentage }}%;"
                          aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                        </div>
                      </div>
                    <span>{{ $totalModules - $completedModules }} remaining out of {{ $totalModules }} modules</span>

                  </div>
                </div>
              </div>
            </div>
        </div>


        @include('foundation.progress')


        </div>
      </div>

    </div>
  </div>


@endsection

@section('scripts')

    <script>
        function openProgressModal(id) {
            $.ajax({
                url: '/foundation-school-modules/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#mod_name').text(response.foundation_module.module_name);
                    $('#mod_selectedId').val(response.module.id);
                    $('#mod_student').val(response.module.foundation_school_id);

                    var progressStatus = response.module.progress_status;
                    if (progressStatus === 'Not Started') {
                        $('#not_started').prop('checked', true);
                    } else if (progressStatus === 'In Progress') {
                        $('#in_progress').prop('checked', true);
                    } else if (progressStatus === 'Missed') {
                        $('#missed').prop('checked', true);
                    } else if (progressStatus === 'Completed') {
                        $('#completed').prop('checked', true);
                    }
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

    <script>
        $("#facilities").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print",],
        });
        $(
            ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
        ).addClass("btn btn-primary btn-sm");
    </script>

    <script>
        var studentProgressChart = {
            series: [{{ $notStartedModules }}, {{ $inProgressModules }}, {{ $missedModules }}, {{ $completedModules }}],
            labels: ['Not Started', 'In Progress', 'Missed', 'Completed'],
            chart: {
                height: 200,
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

        var chart = new ApexCharts(document.querySelector("#studentProgressChart"), studentProgressChart);
        chart.render();
    </script>

@endsection
