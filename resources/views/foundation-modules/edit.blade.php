<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class=" modal-title" id="success-header-modalLabel">Update Convert Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>        <div class="modal-body">

            <form action="{{ route('converts.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="ed_selectedId" name="selectedId">

                <div class="row">
                    <div class="mt-6 col-md-12">
                    <div>
                        <label class="form-label">Event Name</label>
                        <input id="ed_title" name="event_name" type="text" class="form-control @error('event_name') is-invalid @enderror" />
                        @error('event_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>

                    <div class="mt-6 col-md-12">
                        <div>
                            <label class="form-label">Date</label>
                            <input id="ed_date" type="date" name="date" class="form-control @error('date') is-invalid @enderror" />
                        </div>
                        </div>

                        <div class="mt-6 col-md-12">
                            <div>
                            <label class="form-label">Location</label>
                            <input id="ed_location" name="location" type="text" class="form-control  @error('location') is-invalid @enderror" />
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>

                        <div class="mt-6 col-md-12">
                            <div>
                            <label class="form-label">Description</label>
                            <input id="ed_description" name="description" type="text" class="form-control  @error('description') is-invalid @enderror" />
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
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
