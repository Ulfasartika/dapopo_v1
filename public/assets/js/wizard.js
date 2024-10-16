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
        let selects = x.getElementsByTagName("select");
        for (let i = 0; i < inputs.length; i++) {
            console.log(`Input: ${inputs[i].id},Value: ${inputs[i].value}`)
            if (inputs[i].value == "") {
                inputs[i].className += " invalid";
                valid = false;
            }
        }
        for (let i = 0; i < selects.length; i++){
            if (selects[i].multiple){
                if (selects[i].selectedOptions.length === 0){
                    console.log(`Multiple Select: ${selects[i].id}, Selected: ${selects[i].selectedOptions.length}`);
                    selects[i].classList.add("invalid");
                    valid = false;
                } else {
                    selects[i].classList.remove("invalid");
                }
            } else{
                console.log(`Single Select: ${selects[i].id}, Value: ${selects[i].value}`);
                if (selects[i].value === ""){
                    selects[i].classList.add("invalid");
                    valid = false;
                } else {
                    selects[i].classList.remove("invalid");
                }
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

    $('.multiple-select').on('change', function() {
        if ($(this).val()) {
            $(this).removeClass('invalid');
        } else {
            $(this).addClass('invalid');
        }
    });

});
