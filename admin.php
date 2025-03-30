<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM reports");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Report</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>
    <a href="admin_logout.php">Logout</a>

    <h3>Reports Data</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['date']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
