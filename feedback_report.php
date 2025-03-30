<?php
include 'db_connect.php';

// Fetch all feedback entries
$sql = "SELECT id, name, email, rating, feedback, created_at FROM feedback ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Report</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; background-color: #f9f9f9; }
        h1 { text-align: center; color: #333; margin-bottom: 20px; }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }

        .pdf-btn { background-color: #d9534f; }
        .excel-btn { background-color: #5cb85c; }
        .word-btn { background-color: #0275d8; }
        .print-btn { background-color: #f0ad4e; }

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
            background-color: #d659b9;
            color: white;
        }

        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>

<h1>Feedback Report</h1>

<div class="buttons">
    <button class="pdf-btn" onclick="downloadPDF()">Download PDF</button>
    <button class="excel-btn" onclick="downloadExcel()">Download Excel</button>
    <button class="word-btn" onclick="downloadWord()">Download Word</button>
    <button class="print-btn" onclick="printTable()">Print Report</button>
</div>

<?php
if ($result->num_rows > 0) {
    echo "<table id='feedbackTable'>";
    echo "<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Rating</th>
            <th>Feedback</th>
            <th>Date</th>
          </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>". $row["id"]. "</td>
                <td>". htmlspecialchars($row["name"]). "</td>
                <td>". htmlspecialchars($row["email"]). "</td>
                <td>". $row["rating"]. "</td>
                <td>". nl2br(htmlspecialchars($row["feedback"])). "</td>
                <td>". date("d M Y, h:i A", strtotime($row["created_at"])). "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No feedback found.</p>";
}
$conn->close();
?>

<!-- jsPDF and autoTable -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<script>
async function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.text('Feedback Report', 14, 20);
    
    const table = [];
    document.querySelectorAll("#feedbackTable tr").forEach(row => {
        const rowData = [];
        row.querySelectorAll("th, td").forEach(cell => rowData.push(cell.innerText));
        table.push(rowData);
    });

    doc.autoTable({
        head: [table[0]], 
        body: table.slice(1), 
        startY: 30
    });

    doc.save('feedback_report.pdf');
}

function downloadExcel() {
    let csv = [];
    document.querySelectorAll("#feedbackTable tr").forEach(row => {
        const rowData = [];
        row.querySelectorAll("th, td").forEach(cell => rowData.push(`"${cell.innerText}"`));
        csv.push(rowData.join(","));
    });

    const csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
    const downloadLink = document.createElement("a");
    downloadLink.href = URL.createObjectURL(csvFile);
    downloadLink.download = "feedback_report.csv";
    downloadLink.click();
}

function downloadWord() {
    const header = "<html><head><meta charset='utf-8'><title>Feedback Report</title></head><body>";
    const footer = "</body></html>";
    const table = document.getElementById("feedbackTable").outerHTML;
    const sourceHTML = header + table + footer;

    const blob = new Blob(['\ufeff', sourceHTML], { type: 'application/msword' });
    const downloadLink = document.createElement("a");
    downloadLink.href = URL.createObjectURL(blob);
    downloadLink.download = "feedback_report.doc";
    downloadLink.click();
}

function printTable() {
    const tableHTML = document.getElementById("feedbackTable").outerHTML;
    const newWin = window.open("");
    newWin.document.write(`
        <html>
            <head>
                <title>Print Report</title>
                <style>
                    table { width: 100%; border-collapse: collapse; }
                    th, td { padding: 10px; border: 1px solid #000; text-align: center; }
                    th { background-color: #d659b9; color: white; }
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
