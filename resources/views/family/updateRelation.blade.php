<div id="updatePosition" class="modal fade" tabindex="-1" aria-labelledby="primary-header-modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="text-white modal-header modal-colored-header bg-primary">
          <h5 class="text-white modal-title" id="primary-header-modalLabel"></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h5 class="mb-4">Change Leader Title</h5>

          <form action="{{ route('group.leader.update') }}" method="POST">
            @csrf
            @method('PUT')

                <input hidden type="text" name="selectedId" class="form-control" id="update_selectedId">
                <input hidden type="text" name="GroupId" value="{{ $group->id }}">

                <div class="mb-3 form-group">
                  <label class="form-label" for="name">Leader Name</label>
                  <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="update_name">
                  @error('name')
                  <small class="invalid-feedback" role="alert">
                    {{ $message }}
                  </small>
                  @enderror
                </div>

                <div class="mb-3 form-group">
                  <label class="form-label" for="title">Title</label>
                  <input class="form-control  @error('title') is-invalid @enderror" name="title" id="update_title">
                  @error('title')
                  <small class="invalid-feedback" role="alert">
                    {{ $message }}
                  </small>
                  @enderror
                </div>

                <div class="mb-3 form-group">
                    <label class="form-label" for="type">Leader Type</label>
                    <select name="type" id="update_type" class="form-select @error('type') is-invalid @enderror">
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
                    <input type="date" name="date_appointed" class="form-control  @error('name') is-invalid @enderror" id="update_date_appointed">
                    @error('date_appointed')
                    <small class="invalid-feedback" role="alert">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>

            <div class="col-12">
                <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                  <button class="btn btn-primary" type="submit" >Save</button>
                  <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
          </form>
        </div>

        </div>
      </div>
      <!-- /.modal-content -->
    </div>
