{{-- <div id="followupModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class=" modal-title" id="success-header-modalLabel">Follow Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form action="{{ route('converts.status') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="sta_selectedId" name="selectedId">

                <div class="row">

                    <div class="col-md-12">
                        <div class="mb-3 form-group">
                            <label class="form-label">What is the current status of <strong><span name="name" id="sta_name"></span></strong>?</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="">Select status</option>
                                <option value="Pending">Pending</option>
                                <option value="Joined">Joined</option>
                                <option value="Not Interested">Not Interested</option>
                            </select>
                            @error('status')
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
 --}}

<div class="modal fade" id="followupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title fs-3" id="exampleModalLabel">
            New Message
          </h5>
          <button type="button" class="btn-close fs-1" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3 input-group">
              <input type="email" class="form-control" id="text-email" placeholder="Recipients" />
              <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked />
              <label class="btn btn-primary" for="option1">Cc</label>
              <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" />
              <label class="btn btn-primary" for="option2">Bcc</label>
            </div>
            <div>
              <textarea class="form-control" id="text-subject" rows="6" placeholder="Subject"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer justify-content-start">
          <button type="button" class="btn btn-primary d-none d-md-inline" data-bs-dismiss="modal">
            Send
          </button>
          <div class="flex-wrap gap-1 ms-6 d-flex">
            <a href="javascript:void(0)" class="d-flex nav-icon-hover-bg rounded-1">
              <iconify-icon icon="solar:link-circle-line-duotone" class="fs-7"></iconify-icon>
            </a>
            <a href="javascript:void(0)" class="d-flex nav-icon-hover-bg rounded-1">
              <iconify-icon icon="solar:gallery-send-line-duotone" class="fs-7"></iconify-icon>
            </a>
            <a href="javascript:void(0)" class="d-flex nav-icon-hover-bg rounded-1">
              <iconify-icon icon="solar:text-square-line-duotone" class="fs-7"></iconify-icon>
            </a>
            <a href="javascript:void(0)" class="d-flex nav-icon-hover-bg rounded-1">
              <iconify-icon icon="solar:eraser-square-line-duotone" class="fs-7"></iconify-icon>
            </a>
            <a href="javascript:void(0)" class="d-flex nav-icon-hover-bg rounded-1">
              <iconify-icon icon="solar:text-underline-cross-line-duotone" class="fs-7"></iconify-icon>
            </a>
            <a href="javascript:void(0)" class="d-flex nav-icon-hover-bg rounded-1">
              <iconify-icon icon="solar:text-bold-square-line-duotone" class="fs-7"></iconify-icon>
            </a>
            <a href="javascript:void(0)" class="d-flex nav-icon-hover-bg rounded-1">
              <iconify-icon icon="solar:text-italic-square-line-duotone" class="fs-7"></iconify-icon>
            </a>
          </div>
          <div class="ms-md-auto d-flex align-items-center justify-content-between">
            <button type="button" class="btn btn-primary d-inline d-md-none" data-bs-dismiss="modal">
              Send
            </button>
            <a href="javascript:void(0)" class="rounded d-flex nav-icon-hover-bg ms-6 ms-md-0">
              <iconify-icon icon="solar:trash-bin-minimalistic-line-duotone" class="fs-7"></iconify-icon>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
