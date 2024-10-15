$(document).ready(function () {
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block"; // Show the current tab

        // Hide the "Previous" button on the first tab
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }

        // Change the "Next" button to "Submit" on the last tab
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }

        fixStepIndicator(n); // Run a function to display the correct step indicator
    }

    function nextPrev(n) {
        var x = document.getElementsByClassName("tab");

        // Exit the function if any field in the current tab is invalid
        if (n == 1 && !validateForm()) return false;

        // Hide the current tab
        x[currentTab].style.display = "none";

        // Increase or decrease the current tab by 1
        currentTab = currentTab + n;

        // If you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("powerForm").submit();
            return false;
        }

        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].querySelectorAll("input, select"); // Get both input and select elements

        // A loop that checks every input field in the current tab
        for (i = 0; i < y.length; i++) {
            if (y[i].value == "") {
                y[i].className += " invalid"; // Add "invalid" class to the field
                valid = false; // Set valid status to false
            }
        }
        return valid; // Return the valid status
    }

    function fixStepIndicator(n) {
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        x[n].className += " active"; // Add "active" class to the current step
    }

    document.getElementById('selectSite').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        document.getElementById('address').value = selectedOption.getAttribute('data-address');
    });

    $(".multiple-select").select2({
        theme: "bootstrap4",
        width: "100%",
        placeholder: "Select options",
        allowClear: true,
    });
});
