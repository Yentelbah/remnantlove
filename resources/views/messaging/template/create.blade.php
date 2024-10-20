<div class="modal fade" id="createTemplate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Message Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('templates.create') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Title" required>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Message</label>
                            <textarea id="template_message" rows="4" cols="50" class="form-control" name="content" placeholder="Content" required></textarea>
                            <label id="charCount" style="font-size: 12px; text-align:right; margin-top: 6px; color:darkcyan;"></label>
                            <input type="hidden" id="numberOfPages" name="numberOfPages">
                        </div>

                        <div>
                            <!-- Add predefined variables buttons/links here -->
                            <button type="button" class="btn btn-sm btn-success" onclick="insertNewTemplateVariable('\{\{ first_name \}\} ')">First Name</button>
                            <button type="button" class="btn btn-sm btn-success" onclick=" insertNewTemplateVariable('\{\{ last_name \}\}')">Last Name</button>
                        </div>


                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn bg-danger-subtle text-danger me-2" type="button" data-bs-dismiss="modal">Cancel</button>
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
        var messageTextarea = document.getElementById('template_message');
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

    function  insertNewTemplateVariable(variable) {
        var textarea = document.getElementById('template_message');
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
