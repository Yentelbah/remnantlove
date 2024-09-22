
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Members</title>
@endsection

@section('content')

  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Members</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Members</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="px-2 row ">

    <div class="col-sm-4">
     <div class="overflow-hidden card info-card text-bg-info">
        <div class="p-4 card-body">
          <h5 class="text-white fw-bold fs-14 text-nowrap">
            {{ $memberCount }} <span class="fs-2 fw-light"></span>
          </h5>
          <p class="mb-0 opacity-50">Total Membership</p>
        </div>
      </div>
    </div>

    @foreach($memberCountGender as $member)
    <div class="col-sm-2">
      <div class="overflow-hidden card info-card text-bg-primary">
        <div class="p-4 card-body">
          <h5 class="text-white fw-bold fs-14 text-nowrap">
            {{ $member->count_18_and_above }} <span class="fs-2 fw-light"></span>
          </h5>
          <p class="mb-0 opacity-50">{{ $member->gender }} Above 18 </p>
        </div>
      </div>
    </div>
    @endforeach

    @foreach($memberCountGender as $member)
    <div class="col-sm-2">
      <div class="overflow-hidden card info-card text-bg-primary">
        <div class="p-4 card-body">
          <h5 class="text-white fw-bold fs-14 text-nowrap">
            {{ $member->count_below_18 }} <span class="fs-2 fw-light"></span>
          </h5>
          <p class="mb-0 opacity-50">{{ $member->gender }} Below 18</p>
        </div>
      </div>
    </div>
    @endforeach

  </div>

  <div class="mb-4 card">
    <div class="card-body">
      <div class="justify-between mb-2 d-flex">
        <h4 class="mb-0 card-title">All Members</h4>

        <div class="ms-auto">
            <a  class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1" data-bs-toggle="modal" data-bs-target="#createModal" id="#modalCenter">Add Member</a>
        </div>

      </div>

      <div class="p-3 table-responsive">
        <table id="members" class="table align-items-center table-flush table-hover" >
          <thead>
            <!-- start row -->
            <tr>
                <th>#</th>
                <th>Member Number</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Location</th>
                <th>Branch</th>
                <th></th>
            </tr>
            <!-- end row -->
          </thead>
          <tbody>
            <!-- start row -->

            <!-- start row -->
            @forelse($members as $key => $value)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->member_number }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->gender }}</td>
                <td>{{ $value->phone }}</td>
                <td>{{ $value->location }}</td>
                <td>{{ $value->churchBranch->name }}</td>
                <td>
                    <div class="dropdown">
                        <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                          <i class="ti ti-dots-vertical fs-4 d-block"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <form action="{{ route('member.search') }}" method="POST" id="memberFomr{{ $value->id }}">
                                    @csrf
                                    <input type="text" hidden value="{{ $value->id }}" name="query">
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" onclick="document.getElementById('memberFomr{{ $value->id }}').submit(); return false;">View</a>
                                </form>

                            </li>
                            {{-- <li>
                                <a href="{{ route('member.details', ['id' => $value->id]) }}" class="dropdown-item">Show</a>
                            </li> --}}
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
            @empty
              <tr>
                <td colspan="10"><p>No members found</p></td>
              </tr>
            @endforelse
            <!-- end row -->

          </tbody>

        </table>
      </div>

      @include('member.create')
      @include('member.edit')
      @include('member.delete')
      @include('member.download')

    </div>
  </div>

@endsection

@section('scripts')

    <script>
        function openEditModal(id) {
            $.ajax({
                url: '/members/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#ed_name').val(response.name);
                    $('#ed_gender').val(response.gender);
                    $('#ed_dob').val(response.dob);
                    $('#ed_phone').val(response.phone);
                    $('#ed_address').val(response.address);
                    $('#ed_location').val(response.location);
                    $('#ed_email').val(response.email);
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
                url: '/members/' + id, // Replace with the appropriate route for fetching department details
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
        $("#members").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print",],
        });
        $(
            ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
        ).addClass("btn btn-primary btn-sm");
    </script>

@endsection
