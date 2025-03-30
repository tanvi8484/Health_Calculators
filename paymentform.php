<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $upi_id = trim($_POST['upi_id']); // Fixed field name
    $amount = isset($_POST['amount']) ? trim($_POST['amount']) : 0; // Added amount field

    // Basic validation
    if (empty($name) || empty($upi_id) || empty($amount)) {
        echo "<script>alert('All fields are required!'); window.history.back();</script>";
        exit;
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO payments (name, upi_id, amount, payment_status) VALUES (?, ?, ?, 'Done')");
    $stmt->bind_param("ssd", $name, $upi_id, $amount);

    if ($stmt->execute()) {
        echo "<script>alert('Payment details saved successfully!'); window.location.href = 'design.html';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
    }
    

    $stmt->close();
    $conn->close();
}
?>
