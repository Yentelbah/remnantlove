<div class="modal fade" id="singleSMSModal" tabindex="-1" role="dialog"daria-labelledby="Edit Group" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Send SMS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form action="{{ route('sms.sendSingle') }}" method="POST">
                @csrf

                <div class="row">
                    <div id="custom-sms">

                        <div class="mb-3">
                            <label for="title"  class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Title" required>
                        </div>

                        <div class="mb-3">

                            <label for="message" class="form-label" >Message</label>
                            <textarea id="message_input" class="form-control" name="message" placeholder="Message" required></textarea>
                            <label id="charCount" class="mt-1 fs-2 text-info"></label>
                            <input type="hidden" id="numberOfPages" name="numberOfPages">
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Recipeint Phone Number</label>
                        <input style="margin-top: 5px;" id="phone_number" type="text" class="form-control" name="phone_number" placeholder="Recipient" required>
                        <label class="mt-1 mb-1 fs-2 text-info">Phone numbers should be followed by a comma(,) and space if more than one. </label>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" id="schedule" class="form-check-input"  value="schedule" name="schedule">Schedule
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div id="schedule_input" style="display: none;">
                            <input name="delivery_date" type="datetime-local" id="delivery_date" class="form-control @error('delivery_date') is-invalid @enderror" value="{{ old('delivery_date') }}">
                            @error('delivery_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <div class="gap-6 d-flex align-items-center justify-content-end">
                        <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit" >Send</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Retrieve the checkbox and the schedule_input div
        var scheduleCheckbox = document.getElementById('schedule');
        var scheduleInput = document.getElementById('schedule_input');

        // Add event listener to the checkbox
        scheduleCheckbox.addEventListener('change', function () {
            // If the checkbox is checked, display the schedule_input div, otherwise hide it
            if (scheduleCheckbox.checked) {
                scheduleInput.style.display = 'block';
            } else {
                scheduleInput.style.display = 'none';
            }
        });
    });
</script>


