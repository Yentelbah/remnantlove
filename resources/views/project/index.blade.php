
@extends('layouts.flow')


@section('title')
    <title>FaithFlow -- Projects</title>
@endsection

@section('content')
<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Projects</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Projects</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="justify-between mb-2 d-flex">
        <h4 class="mb-0 card-title">All Projects</h4>

        <div class="ms-auto">
            <a  class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1" data-bs-toggle="modal" data-bs-target="#createModal" id="#modalCenter">Add Project</a>
        </div>
      </div>
    <div class="mb-3 row">

          <div class="p-3 table-responsive">
            <table class="table align-items-center table-flush table-hover" id="projects">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($projects as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->description }}</td>

                    <td>
                        <span class="badge {{ $value->status == 'Pending' ? 'badge bg-info' : ($value->status == 'In progress' ? 'badge bg-warning' : ($value->status == 'On hold' ? 'badge bg-primary' : ($value->status == 'Cancelled' ? 'badge bg-secondary' : ($value->status == 'Completed' ? 'badge bg-success' : '')))) }}">
                            {{ $value->status }}
                        </span>
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
                    </td>
                  </tr>

                @endforeach

              </tbody>
            </table>

            @include('project.create')
            @include('project.edit')
            @include('project.delete')
            @include('project.download')

          </div>
          {{-- <div class="card-footer"></div> --}}
        </div>
      </div>


</div>
@endsection

@section('scripts')

    <script>
        function openEditModal(id) {
            $.ajax({
                url: '/project/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#editName').val(response.name);
                    $('#editStart').val(response.start_date);
                    $('#editEnd').val(response.end_date);
                    $('#editDescription').val(response.description);
                    $('#selectedId').val(response.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openDeleteModal(id) {
            $.ajax({
                url: '/project/' + id, // Replace with the appropriate route for fetching department details
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

    <script src="{{ asset('assets//vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>


    <script>
        $("#projects").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print",],
        });
        $(
            ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
        ).addClass("btn btn-primary btn-sm");
    </script>


@endsection
