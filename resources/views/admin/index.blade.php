<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Management - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    a {
        text-decoration: none;
    }
    </style>
    <style>
    .offcanvas-body {
        padding: 2rem;
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .offcanvas-body>div:first-child {
        font-size: 1.1rem;
        font-weight: 500;
        color: #343a40;
        margin-bottom: 1.5rem;
    }

    .dropdown {
        background-color: #ffffff;
        padding: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .dropdown::before {
        
        display: block;
        font-weight: 600;
        font-size: 1.05rem;
        margin-bottom: 0.75rem;
        color: #0d6efd;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        margin-bottom: 0.3rem;
        border-radius: 0.375rem;
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #ffc107;
        color: black !important;
    }

    li {
        list-style-type: none;
    }

    li {
        transition: all 400ms;
    }

    li:has(a:hover) {
        margin-left: 10px
    }
    </style>
</head>

<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-dark bg-primary shadow">
        <div class="container">
                <a class="navbar-brand fs-4 fw-bold">
                    <i class="bi bi-house-heart me-2"></i>Family Management System
                </a>
                <span class="navbar-text text-white d-flex align-items-center justify-content-end " style="width: 24%;">
                    
                
                <span>
                    <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    <i class="navbar-toggler-icon"></i>
                    </a>

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Family Management System</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                        <div>
                            This is a compilation of all the shortcuts we can use to efficiently perform various tasks on a Website
                        </div>
                        <div class="dropdown mt-3">
                            <p class="text-primary fw-bold">Dashboard</p>
                            <li><a class="dropdown-item text-dark" href="/dashboard"><i class="bi bi-speedometer2 text-primary  mb-2 mx-2"></i>Dashboard</a></li>
                        </div>
                        <div class="dropdown mt-3">
                            <p class="text-primary fw-bold">Usefull Links</p>
                            <li><a class="dropdown-item text-dark" href="/admin"><span><i class="bi bi-people  mb-2 mx-2 "></i>Manage Head</a></span></li>
                            <li><a class="dropdown-item text-dark" href="{{ route('state.index') }}"><i class="bi bi-geo-alt  mb-2 mx-2"></i>Manage States</a></li>
                            <li><a class="dropdown-item text-dark" href="{{ route('city.index') }}"><i class="bi bi-buildings  mb-2 mx-2"></i>Manage Cities</a></li>
                            
                            <li><a class="dropdown-item  bg-danger" href="/logout"><i class="bi bi-box-arrow-right  mb-2 mx-2"></i>Logout</a></li>
                        </div>
                        <div class="dropdown mt-3">
                            <p class="text-primary fw-bold">Add Content</p>
                            <li><a class="dropdown-item text-dark" href="/headview"><i class="bi bi-plus-square text-primary  mb-2 mx-2"></i>Create Head</a></li>

                            <li><a class="dropdown-item text-dark" href="{{ route('create.state') }}"><i class="bi bi-plus-square text-primary  mb-2 mx-2"></i>Create State</a></li>
                            <li><a class="dropdown-item  text-dark" href="{{ route('create.city') }}"><i class="bi bi-plus-square text-primary mb-2 mx-2"></i>Create City</a></li>
                            
                        </div>
                    </div>
                    </div>
                </span>
           
            
        </div>
    </nav>

    <div class="container py-4">
        <!-- Success Alert -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-pill">
            <strong>{{ session('name') }} {{ session('surname') }}</strong>: {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Dashboard Header -->
        <div class="card shadow mb-4 rounded-4">
            <div class="card-header bg-primary text-white py-3 rounded-top-4">
                <h4 class="mb-0 fw-bold">
                    <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                </h4>
            </div>

            <div class="card-body p-4 ">
                <!-- Stats Cards telling num of families and their heads -->

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="card bg-primary text-white border-0 rounded-4">
                            <div class="card-body text-center py-3">
                                <i class="bi bi-house-door fs-1 mb-2"></i>
                                <h4 class="mb-0">{{ $heads->total() }}</h4>
                                <small>Total Families</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-success text-white border-0 rounded-4">
                            <div class="card-body text-center py-3">
                                <i class="bi bi-people-fill fs-1 mb-2"></i>
                                <h4 class="mb-0">{{ $totalMembers }}</h4>
                                <small>Total Members</small>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- Search Form -->
                <div class="card shadow-sm mb-4 border-0 rounded-4">
                    <div class="card-header bg-gradient bg-primary text-white py-3 border-0 rounded-top-4">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-search me-2"></i>Search Heads
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-10">
                                <div class="input-group">
                                    <span
                                        class="input-group-text bg-primary text-white border-0 rounded-start-pill px-4">
                                        <i class="bi bi-search fs-5"></i>
                                    </span>
                                    <input type="text" id="searchInput"
                                        class="form-control border-0 rounded-end-pill py-3 px-4 shadow-sm"
                                        placeholder="Search by ➡️ Name, Surname, Mobile, City, State ..."
                                        value="{{ request('search') }}">
                                    <span id="searchLoading"
                                        class="position-absolute top-50 end-0 translate-middle-y me-4 d-none"
                                        style="z-index: 10;">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div>
                    <!-- /// done via https://www.youtube.com/watch?v=8kZ2BVCfalA -->
                    <select style="width : 20%" name="category" id="category"
                        class="form-select rounded-pill w-20 mb-3 " role="button">
                        <option value="name">Select Category</option>

                        <option value="updated_at">Updated At(Latest)</option>
                        <option value="updated_at_asc">Updated At(Oldest)</option>
                        <option value="created_at">Created At(Latest)</option>
                        <option value="created_at_asc">Created At(Oldest)</option>
                    </select>
                </div>

                <!-- Family List with pagination-->
                <div id="tableResults">
                    @include('admin.partials.index-search', ['heads' => $heads])
                </div>
            </div>
        </div>

        <!-- Family List with pagination-->

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

        <!--Script for Categories-->
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