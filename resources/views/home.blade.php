<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMEI Inventory Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        #result {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
        .result-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>Search IMEI Inventory</h1>
<input type="text" id="imeiInput" placeholder="Enter IMEI number">
<button onclick="searchImei()">Search</button>

<div id="result"></div>

<script>
    function searchImei() {
        const imei = document.getElementById('imeiInput').value;
        const url = `http://167.99.83.205/public/api/inventory?imei=${imei}`;
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                displayResult(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                document.getElementById('result').innerHTML = 'Error fetching data';
            });
    }

    function displayResult(data) {
        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = ''; // Clear previous results
        
        if (!data) {
            resultDiv.innerHTML = 'No data found';
            return;
        }

        const itemData = `
            <div class="result-item"><strong>ID:</strong> ${data.id}</div>
            <div class="result-item"><strong>IMEI:</strong> ${data.item_imei}</div>
            <div class="result-item"><strong>TAC:</strong> ${data.item_tac}</div>
            <div class="result-item"><strong>Color:</strong> ${data.item_color}</div>
            <div class="result-item"><strong>Grade:</strong> ${data.item_grade}</div>
            <div class="result-item"><strong>GB:</strong> ${data.item_gb}</div>
            <div class="result-item"><strong>Purchase ID:</strong> ${data.purchase_id}</div>
            <div class="result-item"><strong>Status:</strong> ${data.status}</div>
            <div class="result-item"><strong>Item Details:</strong> ${data.item_details}</div>
            <div class="result-item"><strong>Brand:</strong> ${data.item_brand}</div>
        `;

        const purchaseData = `
            <div class="result-item"><strong>Purchase ID:</strong> ${data.purchase.id}</div>
            <div class="result-item"><strong>Purchase IMEI:</strong> ${data.purchase.item_imei}</div>
            <div class="result-item"><strong>Date:</strong> ${data.purchase.date}</div>
            <div class="result-item"><strong>Supplier ID:</strong> ${data.purchase.supplier_id}</div>
            <div class="result-item"><strong>Tray ID:</strong> ${data.purchase.tray_id}</div>
            <div class="result-item"><strong>QC Required:</strong> ${data.purchase.qc_required}</div>
            <div class="result-item"><strong>QC Completed:</strong> ${data.purchase.qc_completed}</div>
            <div class="result-item"><strong>Repair Required:</strong> ${data.purchase.repair_required}</div>
            <div class="result-item"><strong>Repair Completed:</strong> ${data.purchase.repair_completed}</div>
            <div class="result-item"><strong>Purchase Return:</strong> ${data.purchase.purchase_return}</div>
            <div class="result-item"><strong>Priority:</strong> ${data.purchase.priority}</div>
            <div class="result-item"><strong>User ID:</strong> ${data.purchase.user_id}</div>
            <div class="result-item"><strong>Report Comment:</strong> ${data.purchase.report_comment}</div>
            <div class="result-item"><strong>PO Reference:</strong> ${data.purchase.po_ref}</div>
            <div class="result-item"><strong>Has Return Tag:</strong> ${data.purchase.has_return_tag}</div>
            <div class="result-item"><strong>Unit Confirmed:</strong> ${data.purchase.unit_confirmed}</div>
        `;

        resultDiv.innerHTML = `<h2>Item Details</h2>${itemData}<h2>Purchase Details</h2>${purchaseData}`;
    }
</script>

</body>
</html>
