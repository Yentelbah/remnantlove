
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Evangelism</title>
@endsection


@section('content')

    <div class="mb-3 overflow-hidden position-relative">
        <div class="px-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-0 fs-6">Evangelism Events</h4>
        <nav aria-label="breadcrumb">
            <ol class="mb-0 breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Evangelism</li>
            </ol>
        </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="justify-between mb-2 d-flex">
            <h4 class="mb-0 card-title">Evangelism Events</h4>

            <div class="ms-auto">
                <a  class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1" data-bs-toggle="modal" data-bs-target="#eventModal" id="#modalCenter">Add Evangelism Event</a>
            </div>

            </div>
            <div class="p-3 table-responsive">
                <table class="table align-items-center table-flush table-hover" id="events">
                <thead class="thead-light">
                    <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->event_name }}</td>
                        <td>{{ $value->date }}</td>
                        <td>{{ $value->location }}</td>
                        <td>{{ $value->description }}</td>

                        <td>
                            <div class="dropdown">
                                <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                                  <i class="ti ti-dots-vertical fs-4 d-block"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a href="{{ route('evangelism.converts', $value->id) }}" class="dropdown-item d-flex align-items-center">
                                            <i class="fs-4 ti ti-user-plus me-2"></i>Souls</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="dropdown-item d-flex align-items-center" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#editModal" id="#modalCenter" onclick="openEditModal('{{ $value->id }}')">
                                            <i class="fs-4 ti ti-edit me-2"></i>Edit</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal" id="#modalCenter" onclick="openDeleteModal('{{ $value->id }}')"> <i class="fs-4 ti ti-trash me-2"></i> Delete</a>
                                    </li>

                                </ul>
                              </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                </table>

                @include('evangelism.create')
                @include('evangelism.edit')
                @include('evangelism.delete')

            </div>
            {{-- <div class="card-footer"></div> --}}
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        function openEditModal(id) {
            $.ajax({
                url: '/evangelism_details/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched event details
                    $('#ed_level').val(response.event_level);
                    $('#ed_title').val(response.event_name);
                    $('#ed_date').val(response.date);
                    $('#ed_location').val(response.location);
                    $('#ed_description').val(response.description);
                    $('#ed_selectedId').val(response.id);

                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }


        function openDeleteModal(id) {
            $.ajax({
                url: '/evangelism_details/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#del_name').text(response.event_name);
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
