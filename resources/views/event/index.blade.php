
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Events</title>
@endsection


@section('content')

    <div class="mb-3 overflow-hidden position-relative">
        <div class="px-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-0 fs-6">Events</h4>
        <nav aria-label="breadcrumb">
            <ol class="mb-0 breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Events</li>
            </ol>
        </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="justify-between mb-2 d-flex">
            <h4 class="mb-0 card-title">All Events</h4>

            <div class="ms-auto">
                <a href="{{ route('calendar.index') }}" class="px-4 mb-1 btn bg-primary-subtle text-primary fs-4 ms-auto me-1"><i class="fas fa-calendar"></i></a>

                <a  class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1" data-bs-toggle="modal" data-bs-target="#eventModal" id="#modalCenter">Add Event</a>
            </div>

            </div>
            <div class="p-3 table-responsive">
                <table class="table align-items-center table-flush table-hover" id="events">
                <thead class="thead-light">
                    <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Level</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->title }}</td>
                        <td>{{ $value->start_datetime }}</td>
                        <td>{{ $value->end_datetime }}</td>
                        <td>
                            @if ($value->event_level == 'Success' )
                            <span class="mb-1 badge bg-success text-success">{{ $value->event_level }}</span>
                            @elseif ($value->event_level == 'Warning')
                                <span class="mb-1 badge bg-warning text-warning">{{ $value->event_level }}</span>
                            @elseif ($value->event_level == 'Danger')
                                <span class="mb-1 badge bg-danger text-danger">{{ $value->event_level }}</span>
                            @elseif ($value->event_level == 'Info')
                                <span class="mb-1 badge bg-info text-info">{{ $value->event_level }}</span>
                            @elseif ($value->event_level == 'Primary')
                                <span class="mb-1 badge bg-primary text-primary">{{ $value->event_level }}</span>

                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                                  <i class="ti ti-dots-vertical fs-4 d-block"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                  <li>
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#editModal" id="#modalCenter" onclick="openEditModal('{{ $value->id }}')">Edit</a>
                                  </li>
                                  <li>
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal" id="#modalCenter" onclick="openDeleteModal('{{ $value->id }}')">Delete</a>
                                  </li>

                                </ul>
                              </div>
                            </div>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
                </table>

                @include('event.create')
                @include('event.edit')
                @include('event.delete')
                @include('event.download')

            </div>
            {{-- <div class="card-footer"></div> --}}
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        function openEditModal(id) {
            $.ajax({
                url: '/event/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched event details
                    $('#ed_level').val(response.event_level);
                    $('#ed_title').val(response.title);
                    $('#ed_start_datetime').val(response.start_datetime);
                    $('#ed_end_datetime').val(response.end_datetime);
                    $('#ed_description').val(response.description);
                    $('#ed_selectedId').val(response.id);

                    // Set the radio button based on the event level
                    $('input[name="event_level"]').prop('checked', false); // Uncheck all radio buttons first
                    $('input[name="event_level"][value="' + response.event_level + '"]').prop('checked', true); // Check the appropriate radio button
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }


        function openDeleteModal(id) {
            $.ajax({
                url: '/event/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#del_name').text(response.title);
                    $('#del_selectedId').val(response.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

<script>
    $("#events").DataTable({
        dom: "Bfrtip",
        buttons: ["copy", "csv", "excel", "pdf", "print",],
    });
    $(
        ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
    ).addClass("btn btn-primary btn-sm");
</script>

<script>
        $(document).ready(function () {
        $('#dataTable').DataTable(); // ID From dataTable
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>

@endsection
