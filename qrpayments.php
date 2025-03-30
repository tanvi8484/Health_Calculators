<?php
include 'db_connect.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = 10; // Fixed amount
    $sql = "INSERT INTO qr_payments (amount, payment_status) VALUES ('$amount', 'Completed')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('QR Payment Recorded!'); window.location.href='design.html';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
