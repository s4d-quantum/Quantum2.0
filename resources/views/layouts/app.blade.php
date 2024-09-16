<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $company_info->company_title ?? 'Quantum 2.0' }}</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Add any additional CSS or JS here -->
</head>
<body>
    <div id="app">
        <!-- Top Bar -->
        <header>
            <div class="top-bar">
                <h1>{{ $company_info->company_title ?? 'Quantum 2.0' }}</h1>
                <div class="logout-button">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <div class="container">
            <!-- Sidebar -->
            <aside>
                <nav>
                    <ul>
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('inventory') }}">Inventory</a></li>
                        <li><a href="{{ route('goods-in') }}">Goods In</a></li>
                        <li><a href="{{ route('qc') }}">QC</a></li>
                        <li><a href="{{ route('repair') }}">Repair</a></li>
                        <li><a href="{{ route('goods-out') }}">Goods Out</a></li>
                        <li><a href="{{ route('sales-orders') }}">Sales Orders</a></li>
                    </ul>
                </nav>
            </aside>

            <!-- Main Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Include your JavaScript files here -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
