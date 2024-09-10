
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Converts</title>
@endsection

@section('content')
<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Converts</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Converts</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="justify-between mb-2 d-flex">
        <h4 class="mb-0 card-title">Converts</h4>

        <div class="ms-auto">
            <a href="{{ route('converts.create') }}" class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1">Add Convert</a>
        </div>
      </div>
    <div class="mb-3 row">

        <div class="p-2 table-responsive">
            <table class="table align-items-center table-flush table-hover" id="facilities">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Location</th>
                  <th>Status</th>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                @foreach($converts as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->phone }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->location }}</td>
                    <td>{{ $value->status }}</td>
                    {{-- <td class="px-0">{{ formatShortDates($value->created_at) }}</td> --}}

                    <td>
                        <div class="dropdown">
                            <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                              <i class="ti ti-dots-vertical fs-4 d-block"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                              <li>
                                <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#followModal" id="#modalCenter" onclick="openFollowupModal('{{ $value->id }}')">Follow-up</a>
                              </li>
                              <li>
                                <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#statusModal" id="#modalCenter" onclick="openStatusModal('{{ $value->id }}')">Status</a>
                              </li>

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

            @include('converts.edit')
            @include('converts.status')
            @include('converts.delete')

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
                    $('#ed_date_acquired').val(response.date_acquired);
                    $('#ed_description').val(response.description);
                    $('#selectedId').val(response.id);
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
                url: '/facility/' + id, // Replace with the appropriate route for fetching department details
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
        $("#facilities").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print",],
        });
        $(
            ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
        ).addClass("btn btn-primary btn-sm");
    </script>

@endsection
