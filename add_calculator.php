<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $file_path = mysqli_real_escape_string($conn, $_POST['file_path']);

    $insert = "INSERT INTO calculators (name, description, file_path) VALUES ('$name', '$description', '$file_path')";
    
    if (mysqli_query($conn, $insert)) {
        echo "<script>alert('Calculator added successfully'); window.location.href='view_calculators.php';</script>";
    } else {
        echo "<script>alert('Failed to add calculator');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Calculator</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            max-width: 550px;
            margin: auto;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #c83f68;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            margin-top: 25px;
            width: 100%;
            padding: 14px;
            background-color: #c83f68;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #b53f8b;
        }

        .back-btn {
            display: block;
            text-align: center;
            margin: 20px auto;
            text-decoration: none;
            color: #555;
            font-size: 16px;
        }

        .print-action {
            text-align: center;
            margin: 40px auto 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 15px;
            max-width: 550px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .print-action button {
            padding: 12px 24px;
            margin: 10px;
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

        /* Hide only buttons and actions during print */
        @media print {
            .back-btn,
            .print-action,
            form button {
                display: none !important;
            }
            input, textarea {
                border: none;
                background: none;
                box-shadow: none;
                pointer-events: none;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Add New Calculator</h2>

        <form method="POST">
            <label>Calculator Name:</label>
            <input type="text" name="name" required>

            <label>Description:</label>
            <textarea name="description" rows="4"></textarea>

            <label>File Path (e.g., calculators/bmi.html):</label>
            <input type="text" name="file_path" required>

            <button type="submit">Add Calculator</button>
        </form>

        <a class="back-btn" href="admin_dashboard.php">← Back to Dashboard</a>
    </div>

    <div class="print-action">
        <button onclick="window.print()">Print Report</button>
    </div>

</body>
</html>
