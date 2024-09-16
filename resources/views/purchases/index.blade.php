@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Purchases</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Purchase ID</th>
                <th>Item IMEI</th>
                <th>Date</th>
                <th>Supplier</th>
                <th>Tray ID</th>
                <th>Priority</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
            <tr>
                <td>{{ $purchase->purchase_id }}</td>
                <td>{{ $purchase->item_imei }}</td>
                <td>{{ $purchase->date }}</td>
                <td>{{ $purchase->supplier->name ?? 'N/A' }}</td>
                <td>{{ $purchase->tray_id }}</td>
                <td>{{ $purchase->priority }}</td>
                <!-- Add more columns as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
