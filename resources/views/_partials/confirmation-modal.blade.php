<!-- Custom confirmation message -->
<div class="modal fade" id="confirmation-modal" tabindex="-1" aria-labelledby="confirmation-modal-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmation-modal-label">Confirm Changes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">
            <span aria-hidden="true">&times;</span>
          </button>
          
        </div>
        <div class="modal-body">
          <p>You are about to change the following information:</p>
          <ul>
            <li>Name: <span id="modal-name"></span></li>
            <li>Email: <span id="modal-email"></span></li>
            <li>Office: <span id="office"></span></li>
            <li>Department: <span id="department"></span></li>
            
            <li>Role: <span id="modal-role"></span></li>
          </ul>
          <p>Are you sure you want to proceed?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="confirm-btn">Save changes</button>
        </div>
      </div>
    </div>
  </div>