$(document).ready(function () {
    let currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
        let x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        document.getElementById("prevBtn").style.display = n == 0 ? "none" : "inline";
        document.getElementById("nextBtn").innerHTML = n == (x.length - 1) ? "Submit" : "Next";
        fixStepIndicator(n);
    }

    document.getElementById("nextBtn").addEventListener("click", function() { nextPrev(1); });
    document.getElementById("prevBtn").addEventListener("click", function() { nextPrev(-1); });
    
    function nextPrev(n) {
        let x = document.getElementsByClassName("tab");
        if (n == 1 && !validateForm()) return false;
        x[currentTab].style.display = "none";
        currentTab += n;
        if (currentTab >= x.length) {
            document.getElementById("powerForm").submit();
            return false;
        }
        showTab(currentTab);
    }
    

    function validateForm() {
        let valid = true;
        let x = document.getElementsByClassName("tab")[currentTab];
        let inputs = x.getElementsByTagName("input");
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].value == "") {
                inputs[i].className += " invalid";
                valid = false;
            }
        }
        return valid;
    }

    function fixStepIndicator(n) {
        let steps = document.getElementsByClassName("step");
        for (let i = 0; i < steps.length; i++) {
            steps[i].className = steps[i].className.replace(" active", "");
        }
        steps[n].className += " active";
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
