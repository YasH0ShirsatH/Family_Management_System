<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>State Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">

</head>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-pill mt-4 mx-5">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<body class="bg-light">
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
        <!-- Header Card -->
        <!-- <div class="card shadow mb-4 border-0" style="border-radius: 20px;">
            <div class="card-header bg-gradient bg-primary text-white py-4 border-0"
                style="border-radius: 20px 20px 0 0;">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h3 class="mb-1 fw-bold">
                            <i class="bi bi-map me-2"></i>State Management
                        </h3>
                        <p class="mb-0 opacity-75">Manage all states and their cities</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="/admin" class="btn btn-light rounded-pill px-4 py-2 fw-semibold">
                            <i class="bi bi-arrow-left me-2"></i>Dashboard
                        </a>
                        <a href="{{ route('create.state') }}"
                            class="btn btn-success rounded-pill px-4 py-2 fw-semibold">
                            <i class="bi bi-plus-circle me-2"></i>Add State
                        </a>
                        <a href="/admin/state-city/city" class="btn btn-warning rounded-pill px-4 py-2 fw-semibold">
                            <i class="bi bi-buildings me-2"></i>Cities
                        </a>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Search Bar -->
         <div class="card shadow-sm mb-4 border-0 rounded-4">
            <div class="card-header bg-gradient bg-primary text-white py-3 border-0 rounded-top-4">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-search me-2"></i>Search States
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white border-0 rounded-start-pill px-4">
                                <i class="bi bi-search fs-5"></i>
                            </span>
                            <input type="text" id="searchInput" class="form-control border-0 rounded-end-pill py-3 px-4 shadow-sm"
                                placeholder="Search by ID, Name, or type..." value="{{ request('search') }}">
                            <span id="searchLoading" class="position-absolute top-50 end-0 translate-middle-y me-4 d-none" style="z-index: 10;">
                                <div class="spinner-border spinner-border-sm text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </span>
                        </div>
                       
                    </div>
                    <div class="col-lg-4 col-md-2 mt-3 mt-md-0">
                        <div class="d-flex gap-2 justify-content-md-end">
                            <button type="button" class="btn btn-outline-secondary rounded-pill px-3" onclick="$('#searchInput').val('').trigger('keyup')">
                                <i class="bi bi-x-circle me-1"></i>Clear
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6 mb-3">
                <div class="card bg-primary text-white border-0 h-100" style="border-radius: 20px;">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-geo-alt display-4 mb-3"></i>
                        <h3 class="fw-bold mb-1">{{ $state_count }}</h3>
                        <p class="mb-0 opacity-75">Total States</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card bg-success text-white border-0 h-100" style="border-radius: 20px;">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-buildings display-4 mb-3"></i>
                        <h3 class="fw-bold mb-1">
                            {{ $city_count}}</h3>
                        <p class="mb-0 opacity-75">Total Cities</p>
                    </div>
                </div>
            </div>

        </div>


        <!-- States List -->
        

    <div id="tableResults">
            @include('state-city.partials.state-list', ['states' => $states])
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
    $(function () {
        const listUrl = "{{ url('admin/state-city/states') }}";
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
                .done(function (response) {
                    // replace only the table + pagination area
                    $('#tableResults').html(response);
                })
                .fail(function () {
                    // optional: show a brief message or console error
                    console.error('Failed to fetch list');
                })
                .always(function () {
                    hideLoading();
                });
        }

        // Live search  method applied here
        $(document).on('keyup', '#searchInput', function () {
            const query = $(this).val();
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function () {
                fetchList({search: query});
            }, 800);
        });

        // AJAX pagination done here via https://youtu.be/g0EWWgtA0a0?si=sug4h_xrzTOrmngb
        $(document).on('click', '#tableResults .pagination a', function (e) {
            e.preventDefault();
            const url = new URL($(this).attr('href'), window.location.origin);
            const params = Object.fromEntries(url.searchParams.entries());
            params.search = $('#searchInput').val() || params.search;
            fetchList(params);
            window.history.pushState({}, '', $(this).attr('href'));
        });

        // restore on back/forward
        window.addEventListener('popstate', function () {
            const params = Object.fromEntries(new URLSearchParams(location.search));
            fetchList(params);
        });
    });
    </script>

</html>