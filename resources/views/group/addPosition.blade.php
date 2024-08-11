<div id="addPosition" class="modal fade" tabindex="-1" aria-labelledby="success-header-modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="text-white modal-header modal-colored-header bg-success">
          <h5 class="text-white modal-title" id="success-header-modalLabel"></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h5 class="mb-4">Make Member A Leader</h5>

          <form action="{{ route('group.leader') }}" method="POST">
            @csrf
                <input hidden type="text" name="selectedId" class="form-control" id="le_selectedId">
                <input hidden type="text" name="GroupId" value="{{ $group->id }}">

                <div class="mb-3 form-group">
                  <label class="form-label" for="name">Member Name</label>
                  <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="le_name">
                  @error('name')
                  <small class="invalid-feedback" role="alert">
                    {{ $message }}
                  </small>
                  @enderror
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

            <div class="col-12">
                <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                  <button class="btn btn-success" type="submit" >Save</button>
                  <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
          </form>
        </div>

        </div>
      </div>
      <!-- /.modal-content -->
    </div>
