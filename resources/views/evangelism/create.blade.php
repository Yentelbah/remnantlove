
<div id="eventModal" class="modal fade" tabindex="-1" aria-labelledby="success-header-modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header modal-colored-header">
            <h5 class=" modal-title" id="success-header-modalLabel">Add Evangelism Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('evangelism.store') }}" method="POST">
            @csrf

            <input type="hidden" id="selectedId" name="selectedId">

            <div class="row">
                <div class="mt-6 col-md-12">
                <div>
                    <label class="form-label">Name</label>
                    <input id="event_name" name="event_name" type="text" class="form-control @error('event_name') is-invalid @enderror" />
                    @error('event_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>


                <div class="mt-6 col-md-12">
                <div>
                    <label class="form-label">Date</label>
                    <input id="date" type="date" name="date" class="form-control @error('date') is-invalid @enderror" />
                </div>
                </div>

                <div class="mt-6 col-md-12">
                    <div>
                    <label class="form-label">Location</label>
                    <input id="location" name="location" type="text" class="form-control  @error('location') is-invalid @enderror" />
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

                <div class="mt-6 col-md-12">
                    <div>
                    <label class="form-label">Description</label>
                    <input id="description" name="description" type="text" class="form-control  @error('description') is-invalid @enderror" />
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal">
            Close
          </button>
          {{-- <button type="submit" class="btn btn-success btn-update-event" data-fc-event-public-id="">
            Update changes
          </button> --}}
          <button type="submit" class="btn btn-primary btn-add-event">
            Save
          </button>
        </form>
        </div>
      </div>
    </div>
  </div>
