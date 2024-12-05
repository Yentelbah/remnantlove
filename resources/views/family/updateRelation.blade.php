<div id="updateRelation" class="modal fade" tabindex="-1" aria-labelledby="primary-header-modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Change Member Relation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

          <form action="{{ route('family.relation.update') }}" method="POST">
            @csrf
            @method('PUT')

                <input hidden type="text" name="member_id" class="form-control" id="update_selectedId">
                <input hidden type="text" name="familyId" value="{{ $thisFamily->id }}">

                <div class="mb-3 form-group">
                  <label class="form-label" for="name">Member Name</label>
                  <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="rel_name">
                  @error('name')
                  <small class="invalid-feedback" role="alert">
                    {{ $message }}
                  </small>
                  @enderror
                </div>

                <div class="mb-3 form-group">
                    <label class="form-label" for="relation">Relation</label>
                    <select name="relation" id="rel_relation" class="form-select @error('relation') is-invalid @enderror">
                        <option value="">Select relation</option>
                        <option value="Head">Head</option>
                        <option value="Spouse">Spouse</option>
                        <option value="Child">Child</option>
                        <option value="Parent">Parent</option>
                        <option value="Sibling">Sibling</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('relation')
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
