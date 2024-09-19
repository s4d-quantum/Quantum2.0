@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Manage Products</h1>
    </section>
    <br>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form id="filterForm" class="form-inline">
                    <div class="form-group" style="margin-right: 10px;">
                        <label for="stockType">Stock Type:</label>
                        <select id="stockType" class="form-control">
                            <option value="instock">In Stock</option>
                            <option value="sold">Sold</option>
                            <option value="all">All</option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-right: 10px;">
                        <label for="category">Category:</label>
                        <select id="category" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-right: 10px;">
                        <label for="color">Color:</label>
                        <select id="color" class="form-control">
                            <option value="">Select Color</option>
                            @foreach($colors as $color)
                                <option value="{{ $color }}">{{ $color }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-right: 10px;">
                        <label for="gb">GB:</label>
                        <select id="gb" class="form-control">
                            <option value="">Select GB</option>
                            @foreach([4, 8, 16, 32, 64, 128, 256, 512, 1028] as $gb)
                                <option value="{{ $gb }}">{{ $gb }} GB</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-right: 10px;">
                        <label for="grade">Grade:</label>
                        <select id="grade" class="form-control">
                            <option value="">Select Grade</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->grade_id }}">{{ $grade->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-right: 10px;">
                        <label for="tray">Tray#:</label>
                        <select id="tray" class="form-control">
                            <option value="">Select Tray</option>
                            @foreach($trays as $tray)
                                <option value="{{ $tray->tray_id }}">{{ $tray->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-right: 10px;">
                        <label for="qcDone">QC Done?</label>
                        <select id="qcDone" class="form-control">
                            <option value="">Select QC Status</option>
                            <option value="1">Complete</option>
                            <option value="0">Incomplete</option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-right: 10px;">
                        <label for="qcStatus">QC Status:</label>
                        <select id="qcStatus" class="form-control">
                            <option value="">Select QC Result</option>
                            <option value="1">Passed</option>
                            <option value="0">Failed</option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-right: 10px;">
                        <label for="supplier">Supplier:</label>
                        <select id="supplier" class="form-control">
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->supplier_id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-right: 10px;">
                        <label for="customer">Customer:</label>
                        <select id="customer" class="form-control">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->customer_id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-right: 10px;">
                        <label for="fromDate">From Date:</label>
                        <input type="date" id="fromDate" class="form-control" placeholder="From:">
                    </div>

                    <div class="form-group" style="margin-right: 10px;">
                        <label for="toDate">To Date:</label>
                        <input type="date" id="toDate" class="form-control" placeholder="To:">
                    </div>

                    <button type="button" class="btn btn-success" id="applyFilters">Apply Filters</button>
                </form>

                <br>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchImei" placeholder="Search IMEI">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success" id="searchImeiBtn">Search</button>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchModel" placeholder="Search Model">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success" id="searchModelBtn">Search</button>
                            </span>
                        </div>
                    </div>
                </div>

                <br>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success">
                        <div class="box-body custom_datatable_wrapper">
                            <table class="table table-striped table-hover" id="inventoryTable">
                                <thead>
                                    <tr>
                                        <th>P.ID</th>
                                        <th>IMEI</th>
                                        <th>Brand</th>
                                        <th>Supplier</th>
                                        <th>Color</th>
                                        <th>GB</th>
                                        <th>Grade</th>
                                        <th>Details</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be populated here via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- JavaScript Section -->
<script>
    document.getElementById('applyFilters').addEventListener('click', function() {
        fetchInventoryData();
    });

    document.getElementById('searchImeiBtn').addEventListener('click', function() {
        searchByImei();
    });

    document.getElementById('searchModelBtn').addEventListener('click', function() {
        searchByModel();
    });

    function fetchInventoryData() {
        // Gather filter values
        const stockType = document.getElementById('stockType').value;
        const category = document.getElementById('category').value;
        const color = document.getElementById('color').value;
        const gb = document.getElementById('gb').value;
        const grade = document.getElementById('grade').value;
        const tray = document.getElementById('tray').value;
        const qcDone = document.getElementById('qcDone').value;
        const qcStatus = document.getElementById('qcStatus').value;
        const supplier = document.getElementById('supplier').value;
        const customer = document.getElementById('customer').value;
        const fromDate = document.getElementById('fromDate').value;
        const toDate = document.getElementById('toDate').value;

        // Build query parameters
        const params = new URLSearchParams({
            stockType,
            category,
            color,
            gb,
            grade,
            tray,
            qcDone,
            qcStatus,
            supplier,
            customer,
            fromDate,
            toDate,
        });

        // Make AJAX request
        fetch(`{{ route('inventory.data') }}?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                // Populate the table with data
                populateInventoryTable(data);
            })
            .catch(error => console.error('Error fetching inventory data:', error));
    }

    function searchByImei() {
        const imei = document.getElementById('searchImei').value;

        fetch(`{{ route('inventory.searchImei') }}?imei=${imei}`)
            .then(response => response.json())
            .then(data => {
                populateInventoryTable(data);
            })
            .catch(error => console.error('Error searching by IMEI:', error));
    }

    function searchByModel() {
        const model = document.getElementById('searchModel').value;

        fetch(`{{ route('inventory.searchModel') }}?model=${model}`)
            .then(response => response.json())
            .then(data => {
                populateInventoryTable(data);
            })
            .catch(error => console.error('Error searching by model:', error));
    }

    function populateInventoryTable(data) {
        const tbody = document.querySelector('#inventoryTable tbody');
        tbody.innerHTML = ''; // Clear existing data

        data.forEach(item => {
            const row = document.createElement('tr');

            // Create table cells
            const pidCell = document.createElement('td');
            pidCell.textContent = item.id; // Assuming 'id' is the primary key

            const imeiCell = document.createElement('td');
            const imeiLink = document.createElement('a');
            imeiLink.href = `/inventory/item/${item.item_imei}`;
            imeiLink.textContent = item.item_imei;
         imeiCell.appendChild(imeiLink);

            const brandCell = document.createElement('td');
            brandCell.textContent = item.item_brand;

            const supplierCell = document.createElement('td');
            supplierCell.textContent = item.supplier_name; // Adjust as needed

            const colorCell = document.createElement('td');
            colorCell.textContent = item.color;

            const gbCell = document.createElement('td');
            gbCell.textContent = item.gb;

            const gradeCell = document.createElement('td');
            gradeCell.textContent = item.grade_title; // Adjust as needed

            const detailsCell = document.createElement('td');
            detailsCell.textContent = item.item_details;

            const statusCell = document.createElement('td');
            statusCell.textContent = item.status == 1 ? 'In Stock' : 'Sold';

            // Append cells to the row
            row.appendChild(pidCell);
            row.appendChild(imeiCell);
            row.appendChild(brandCell);
            row.appendChild(supplierCell);
            row.appendChild(colorCell);
            row.appendChild(gbCell);
            row.appendChild(gradeCell);
            row.appendChild(detailsCell);
            row.appendChild(statusCell);

            // Append row to the table body
            tbody.appendChild(row);
        });
    }

    // Optionally, fetch initial data when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        fetchInventoryData();
    });
</script>
@endsection
