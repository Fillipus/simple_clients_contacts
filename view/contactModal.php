<div id="contactModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- Modal Header with Tab Buttons -->
            <div class="modal-header">
                <h5 id="contactModalLabel" class="modal-title">Contact Management</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body with Tabs -->
            <div class="modal-body">
                <div id="generalTab" class="tab-content active">
                    <h6 class="font-weight-bold">Add Contact</h6>
                    <form id="contactForm" onsubmit="handleContactFormSubmit(event)">
                    <div class="form-group">
                            <label for="contactName">Name</label>
                            <input type="text" id="contactName" name="contactName" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="contactSurname">Surname</label>
                            <input type="text" id="contactSurname" name="contactSurname" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="contactEmail">Email</label>
                            <input type="email" id="contactEmail" name="contactEmail" class="form-control" required />
                        </div>
                        <button type="submit" class="btn btn-primary">Save Contact</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
