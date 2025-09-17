<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
    <div id="mainContent">
        @include('partials.navbar2', ['shouldShowDiv' => true])

        <div class="container py-5" style="margin-top: 20px;">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-primary text-white text-center">
                            <h5 class="mb-0"><i class="bi bi-person-gear me-2"></i>Administrator</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="bi bi-shield-check text-primary" style="font-size: 2rem;"></i>
                                </div>
                                <h4 class="fw-bold text-primary mb-1">{{ $user->first_name." ".$user->last_name }}</h4>
                                <p class="text-muted mb-2">System Administrator</p>
                                <span class="badge bg-primary px-3 py-2">ADMIN ACCESS</span>
                            </div>
                            <div class="row g-3 text-center">
                                <div class="col-6">
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-people text-success fs-4"></i>
                                        <div class="fw-bold text-success">{{ $totalhead + $totalmembercount }}</div>
                                        <small class="text-muted">Total Users</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-info bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-buildings text-info fs-4"></i>
                                        <div class="fw-bold text-info">{{ $totalcitycount + $totalstatecount }}</div>
                                        <small class="text-muted">Locations</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0"><i class="bi bi-database-gear me-2"></i>Export Data</h6>
                        </div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div><i class="bi bi-person text-warning me-2"></i>Heads</div>
                                <div>
                                    <a href="{{ route('download_all') }}" class="btn btn-sm btn-outline-danger me-1">PDF</a>
                                    <a href="{{ route('download_excel_all') }}" class="btn btn-sm btn-outline-success">Excel</a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div><i class="bi bi-people text-info me-2"></i>Members</div>
                                <div>
                                    <a href="{{ route('download_all_members') }}" class="btn btn-sm btn-outline-danger me-1">PDF</a>
                                    <a href="{{ route('download_excel_all_members') }}" class="btn btn-sm btn-outline-success">Excel</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0"><i class="bi bi-journal-text me-2"></i>Admin Logs</h6>
                        </div>
                        <div class="card-body p-0" style="max-height: 300px; overflow-y: auto;">
                            <div class="list-group list-group-flush">
                                @forelse($logs as $log)
                                    <div class="list-group-item border-0 py-2">
                                        <div class="small text-muted">{{ Str::before($admin1->email, '@') }}</div>
                                        <div class="fw-medium">{{ $log->logs }}</div>
                                    </div>
                                @empty
                                    <div class="list-group-item text-center text-muted">No logs found</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i>Profile Information</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded">
                                        <label class="fw-bold text-primary mb-1">First Name</label>
                                        <p class="mb-0 h6">{{ $user->first_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded">
                                        <label class="fw-bold text-primary mb-1">Last Name</label>
                                        <p class="mb-0 h6">{{ $user->last_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded">
                                        <label class="fw-bold text-primary mb-1">Email</label>
                                        <p class="mb-0 h6">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded">
                                        <label class="fw-bold text-primary mb-1">Mobile</label>
                                        <p class="mb-0 h6">{{ $user->mobile }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-light p-3 rounded">
                                        <label class="fw-bold text-primary mb-1">Address</label>
                                        <p class="mb-0 h6">{{ $user->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $statusData = [
                            ['title' => 'Family Heads', 'icon' => 'person-fill', 'total' => $totalhead, 'data' => [
                                ['label' => 'Active', 'count' => $headcount, 'color' => '#198754'],
                                ['label' => 'Inactive', 'count' => $inactiveheadcount, 'color' => '#ffc107'],
                                ['label' => 'Deleted', 'count' => $deletedheadcount, 'color' => '#dc3545'],
                            ], 'link' => '/admin'],
                            ['title' => 'Family Members', 'icon' => 'people-fill', 'total' => $totalmembercount, 'data' => [
                                ['label' => 'Active', 'count' => $membercount, 'color' => '#198754'],
                                ['label' => 'Inactive', 'count' => $inactivemembercount, 'color' => '#ffc107'],
                                ['label' => 'Deleted', 'count' => $deletedmembercount, 'color' => '#dc3545'],
                            ], 'link' => '#'],
                            ['title' => 'Cities', 'icon' => 'buildings-fill', 'total' => $totalcitycount, 'data' => [
                                ['label' => 'Active', 'count' => $citycount, 'color' => '#198754'],
                                ['label' => 'Inactive', 'count' => $inactivecitycount, 'color' => '#ffc107'],
                                ['label' => 'Deleted', 'count' => $deletedcitycount, 'color' => '#dc3545'],
                            ], 'link' => '/admin/state-city/city'],
                            ['title' => 'States', 'icon' => 'geo-fill', 'total' => $totalstatecount, 'data' => [
                                ['label' => 'Active', 'count' => $statecount, 'color' => '#198754'],
                                ['label' => 'Inactive', 'count' => $inactivestatecount, 'color' => '#ffc107'],
                                ['label' => 'Deleted', 'count' => $deletedstatecount, 'color' => '#dc3545'],
                            ], 'link' => '/admin/state-city/states'],
                        ];
                    @endphp

                    <div class="row g-4">
                        @foreach ($statusData as $index => $item)
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">
                                            <i class="bi bi-{{ $item['icon'] }} me-2"></i>{{ $item['title'] }}
                                        </h6>
                                        <a href="{{ $item['link'] }}" class="btn btn-outline-light btn-sm">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <h2 class="text-primary fw-bold mb-1">{{ $item['total'] }}</h2>
                                            <small class="text-muted">Total {{ $item['title'] }}</small>
                                        </div>
                                        
                                        <div style="height: 200px; margin-bottom: 20px;">
                                            <canvas id="chart{{ $index }}"></canvas>
                                        </div>
                                        
                                        <div class="row g-2">
                                            @foreach ($item['data'] as $status)
                                                <div class="col-4 text-center">
                                                    <div class="p-2 rounded border">
                                                        <div class="fw-bold" style="color: {{ $status['color'] }};">{{ $status['count'] }}</div>
                                                        <small class="text-muted">{{ $status['label'] }}</small>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($statusData as $index => $item)
                const ctx{{ $index }} = document.getElementById('chart{{ $index }}').getContext('2d');
                new Chart(ctx{{ $index }}, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode(array_column($item['data'], 'label')) !!},
                        datasets: [{
                            data: {!! json_encode(array_column($item['data'], 'count')) !!},
                            backgroundColor: {!! json_encode(array_column($item['data'], 'color')) !!},
                            borderWidth: 2,
                            borderColor: '#fff',
                            cutout: '60%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            @endforeach
        });
    </script>
</body>
</html>