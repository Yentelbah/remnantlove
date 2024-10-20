<div class="modal fade" id="scheduleMessage" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Schedule Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sms.sendBulk') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="mb-3">
                            <div class="mb-1">
                                <input type="radio" id="template-btn-schedule" name="type" value="template" checked>
                                <label for="template">Schedule Template</label> <br>
                            </div>
                            <div>
                                <input type="radio" id="custom-schedule" name="type" value="custom">
                                <label for="custom">Schedule New Message</label>
                            </div>
                        </div>

                        <!-- Task Templates Dropdown (Shown if template is selected) -->
                        <div class="mb-3" id="template-selection-schedule">
                            <label for="template_id" class="form-label">Select a Template</label>
                            <select name="template_id" class="form-control">
                                <option value="">Select template</option>
                                @foreach($templates as $template)
                                    <option value="{{ $template->id }}">{{ $template->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="custom-sms-schedule" style="display: none;">

                            <div class="mb-3">
                                <label for="title"  class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title">
                            </div>

                            <div class="mb-3">

                                <label for="message" class="form-label" >Message</label>
                                <textarea id="message_schedule" class="form-control" name="message" placeholder="Message"></textarea>
                                <label id="charCountSchedule" class="mt-1 fs-2 text-info"></label>
                                <input type="hidden" id="numberOfPagesSchedule" name="numberOfPages">
                            </div>

                            <div class="mb-3">
                                <!-- Add predefined variables buttons/links here -->
                                <button type="button" class="btn btn-sm btn-success" onclick="insertScheduleVariable('\{\{ first_name \}\} ')">First Name</button>
                                <button type="button" class="btn btn-sm btn-success" onclick=" insertScheduleVariable('\{\{ last_name \}\}')">Last Name</button>
                            </div>

                        </div>


                        <div class="mb-3">
                            <label for="group" class="form-label">Recipient Group</label>
                            <select name="group" class="form-control @error('group') is-invalid @enderror" id="">
                                <option value="">Select group</option>
                                <option value="members">Members</option>
                                <option value="pastors">Pastors</option>
                                <option value="staff">Staff</option>
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
                            <label for="group" class="form-label">Send at</label>
                            <input name="delivery_date" type="datetime-local" id="delivery_date" class="form-control @error('delivery_date') is-invalid @enderror" value="{{ old('delivery_date') }}">
                            @error('delivery_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
        var messageTextarea = document.getElementById('message_schedule');
        var charCountElement = document.getElementById('charCountSchedule');
        var numberOfPagesInput = document.getElementById('numberOfPagesSchedule');

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

    function  insertScheduleVariable(variable) {
        var textarea = document.getElementById('message_schedule');
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
    document.getElementById('template-btn-schedule').addEventListener('click', function () {
        document.getElementById('template-selection-schedule').style.display = 'block';
        document.getElementById('custom-sms-schedule').style.display = 'none';
    });

    document.getElementById('custom-schedule').addEventListener('click', function () {
        document.getElementById('template-selection-schedule').style.display = 'none';
        document.getElementById('custom-sms-schedule').style.display = 'block';
    });
</script>

