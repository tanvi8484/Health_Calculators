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
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $file_path = mysqli_real_escape_string($conn, $_POST['file_path']);

    $update = "UPDATE calculators SET name='$name', description='$description', file_path='$file_path' WHERE id=$id";

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('Calculator updated successfully'); window.location.href='view_calculators.php';</script>";
    } else {
        echo "<script>alert('Failed to update calculator');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            padding: 30px;
        }
        h2 {
            text-align: center;
            color: #c83f68;
            margin-bottom: 30px;
        }
        form {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            max-width: 550px;
            margin: auto;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-top: 20px;
            font-size: 15px;
            color: #555;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
        }
        textarea {
            resize: vertical;
        }
        button {
            margin-top: 30px;
            width: 100%;
            padding: 14px;
            background-color: rgb(189, 74, 116);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button:hover {
            background-color: rgb(175, 71, 116);
            transform: translateY(-2px);
        }
        .back-btn {
            display: block;
            text-align: center;
            margin: 20px auto 0 auto;
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
        /* Hide non-essential elements during print */
        @media print {
            .back-btn,
            .print-action,
            button {
                display: none;
            }
        }
    </style>
</head>
<body>

    <h2>Update Calculator</h2>

    <form method="POST">
        <label for="name">Calculator Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($calculator['name']); ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4"><?php echo htmlspecialchars($calculator['description']); ?></textarea>

        <label for="file_path">File Path (e.g., calculators/bmi.html):</label>
        <input type="text" name="file_path" id="file_path" value="<?php echo htmlspecialchars($calculator['file_path']); ?>" required>

        <button type="submit">Update Calculator</button>
    </form>

    <a class="back-btn" href="view_calculators.php">← Back to Calculators</a>

    <div class="print-action">
        <button onclick="window.print()">Print Page</button>
    </div>

</body>
</html>
