<div id="downloadModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="text-white modal-header modal-colored-header bg-info">
          <h5 class="text-white modal-title" id="info-header-modalLabel"></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <h5 class="mb-4">Download</h5>
                <form action="{{ route('group.export') }}" method="GET">
                @csrf
                    <p>Download group data as Excel.</p>
            <div class="col-12">
                <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                  <button class="btn btn-primary" type="submit" >Download</button>
                  <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
