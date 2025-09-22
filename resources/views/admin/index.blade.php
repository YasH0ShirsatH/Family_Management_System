<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Management - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">
    <style>
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f5f7;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card-header-main {
            background-color: #007bff;
            color: white;
            padding: 1.5rem;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .header-buttons .btn {
            border-radius: 20px;
            font-weight: 500;
            padding: 8px 20px;
        }

        .stats-card {
            background-color: #fff;
            padding: 1.5rem;
            border: 1px solid #e9ecef;
            border-radius: 12px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: #495057;
        }

        .stat-item .stat-value {
            font-weight: 700;
            margin-right: 5px;
        }

        .stat-item .stat-label {
            font-size: 1rem;
            color: #6c757d;
        }

        .search-card {
            background-color: #fff;
            border: 1px solid #e9ecef;
        }

        .search-input-group .form-control {
            border: 1px solid #ced4da;
            box-shadow: none;
            padding: 0.75rem 1rem;
        }

        .search-input-group .input-group-text {
            background-color: white;
            border: 1px solid #ced4da;
            color: #007bff;
        }

        .search-input-group .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }

        .search-input-group:focus-within .input-group-text {
            border-color: #007bff;
        }

        .search-loading-spinner {
            color: #007bff;
        }

        .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
        }

        .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }

        .alert {
            border-radius: 12px;
            font-weight: 500;
            border: none;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .active-class-2{
            background-color: #198754;
            color : white;
            transform: translateX(5px);
        }
    </style>

</head>

<body class="bg-light">
    <div id="mainContent">


    @include('partials.navbar2',['shouldShowDiv' => true])

        <div class="container py-4">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <strong>{{ ucfirst(session('name')) }} {{ ucfirst(session('surname')) }}</strong>: {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>{{ session('name') }} {{ session('surname') }}</strong>: {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-header-main d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                    <div class="flex-grow-1">
                        <h4 class="mb-0 fw-bold">
                            <i class="bi bi-speedometer2 me-2"></i>Manage Families
                        </h4>
                    </div>
                    <div class="header-buttons d-flex flex-column flex-sm-row gap-2">
                        <a href="{{ route('download_all') }}" class="btn btn-outline-light" data-toggle="tooltip" data-placement="bottom" title="Export Data in PDF">PDF</a>
                        <a href="{{ route('download_excel_all') }}" class="btn btn-outline-light" data-toggle="tooltip" data-placement="bottom" title="Export Data in excel">Excel</a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="card stats-card mb-4">
                        <div class="row g-3 text-center">
                            <div class="col-12 col-sm-6">
                                <div class="stat-item">
                                    <i class="me-2 bi bi-house-door"></i>
                                    <span class="stat-value">{{ $heads->total() }}</span>
                                    <span class="stat-label">Total Family Heads</span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="stat-item">
                                    <i class="me-2 bi bi-people-fill"></i>
                                    <span class="stat-value">{{ $totalMembers }}</span>
                                    <span class="stat-label">Total Members</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4 search-card">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <div class="input-group search-input-group position-relative">
                                        <span class="input-group-text">
                                            <i class="bi bi-search"></i>
                                        </span>
                                        <input type="text" id="searchInput"
                                            class="form-control"
                                            placeholder="Search by name, surname, mobile, city, state..."
                                            value="{{ request('search') }}">

                                        <span id="searchLoading"
                                            class="position-absolute top-50 end-0 translate-middle-y me-3 d-none"
                                            style="z-index: 10;">
                                            <div class="spinner-border spinner-border-sm search-loading-spinner" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-auto mb-2 mb-md-0">
                                <label for="category" class="form-label mb-0 fw-semibold">Sort By:</label>
                            </div>
                            <div class="col-12 col-md-auto">
                                <select name="category" id="category" class="form-select" style="max-width: 300px;">
                                    <option value="name">Select Category</option>
                                    <option value="updated_at">Updated At (Latest)</option>
                                    <option value="updated_at_asc">Updated At (Oldest)</option>
                                    <option value="created_at">Created At (Latest)</option>
                                    <option value="created_at_asc">Created At (Oldest)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="tableResults">
                        @include('admin.partials.index-search', ['heads' => $heads])
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
        $(function() {
            const listUrl = "{{ url('/admin') }}";
            let debounceTimeout = null;

            function showLoading() {
                $('#searchLoading').removeClass('d-none');
                $('#searchInput').prop('disabled', true);
            }

            function hideLoading() {
                $('#searchLoading').addClass('d-none');
                $('#searchInput').prop('disabled', false);
            }

            function fetchList(params = {}) {
                showLoading();
                $.get(listUrl, params)
                    .done(function(response) {

                        $('#tableResults').html(response);
                    })
                    .fail(function() {

                        console.error('Failed to fetch list');
                    })
                    .always(function() {
                        hideLoading();
                    });
            }


            $(document).on('keyup', '#searchInput', function() {
                const query = $(this).val();
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(function() {
                    fetchList({
                        search: query
                    });
                }, 800);
            });


            $(document).on('click', '#tableResults .pagination a', function(e) {
                e.preventDefault();
                const url = new URL($(this).attr('href'), window.location.origin);
                const params = Object.fromEntries(url.searchParams.entries());
                params.search = $('#searchInput').val() || params.search;
                fetchList(params);
                window.history.pushState({}, '', $(this).attr('href'));
            });

            // restore on back/forward
            window.addEventListener('popstate', function() {
                const params = Object.fromEntries(new URLSearchParams(location.search));
                fetchList(params);
            });
        });
        </script>

        <script>
        $(document).ready(function() {
            $('#category').on('change', function() {
                var selectedValue = $(this).val();
                if (selectedValue) {
                    $.ajax({
                        url: "{{ url('/admin') }}",
                        type: 'GET',
                        data: {
                            category: selectedValue
                        },
                        success: function(response) {
                            $('#tableResults').html(response);
                            $('#category').val(selectedValue);
                            console.log(selectedValue)
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
        </script>
</body>

</html>
