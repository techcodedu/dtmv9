//trigger the document saving alert
$(document).ready(function() {
    setTimeout(function() {
        $('#success-message').fadeOut('slow');
    }, 1000);
});

// modal confirmation 
// Add event listener to the form submit button in the edit_user.blade.php
const submitBtn = document.getElementById('submit-btn');
if (submitBtn) {
    submitBtn.addEventListener('click', function(e) {
        e.preventDefault(); // prevent form submission

        // Get form values
        const name = document.querySelector('input[name="name"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const office = document.querySelector('#office-select').value;
        const department = document.querySelector('#department-select').value;
        const role = document.querySelector('select[name="role"]').value;

        // Set confirmation modal values
        document.getElementById('modal-name').innerText = name;
        document.getElementById('modal-email').innerText = email;
        document.getElementById('office').innerText = document.querySelector('#office-select option:checked').textContent;
        document.getElementById('department').innerText = document.querySelector('#department-select option:checked').textContent;
        document.getElementById('modal-role').innerText = role;

        // Show confirmation modal
        const confirmationModal = new bootstrap.Modal(document.getElementById('confirmation-modal'));
        confirmationModal.show();

        // Add event listener to the confirmation button
        document.getElementById('confirm-btn').addEventListener('click', function() {
            // Submit form
            document.getElementById('update-form').submit();
        });
    });
}

// disabling the department field in the create_user.blade.php
document.addEventListener('DOMContentLoaded', function() {
    const officeSelect = document.getElementById('office_id');
    const departmentGroup = document.getElementById('department-group');
    const departmentInput = document.getElementById('department-input');
    
    officeSelect.addEventListener('change', function(e) {
        const selectedOption = e.target.options[e.target.selectedIndex].text;
        if (selectedOption === 'Admin') {
            departmentGroup.style.display = 'none';
            departmentInput.style.display = 'block';
        } else {
            departmentGroup.style.display = 'block';
            departmentInput.style.display = 'none';
            document.querySelector('select[name="department_id"]').value = '';
        }
    });
});

// Add this at the bottom of your custom js file
document.addEventListener('DOMContentLoaded', function() {
    const officeSelect = document.getElementById('office-select');
    const departmentSelect = document.getElementById('department-select');

    officeSelect.addEventListener('change', function(e) {
        const selectedOption = e.target.options[e.target.selectedIndex].text;
        if (selectedOption === 'Admin') {
            departmentSelect.style.display = 'none';
        } else {
            departmentSelect.style.display = 'block';
        }
    });

    // Trigger the change event on page load
    officeSelect.dispatchEvent(new Event('change'));
});

