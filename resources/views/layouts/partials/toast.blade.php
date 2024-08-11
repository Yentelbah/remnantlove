
{{--
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
    <div id="toast-container">
        @if(session()->has('success'))
            <div class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header">
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session()->has('error'))
            <div class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header">
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        @endif
    </div>
</div> --}}


   <!-- Position it -->
    <div style="position: absolute; top: 7%; right: 0; z-index: 5; min-width: 300px;">

      @if(session()->has('success'))

      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-header bg-success text-white">
            <i class="fas fa-check mr-2"></i>
            <strong class="mr-auto">Success</strong>
            <small class="text-muted">just now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="toast-body">
            {{ session('success') }}
        </div>
      </div>
      @endif

      @if(session()->has('error'))
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">

        <div class="toast-header bg-danger text-white">
            <i class="fas fa-ban mr-2"></i>
            <strong class="mr-auto">Stop!</strong>
            <small class="text-muted">just now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ session('error') }}
        </div>
      </div>
      @endif

      @if(session()->has('info'))
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">

        <div class="toast-header bg-primary text-white">
            <i class="fas fa-info mr-2"></i>
            <strong class="mr-auto">Information</strong>
            <small class="text-muted">just now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ session('info') }}
        </div>
      </div>
      @endif

      @if(session()->has('warning'))
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">

        <div class="toast-header bg-warning text-white">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <strong class="mr-auto">Warning!</strong>
            <small class="text-muted">just now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ session('warning') }}
        </div>
      </div>
      @endif
    </div>
