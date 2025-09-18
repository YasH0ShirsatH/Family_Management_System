<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-header {
            background: #0d6efd;
            color: #fff;
            padding: 32px 0 24px 0;
            border-radius: 18px;
            margin-bottom: 32px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
        }
        .sidebar-body .btn {
            font-size: 1rem !important;
        }

        .dashboard-header h2 {
            font-weight: 700;
            
            margin-bottom: 0;
        }

        .quick-access .btn {
            font-size: 1.1rem;
            padding: 1.5rem 1rem;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.15s;
        }

        .quick-access .btn:hover {
            transform: translateY(-4px) scale(1.03);
        }

        .stats-row {
            margin-bottom: 32px;
        }

        .stat-card {
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            background: #fff;
            text-align: center;
            padding: 2rem 1rem;
            margin-bottom: 0;
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 1.05rem;
            color: #6c757d;
        }

        .charts-section {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            margin-bottom: 32px;
        }

        .charts-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #0d6efd;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 991px) {
            .charts-section {
                padding: 1rem;
            }

            .dashboard-header {
                padding: 24px 0 16px 0;
            }
        }

        @media (max-width: 767px) {
            .quick-access .btn {
                font-size: 1rem;
                padding: 1rem 0.5rem;
            }

            .stat-card {
                padding: 1.2rem 0.5rem;
            }

            .charts-section {
                padding: 0.5rem;
            }

            .abc {
                margin-top: 20px;
                padding: 20px 15px 20px 15px;
            }
        }
    </style>
</head>

<body>
    <div id="mainContent">

        @include('partials.navbar2', ['shouldShowDiv' => true])

        <div class="container py-4">
            <div class="dashboard-header text-center abc">
                <h2><i class="bi bi-speedometer2 me-2"></i>Family Management Dashboard</h2>
                <p class="lead mb-0">Welcome! Here’s a quick overview and access to key features.</p>
            </div>

            @if (session('error'))
                <div class="alert alert-success alert-dismissible fade show rounded-pill">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Quick Access Buttons -->
            <div class="row quick-access g-4 mb-4">
                <div class="col-md-4">
                    <a href="{{ route('admin.index') }}" class="btn btn-primary w-100 shadow">
                        <i class="bi bi-people fs-2 d-block mb-2"></i>
                        <span class="fw-bold">Manage Families</span>
                        <div class="small">View and manage all family records</div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/headview" class="btn btn-success w-100 shadow">
                        <i class="bi bi-plus-circle fs-2 d-block mb-2"></i>
                        <span class="fw-bold">Create Head</span>
                        <div class="small">Create a new Family Tree</div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/state-city" class="btn btn-warning w-100 shadow">
                        <i class="bi bi-buildings fs-2 d-block mb-2"></i>
                        <span class="fw-bold">Manage States</span>
                        <div class="small">View and Manage States and Cities</div>
                    </a>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="row stats-row g-4 mb-4">
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon text-primary"><i class="bi bi-people"></i></div>
                        <div class="stat-value text-primary">{{ $headcount }}</div>
                        <div class="stat-label">Total Families</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon text-success"><i class="bi bi-person-check"></i></div>
                        <div class="stat-value text-success">{{ $membercount }}</div>
                        <div class="stat-label">Active Members</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon text-warning"><i class="bi bi-geo-alt"></i></div>
                        <div class="stat-value text-warning">{{ $statecount }}</div>
                        <div class="stat-label">Total States</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon text-danger"><i class="bi bi-geo-fill"></i></div>
                        <div class="stat-value text-danger">{{ $citycount }}</div>
                        <div class="stat-label">Total Cities</div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-section mb-4">
                <div class="charts-title"><i class="bi bi-bar-chart-line me-2"></i>Statistics Overview</div>
                <div class="row g-4">
                    <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                        <h5 class="text-danger mb-3 text-center">
                            Age Distribution of Family Heads
                        </h5>
                        <canvas style="width:100%;max-height:350px;" id="myChart"></canvas>
                    </div>
                    <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                        <h5 class="text-success mb-3 text-center">
                            Members per Family 
                        </h5>
                        <canvas style="width:100%;max-height:350px;" id="myChart3"></canvas>
                    </div>

                </div>
                
            </div>
            <!-- ...existing code... -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            @php
                $topStateCounts = collect($topStates)->pluck('count')
            @endphp
        </div>
        <script>
            const ctx = document.getElementById('myChart');
           
            const ctx3 = document.getElementById('myChart3');
            

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($nameData),
                    datasets: [{
                        label: 'Age',
                        data: @json($ageData),
                        borderWidth: 1,
                        backgroundColor: '#dc3545'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: false,
                            min: 20
                        }
                    }
                }
            });

           

            new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: @json($membersPerFamilyLabels),
                    datasets: [{
                        label: 'Members',
                        data: @json($membersPerFamilyData),
                        borderWidth: 1,
                        backgroundColor: '#198754'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                stepSize: 1
                            }
                        }
                    }
                }
            });

          
        </script>
</body>

</html>