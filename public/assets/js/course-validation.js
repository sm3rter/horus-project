// Function to calculate total
    function calculateTotal() {
        const present = parseInt(document.querySelector('input[name="total_present_students"]').value) || 0;
        const absent = parseInt(document.querySelector('input[name="total_absent_students"]').value) || 0;
        const withdraw = parseInt(document.querySelector('input[name="withdraw_students"]').value) || 0;
        const incomplete = parseInt(document.querySelector('input[name="incomplete_students"]').value) || 0;
        const deprived = parseInt(document.querySelector('input[name="total_deprived_students"]').value) || 0;

        const total = present + absent + withdraw + incomplete + deprived;
        const totalInput = document.querySelector('input[name="total_students"]');
        totalInput.value = total;
        
        // Remove any existing error message
        const existingError = totalInput.parentElement.querySelector('.total-error');
        if (existingError) {
            existingError.remove();
        }
    }

    // Function to validate total
    function validateTotal() {
        const present = parseInt(document.querySelector('input[name="total_present_students"]').value) || 0;
        const absent = parseInt(document.querySelector('input[name="total_absent_students"]').value) || 0;
        const withdraw = parseInt(document.querySelector('input[name="withdraw_students"]').value) || 0;
        const incomplete = parseInt(document.querySelector('input[name="incomplete_students"]').value) || 0;
        const deprived = parseInt(document.querySelector('input[name="total_deprived_students"]').value) || 0;
        const totalInput = document.querySelector('input[name="total_students"]');
        const enteredTotal = parseInt(totalInput.value) || 0;

        const calculatedTotal = present + absent + withdraw + incomplete + deprived;

        // Remove any existing error message
        const existingError = totalInput.parentElement.querySelector('.total-error');
        if (existingError) {
            existingError.remove();
        }

        if (enteredTotal !== calculatedTotal) {
            // Add error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback total-error';
            errorDiv.style.display = 'block';
            errorDiv.innerHTML = `<strong>Total must equal the sum of all student counts (${calculatedTotal})</strong>`;
            totalInput.classList.add('is-invalid');
            totalInput.parentElement.appendChild(errorDiv);
            return false;
        } else {
            totalInput.classList.remove('is-invalid');
            return true;
        }
    }

    // Add event listeners to all student count inputs
    const studentInputs = [
        'total_present_students',
        'total_absent_students',
        'withdraw_students',
        'incomplete_students',
        'total_deprived_students'
    ];

    studentInputs.forEach(inputName => {
        document.querySelector(`input[name="${inputName}"]`).addEventListener('input', calculateTotal);
    });

    // Add validation on total input change
    document.querySelector('input[name="total_students"]').addEventListener('input', validateTotal);

    // Add form validation before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!validateTotal()) {
            e.preventDefault();
        }
    });

    // Calculate initial total on page load
    document.addEventListener('DOMContentLoaded', calculateTotal);

    // Function to calculate and update success/failed students
    function updateSuccessFailedCounts() {
        const totalStudents = parseInt(document.querySelector('input[name="total_students"]').value) || 0;
        const deprivedStudents = parseInt(document.querySelector('input[name="total_deprived_students"]').value) || 0;
        const incompleteStudents = parseInt(document.querySelector('input[name="incomplete_students"]').value) || 0;
        const withdrawStudents = parseInt(document.querySelector('input[name="withdraw_students"]').value) || 0;

        const eligibleStudents = totalStudents - (deprivedStudents + incompleteStudents + withdrawStudents);
        
        const successInput = document.querySelector('input[name="success_students"]');
        const failedInput = document.querySelector('input[name="failed_students"]');

        // When success students input changes
        successInput.addEventListener('input', function() {
            const successCount = parseInt(this.value) || 0;
            if (successCount <= eligibleStudents) {
                failedInput.value = eligibleStudents - successCount;
            } else {
                this.value = eligibleStudents;
                failedInput.value = 0;
            }
        });

        // When failed students input changes
        failedInput.addEventListener('input', function() {
            const failedCount = parseInt(this.value) || 0;
            if (failedCount <= eligibleStudents) {
                successInput.value = eligibleStudents - failedCount;
            } else {
                this.value = eligibleStudents;
                successInput.value = 0;
            }
        });
    }

    // Add event listeners to inputs that affect eligible students count
    const eligibilityInputs = [
        'total_students',
        'total_deprived_students',
        'incomplete_students',
        'withdraw_students'
    ];

    eligibilityInputs.forEach(inputName => {
        document.querySelector(`input[name="${inputName}"]`).addEventListener('input', updateSuccessFailedCounts);
    });
    