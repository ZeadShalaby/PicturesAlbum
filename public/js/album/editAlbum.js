function openNav() {
    document.getElementById("myNav").style.top = "0%";
    document.getElementById("myNav").style.width = "15%";
}

// Get the finish checkbox element
var finishCheckbox = document.getElementById("finish");

// Add event listener to the finish checkbox
finishCheckbox.addEventListener("change", function () {
    // If the checkbox is checked
    if (this.checked) {
        // Get the form element
        var form = document.getElementById("myForm");
        // Submit the form
        form.submit();
    }
});
