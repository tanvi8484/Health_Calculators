<?php
include 'db_connect.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = trim($_POST['name']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $rating = (int) $_POST['rating'];
    $feedback = trim($_POST['feedback']);

    // Check for required fields
    if (empty($name) || empty($rating) || empty($feedback)) {
        echo "<script>alert('All fields are required!'); window.location.href = 'feedback_form.html';</script>";
        exit;
    }

    // Check if rating is between 1 and 5
    if ($rating < 1 || $rating > 5) {
        echo "<script>alert('Please provide a valid rating between 1 and 5'); window.location.href = 'feedback_form.html';</script>";
        exit;
    }

    // Prevent SQL Injection by binding parameters
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, feedback) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $email, $rating, $feedback);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>
            alert('Feedback Submitted Successfully!');
            window.location.href = 'design.html'; // Redirect to form page
        </script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'feedback_form.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
