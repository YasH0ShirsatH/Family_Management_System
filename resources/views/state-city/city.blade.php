<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">
    <style>
        .statelinks {
            text-decoration: none;
            color: #6c757d;
        }

        .statelinks:hover {
            text-decoration: underline;
            color: #0d6efd;
        }
        .active-class-4{
            background-color: #198754;
            color : white;
            transform: translateX(5px);
        }
    </style>

</head>



<body class="bg-light" id="cities">
    <div id="mainContent">

        @include('partials.navbar2', ['shouldShowDiv' => true])


        

        <div class="container py-4">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-pill mt-4 ">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
            <!-- Search Card -->
            <div class="card shadow-sm mb-4 border-0 rounded-4">
                <div class="card-header bg-gradient bg-primary text-white py-3 border-0 rounded-top-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-search me-2"></i>Search Cities
                    </h5>
                    <a href="{{ route('state.index') }}" class="ms-2 btn ms-2 btn-outline-warning rounded-pill py-2 fw-semibold btn-sm">
                     <i class="bi bi-arrow-left me-2"></i>Go To States
                    </a>
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center g-3">
                        <div class="col-12 col-md-8 col-lg-9">
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white border-0 rounded-start-pill px-3 px-md-4">
                                    <i class="bi bi-search fs-5"></i>
                                </span>
                                <input type="text" id="searchInput"
                                    class="form-control border-0 rounded-end-pill py-2 py-md-3 px-3 px-md-4 shadow-sm"
                                    placeholder="Search by ID, Name, or State..."
                                    value="{{ request('search') }}">
                                <span id="searchLoading"
                                    class="position-absolute top-50 end-0 translate-middle-y me-3 me-md-4 d-none"
                                    style="z-index: 10;">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="d-grid d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-outline-secondary rounded-pill px-3"
                                    onclick="$('#searchInput').val('').trigger('keyup')">
                                    <i class="bi bi-x-circle me-1"></i>Clear
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card bg-primary text-white border-0 h-100" style="border-radius: 20px;">
                        <div class="card-body text-center py-3 py-md-4">
                            <i class="bi bi-geo-alt display-5 display-md-4 mb-2 mb-md-3"></i>
                            <h3 class="fw-bold mb-1">{{ $state_count }}</h3>
                            <p class="mb-0 opacity-75 small">Total States</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('create.city') }}" class="text-decoration-none">
                        <div class="card bg-warning text-dark border-0 h-100 shadow-sm"
                            style="border-radius: 20px; transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)'">
                            <div class="card-body text-center py-3 py-md-4">
                                <i class="bi bi-plus display-5 display-md-4 mb-2 mb-md-3"></i>
                                <h5 class="fw-bold mb-1">Add New City</h5>
                                <p class="mb-0 small opacity-75">Create a new city entry</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-12 col-lg-4">
                    <a href="{{ route('city.index') }}" style="text-decoration : none">
                        <div class="card bg-success text-white border-0 h-100" style="border-radius: 20px;">
                            <div class="card-body text-center py-3 py-md-4">
                                <i class="bi bi-buildings display-5 display-md-4 mb-2 mb-md-3"></i>
                                <h3 class="fw-bold mb-1">
                                    {{ $city_count}}
                                </h3>
                                <p class="mb-0 opacity-75 small">Total Cities</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- REPLACE ONLY THIS CONTAINER via AJAX -->
            <div id="tableResults">
                @include('state-city.partials.city-list', ['cities' => $cities])
            </div>
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
                    fetchList({ search: query });
                }, 800);
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>