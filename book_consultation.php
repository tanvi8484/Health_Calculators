<?php
include 'db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $message = $_POST['message'];

    // Prevent SQL Injection
    $stmt = $conn->prepare("INSERT INTO consultations (name, email, phone, preferred_date, preferred_time, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $date, $time, $message);

    if ($stmt->execute()) {
        echo "<script>
            alert('Consultation Booked Successfully!');
            window.location.href = 'paymentform.html'; // Redirect to form page
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
