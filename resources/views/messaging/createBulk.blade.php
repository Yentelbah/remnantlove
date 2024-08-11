<div class="modal fade" id="bulkSMSModal" tabindex="-1" role="dialog"daria-labelledby="Edit Group" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="text-white modal-header modal-colored-header bg-primary">
                <h5 class="text-white modal-title" id="primary-header-modalLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <h5 class="mb-4">Send Bulk SMS</h5>
            <form action="{{ route('sms.sendBulk') }}" method="POST">
                @csrf

                <input hidden type="text" value="" name="phone_number">

                    <div class="row">
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input style="margin-top: 5px; margin-bottom: 10px;" id="" type="text" class="form-control" name="subject" placeholder="Subject" required>
                        </div>

                        <div class="mb-3">
                            <label for="group" class="form-label">Group</label>
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

                        <div class="">
                            <label for="message" class="form-label">Message</label>
                            <textarea style="margin-top: 5px;" id="message_bulk" class="form-control" name="message" required></textarea>
                            <label id="charCountBulk" style="font-size: 12px; text-align:right; margin-top: 6px; color:darkcyan;"></label>
                            <input type="hidden" id="numberOfPagesBukl" name="numberOfPages">
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="gap-6 mt-0 d-flex align-items-center justify-content-end">
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
        var messageTextarea = document.getElementById('message_bulk');
        var charCountElement = document.getElementById('charCountBulk');
        var numberOfPagesInput = document.getElementById('numberOfPagesBukl');

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
