<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class=" modal-title" id="success-header-modalLabel">Update Recorded Attendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>        <div class="modal-body">

            <form action="{{ route('attendance.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="ed_att_selectedId" name="att_id">

                <p class="mb-4 card-subtitle">Provide acurate information</p>

                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="children_males" class="form-label">Total Male Children</label>
                        <input name="children_males" type="number" id="ed_children_males" class="form-control @error('children_males') is-invalid @enderror"  value="{{ old('children_males') }}"/>
                        @error('children_males')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label for="children_females" class="form-label">Total Female Children</label>

                        <input name="children_females" type="number" id="ed_children_females" class="form-control @error('children_females') is-invalid @enderror"  value="{{ old('children_females') }}"/>
                        @error('children_females')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label for="adult_males" class="form-label">Total Adult Males</label>

                        <input name="adult_males" type="number" id="ed_adult_males" class="form-control @error('adult_males') is-invalid @enderror"  value="{{ old('adult_males') }}"/>
                        @error('adult_males')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label for="adult_females" class="form-label">Total Adult Females</label>

                        <input name="adult_females" type="number" id="ed_adult_females" class="form-control @error('adult_females') is-invalid @enderror"  value="{{ old('adult_females') }}"/>
                        @error('adult_females')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
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
</div>
