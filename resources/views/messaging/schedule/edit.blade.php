<div class="modal fade" id="editSchedule" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Edit Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('schedule.update') }}" method="POST">
                    @method('PUT')
                    @csrf

                    <input hidden type="text" name="selectedId" class="form-control" id="ed_sheduledId">

                    <div class="row">
                        <div class="mb-3">
                            <label for="title" class="form-label">Sender ID</label>
                            <select name="senderID" id="ed_senderID" class="form-control">
                                <option value="">Choose Sender ID</option>
                                @foreach($senderID as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->senderID }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="ed_sheduled_title">

                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Message</label>

                            <div>
                                <!-- Add predefined variables buttons/links here -->
                                <button type="button" class="btn btn-secondary" onclick="insertSheduleVariable('\{\{ first_name \}\} ')">First Name</button>
                                <button type="button" class="btn btn-secondary" onclick="insertSheduleVariable('\{\{ last_name \}\}')">Last Name</button>
                            </div>

                            <textarea id="ed_shedule_content" rows="4" cols="50" class="form-control" name="content" placeholder="Content" required></textarea>
                            <label id="charCount" style="font-size: 12px; text-align:right; margin-top: 6px; color:darkcyan;"></label>
                            <input type="hidden" id="numberOfPages" name="numberOfPages">

                        </div>

                        <div class="mb-3">
                            <div id="schedule_input">
                                <input name="delivery_date" type="datetime-local" id="ed_schedule_date" class="form-control @error('delivery_date') is-invalid @enderror" value="{{ old('delivery_date') }}">
                                @error('delivery_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>

                        <button type="submit" class="text-white btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var maxLength = 160; // Set your desired maximum character count
        var messageTextarea = document.getElementById('ed_shedule_content');
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

    function insertSheduleVariable(variable) {
        var textarea = document.getElementById('ed_shedule_content');
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
