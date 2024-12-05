<div class="modal fade" id="sendTemplate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Send Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sms.sendBulk') }}" method="POST">
                    @csrf

                    <input hidden type="text" name="template_id" class="form-control" id="templateID">
                    <input hidden id="template-btn-bulk" name="type" value="template">

                    <div class="row">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Title" id="send_title" required>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Recipient</label>
                            <select name="group" id="" class="form-control">
                                <option value="">Select group</option>
                                <option value="members">Members</option>
                                <option value="pastors">Pastors</option>
                                <option value="staff">Staff</option>
                                <option value="students">Students</option>
                                <option value="converts">Converts</option>
                                <option value="visitors">Visitors</option>
                                @foreach($groups as $key => $group)
                                    <option value="{{ $group->id }}">{{ $group->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="title" class="form-label">Sender ID</label>
                            <select name="senderID" id="" class="form-control">
                                <option value="">Choose Sender ID</option>
                                @foreach($senderID as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->senderID }} </option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="mb-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" id="schedule_check" class="form-check-input"  value="schedule" name="schedule">Schedule
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div id="schedule_input_template" style="display: none;">
                                <input name="delivery_date" type="datetime-local" id="delivery_date" class="form-control @error('delivery_date') is-invalid @enderror" value="{{ old('delivery_date') }}">
                                @error('delivery_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <div id="schedule_input" style="display: none;">
                                <input name="delivery_date"
                                    type="datetime-local"
                                    id="delivery_date"
                                    class="form-control @error('delivery_date') is-invalid @enderror"
                                    value="{{ old('delivery_date') }}"> <!-- Include the old date -->
                                @error('delivery_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn bg-danger-subtle text-danger me-2" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="text-white btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var maxLength = 160; // Set your desired maximum character count
        var messageTextarea = document.getElementById('send_content');
        var charCountElement = document.getElementById('charCount');
        var numberOfPagesInput = document.getElementById('numberOfPages');

        messageTextarea.addEventListener('input', function () {
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
        var scheduleCheckbox = document.getElementById('schedule_check');
        var scheduleInput = document.getElementById('schedule_input_template');

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
