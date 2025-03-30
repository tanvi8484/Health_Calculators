<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: view_calculators.php");
    exit();
}

$id = intval($_GET['id']);

$calculator = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM calculators WHERE id = $id"));

if (!$calculator) {
    echo "<script>alert('Calculator not found'); window.location.href='view_calculators.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delete = mysqli_query($conn, "DELETE FROM calculators WHERE id = $id");

    if ($delete) {
        echo "<script>alert('Calculator deleted successfully'); window.location.href='view_calculators.php';</script>";
    } else {
        echo "<script>alert('Failed to delete calculator'); window.location.href='view_calculators.php';</script>";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            padding: 30px;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            color: #d9534f;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            color: #555;
        }
        .btn {
            padding: 12px 24px;
            margin: 20px 10px 0 10px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .delete-btn {
            background-color: rgb(226, 54, 72);
            color: #fff;
        }
        .delete-btn:hover {
            background-color: rgb(200, 45, 60);
            transform: translateY(-2px);
        }
        .cancel-btn {
            background-color: #ccc;
            color: #333;
        }
        .cancel-btn:hover {
            background-color: #bbb;
            transform: translateY(-2px);
        }
        .print-action {
            margin-top: 30px;
        }
        .print-action button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background-color: #c83f68;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        .print-action button:hover {
            background-color: #b53f8b;
        }
        @media print {
            form,
            .cancel-btn,
            .delete-btn,
            .print-action {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Confirm Delete</h2>
        <p>Are you sure you want to delete the calculator:</p>
        <p><strong><?php echo htmlspecialchars($calculator['name']); ?></strong></p>

        <form method="POST">
            <button type="submit" class="btn delete-btn">Yes, Delete</button>
            <a href="view_calculators.php" class="btn cancel-btn">Cancel</a>
        </form>

        <div class="print-action">
            <button onclick="window.print()">Print Page</button>
        </div>
    </div>

</body>
</html>
