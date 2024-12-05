@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Attendance</title>
@endsection

@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-0 fs-6">Attendance</h4>
    <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">Attendance</li>
        </ol>
    </nav>
    </div>
</div>

<div class="row">
    @foreach($statistics as $category => $stat)
    <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
        <div class="overflow-hidden card w-100 position-relative">
        <div class="card-body">
            <div class="d-flex align-items-end justify-content-between">
                <div>
                    <h4 class="mb-0 card-title fs-6">{{ $stat['last_attendance'] }}</h4>
                    <p class="card-subtitle">{{ $category }}</p>
                </div>

                @if (is_null($stat['percentage_change']))
                <span class="text-success fw-normal">NA</span>
                @elseif ($stat['percentage_change'] <= 0)
                    <span class="text-danger fw-normal">{{ number_format($stat['percentage_change'], 2) }}%</span>
                @else
                    <span class="text-success fw-normal">{{ number_format($stat['percentage_change'], 2) }}%</span>
                @endif
            </div>
        </div>
        <div id="chart-{{ Str::slug($category) }}"></div>
        </div>
    </div>

        {{-- <div class="col-md-3">
            <div class="card">
                    <div id="chart-{{ Str::slug($category) }}"></div>
                    <div class="mt-0 d-flex align-items-center">

                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 fs-4">{{ $stat['last_attendance'] }}</h5>
                                <span class="border badge rounded-pill bg-success-subtle text-success border-success ms-1">
                                @if (is_null($stat['percentage_change']))
                                    N/A
                                @else
                                    {{ number_format($stat['percentage_change'], 2) }}%
                                @endif
                                </span>
                            </div>
                            <p class="mb-0">{{ $category }}</p>
                        </div>
                    </div>
            </div>
        </div> --}}
    @endforeach
</div>


<div class="row">
    <div class="col-md-5 col-lg-4">
        <div class="card card-body">
            <div class="justify-between mb-2 d-flex">
                <h4 class="py-2 mb-0 card-title">Services</h4>

                <div class="ms-auto">

                    <button type="button" class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto" data-bs-target="#serviceModal" data-bs-toggle="modal"><i class="ti ti-home me-1 fs-5"></i>Add Service</button>
                </div>
            </div>


            <div class="p-3 table-responsive">
                <table class="table align-middle search-table text-nowrap" id="service_table">
                <thead class="header-item">
                    <th>Service</th>
                    <th>Date</th>
                    <th></th>
                </thead>
                <tbody>
                    <!-- start row -->
                    @php $i = 1; @endphp
                    @foreach ($services as $item)

                    <tr class="search-items">

                        <td>
                            <span class="usr-ph-no">{{ $item->name }}</span>
                        </td>
                        <td>
                            <span class="usr-ph-no">{{ \Carbon\Carbon::parse($item->service_date)->format('d M Y') }}</span>
                        </td>

                        <td>
                            <div class="dropdown">
                                <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                                  <i class="ti ti-dots-vertical fs-4 d-block"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">

                                  <li>
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#recordModal" id="#modalCenter" onclick="openRecordModal('{{ $item->id }}')">Attendance</a>
                                  </li>

                                  <li>
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#ser_editModal" id="#modalCenter" onclick="openServiceEditModal('{{ $item->id }}')">Edit</a>
                                  </li>
                                  <li>
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal" id="#modalCenter" onclick="openServiceDeleteModal('{{ $item->id }}')">Delete</a>
                                  </li>

                                </ul>
                              </div>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
                </table>

            </div>
        </div>


        <div class="pt-8 mb-6 text-center border rounded-3">
            <br>
            {!! QrCode::size(300)->generate(route('attendance.form', [
                'churchId' => $church_id, // Replace with the variable holding the church ID
            ])) !!}
                    <p class="mt-3">Service Attendance Form</p>

        </div>

    </div>
    <div class="col-md-7 col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="justify-between mb-2 d-flex">
                    <h4 class="mb-0 card-title">Service Attendance Statistics</h4>
                </div>

                <div class="p-3 table-responsive">
                    <table class="table align-middle search-table text-nowrap" id="table">
                    <thead class="header-item">
                        <th>#</th>
                        <th>Service</th>
                        <th>C-M</th>
                        <th>C-F</th>
                        <th>A-M</th>
                        <th>A-F</th>
                        <th>Total</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <!-- start row -->
                        @php $i = 1; @endphp
                        @foreach ($attendances as $item)

                        <tr class="search-items">
                        <th scope="row">{{ $i++ }}</th>
                        <td>
                        <div class="d-flex align-items-center">
                            <div>
                              <h6 class="mb-1 fw-bolder">{{  $item->service->name  }}</h6>
                              <p class="mb-0 fs-3">Category: {{ $item->service->category }}</p>
                              <p class="mb-0 fs-3">{{ \Carbon\Carbon::parse($item->service->service_date)->format('d M Y') }}</p>
                            </div>
                          </div>
                        </td>

                        <td>
                            <span class="usr-location" data-location="{{ $item->children_males }}">{{ $item->children_males }}</span>
                        </td>

                        <td>
                            <span class="usr-location" data-location="{{ $item->children_females }}">{{ $item->children_females }}</span>
                        </td>
                            <td>
                            <span>{{ $item->adult_males }}</span>
                            </td>

                            <td>
                            <span class="usr-location" data-location="{{ $item->adult_females }}">{{ $item->adult_females }}</span>
                            </td>

                        <td>
                            <span class="usr-location" data-location="{{ $item->tatal_attendance }}">{{ $item->total_attendance }}</span>
                        </td>
                        <td style="text-align: center;">

                            <a type="button" value="{{ $item->id }}" class="text-info edit me-2" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openEditModal('{{ $item->id }}')">
                                <i class="ti ti-pencil fs-5"></i>
                            </a>

                        </td>

                        </tr>
                        @endforeach
                    </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @include('attendance.service')
    @include('attendance.record')
    @include('attendance.edit')
    @include('attendance.service.edit')
    @include('attendance.service.delete')

</div>




@endsection

@section('scripts')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @foreach($chartData as $category => $data)
            // Debugging: print the JSON data to the console
            console.log("Category: {{ addslashes($category) }}");
            console.log("Attendances: @json($data['attendances'])");

            var options = {
                series: [{
                    color: "var(--bs-primary)",
                    name: "{{ addslashes($category) }} Attendance",
                    data: @json($data['attendances'])
                }],
                chart: {
                    height: 80,
                    type: 'area',
                    fontFamily: 'inherit',
                    foreColor: '#626b81',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                grid: {
                    borderColor: 'rgba(0,0,0,0.0)',
                    strokeDashArray: 4,
                    strokeWidth: 3,
                    padding: {
                        top: -20,
                        bottom: 0,
                        left: 1,
                        right: 3
                    },
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 0.01,
                        inverseColors: false,
                        opacityFrom: 0.1,
                        opacityTo: 0,
                        stops: [20, 180],
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: '1',
                },
                xaxis: {
                    categories:{
                        show: false,
                    }, //@json($data['dates']),
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    labels: {
                        show: false,
                    },
                },
                tooltip: {
                    theme: 'dark',
                },
            };

            try {
                var chart = new ApexCharts(document.querySelector("#chart-{{ Str::slug($category) }}"), options);
                chart.render();
            } catch (error) {
                console.error("Error rendering chart for category: {{ addslashes($category) }}", error);
            }
        @endforeach
    });
</script>

<script>
    $("#table").DataTable({
        dom: "Bfrtip",
        buttons: ["copy", "csv", "excel", "pdf", "print",],
    });
    $(
        ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
    ).addClass("btn btn-primary btn-sm");
</script>


<script>
    function openServiceEditModal(id) {
        $.ajax({
            url: '/church_service/' + id, // Replace with the appropriate route for fetching service details
            type: 'GET',
            success: function(response) {
                // Parse the service date to 'YYYY-MM-DD' format if it includes time
                var serviceDate = response.service_date.split(' ')[0];  // Take only the date part

                // Update the modal content with the fetched service details
                $('#ser_ed_name').val(response.name);
                $('#ser_ed_category').val(response.category);
                $('#ser_ed_date').val(serviceDate);  // Set the date in 'YYYY-MM-DD' format
                $('#ser_ed_selectedId').val(response.id);
            },
            error: function(xhr) {
                // Handle error case
                console.log(xhr);
            }
        });
    }


    function openRecordModal(id) {
        $.ajax({
            url: '/church_service_att/' + id,
            type: 'GET',
            success: function(response) {
                $('#children_males').val(response.child_male_count);
                $('#children_females').val(response.child_female_count);
                $('#adult_males').val(response.adult_male_count);
                $('#adult_females').val(response.adult_female_count);
                $('#ser_name').text(response.service_name);
                $('#ser_selectedId').val(response.service_id);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

    function openServiceDeleteModal(id) {
        $.ajax({
            url: '/church_service/' + id, // Replace with the appropriate route for fetching department details
            type: 'GET',
            success: function(response) {
                // Update the modal content with the fetched department details
                $('#del_name').text(response.name);
                $('#del_selectedId').val(response.id);
            },
            error: function(xhr) {
                // Handle error case
                console.log(xhr);
            }
        });
    }

    function openEditModal(id) {
        $.ajax({
            url: '/attendance/' + id, // Replace with the appropriate route for fetching department details
            type: 'GET',
            success: function(response) {
                // Update the modal content with the fetched department details
                $('#ed_adult_females').val(response.adult_females);
                $('#ed_adult_males').val(response.adult_males);
                $('#ed_children_females').val(response.children_females);
                $('#ed_children_males').val(response.children_males);
                $('#ed_att_selectedId').val(response.id);
            },
            error: function(xhr) {
                // Handle error case
                console.log(xhr);
            }
        });
    }
</script>


@endsection
