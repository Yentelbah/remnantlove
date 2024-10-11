
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Pastors</title>
@endsection

@section('content')
  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Pastors</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('member.index') }}">Members</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Pastors</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
        <div class="justify-between mb-2 d-flex">
            <h4 class="mb-0 card-title">Pastors</h4>

            <div class="ms-auto">
                <a href="{{ route('pastor.new') }}" class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1">Add Pastor</a>
            </div>
        </div>

        <div class="p-3 table-responsive">
            <table class="table mb-0 align-middle table-hover" id="dataTablePastor">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Branch</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($pastors as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>

                    <td>
                        <div class="d-flex align-items-center">
                          <div class="me-3">
                            @if ($value->member->gender == 'Male')
                            <img src="{{ $value->member->photo == '' ?  '../assets/images/profile/male.png' : asset('storage/' .$value->member->photo) }}" class="rounded-circle" alt="img" class="img-fluid rounded-circle preview" width="50">
                            @else
                            <img src="{{ $value->member->photo == '' ?  '../assets/images/profile/female.png' : asset('storage/' .$value->member->photo) }}" class="rounded-circle" alt="img" class="img-fluid rounded-circle preview" width="50">
                            @endif
                          </div>

                          <div>
                            <h6 class="mb-1 fw-bolder">{{ $value->member->name }}</h6>
                            <p class="mb-0 fs-3">{{ $value->member->member_number }}</p>
                          </div>
                        </div>
                      </td>

                    {{-- <td>{{ $value->member->name }}</td> --}}
                    <td><p class="mb-0 fs-3">{{ $value->member->gender }}</p></td>
                    <td>{{ $value->member->phone }}</td>
                    <td>{{ $value->member->location }}</td>
                    <td>{{ $value->member->churchBranch->name }}</td>
                    <td>
                        <div class="dropdown">
                            <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                              <i class="ti ti-dots-vertical fs-4 d-block"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <form action="{{ route('member.search') }}" method="POST" id="memberForm{{ $value->member->id }}">
                                        @csrf
                                        <input type="text" hidden value="{{ $value->member->id }}" name="query">
                                        <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->member->id }}" onclick="document.getElementById('memberForm{{ $value->member->id }}').submit(); return false;">View</a>
                                    </form>

                                </li>
                                @if ($nonExistingUsers->contains('member_id', $value->member_id))
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#createModal" id="#modalCenter" onclick="openUserAccountModal('{{ $value->id }}')">+ User Account</a>
                                </li>
                                @endif
                              <li>
                                <a href="{{ route('pastor.edit', ['id' => $value->id]) }}" class="dropdown-item">Edit</a>
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
    @include('pastor.delete')
    @include('leader.account')


@endsection

@section('scripts')

    <script>
        function openDeleteModal(id) {
            $.ajax({
                url: '/pastor/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#del_name').text(response.member.name);
                    $('#del_selectedId').val(response.pastor.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openUserAccountModal(id) {
            $.ajax({
                url: '/pastor/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#acc_user_name').val(response.member.name);
                    $('#leader_id').val(response.member.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

    <script>
        $("#dataTablePastor").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print",],
        });
        $(
            ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
        ).addClass("btn btn-primary btn-sm");
    </script>

@endsection
