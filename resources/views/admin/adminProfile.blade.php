<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    /* General Body Styling */
    body {
        background-color: #f0f2f5;
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }

    /* Card and Container Styling */
    .card {
        border-radius: 1rem;
        border: none;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .container.py-4 {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }

    /* Profile Photo Styling */
    .profile-photo {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* List Group Styling */
    .list-group-item {
        border-color: #e9ecef;
    }

    /* Information Section Styling */
    .info-item {
        padding: 0.75rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #495057;
    }

    .info-value {
        color: #6c757d;
    }

    /* Status Cards Styling */
    .status-card-header {
        font-weight: 600;
    }

    /* Circular Progress Bar Styling (Same as before) */
    .circular-progress-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 1rem;
        text-align: center;
    }

    .circular-progress {
        position: relative;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: conic-gradient(#007bff 0deg, #e0e0e0 0deg);
        transition: background 0.5s ease-in-out;
    }

    .circular-progress::before {
        content: "";
        position: absolute;
        width: 84%;
        height: 84%;
        background-color: #fff;
        border-radius: 50%;
    }

    .progress-value {
        position: relative;
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
    }

    .progress-color-success {
        background: conic-gradient(#28a745 var(--progress-angle), #e0e0e0 var(--progress-angle));
    }

    .progress-color-warning {
        background: conic-gradient(#ffc107 var(--progress-angle), #e0e0e0 var(--progress-angle));
    }

    .progress-color-danger {
        background: conic-gradient(#dc3545 var(--progress-angle), #e0e0e0 var(--progress-angle));
    }

    .progress-color-info {
        background: conic-gradient(#17a2b8 var(--progress-angle), #e0e0e0 var(--progress-angle));
    }

    .progress-color-primary {
        background: conic-gradient(#007bff var(--progress-angle), #e0e0e0 var(--progress-angle));
    }

    .details-list {
        list-style: none;
        padding-left: 0;
        font-size: 0.9rem;
        text-align: left;
        width: 100%;
    }

    .details-list li {
        margin-bottom: 0.25rem;
    }
    </style>
</head>

<body>
    @include('partials.navbar2', ['shouldShowDiv' => true])

    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-4">
                {{-- Profile Card --}}
                <div class="card mb-4 shadow-sm bg-light border-0 rounded-4">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center p-4">

                            <div class="mt-2">
                                <h4 class="fw-bold mb-1 text-dark">
                                    {{ $user->first_name . " " . $user->last_name }}
                                </h4>

                                <p class="text-muted mb-3 fs-6">Family Management System</p>

                                <hr class="w-50 mx-auto mb-3 mt-2 opacity-50">

                                <span class="badge bg-primary text-uppercase fs-6 px-4 py-2 rounded-pill shadow-sm">
                                    Admin
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Download Data Card --}}
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                            <h6 class="mb-0 text-primary">
                                <i class="bi bi-database-gear me-2"></i>Get Data From Database:
                            </h6>
                            <span>&nbsp;</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 text-warning">
                                <i class="bi bi-person me-2"></i>Heads
                            </h6>
                            <div>
                                <a href="{{ route('download_all') }}"
                                    class="btn btn-sm btn-outline-secondary me-2 rounded-pill">PDF</a>
                                <a href="{{ route('download_excel_all') }}"
                                    class="btn btn-sm btn-outline-secondary rounded-pill">Excel</a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 text-info">
                                <i class="bi bi-people me-2"></i>Members
                            </h6>
                            <div>
                                <a href="{{ route('download_all_members') }}"
                                    class="btn btn-sm btn-outline-secondary me-2 rounded-pill">PDF</a>
                                <a href="{{ route('download_excel_all_members') }}"
                                    class="btn btn-sm btn-outline-secondary rounded-pill">Excel</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-8">
                {{-- Profile Information Card --}}
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <h5 class="fw-bold mb-0">Profile Information</h5>
                        </div>
                        <div class="row g-2">
                            <div class="col-sm-3 info-label">First Name</div>
                            <div class="col-sm-9 info-value">{{ $user->first_name }}</div>
                            <div class="col-12">
                                <hr class="my-2">
                            </div>

                            <div class="col-sm-3 info-label">Last Name</div>
                            <div class="col-sm-9 info-value">{{ $user->last_name }}</div>
                            <div class="col-12">
                                <hr class="my-2">
                            </div>

                            <div class="col-sm-3 info-label">Email</div>
                            <div class="col-sm-9 info-value">{{ $user->email }}</div>
                            <div class="col-12">
                                <hr class="my-2">
                            </div>

                            <div class="col-sm-3 info-label">Mobile</div>
                            <div class="col-sm-9 info-value">{{ $user->mobile }}</div>
                            <div class="col-12">
                                <hr class="my-2">
                            </div>

                            <div class="col-sm-3 info-label">Address</div>
                            <div class="col-sm-9 info-value">{{ $user->address }}</div>
                        </div>
                    </div>
                </div>

                {{-- Status Cards --}}
                <div class="row g-4">
                    @php
                    $statusData = [
                    [
                    'title' => 'Heads Status',
                    'icon' => 'person-fill',
                    'total' => $totalhead,
                    'active_count' => $headcount,
                    'inactive_count' => $inactiveheadcount,
                    'deleted_count' => $deletedheadcount,
                    'link' => '/admin',
                    ],
                    [
                    'title' => 'Members Status',
                    'icon' => 'people-fill',
                    'total' => $totalmembercount,
                    'active_count' => $membercount,
                    'inactive_count' => $inactivemembercount,
                    'deleted_count' => $deletedmembercount,
                    'link' => '#',
                    ],
                    [
                    'title' => 'City Status',
                    'icon' => 'buildings-fill',
                    'total' => $totalcitycount,
                    'active_count' => $citycount,
                    'inactive_count' => $inactivecitycount,
                    'deleted_count' => $deletedcitycount,
                    'link' => '/admin/state-city/city',
                    ],
                    [
                    'title' => 'States Status',
                    'icon' => 'geo-fill',
                    'total' => $totalstatecount,
                    'active_count' => $statecount,
                    'inactive_count' => $inactivestatecount,
                    'deleted_count' => $deletedstatecount,
                    'link' => '/admin/state-city/states',
                    ],
                    ];
                    @endphp

                    @foreach ($statusData as $item)
                    <div class="col-sm-6">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column align-items-center text-center">
                                <h6 class="status-card-header d-flex align-items-center mb-3 text-info fw-bold">
                                    <i class="bi bi-{{ $item['icon'] }} me-2"></i>
                                    <a href="{{ $item['link'] }}" class="text-decoration-none">{{ $item['title'] }}</a>
                                </h6>

                                {{-- Single Circular Progress Bar --}}
                                <div class="circular-progress-wrapper mb-3">
                                    @php
                                    $activePercentage = $item['total'] > 0 ? round(($item['active_count'] * 100 /
                                    $item['total'])) : 0;
                                    @endphp
                                    <div class="circular-progress" data-progress="{{ $activePercentage }}"
                                        data-color="success">
                                        <span class="progress-value">{{ $activePercentage }}%</span>
                                    </div>
                                </div>

                                {{-- Details List --}}
                                <ul class="details-list">
                                    <li><span class="fw-bold">Total:</span> {{ $item['total'] }}</li>
                                    <li><span class="fw-bold text-success">Active:</span> {{ $item['active_count'] }}
                                    </li>
                                    <li><span class="fw-bold text-warning">Inactive:</span>
                                        {{ $item['inactive_count'] }}</li>
                                    <li><span class="fw-bold text-danger">Deleted:</span> {{ $item['deleted_count'] }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const circularProgressBars = document.querySelectorAll('.circular-progress');

        circularProgressBars.forEach(bar => {
            const progress = bar.dataset.progress;
            const color = bar.dataset.color;
            const angle = progress * 3.6;
            const valueSpan = bar.querySelector('.progress-value');

            bar.style.setProperty('--progress-angle', `${angle}deg`);
            bar.classList.add(`progress-color-${color}`);
            valueSpan.textContent = `${progress}%`;
        });
    });
    </script>
</body>

</html>