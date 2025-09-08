<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">


</head>



<body class="bg-light" id="cities">
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand mb-0 h1">
                <i class="bi bi-buildings me-2"></i>City Management
            </span>
            <div>
                <a href="/admin" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left me-1"></i>Back
                </a>
                <a href="/admin/state-city/createcity" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>Add Cities
                </a>
                <a href="/admin/state-city/states" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-right me-1"></i>Go to States
                </a>
            </div>
        </div>
    </nav>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-pill mt-4 mx-5">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="container py-4">
        <!-- Search Card -->
        <div class="card shadow-sm mb-4 border-0 rounded-4">
            <div class="card-header bg-gradient bg-primary text-white py-3 border-0 rounded-top-4">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-search me-2"></i>Search Cities
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
                                placeholder="Search by ID, Name, or State..." value="{{ request('search') }}">
                            <span id="searchLoading" class="position-absolute top-50 end-0 translate-middle-y me-4 d-none" style="z-index: 10;">
                                <div class="spinner-border spinner-border-sm text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </span>
                        </div>
                        <div class="form-text mt-2 ms-3">
                            <i class="bi bi-info-circle me-1"></i>
                            Search by city ID, name, or state ID for quick results
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

        <!-- REPLACE ONLY THIS CONTAINER via AJAX -->
        <div id="tableResults">
            @include('state-city.partials.city-list', ['cities' => $cities])
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
    $(function () {
        const listUrl = "{{ url('admin/state-city/city') }}";
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

        // Live search (debounced)
        $(document).on('keyup', '#searchInput', function () {
            const query = $(this).val();
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function () {
                fetchList({search: query});
            }, 400);
        });

        // AJAX pagination — delegated to the table container
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
</body>
</html>