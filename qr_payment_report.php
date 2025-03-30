<?php
include 'db_connect.php'; // Database connection

$sql = "SELECT * FROM qr_payments ORDER BY payment_date DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Payment Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f9f9f9; }
        h1 { text-align: center; color: #333; margin-bottom: 20px; }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        button, .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            text-decoration: none;
        }

        .pdf-btn { background-color: #d9534f; }
        .excel-btn { background-color: #5cb85c; }
        .word-btn { background-color: #0275d8; }
        .print-btn { background-color: #f0ad4e; }
        .home-btn { background-color: rgb(175, 76, 125); }

        .home-btn:hover { background-color: rgb(160, 69, 131); }

        table {
            width: 95%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: rgb(175, 76, 125);
            color: white;
        }

        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>

<h1>QR Payment Report</h1>

<div class="buttons">
    <a href="design.html" class="btn home-btn">Back to Home</a>
    <button class="pdf-btn" onclick="downloadPDF()">Download PDF</button>
    <button class="excel-btn" onclick="downloadExcel()">Download Excel</button>
    <button class="word-btn" onclick="downloadWord()">Download Word</button>
    <button class="print-btn" onclick="printTable()">Print Report</button>
</div>

<table id="qrPaymentTable">
    <tr>
        <th>ID</th>
        <th>Amount (₹)</th>
        <th>Payment Status</th>
        <th>Payment Date</th>
    </tr>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td>₹<?php echo $row['amount']; ?></td>
                <td><?php echo $row['payment_status']; ?></td>
                <td><?php echo $row['payment_date']; ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="4">No payments found.</td></tr>
    <?php endif; ?>
</table>

<!-- jsPDF and autoTable -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<script>
async function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.text('QR Payment Report', 14, 20);
    
    const table = [];
    document.querySelectorAll("#qrPaymentTable tr").forEach(row => {
        const rowData = [];
        row.querySelectorAll("th, td").forEach(cell => rowData.push(cell.innerText));
        table.push(rowData);
    });

    doc.autoTable({
        head: [table[0]], 
        body: table.slice(1), 
        startY: 30
    });

    doc.save('qr_payment_report.pdf');
}

function downloadExcel() {
    let csv = [];
    document.querySelectorAll("#qrPaymentTable tr").forEach(row => {
        const rowData = [];
        row.querySelectorAll("th, td").forEach(cell => rowData.push(`"${cell.innerText}"`));
        csv.push(rowData.join(","));
    });

    const csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
    const downloadLink = document.createElement("a");
    downloadLink.href = URL.createObjectURL(csvFile);
    downloadLink.download = "qr_payment_report.csv";
    downloadLink.click();
}

function downloadWord() {
    const header = "<html><head><meta charset='utf-8'><title>QR Payment Report</title></head><body>";
    const footer = "</body></html>";
    const table = document.getElementById("qrPaymentTable").outerHTML;
    const sourceHTML = header + table + footer;

    const blob = new Blob(['\ufeff', sourceHTML], { type: 'application/msword' });
    const downloadLink = document.createElement("a");
    downloadLink.href = URL.createObjectURL(blob);
    downloadLink.download = "qr_payment_report.doc";
    downloadLink.click();
}

function printTable() {
    const tableHTML = document.getElementById("qrPaymentTable").outerHTML;
    const newWin = window.open("");
    newWin.document.write(`
        <html>
            <head>
                <title>Print Report</title>
                <style>
                    table { width: 100%; border-collapse: collapse; }
                    th, td { padding: 10px; border: 1px solid #000; text-align: center; }
                    th { background-color: rgb(175, 76, 125); color: white; }
                    tr:nth-child(even) { background-color: #f9f9f9; }
                </style>
            </head>
            <body>
                ${tableHTML}
            </body>
        </html>
    `);
    newWin.document.close();
    newWin.print();
}
</script>

</body>
</html>
