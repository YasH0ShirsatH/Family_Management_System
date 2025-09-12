<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #e2e8f0;
        }
    </style>
</head>
<body>
    @include('partials.navbar2',['shouldShowDiv' => true])

    <div class="container py-4">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if(empty($member->photo_path))
                                <img src="{{ asset('uploads/images/noimage.png') }}" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;" alt="No Image">
                            @else
                                <img src="{{ asset('uploads/images/' . $member->photo_path) }}" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;" alt="Member Photo">
                            @endif
                            <div class="mt-3">
                                <h4 class="fw-bold">{{ $user->first_name." ".$user->last_name }}</h4>
                                <p class="text-secondary mb-1">Family Management System</p>
                                <span class="badge bg-primary text-uppercase fs-6">Admin</span>
                                <a href="#" class="btn btn-outline-primary mt-3">Message</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 text-primary"><i class="bi bi-globe me-2"></i>Website</h6>
                            <span class="text-secondary">Not Provided</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 text-dark"><i class="bi bi-github me-2"></i>Github</h6>
                            <span class="text-secondary">Not Provided</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 text-info"><i class="bi bi-twitter me-2"></i>Twitter</h6>
                            <span class="text-secondary">Not Provided</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 text-danger"><i class="bi bi-instagram me-2"></i>Instagram</h6>
                            <span class="text-secondary">Not Provided</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 text-primary"><i class="bi bi-facebook me-2"></i>Facebook</h6>
                            <span class="text-secondary">Not Provided</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <h5 class="fw-bold mb-0">Profile Information</h5>
                        </div>
                        <div class="row g-2">
                            <div class="col-sm-3 fw-bold">First Name</div>
                            <div class="col-sm-9 text-secondary">{{ $user->first_name }}</div>
                            <div class="col-12"><hr class="my-2"></div>

                            <div class="col-sm-3 fw-bold">Last Name</div>
                            <div class="col-sm-9 text-secondary">{{ $user->last_name }}</div>
                            <div class="col-12"><hr class="my-2"></div>

                            <div class="col-sm-3 fw-bold">Email</div>
                            <div class="col-sm-9 text-secondary">{{ $user->email }}</div>
                            <div class="col-12"><hr class="my-2"></div>

                            <div class="col-sm-3 fw-bold">Mobile</div>
                            <div class="col-sm-9 text-secondary">{{ $user->mobile  }}</div>
                            <div class="col-12"><hr class="my-2"></div>

                            <div class="col-sm-3 fw-bold">Address</div>
                            <div class="col-sm-9 text-secondary">{{ $user->address }}</div>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    @php
                        $statusData = [
                            ['title' => 'Head Status', 'icon' => 'person-fill', 'total' => $totalhead, 'data' => [
                                ['label' => 'Total Heads', 'count' => $totalhead],
                                ['label' => 'Active Heads', 'count' => $headcount],
                                ['label' => 'Inactive Heads', 'count' => $inactiveheadcount],
                                ['label' => 'Deleted Heads', 'count' => $deletedheadcount],
                            ]],
                            ['title' => 'Members Status', 'icon' => 'people-fill', 'total' => $totalmembercount, 'data' => [
                                ['label' => 'Total Members', 'count' => $totalmembercount],
                                ['label' => 'Active Members', 'count' => $membercount],
                                ['label' => 'Inactive Members', 'count' => $inactivemembercount],
                                ['label' => 'Deleted Members', 'count' => $deletedmembercount],
                            ]],
                            ['title' => 'City Status', 'icon' => 'buildings-fill', 'total' => $totalcitycount, 'data' => [
                                ['label' => 'Total Cities', 'count' => $totalcitycount],
                                ['label' => 'Active Cities', 'count' => $citycount],
                                ['label' => 'Inactive Cities', 'count' => $inactivecitycount],
                                ['label' => 'Deleted Cities', 'count' => $deletedcitycount],
                            ]],
                            ['title' => 'States Status', 'icon' => 'geo-fill', 'total' => $totalstatecount, 'data' => [
                                ['label' => 'Total States', 'count' => $totalstatecount],
                                ['label' => 'Active States', 'count' => $statecount],
                                ['label' => 'Inactive States', 'count' => $inactivestatecount],
                                ['label' => 'Deleted States', 'count' => $deletedstatecount],
                            ]],
                        ];
                    @endphp

                    @foreach ($statusData as $item)
                        <div class="col-sm-6">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3 text-info fw-bold">
                                        <i class="bi bi-{{ $item['icon'] }} me-2"></i>{{ $item['title'] }}
                                    </h6>
                                    @foreach ($item['data'] as $status)
                                        <small>{{ $status['label'] }} : ({{ $status['count'] }})</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-primary" role="progressbar" 
                                                style="width: {{ $item['total'] > 0 ? ($status['count'] * 100 / $item['total']) : 0 }}%"
                                                aria-valuenow="{{ $status['count'] }}" aria-valuemin="0" aria-valuemax="{{ $item['total'] }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>