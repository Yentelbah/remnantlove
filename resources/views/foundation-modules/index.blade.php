
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Foundation School</title>
@endsection

@section('content')
<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Foundation School</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Foundation School</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="justify-between mb-2 d-flex">
        <h4 class="mb-0 card-title">Modules</h4>

        <div class="ms-auto">
            <a href="{{ route('foundation-modules.create') }}" class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1">Add Module</a>
        </div>
      </div>
    <div class="mb-3 row">

        <div class="p-2 table-responsive">
            <table class="table align-items-center table-flush table-hover" id="facilities">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                @foreach($modules as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->module_name }}</td>
                    <td>{{ $value->description }}</td>

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

            @include('foundation-modules.edit')
           @include('foundation-modules.delete')

          </div>
        </div>
      </div>

  </div>

@endsection

@section('scripts')

    <script>
        function openEditModal(id) {
            $.ajax({
                url: '/foundation-modules/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#ed_name').val(response.module_name);
                    $('#ed_description').val(response.description);
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
                url: '/foundation-modules/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#del_name').text(response.module_name);
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
