
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Souls Won --  {{ $evangelism->event_name }}</title>
@endsection


@section('content')

    <div class="mb-3 overflow-hidden position-relative">
        <div class="px-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-0 fs-6">{{ $evangelism->event_name }}</h4>
        <nav aria-label="breadcrumb">
            <ol class="mb-0 breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('evangelism.index') }}">Evangelism Events</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Event</li>
            </ol>
        </nav>
        </div>
    </div>

    <div class="row">
        <div class="col col-lg-4">
            <div class="card ">
                <div class="pt-4 pb-1 card-body">
                  <h4 class="mb-2 fs-6">Event Details</h4>
                  <div class="py-9 border-top">

                    <div class="mt-1 mb-4 border-bottom">
                      <div class="pb-2 mb-3 border-bottom">
                        <h6>{{ $evangelism->description }}</h6>
                      </div>

                      <ul>
                        <li class="py-2">
                          <p class="mb-0 fw-normal text-dark">
                            Date:
                            <span class="fw-light ms-1">{{ formatShortDates($evangelism->date) }}</span>
                          </p>
                        </li>

                        <li class="py-2">
                          <p class="mb-0 fw-normal text-dark">
                            Location:
                            <span class="fw-light ms-1">{{ $evangelism->location }}</span>
                          </p>
                        </li>

                        <li class="py-2">
                            <p class="mb-0 fw-normal text-dark">
                              Souls won:
                              <span class="fw-light ms-1">{{ number_format($count,) }}</span>
                            </p>
                          </li>
                      </ul>
                    </div>


                  </div>

                </div>
            </div>

            @include('evangelism.add')

        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="justify-between mb-2 d-flex">
                    <h4 class="mb-0 card-title">Souls Won</h4>
                    <a data-bs-toggle="modal" data-bs-target="#createModal" id="#modalCenter" class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1">Add Soul</a>

                    </div>
                    <div class="p-1 table-responsive">
                        <table class="table align-items-center table-flush table-hover" id="events">
                        <thead class="thead-light">
                            <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Leader</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($evangelism->converts as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->shepherd->name ?? 'No Shepherd'}}</td>

                                <td>
                                    <div class="dropdown">
                                        <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                                          <i class="ti ti-dots-vertical fs-4 d-block"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">

                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item d-flex align-items-center" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#editModal" id="#modalCenter" onclick="openEditModal('{{ $value->id }}')">
                                                    <i class="fs-4 ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal" id="#modalCenter" onclick="openDeleteModal('{{ $value->id }}')"> <i class="fs-4 ti ti-trash me-2"></i> Delete</a>
                                            </li>

                                        </ul>
                                      </div>
                                    </div>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                        </table>

                        @include('converts.edit')
                        @include('converts.status')
                        @include('converts.delete')
                        @include('converts.follow_up')

                    </div>
                    {{-- <div class="card-footer"></div> --}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script>
    function openEditModal(id) {
        $.ajax({
            url: '/converts/' + id, // Replace with the appropriate route for fetching department details
            type: 'GET',
            success: function(response) {
                // Update the modal content with the fetched department details
                $('#ed_name').val(response.name);
                $('#ed_gender').val(response.gender);
                $('#ed_phone').val(response.phone);
                $('#ed_location').val(response.location);
                $('#ed_email').val(response.email);
                $('#ed_shepherd').val(response.shepherd_id);
                $('#ed_description').val(response.description);
                $('#ed_dob').val(response.dob);
                $('#ed_occupation').val(response.occupation);
                $('#ed_preferred_contact').val(response.preferred_contact);
                $('#ed_best_time').val(response.best_time);
                $('#ed_selectedId').val(response.id);
            },
            error: function(xhr) {
                // Handle error case
                console.log(xhr);
            }
        });
    }

    function openStatusModal(id) {
        $.ajax({
            url: '/converts/' + id, // Replace with the appropriate route for fetching department details
            type: 'GET',
            success: function(response) {
                // Update the modal content with the fetched department details
                $('#sta_name').text(response.name);
                $('#status').val(response.status);
                $('#sta_selectedId').val(response.id);
            },
            error: function(xhr) {
                // Handle error case
                console.log(xhr);
            }
        });
    }

    function openDeleteModal(id) {
        $.ajax({
            url: '/converts/' + id, // Replace with the appropriate route for fetching department details
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
