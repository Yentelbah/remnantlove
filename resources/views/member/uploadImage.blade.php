<div id="imageModal" class="modal fade" tabindex="-1" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-colored-header">
                <h5 class=" modal-title" id="success-header-modalLabel">Upload Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="member-image-upload" action="{{ route('member.image.upload') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <input type="hidden" name="member_id" value="{{ $member->id }}"> <!-- This holds the member ID -->

                    <div class="form-group">
                        <label class="form-label" for="profile-image">Upload Profile Image</label>
                        <input class="form-control" type="file" name="photo" id="profile-image" accept="image/*">
                    </div>

                    <div class="col-12">
                        <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary" type="submit" >Save</button>
                            <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>