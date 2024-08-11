<div class="modal fade" id="balanceSheetModal" tabindex="-1" role="dialog"daria-labelledby="Edit Group" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="text-white modal-header modal-colored-header bg-primary">
                <h5 class="text-white modal-title" id="primary-header-modalLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="mb-4">Balance Sheet</h5>

                <form action="{{ route('balance_sheet.generate') }}" method="POST">
                    @csrf

                            <p>You are about to generate the balance sheet statement, are you sure you want to proceed?</p>
                            <input hidden type="date" id="balDate" value="" name="date">

                    <div class="col-12">
                        <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary" type="submit" >Generate</button>
                            <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Get the current date
    var currentDate = new Date().toISOString().split("T")[0];

    // Set the current date as the value of the input field
    document.getElementById("balDate").value = currentDate;
</script>
