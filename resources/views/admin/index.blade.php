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
        /* General body and font styles for a clean, professional look */
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f5f7; /* A modern, light gray background */
        }

        /* Container and Card styling */
        

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); /* More subtle shadow */
        }

        /* Header and its components */
        .card-header-main {
            background-color: #007bff; /* Primary brand color */
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

        /* Stats Section */
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

        /* Search Form */
        .search-card {
            background-color: #fff;
            border: 1px solid #e9ecef;
            
        }

        .search-input-group .form-control {
            border: 1px solid #ced4da;
            
           
            box-shadow: none;
            padding: 1rem 1.5rem;
        }

        .search-input-group .input-group-text {
            background-color: white;
            border: 1px solid #ced4da;

          
            color: #007bff;
        }
        
        .search-input-group .form-control:focus, .search-input-group .input-group-text:focus-within {
             border-color: #007bff;
             box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }

        .search-loading-spinner {
            color: #007bff;
        }

        /* Select dropdown */
        .form-select.rounded-pill {
            border-radius: 20px;
            padding-left: 1rem;
            width: fit-content !important;
        }
        
        /* Alert message */
        .alert-success {
            border-radius: 20px;
            font-weight: 500;
            background-color: #d4edda;
            color: #155724;
            border: none;
        }

    </style>
</head>

<body class="bg-light">
    @include('partials.navbar2',['shouldShowDiv' => true])

    <div class="container py-4">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{ session('name') }} {{ session('surname') }}</strong>: {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header-main d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold">
                    <i class="bi bi-speedometer2 me-2"></i>Manage Families
                </h4>
               <div class="header-buttons d-flex gap-2">
                 <a href="{{ route('download_all') }}" class="btn btn-outline-light" data-toggle="tooltip" data-placement="bottom" title="Export Data in PDF">PDF</a>
                <a href="{{ route('download_excel_all') }}" class="btn btn-outline-light" data-toggle="tooltip" data-placement="bottom" title="Export Data in excel">Excel</a>
               </div>
            </div>

            <div class="card-body p-4">
                <div class="card stats-card mb-4">
                    <div class="row g-2 text-center">
                        <div class="col-md-6">
                            <div class="stat-item">
                                <i class="me-2 bi bi-house-door"></i>
                                <span class="stat-value">{{ $heads->total() }}</span>
                                <span class="stat-label">Total Families</span>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                            <div class="col-lg-8 col-md-10 w-100">
                                <div class="input-group search-input-group">
                                    <input type="text" id="searchInput"
                                        class="form-control w-100"
                                        style="border-radius : 5px"
                                        placeholder="Search by name, surname, mobile, city, state..."
                                        value="{{ request('search') }}">

                                    <span id="searchLoading"
                                        class="position-absolute top-50 end-0 translate-middle-y me-4 d-none"
                                        style="z-index: 234234;">
                                        <div class="spinner-border spinner-border-sm search-loading-spinner" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div>
                    <select name="category" id="category"
                        class="form-select rounded-pill mb-3" role="button">
                        <option value="name" {{ $category1 == 'name' ? 'selected' : '' }}>Select Category</option>
                        <option value="updated_at" {{ $category1 == 'updated_at' ? 'selected' : '' }} >Updated At(Latest)</option>
                        <option value="updated_at_asc" {{ $category1 == 'updated_at_asc' ? 'selected' : '' }} >Updated At(Oldest)</option>
                        <option value="created_at" {{ $category1 == 'created_at' ? 'selected' : '' }} >Created At(Latest)</option>
                        <option value="created_at_asc" {{ $category1 == 'created_at_asc' ? 'selected' : '' }} >Created At(Oldest)</option>
                    </select>
                </div>

                <div id="tableResults">
                    @include('admin.partials.index-search', ['heads' => $heads])
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
                        // replace only the table + pagination area
                        $('#tableResults').html(response);
                    })
                    .fail(function() {
                        // optional: show a brief message or console error
                        console.error('Failed to fetch list');
                    })
                    .always(function() {
                        hideLoading();
                    });
            }

            // Live search (debounced)
            $(document).on('keyup', '#searchInput', function() {
                const query = $(this).val();
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(function() {
                    fetchList({
                        search: query
                    });
                }, 800);
            });

            // AJAX pagination — delegated to the table container
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