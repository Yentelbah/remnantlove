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

    <div class="card">
        <div class="card card-body">
            <div class="justify-between mb-2 d-flex">
                <h4 class="mb-0 card-title">Attendance Statistics</h4>



                <div class="ms-auto">

                    <button type="button" class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto" data-bs-target="#serviceModal" data-bs-toggle="modal"><i class="ti ti-home me-1 fs-5"></i>Add Service</button>


                    <a href="{{ route('attendance.create') }}"  class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1" >Record Attendance</a>
                </div>
            </div>

            @include('attendance.service')

            <div class="p-3 table-responsive">
                <table class="table align-middle search-table text-nowrap" id="table">
                <thead class="header-item">
                    <th>#</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>C-M</th>
                    <th>C-F</th>
                    <th>A-M</th>
                    <th>A-F</th>
                    <th>Total</th>
                </thead>
                <tbody>
                    <!-- start row -->
                    @php $i = 1; @endphp
                    @foreach ($attendances as $item)

                    <tr class="search-items">
                    <th scope="row">{{ $i++ }}</th>
                    <td>
                        <span class="usr-ph-no" data-phone="{{ $item->service->name }}">{{ $item->service->name }}</span>
                    </td>
                    <td>
                        <span class="usr-ph-no" data-phone="{{ $item->service->service_date }}">{{ $item->service->service_date }}</span>
                    </td>

                    <td>
                        <span class="usr-location" data-location="{{ $item->children_males }}">{{ $item->children_males }}</span>
                    </td>

                    <td>
                        <span class="usr-location" data-location="{{ $item->children_females }}">{{ $item->children_females }}</span>
                    </td>
                        <td>
                        <span class="usr-location" data-location="{{ $item->adult_males }}">{{ $item->adult_males }}</span>
                        </td>

                        <td>
                        <span class="usr-location" data-location="{{ $item->adult_females }}">{{ $item->adult_females }}</span>
                        </td>

                    <td>
                        <span class="usr-location" data-location="{{ $item->tatal_attendance }}">{{ $item->total_attendance }}</span>
                    </td>

                    </tr>
                    @endforeach
                </tbody>
                </table>

            </div>
                <!--MODALS-->


            </div>
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

@endsection
