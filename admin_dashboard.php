<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch stats
$users_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_users FROM users"))['total_users'];
$consultations_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_consultations FROM consultations"))['total_consultations'];
$contact_messages_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_contacts FROM contact_messages"))['total_contacts'];
$feedback_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_feedback FROM feedback"))['total_feedback'];
$qr_payments_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_qr_payments FROM qr_payments"))['total_qr_payments'];
$payments_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_payments FROM payments"))['total_payments'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f2f2f2;
        }

        h1, h2, h3 {
            text-align: center;
            color: #333;
        }

        a.logout-btn {
            display: inline-block;
            margin: 10px auto;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #ff6347;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a.logout-btn:hover {
            background-color: #e5533d;
        }

        section {
            max-width: 1200px;
            margin: 30px auto;
        }

        .reports {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .box {
            background-color: #fff;
            padding: 20px;
            width: 250px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: #333;
        }

        .box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .box h4 {
            margin-bottom: 10px;
            color: #555;
        }

        .box p {
            font-size: 24px;
            color: #333;
            margin: 0;
        }

    </style>
</head>
<body>

    <h1>Welcome, <?php echo $_SESSION['admin']; ?>!</h1>
    <div style="text-align: center;">
        <a class="logout-btn" href="admin_logout.php">Logout</a>
    </div>

    <section>
        <h2>Admin Dashboard</h2>
        <div class="reports">
            <a class="box" href="register_report.php">
                <h4>Registered Users</h4>
                <p><?php echo $users_count; ?></p>
            </a>
            <a class="box" href="login_report.php">
                <h4>Manage Users</h4>
                <p><?php echo $users_count; ?></p>
            </a>
            <a class="box" href="consultation_report.php">
                <h4>View Consultations</h4>
                <p><?php echo $consultations_count; ?></p>
            </a>
            <a class="box" href="contact_report.php">
                <h4>View Contact Messages</h4>
                <p><?php echo $contact_messages_count; ?></p>
            </a>
            <a class="box" href="feedback_report.php">
                <h4>View Feedback</h4>
                <p><?php echo $feedback_count; ?></p>
            </a>
            <a class="box" href="qr_payment_report.php">
                <h4>View QR Payments</h4>
                <p><?php echo $qr_payments_count; ?></p>
            </a>
            <a class="box" href="payment_report.php">
                <h4>View UPI Payments</h4>
                <p><?php echo $payments_count; ?></p>
            </a>
        </div>
    </section>

    <!-- 🔹 Calculator Management Section -->
    <section>
        <h2>Calculator Management</h2>
        <div class="reports">
            <a class="box" href="add_calculator.php">
                <h4>Add Calculator</h4>
                <p>➕</p>
            </a>
            <a class="box" href="update_calculator.php">
                <h4>Update Calculator</h4>
                <p>✏️</p>
            </a>
            <a class="box" href="delete_calculator.php">
                <h4>Remove Calculator</h4>
                <p>🗑️</p>
            </a>
            <a class="box" href="view_calculators.php">
                <h4>View Calculators</h4>
                <p>📊</p>
            </a>
        </div>
    </section>

</body>
</html>
