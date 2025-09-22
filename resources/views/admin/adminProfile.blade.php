<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    .validation-error label {
        color: #dc3545;
        font-size: 14px;
        margin-top: 4px;
        font-weight: 500;
        padding-left: 2px;
        min-height: 18px;
        transition: all 0.2s;
    }

    input.error,
    select.error,
    textarea.error {
        border-color: #dc3545;
        background-color: #fff0f0;
    }
    </style>
</head>

<body class="bg-light">
    <div id="mainContent">
        @include('partials.navbar2', ['shouldShowDiv' => true])

        <div class="container py-5" style="margin-top: 20px;">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-pill">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-pill">
                <strong>{{ session('error') }}</strong>
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
                                @if($user->superuser == '0')
                                    <i class="bi bi-shield-check text-secondary" style="font-size: 2rem;"></i>
                                @else
                                    <i class="bi bi-person-gear text-primary" style="font-size: 2rem;"></i>
                                @endif
                                </div>

                                @if($user->superuser == '1')
                                <h4 class="fw-bold text-primary mb-1">{{ $user->first_name . ' ' . $user->last_name }}
                                                                </h4>
                                    <p class="text-primary mb-2">Super Administrator</p>
                                    <span class="badge bg-primary px-3 py-2">SUPER ADMIN ACCESS</span>
                                @else
                                <h4 class="fw-bold text-secondary mb-1">{{ $user->first_name . ' ' . $user->last_name }}
                                                                </h4>
                                    <p class="text-muted mb-2">System Administrator</p>
                                    <span class="badge bg-secondary px-3 py-2">ADMIN ACCESS</span>
                                @endif
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
                     @if($admin1->superuser == '1')
                        <div class="card-body p-3 border-bottom">
                            <select id="emailFilter" class="form-select form-select-sm">
                                <option value="">All Emails</option>
                                    @foreach($logs->unique('user.email') as $log)
                                        <option value="{{ $log->user->email }}">{{ $log->user->email }}</option>
                                    @endforeach
                            </select>
                        </div>
                    @endif
                        <div class="card-body p-0" style="max-height: 300px; overflow-y: auto;">
                            <div class="list-group list-group-flush">
                                @if($admin1->superuser == '1')
                                @forelse($logs as $log)
                                <div class="list-group-item border-0 py-2 log-item" data-email="{{ $log->user->email }}">
                                    <div class="small text-muted"><span class="text-success">(
                                            #LogId-{{ $log->id }}
                                            )</span> &nbsp;{{ Str::before($log->user->email, '@') }}</div>
                                    <div class="fw-medium">{{ $log->logs }}</div>
                                </div>

                                @empty
                                <div class="list-group-item text-center text-muted">No logs found</div>
                                @endforelse
                                @else
                                @forelse($logs as $log)
                                      <div class="list-group-item border-0 py-2 log-item" data-email="{{ $admin1->email }}">
                                         <div class="small text-muted"><span class="text-success">(
                                               #LogId-{{ $log->id }}
                                                                            )</span> &nbsp;{{ Str::before($admin1->email, '@') }}</div>
                                                                    <div class="fw-medium">{{ $log->logs }}</div>
                                                                </div>

                                                                @empty
                                                                <div class="list-group-item text-center text-muted">No logs found</div>
                                                      @endforelse
                                @endif
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
                            <form id="formSubmit" method="post">
                                @csrf
                                <div class="mb-3 form-group">
                                    <label for="active-member" class="form-label fw-semibold">Select Head to
                                        Activate</label>
                                    <select role="button" name="active_member" id="active-member"
                                        class="form-select fw-6 form-select-md rounded-pill">
                                        <option value="" selected disabled>Choose a family head to activate...
                                        </option>
                                        @foreach ($heads as $head)
                                        <option value="{{ $head->id }}">{{ $head->name }}
                                            {{ $head->surname }}</option>
                                        @endforeach
                                    </select>
                                    <div class="validation-error"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Activation Mode</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="activation_mode"
                                            id="activateAll" value="all" checked>
                                        <label class="form-check-label" for="activateAll">
                                            Activate Head and All Members
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="activation_mode"
                                            id="activateSelected" value="selected">
                                        <label class="form-check-label" for="activateSelected">
                                            Activate Head and Select Specific Members
                                        </label>
                                    </div>
                                </div>

                                <div id="members-section" class="mb-3" style="display: none;">
                                    <label class="form-label fw-semibold">Select Members to Activate</label>
                                    <div id="members-container" class="border rounded p-3 bg-light">
                                    </div>
                                    <div class="validation-error" id="members-validation"></div>
                                </div>

                                <div id="no-members-message" class="alert alert-info" style="display: none;">
                                    <i class="bi bi-info-circle me-2"></i>This head has no inactive members to activate.
                                </div>

                                <div id="loading-message" class="text-center" style="display: none;">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mt-2 text-muted">Loading members...</p>
                                </div>

                                <div class="d-grid mt-4">
                                    <button type="submit" id="activate-btn"
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
                            <form id="formSubmit2" action="{{ route('deactivateHead.head') }}" method="post">
                                @csrf
                                <div class="mb-3 form-group">
                                    <label for="deactive-member" class="form-label fw-semibold">Select Head to
                                        Dectivate (All Members will be deactivated too)</label>
                                    <select role="button" name="deactive_member" id="deactive-member"
                                        class="form-select fw-6 form-select-md rounded-pill">
                                        <option value="" selected disabled>Choose a family head to deactivate...
                                        </option>
                                        @foreach ($heads2 as $head)
                                        <option value="{{ $head->id }}">{{ $head->name }}
                                            {{ $head->surname }}</option>
                                        @endforeach
                                    </select>
                                    <div class="validation-error"></div>
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
                 @if($user->superuser == '1')
                  <div class="col-lg-12">
                      <div class="card border-0 shadow-sm mb-4">
                          <div class="card-header bg-danger text-white">
                              <h5 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i>Add User</h5>
                          </div>
                          <div class="card-body p-4">
                              <div class="row g-4 align-items-center">
                                  <div class="col-md-auto text-center">
                                      <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                          <i class="bi bi-person-plus text-dander" style="font-size: 2.5rem;"></i>
                                      </div>
                                  </div>
                                  <div class="col-md">
                                      <h6 class="fw-bold text-danger">Create a New Admin Profile</h6>
                                      <p class="text-muted mb-0 small">
                                          This will take you to the registration form where you can enter the new admins details and set up their account credentials.
                                      </p>
                                  </div>
                                  <div class="col-md-auto ms-md-auto">
                                      <a href="/register" class="btn btn-danger rounded-pill px-4 py-2 fw-semibold d-flex align-items-center">
                                          Register New Admin<i class="bi bi-arrow-right ms-2"></i>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              @endif

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
                    'link' => '/admin',
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
                    'link' => '/allmembers',
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
                    'link' => '/admin/state-city/city',
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
                    'link' => '/admin/state-city/states',
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
                        legend: {
                            display: false
                        }
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
                        legend: {
                            display: false
                        }
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
                        legend: {
                            display: false
                        }
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
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
    jQuery(document).ready(function() {


        $('#formSubmit').validate({
            rules: {
                active_member: {
                    required: true
                },
                deactive_member: {
                    required: true
                },

            },
            messages: {
                active_member: {
                    required: "Please select head"
                },
                deactive_member: {
                    required: "Please select head"
                },
            },
            errorPlacement: function(error, element) {
                var $container = element.closest('.form-group').find('.validation-error');
                if ($container.length) {
                    $container.html(error);
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element) {
                $(element).addClass('error');
            },
            unhighlight: function(element) {
                $(element).removeClass('error');
                $(element).closest('.form-group').find('.validation-error').empty();
            }
        });


        $('#formSubmit2').validate({
            rules: {

                deactive_member: {
                    required: true
                },

            },
            messages: {

                deactive_member: {
                    required: "Please select head"
                },
            },
            errorPlacement: function(error, element) {
                var $container = element.closest('.form-group').find('.validation-error');
                if ($container.length) {
                    $container.html(error);
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element) {
                $(element).addClass('error');
            },
            unhighlight: function(element) {
                $(element).removeClass('error');
                $(element).closest('.form-group').find('.validation-error').empty();
            }
        });

        $('input[name="activation_mode"]').on('change', function() {
            var mode = $(this).val();
            if (mode === 'selected') {
                var headId = $('#active-member').val();
                if (headId) {
                    loadMembersForHead(headId);
                }
            } else {
                $('#members-section').hide();
                $('#no-members-message').hide();
                $('#members-container').empty();
                $('#members-validation').empty();
            }
        });

        $('#active-member').on('change', function() {
            var headId = $(this).val();
            var selectedMode = $('input[name="activation_mode"]:checked').val();

            $('#members-section').hide();
            $('#no-members-message').hide();
            $('#members-container').empty();
            $('#members-validation').empty();

            if (headId && selectedMode === 'selected') {
                loadMembersForHead(headId);
            }
        });

        function loadMembersForHead(headId) {
            $('#loading-message').show();

            $.ajax({
                url: '/dashboard/admin-profile/get-inactive-members/' + headId,
                type: 'GET',
                success: function(response) {
                    $('#loading-message').hide();

                    if (response.members && response.members.length > 0) {
                        var membersHtml = '<div class="row">';
                        response.members.forEach(function(member) {
                            membersHtml += '<div class="col-md-6 mb-2">';
                            membersHtml += '<div class="form-check">';
                            membersHtml +=
                                '<input class="form-check-input member-checkbox" type="checkbox" value="' +
                                member.id + '" id="member_' + member.id + '">';
                                membersHtml += '<label class="form-check-label" for="member_' +
                                member.id + '">';

                            membersHtml += '<strong>' + member.name + '</strong>';
                            if (member.birthdate) {
                                var age = new Date().getFullYear() - new Date(member
                                    .birthdate).getFullYear();
                                membersHtml += ' <small class="text-muted">(' + age +
                                    ' years old)</small>';
                            }
                            if (member.education) {
                                membersHtml += '<br><small class="text-muted">' + member
                                    .education + '</small>';
                            }
                           let statusText = '';

                           if (member.status == '0') {
                                text = 'text-warning '
                               statusText = 'Inactive';
                           } else if (member.status == '9') {
                                text = 'text-danger'
                               statusText = 'Deleted';
                           }

                           membersHtml += '<br><small class=' + text + '>( ' + statusText + ' )</small>';

                            membersHtml += '</label>';
                            membersHtml += '</div>';
                            membersHtml += '</div>';
                        });
                        membersHtml += '</div>';

                        $('#members-container').html(membersHtml);
                        $('#members-section').show();

                        validateMemberSelection();
                    } else {
                        $('#no-members-message').show();
                    }
                },
                error: function(xhr, status, error) {
                    $('#loading-message').hide();
                    console.error('Error fetching members:', error);
                    alert('Error loading members. Please try again.');
                }
            });
        }

        $(document).on('change', '.member-checkbox', function() {
            validateMemberSelection();
        });

        function validateMemberSelection() {
            var selectedMembers = $('.member-checkbox:checked').length;
            var $validationDiv = $('#members-validation');

            if (selectedMembers === 0) {
                $validationDiv.html(
                    '<label class="text-danger">Please select at least one member to activate</label>');
            } else {
                $validationDiv.empty();
            }
        }

        $('#formSubmit').on('submit', function(e) {
            e.preventDefault();

            var headId = $('#active-member').val();
            var activationMode = $('input[name="activation_mode"]:checked').val();
            var selectedMembers = [];

            if (activationMode === 'selected') {
                $('.member-checkbox:checked').each(function() {
                    selectedMembers.push($(this).val());
                });

                if (selectedMembers.length === 0) {
                    e.preventDefault();
                    $('#members-validation').html(
                        '<label class="text-danger">Please select at least one member to activate</label>'
                    );
                    return false;
                }
            }

            var $submitBtn = $('#activate-btn');
            var originalText = $submitBtn.html();
            $submitBtn.prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Activating...'
            );

            var formData = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                head_id: headId,
                activation_mode: activationMode
            };

            if (activationMode === 'selected') {
                formData.member_ids = selectedMembers;
            }

            $.ajax({
                url: '/dashboard/admin-profile/activate-selected',
                type: 'POST',
                data: formData,
                success: function(response) {
                    window.location.href = '/dashboard/admin-profile?success=' +
                        encodeURIComponent(response.message);
                },
                error: function(xhr, status, error) {
                    console.error('Error activating members:', error);
                    var errorMessage = 'Error activating members. Please try again.';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    window.location.href = '/dashboard/admin-profile?error=' +
                        encodeURIComponent(errorMessage);
                },
                complete: function() {
                    $submitBtn.prop('disabled', false).html(originalText);
                }
            });
        });
    });

    // Email filter functionality
    document.getElementById('emailFilter').addEventListener('change', function() {
        const selectedEmail = this.value;
        const logItems = document.querySelectorAll('.log-item');

        logItems.forEach(item => {
            if (selectedEmail === '' || item.dataset.email === selectedEmail) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
    </script>

</body>

</html>
