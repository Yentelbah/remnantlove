
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Leaders</title>
@endsection

@section('content')
  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Add Leader</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('member.index') }}">Members</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('leader.index') }}">Leaders</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Add Leader</li>
        </ol>
      </nav>
    </div>
  </div>


  <div class="card">
    <div class="card-body wizard-content">
      <h4 class="mb-6 card-title">New Leader Information</h4>
      <br>
      <form action="{{ route('leader.store') }}" method="POST" class="tab-wizard wizard-circle">
        @csrf

            <div class="mx-auto row d-flex">
                <!-- Input fields -->
                <div class="order-2 col-lg-8 col-12 order-lg-1">
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="group">Select Group</label>
                            <select class="form-select" id="group" name="group_id">
                                <option value="">Select existing member</option>
                                @foreach ($groups as $result)
                                    <option value="{{ $result->id }}">{{ $result->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="member">Select Member:</label>
                            <select class="form-select" id="member" name="member_id">
                                <option value="">Select a member</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 form-group">
                        <label class="form-label" for="title">Title</label>
                        <input class="form-control  @error('title') is-invalid @enderror" name="title" id="le_title">
                        @error('title')
                        <small class="invalid-feedback" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
                      </div>

                      <div class="mb-3 form-group">
                          <label class="form-label" for="type">Leader Type</label>
                          <select name="type" id="le_type" class="form-select @error('type') is-invalid @enderror">
                              <option value="">Select leader type</option>
                              <option value="Main">Main</option>
                              <option value="Other">Other</option>
                          </select>
                          @error('type')
                          <small class="invalid-feedback" role="alert">
                            {{ $message }}
                          </small>
                          @enderror
                      </div>


                      <div class="mb-3 form-group">
                          <label class="form-label" for="date_appointed">Date Appointed</label>
                          <input type="date" name="date_appointed" class="form-control  @error('name') is-invalid @enderror" id="date_appointed">
                          @error('date_appointed')
                          <small class="invalid-feedback" role="alert">
                            {{ $message }}
                          </small>
                          @enderror
                        </div>

                </div>

                <!-- Image -->
                <div class="order-1 col-lg-4 col-12 d-flex justify-content-center order-lg-2">
                    <img src="../assets/images/backgrounds/lead.svg" alt="" class="img-fluid" width="100%">
                </div>


            </div>



        </section>



          <div class="col-12">
            <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
              <button class="btn btn-success" type="submit" >Create Leader</button>
            </div>
        </div>
        </section>
      </form>
    </div>
  </div>
@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {
        $('#group').change(function() {
            var groupId = $(this).val();
            if (groupId) {
                $.ajax({
                    url: '/group/' + groupId + '/members',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#member').empty();
                        $('#member').append('<option value="">Select a member</option>');
                        $.each(data, function(key, value) {
                            $('#member').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            } else {
                $('#member').empty();
                $('#member').append('<option value="">Select a member</option>');
            }
        });
    });
    </script>

@endsection
