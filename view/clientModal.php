<div id="clientModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- Modal Header with Tab Buttons -->
            <div class="modal-header">
                <h5 id="clientModalLabel" class="modal-title">Client Management</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body with Tabs -->
            <div class="modal-body">
                <div class="btn-group btn-group-toggle mb-4" data-toggle="buttons">
                    <label class="btn btn-outline-primary active" id="generalTab">
                        <input type="radio" name="tabs" checked onclick="switchTab('general')" /> General
                    </label>
                    <label class="btn btn-outline-primary" id="linkingTab">
                        <input type="radio" name="tabs" onclick="switchTab('linking')" /> Linking Contact
                    </label>
                </div>
            </div>

            <!-- Tab Contents -->
            <div id="generalContent" class="tab-content">
                <h6 class="font-weight-bold">Add Client</h6>
                <form id="clientForm" onsubmit="handleClientFormSubmit(event)">
                    <div class="form-group">
                        <label for="clientName">Client Name</label>
                        <input type="text" id="clientName" name="clientName" class="form-control" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Save Client</button>
                </form>
            </div>

            <div id="linkingContent" class="tab-content" style="display:none;">
                <h6 class="font-weight-bold">Link Contact</h6>
                <form id="linkingForm" onsubmit="handleLinkingFormSubmit(event)">
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
                    <button type="submit" class="btn btn-primary">Link Contact</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>