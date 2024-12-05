<div class="modal fade" id="bulkSMSModal" tabindex="-1" role="dialog"daria-labelledby="Edit Group" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Send Bulk SMS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form action="{{ route('sms.sendBulk') }}" method="POST">
                @csrf

                    <div class="row">
                        <div class="mb-3">
                            <div class="mb-1">
                                <input type="radio" id="template-btn-bulk" name="type" value="template" checked>
                                <label for="template">Send Template</label> <br>
                            </div>
                            <div>
                                <input type="radio" id="custom-bulk" name="type" value="custom">
                                <label for="custom">Send New Message</label>
                            </div>
                        </div>

                        <!-- Task Templates Dropdown (Shown if template is selected) -->
                        <div class="mb-3" id="template-selection-bulk">
                            <label for="template_id" class="form-label">Select a Template</label>
                            <select name="template_id" class="form-control">
                                <option value="">Select template</option>
                                @foreach($templates as $template)
                                    <option value="{{ $template->id }}">{{ $template->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="custom-sms-bulk" style="display: none;">

                            <div class="mb-3">
                                <label for="title"  class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title">
                            </div>

                            <div class="mb-3">

                                <label for="message" class="form-label" >Message</label>
                                <textarea id="message_bulk" class="form-control" name="message" placeholder="Message"></textarea>
                                <label id="charCountBulk" class="mt-1 fs-2 text-info"></label>
                                <input type="hidden" id="numberOfPagesBulk" name="numberOfPages">
                            </div>

                            <div class="mb-3">
                                <!-- Add predefined variables buttons/links here -->
                                <button type="button" class="btn btn-sm btn-success" onclick="insertBulkVariable('\{\{ first_name \}\} ')">First Name</button>
                                <button type="button" class="btn btn-sm btn-success" onclick=" insertBulkVariable('\{\{ last_name \}\}')">Last Name</button>
                            </div>

                        </div>


                        <div class="mb-3">
                            <label for="group" class="form-label">Recipient Group</label>
                            <select name="group" class="form-control @error('group') is-invalid @enderror" id="">
                                <option value="">Select group</option>
                                <option value="members">Members</option>
                                <option value="pastors">Pastors</option>
                                <option value="staff">Staff</option>
                                {{-- <option value="students">Foundation Students</option>
                                <option value="converts">Converts</option>
                                <option value="visitors">Visitors</option> --}}
                                @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>

                            @error('group')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" id="schedule_bulk" class="form-check-input"  value="schedule" name="schedule">Schedule
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div id="schedule_input_bulk" style="display: none;">
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
                        <div class="gap-6 mt-0 d-flex align-items-center justify-content-end">
                            <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit">Send</button>
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
        var messageTextarea = document.getElementById('message_bulk');
        var charCountElement = document.getElementById('charCountBulk');
        var numberOfPagesInput = document.getElementById('numberOfPagesBulk');

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

    function  insertBulkVariable(variable) {
        var textarea = document.getElementById('message_bulk');
        var cursorPosition = textarea.selectionStart;
        var textBeforeCursor = textarea.value.substring(0, cursorPosition);
        var textAfterCursor = textarea.value.substring(cursorPosition);
        textarea.value = textBeforeCursor + variable + textAfterCursor;
        // Move the cursor after the inserted variable
        textarea.setSelectionRange(cursorPosition + variable.length, cursorPosition + variable.length);
        // Trigger input event to update character count
        textarea.dispatchEvent(new Event('input'));
    }

</script>

<script>
    // Toggle between template and custom task steps
    document.getElementById('template-btn-bulk').addEventListener('click', function () {
        document.getElementById('template-selection-bulk').style.display = 'block';
        document.getElementById('custom-sms-bulk').style.display = 'none';
    });

    document.getElementById('custom-bulk').addEventListener('click', function () {
        document.getElementById('template-selection-bulk').style.display = 'none';
        document.getElementById('custom-sms-bulk').style.display = 'block';
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Retrieve the checkbox and the schedule_input div
        var scheduleCheckbox = document.getElementById('schedule_bulk');
        var scheduleInput = document.getElementById('schedule_input_bulk');

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

