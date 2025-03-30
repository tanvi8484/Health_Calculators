<?php
include 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashedPassword)) {
        // Record successful login
        $logStmt = $conn->prepare("INSERT INTO login_history (username) VALUES (?)");
        $logStmt->bind_param("s", $username);
        $logStmt->execute();
        $logStmt->close();

        header("Location: design.html");
        exit();
    } else {
        echo "<script>alert('Invalid username or password.'); window.location.href = 'login.html';</script>";
    }
}
?>
