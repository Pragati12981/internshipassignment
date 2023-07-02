// Display the selected file name for the health report input field
const healthReportInput = document.getElementById("healthReport");
const healthReportLabel = document.querySelector("label[for='healthReport']");

healthReportInput.addEventListener("change", function() {
  if (healthReportInput.files.length > 0) {
    healthReportLabel.textContent = "Health Report: " + healthReportInput.files[0].name;
  }
});
