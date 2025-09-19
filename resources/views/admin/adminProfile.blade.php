<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .active-class {
            background-color: #ffc107;
            color: black;
            transform: translateX(5px);
        }
    </style>
</head>

<body class="bg-light">
    <div id="mainContent">
        @include('partials.navbar2', ['shouldShowDiv' => true])

        <div class="container py-5" style="margin-top: 20px;">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-pill">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-primary text-white text-center">
                            <h5 class="mb-0"><i class="bi bi-person-gear me-2"></i>Administrator</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-shield-check text-primary" style="font-size: 2rem;"></i>
                                </div>
                                <h4 class="fw-bold text-primary mb-1">{{ $user->first_name . " " . $user->last_name }}
                                </h4>
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
                                    <a href="{{ route('download_all') }}"
                                        class="btn btn-sm btn-outline-danger me-1">PDF</a>
                                    <a href="{{ route('download_excel_all') }}"
                                        class="btn btn-sm btn-outline-success">Excel</a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div><i class="bi bi-people text-info me-2"></i>Members</div>
                                <div>
                                    <a href="{{ route('download_all_members') }}"
                                        class="btn btn-sm btn-outline-danger me-1">PDF</a>
                                    <a href="{{ route('download_excel_all_members') }}"
                                        class="btn btn-sm btn-outline-success">Excel</a>
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
                                    <div class="small text-muted"><span class="text-success">( #LogId-{{ $log->id }}
                                            )</span> &nbsp;{{ Str::before($admin1->email, '@') }}</div>
                                    <div class="fw-medium">{{ $log->logs }}</div>
                                </div>
                                @empty
                                <div class="list-group-item text-center text-muted">No logs found</div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 mb-4 mt-4">
                        <div class="card-header bg-primary text-white rounded-top-1 py-2">
                            <h6 class="mb-0  d-flex align-items-center">
                                <i class="bi bi-person-check-fill me-2"></i>Activate / Restore Family Head
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('activate.head') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="active-member" class="form-label fw-semibold">Select Head to
                                        Activate (All Members will be activated too)</label>
                                    <select role="button" name="active_member" id="active-member"
                                        class="form-select fw-6 form-select-md rounded-pill">
                                        <option value="" selected disabled>Choose a family head to activate...</option>
                                        @foreach ($heads as $head)
                                        <option value="{{ $head->id }}">{{ $head->name }} {{ $head->surname }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="d-grid mt-4">
                                    <button type="submit"
                                        class="btn btn-outline-primary btn-sm rounded-pill fw-semibold py-2">
                                        <i class="bi bi-shield-check me-2"></i>Activate
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm rounded-4 mb-4 mt-4">
                        <div class="card-header bg-danger text-white rounded-top-1 py-2">
                            <h6 class="mb-0  d-flex align-items-center">
                                <i class="bi bi-person-check-fill me-2"></i>Deactivate Family Head
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('deactivateHead.head') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="deactive-member" class="form-label fw-semibold">Select Head to
                                        Dectivate (All Members will be deactivated too)</label>
                                    <select role="button" name="deactive_member" id="deactive-member"
                                        class="form-select fw-6 form-select-md rounded-pill">
                                        <option value="" selected disabled>Choose a family head to deactivate...
                                        </option>
                                        @foreach ($heads2 as $head)
                                        <option value="{{ $head->id }}">{{ $head->name }} {{ $head->surname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-grid mt-4">
                                    <button type="submit"
                                        class="btn btn-outline-danger btn-sm rounded-pill fw-semibold py-2">
                                        <i class="bi bi-trash me-2"></i>Dectivate
                                    </button>
                                </div>
                            </form>
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
                    [
                    'title' => 'Family Heads',
                    'icon' => 'person-fill',
                    'total' => $totalhead,
                    'data' => [
                    ['label' => 'Active', 'count' => $headcount, 'color' => '#198754'],
                    ['label' => 'Inactive', 'count' => $inactiveheadcount, 'color' => '#ffc107'],
                    ['label' => 'Deleted', 'count' => $deletedheadcount, 'color' => '#dc3545'],
                    ],
                    'link' => '/admin'
                    ],
                    [
                    'title' => 'Family Members',
                    'icon' => 'people-fill',
                    'total' => $totalmembercount,
                    'data' => [
                    ['label' => 'Active', 'count' => $membercount, 'color' => '#198754'],
                    ['label' => 'Inactive', 'count' => $inactivemembercount, 'color' => '#ffc107'],
                    ['label' => 'Deleted', 'count' => $deletedmembercount, 'color' => '#dc3545'],
                    ],
                    'link' => '/admin'
                    ],
                    [
                    'title' => 'Cities',
                    'icon' => 'buildings-fill',
                    'total' => $totalcitycount,
                    'data' => [
                    ['label' => 'Active', 'count' => $citycount, 'color' => '#198754'],
                    ['label' => 'Inactive', 'count' => $inactivecitycount, 'color' => '#ffc107'],
                    ['label' => 'Deleted', 'count' => $deletedcitycount, 'color' => '#dc3545'],
                    ],
                    'link' => '/admin/state-city/city'
                    ],
                    [
                    'title' => 'States',
                    'icon' => 'geo-fill',
                    'total' => $totalstatecount,
                    'data' => [
                    ['label' => 'Active', 'count' => $statecount, 'color' => '#198754'],
                    ['label' => 'Inactive', 'count' => $inactivestatecount, 'color' => '#ffc107'],
                    ['label' => 'Deleted', 'count' => $deletedstatecount, 'color' => '#dc3545'],
                    ],
                    'link' => '/admin/state-city/states'
                    ],
                    ];
                    @endphp

                    <div class="row g-4">
                        @foreach ($statusData as $index => $item)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div
                                    class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
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
                                        <small class="text-muted">Total {{ $item['title'] }} Registered In
                                            Database</small>
                                    </div>

                                    <div style="height: 200px; margin-bottom: 20px;">
                                        <canvas id="chart{{ $index }}"></canvas>
                                    </div>

                                    <div class="row g-2">
                                        @foreach ($item['data'] as $status)
                                        <div class="col-4 text-center">
                                            <div class="p-2 rounded border">
                                                <div class="fw-bold" style="color: {{ $status['color'] }};">
                                                    {{ $status['count'] }}
                                                </div>
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
        // Family Heads Chart
        const canvas0 = document.getElementById('chart0');
        if (canvas0) {
            const ctx0 = canvas0.getContext('2d');
            new Chart(ctx0, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_column($statusData[0]['data'], 'label')) !!},
                    datasets: [{
                        data: {!! json_encode(array_column($statusData[0]['data'], 'count')) !!},
                        backgroundColor: {!! json_encode(array_column($statusData[0]['data'], 'color')) !!},
                        borderWidth: 2,
                        borderColor: '#fff',
                        cutout: '60%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }

        // Family Members Chart
        const canvas1 = document.getElementById('chart1');
        if (canvas1) {
            const ctx1 = canvas1.getContext('2d');
            new Chart(ctx1, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_column($statusData[1]['data'], 'label')) !!},
                    datasets: [{
                        data: {!! json_encode(array_column($statusData[1]['data'], 'count')) !!},
                        backgroundColor: {!! json_encode(array_column($statusData[1]['data'], 'color')) !!},
                        borderWidth: 2,
                        borderColor: '#fff',
                        cutout: '60%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }

        //! Cities Chart
        const canvas2 = document.getElementById('chart2');
        if (canvas2) {
            const ctx2 = canvas2.getContext('2d');
            new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_column($statusData[2]['data'], 'label')) !!},
                    datasets: [{
                        data: {!! json_encode(array_column($statusData[2]['data'], 'count')) !!},
                        backgroundColor: {!! json_encode(array_column($statusData[2]['data'], 'color')) !!},
                        borderWidth: 2,
                        borderColor: '#fff',
                        cutout: '60%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }

        // States Chart
        const canvas3 = document.getElementById('chart3');
        if (canvas3) {
            const ctx3 = canvas3.getContext('2d');
            new Chart(ctx3, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(array_column($statusData[3]['data'], 'label')) !!},
                    datasets: [{
                        data: {!! json_encode(array_column($statusData[3]['data'], 'count')) !!},
                        backgroundColor: {!! json_encode(array_column($statusData[3]['data'], 'color')) !!},
                        borderWidth: 2,
                        borderColor: '#fff',
                        cutout: '60%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }
    });
    </script>

</body>

</html>
