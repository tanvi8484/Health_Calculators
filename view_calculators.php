<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$calculators = mysqli_query($conn, "SELECT * FROM calculators ORDER BY date_added DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calculator Management Report</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 30px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: rgb(170, 53, 148);
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a.action-btn {
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 14px;
            margin: 0 4px;
        }
        .edit-btn { background-color: rgb(255, 0, 128); }
        .delete-btn { background-color: rgb(226, 54, 72); }
        .link-btn { background-color: rgb(236, 116, 180); }

        .action-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
        }

        .action-buttons button {
            padding: 10px 20px;
            margin: 5px;
            font-size: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background-color: rgb(200, 63, 104);
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .action-buttons button:hover {
            background-color: rgb(181, 63, 139);
        }

        @media print {
            .action-buttons, .action-btn, th:nth-child(4), th:nth-child(5), td:nth-child(4), td:nth-child(5) {
                display: none !important;
            }
        }
        .back-btn {
    display: inline-block;
    margin: 40px auto;
    text-align: center;
    text-decoration: none;
    color: #555;
    font-size: 16px;
    padding: 12px 24px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.back-btn:hover {
    background-color: #f0f0f0;
    color: #333;
}

/* Center the back button wrapper */
.back-btn-wrapper {
    text-align: center;
    margin-top: 30px;
}

    </style>
</head>
<body>

    <h2>All Calculators</h2>

    <div class="action-buttons">
        <button onclick="printTable()">Print</button>
        <button onclick="downloadPDF()">Download PDF</button>
        <button onclick="downloadExcel()">Download Excel</button>
    </div>

    <table id="calculatorTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($calculators)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td>
                    <a class="action-btn link-btn" href="<?php echo htmlspecialchars($row['file_path']); ?>" target="_blank">Open</a>
                </td>
                <td>
                    <a class="action-btn edit-btn" href="update_calculator.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a class="action-btn delete-btn" href="delete_calculator.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this calculator?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <div class="back-btn-wrapper">
    <a class="back-btn" href="admin_dashboard.php">← Back to Dashboard</a>
    </div>


    <script>
        function printTable() {
            window.print();
        }

        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            doc.setFontSize(18);
            doc.text("Calculator Management Report", 14, 22);

            const head = [['ID', 'Name', 'Description']];
            const rows = [];
            document.querySelectorAll('#calculatorTable tbody tr').forEach(row => {
                const rowData = [
                    row.cells[0].innerText,
                    row.cells[1].innerText,
                    row.cells[2].innerText
                ];
                rows.push(rowData);
            });

            doc.autoTable({
                head: head,
                body: rows,
                startY: 30,
                theme: 'grid'
            });

            doc.save('calculator_report.pdf');
        }

        function downloadExcel() {
            const table = document.getElementById('calculatorTable');
            const wb = XLSX.utils.book_new();
            const ws_data = [['ID', 'Name', 'Description']];

            table.querySelectorAll('tbody tr').forEach(row => {
                ws_data.push([
                    row.cells[0].innerText,
                    row.cells[1].innerText,
                    row.cells[2].innerText
                ]);
            });

            const ws = XLSX.utils.aoa_to_sheet(ws_data);
            XLSX.utils.book_append_sheet(wb, ws, 'Calculators');
            XLSX.writeFile(wb, 'calculator_report.xlsx');
        }
    </script>

</body>
</html>
