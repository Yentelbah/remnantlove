<div class="modal fade" id="followupModal" tabindex="-1" role="dialog"daria-labelledby="Edit Group" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Follow Up on <span id="fl_name"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form action="{{ route('follow-ups.store') }}" method="POST">
                @csrf

                <input type="hidden" id="fl_selectedId" name="selectedId">
                <input type="hidden" id="fl_origin" name="origin">

                <!-- Task Template or Custom -->
                <div class="mb-3 ">
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Date</label>
                        <input type="date" name="follow_up_date" class="form-control" required>
                    </div>
                </div>

                <div class="mb-4 ">
                    <label for="method" class="form-label">Medium</label>
                    <select name="method" class="form-control" id="medium">
                        <option value="">Select medium</option>
                        <option value="sms">SMS</option>
                        <option value="phone">Phone</option>
                        <option value="email">Email</option>
                    </select>
                </div>

                <div class="row">
                    <div id="custom-sms">

                        <div class="mb-3">

                            <label for="message" class="form-label" >Message</label>
                            <textarea id="message_input" class="form-control" name="message" placeholder="Message" required></textarea>
                            <label id="charCount" class="mt-1 fs-2 text-info"></label>
                            <input type="hidden" id="numberOfPages" name="numberOfPages">
                        </div>

                    </div>

                </div>
                <div class="col-12">
                    <div class="gap-6 d-flex align-items-center justify-content-end">
                        <button class="btn btn-primary" type="submit" >Send</button>
                        <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var maxLength = 160; // Set your desired maximum character count
        var messageTextarea = document.getElementById('message_input');
        var charCountElement = document.getElementById('charCount');
        var numberOfPagesInput = document.getElementById('numberOfPages');

        messageTextarea.addEventListener('input', function() {
            var currentLength = messageTextarea.value.length;
            var pages = Math.ceil(currentLength / maxLength);

            if (pages === 1) {
                charCountElement.textContent = '1 page';
            } else {
                charCountElement.textContent = pages + ' pages';
            }

            numberOfPagesInput.value = pages; // Update the hidden input with the number of pages
        });
    });
</script>


