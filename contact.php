<?php
include 'db_connect.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = trim($_POST['name']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST['message']);

    // Check for required fields
    if (empty($name) || empty($email) || empty($message)) {
        echo "<script>alert('All fields are required!'); window.location.href = 'contact.html';</script>";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!'); window.location.href = 'contact.html';</script>";
        exit;
    }

    // Prevent SQL Injection by binding parameters
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>
            alert('Message Sent Successfully!');
            window.location.href = 'design.html'; // Redirect to form page
        </script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'contact.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
