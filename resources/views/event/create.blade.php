
<div id="eventModal" class="modal fade" tabindex="-1" aria-labelledby="success-header-modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="text-white modal-header modal-colored-header bg-success">
            <h5 class="text-white modal-title" id="success-header-modalLabel"></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h5 class="mb-4">Add Event</h5>

        <form action="{{ route('event.create') }}" method="POST">
            @csrf

            <input type="hidden" id="selectedId" name="selectedId">

            <div class="row">
                <div class="mt-6 col-md-12">
                <div>
                    <label class="form-label">Event Title</label>
                    <input id="event-title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" />
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>

                <div class="mt-6 col-md-12">
                    <div>
                    <label class="form-label">Event Description</label>
                    <input id="description" name="description" type="text" class="form-control  @error('description') is-invalid @enderror" />
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

                <div class="mt-6 col-md-12">
                <div>
                    <label class="form-label">Event Color</label>
                </div>
                <div class="d-flex">
                    <div class="n-chk">
                    <div class="form-check form-check-primary form-check-inline">
                        <input class="form-check-input" type="radio" name="event_level" value="Danger" id="modalDanger" />
                        <label class="form-check-label" for="modalDanger">Danger</label>
                    </div>
                    </div>

                    <div class="n-chk">
                    <div class="form-check form-check-warning form-check-inline">
                        <input class="form-check-input" type="radio" name="event_level" value="Success" id="modalSuccess" />
                        <label class="form-check-label" for="modalSuccess">Success</label>
                    </div>
                    </div>
                    <div class="n-chk">
                    <div class="form-check form-check-success form-check-inline">
                        <input class="form-check-input" type="radio" name="event_level" value="Primary" id="modalPrimary" />
                        <label class="form-check-label" for="modalPrimary">Primary</label>
                    </div>
                    </div>
                    <div class="n-chk">
                    <div class="form-check form-check-danger form-check-inline">
                        <input class="form-check-input" type="radio" name="event_level" value="Warning" id="modalWarning" />
                        <label class="form-check-label" for="modalWarning">Warning</label>
                    </div>
                    </div>
                </div>
                </div>

                <div class="mt-6 col-md-6">
                <div>
                    <label class="form-label">Enter Start Date</label>
                    <input id="event-start-date" type="datetime-local" name="start_datetime" class="form-control @error('start_datetime') is-invalid @enderror" />
                </div>
                </div>

                <div class="mt-6 col-md-6">
                <div>
                    <label class="form-label">Enter End Date</label>
                    <input id="event-end-date" type="datetime-local"  name="end_datetime" class="form-control @error('end_datetime') is-invalid @enderror" />
                    @error('end_datetime')
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
