document.addEventListener("DOMContentLoaded", function () {
    // Run function to set the correct section on page load
    togglePaymentMethod();
});

// Function to show/hide UPI and QR Code sections
function togglePaymentMethod() {
    let method = document.getElementById("payment-method").value;
    let upiSection = document.getElementById("upi-section");
    let qrSection = document.getElementById("qr-code");
    let amountInput = document.getElementById("amount");

    if (method === "upi") {
        upiSection.style.display = "block";  // Show UPI fields
        qrSection.style.display = "none";    // Hide QR Code
        amountInput.value = 10;  // Set ₹10 for UPI
    } else {
        upiSection.style.display = "none";   // Hide UPI fields
        qrSection.style.display = "block";   // Show QR Code
    }
}

// Function to confirm payment before submission
function confirmPayment() {
    let method = document.getElementById("payment-method").value;
    let confirmationMessage = method === "upi" 
        ? "You will pay ₹10 via UPI. Proceed?" 
        : "Please scan the QR Code to complete your payment. Click OK when done.";

    return confirm(confirmationMessage);
}
