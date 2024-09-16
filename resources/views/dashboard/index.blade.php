@extends('layouts.app')

@section('content')
    <div class="dashboard">
        <!-- Stock Totals -->
        <div class="stock-totals">
            <h2>Stock Totals</h2>
            <ul>
                <li>Total IMEI Stock: {{ $imei_products_total }}</li>
                <li>Total Serial Stock: {{ $serial_products_total }}</li>
            </ul>
        </div>

        <!-- Units Not Confirmed (Pending QC) -->
        <div class="pending-qc">
            <h2>Units Not Confirmed</h2>
            <ul>
                <li>IMEI Units Pending QC: {{ $unit_confirmed }}</li>
                <li>Serial Units Pending QC: {{ $serial_unit_confirmed }}</li>
            </ul>
        </div>

        <!-- Today's Bookings -->
        <div class="today-bookings">
            <h2>Today's Bookings</h2>
            <ul>
                <li>Total IMEI Bookings In: {{ $total_bookingin }}</li>
                <li>Total IMEI Bookings Out: {{ $total_bookingout }}</li>
                <li>Total Serial Bookings In: {{ $total_serial_bookingin }}</li>
                <li>Total Serial Bookings Out: {{ $total_serial_bookingout }}</li>
            </ul>
        </div>

        <!-- Returns -->
        <div class="returns">
            <h2>Returns</h2>
            <ul>
                <li>Total IMEI Returns: {{ $total_imei_returns }}</li>
                <li>Total Serial Returns: {{ $total_serial_returns }}</li>
            </ul>
        </div>

        <!-- Recent IMEI Goods In -->
        <div class="imei-goods-in">
            <h2>Recent IMEI Goods In</h2>
            <table>
                <thead>
                    <tr>
                        <th>IMEI</th>
                        <th>Model</th>
                        <th>Date Received</th>
                        <!-- Add other relevant columns -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recent_imei_goods_in as $imei)
                        <tr>
                            <td>{{ $imei->item_imei }}</td.
                            <td>{{ $imei->date }}</td>
                            <!-- Add other relevant data -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination Links -->
            {{ $recent_imei_goods_in->links() }}
        </div>

        <!-- Recent Serial Goods In -->
        <div class="serial-goods-in">
            <h2>Recent Serial Goods In</h2>
            <table>
                <thead>
                    <tr>
                        <th>Serial Number</th>
                        <th>Model</th>
                        <th>Date Received</th>
                        <!-- Add other relevant columns -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recent_serial_goods_in as $serial)
                        <tr>
                            <td>{{ $serial->item_code }}</td>
                            <td>{{ $serial->date }}</td>
                            <!-- Add other relevant data -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination Links -->
            {{ $recent_serial_goods_in->links() }}
        </div>
    </div>
@endsection
