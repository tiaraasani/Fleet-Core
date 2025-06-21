{{-- resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemakaian Kendaraan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <i class="bi bi-truck me-2"></i> FleetApp
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarMain">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-list-check me-1"></i> Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-box-arrow-right me-1"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container py-5">
        <h2 class="text-center mb-4">Dashboard Pemakaian Kendaraan</h2>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card p-4 bg-white">
                    <canvas id="usageChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>

    @php
        // Ambil total tertinggi dari semua status
        $maxPerBar = collect($datasets)->reduce(function ($carry, $set) {
            return collect($set['data'])
                ->zip($carry)
                ->map(function ($pair) {
                    return ($pair[0] ?? 0) + ($pair[1] ?? 0);
                });
        }, array_fill(0, count($labels), 0));
        $maxValue = max($maxPerBar->toArray());
        $yMax = $maxValue === 1 ? 2 : $maxValue + 1;
    @endphp

    <script>
        const ctx = document.getElementById('usageChart').getContext('2d');
        const usageChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: {!! json_encode($datasets) !!}
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0,
                            callback: function(value) {
                                return Number.isInteger(value) ? value : null;
                            },
                            suggestedMax: {{ $yMax }}
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
