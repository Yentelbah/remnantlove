
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Branches</title>
@endsection

@section('content')
  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Branches</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Branches</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
        <div class="justify-between mb-2 d-flex">
            <h4 class="mb-0 card-title">Branches</h4>

            <div class="ms-auto">
                <a href="{{ route('branch.create') }}" class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1">Add Branch</a>
            </div>
        </div>

        <div class="p-3 table-responsive">
            <table class="table mb-0 align-middle table-hover" id="dataTableBranche">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Pastor</th>
                    <th>Location</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($branches as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>

                    <td>
                        <div class="d-flex align-items-center">
                          <div>
                            <h6 class="mb-1 fw-bolder">{{ $value->name }}</h6>
                            {{-- <p class="mb-0 fs-3">{{ $value->member->member_number }}</p> --}}
                          </div>
                        </div>
                      </td>

                    {{-- <td>{{ $value->member->name }}</td> --}}
                    <td><p class="mb-0 fs-3">{{ $value->pastor->member->name ?? 'No Pastor Assigned' }}</p></td>
                    <td>{{ $value->city }}</td>
                    <td>{{ $value->phone }}</td>
                    <td>@if(  $value->status == 'main') <span class="mb-1 badge bg-primary-subtle text-primary">Main Branch</span>
                    @else <span class="mb-1 badge bg-success-subtle text-success">Sub Branch</span> @endif</td>

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
                @endforeach


                </tbody>
            </table>
        </div>

        </div>

  </div>
    @include('church_branches.edit')
    @include('church_branches.delete')

@endsection

@section('scripts')

    <script>
        function openEditModal(id) {
            $.ajax({
                url: '/church_branch/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#name').val(response.name);
                    $('#address').val(response.address);
                    $('#city').val(response.city);
                    $('#country').val(response.country);
                    $('#region').val(response.region);
                    $('#phone').val(response.phone);
                    $('#phone2').val(response.phone2);
                    $('#status').val(response.status);
                    $('#pastor_id').val(response.pastor_id);
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
                url: '/church_branch/' + id, // Replace with the appropriate route for fetching department details
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
        $("#dataTableBranche").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print",],
        });
        $(
            ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
        ).addClass("btn btn-primary btn-sm");
    </script>

@endsection
