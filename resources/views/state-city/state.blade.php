<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>State Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">

   <style>
    .active-class-3{
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            color : white;
            transform: translateX(5px);
        }
   </style>

</head>

<body class="bg-light">
    <div id="mainContent">
        <div class="container py-4">
            @include('partials.navbar2', ['shouldShowDiv' => true])
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-pill mt-4 ">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

         <!-- Stats Cards -->
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
                            <a href="{{ route('create.state') }}" class="text-decoration-none">
                                <div class="card bg-warning text-dark border-0 h-100 shadow-sm"
                                    style="border-radius: 20px; transition: all 0.3s ease;"
                                    onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)'">
                                    <div class="card-body text-center py-3 py-md-4">
                                        <i class="bi bi-plus display-5 display-md-4 mb-2 mb-md-3"></i>
                                        <h5 class="fw-bold mb-1">Add New State</h5>
                                        <p class="mb-0 small opacity-75">Create a new state entry</p>
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

            <!-- Search Bar -->
            <div class="card shadow-sm mb-4 border-0 rounded-4">
                <div
                    class="card-header bg-gradient bg-primary text-white py-3 border-0 rounded-top-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-search me-2"></i>Search States
                    </h5>
                    <a href="{{ route('city.index') }}"
                        class="btn ms-2 btn-outline-warning rounded-pill py-2 fw-semibold btn-sm ms-2">
                        Go To Cities<i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center g-3">
                        <div class="col-12 col-md-8 col-lg-9">
                            <div class="input-group">
                                <span
                                    class="input-group-text bg-primary text-white border-0 rounded-start-pill px-3 px-md-4">
                                    <i class="bi bi-search fs-5"></i>
                                </span>
                                <input type="text" id="searchInput"
                                    class="form-control border-0 rounded-end-pill py-2 py-md-3 px-3 px-md-4 shadow-sm"
                                    placeholder="Search by ID, Name, or type..." value="{{ request('search') }}">
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

            <!-- States List -->
            <div id="tableResults">
                @include('state-city.partials.state-list', ['states' => $states])
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(function () {
        const listUrl = "{{ url('admin/state-city/states') }}";
        let debounceTimeout = null;

        function fetchList(params = {}) {
            $('#searchLoading').removeClass('d-none');
            $.get(listUrl, params)
                .done(function (response) {
                    $('#tableResults').html(response);
                })
                .always(function () {
                    $('#searchLoading').addClass('d-none');
                });
        }

        $(document).on('keyup', '#searchInput', function () {
            const query = $(this).val();
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function () {
                fetchList({ search: query });
            }, 800);
        });

        $(document).on('click', '#tableResults .pagination a', function (e) {
            e.preventDefault();
            const url = new URL($(this).attr('href'), window.location.origin);
            const params = Object.fromEntries(url.searchParams);
            fetchList(params);
        });

        $(document).on('click', '#tableResults .deleteBtn', function (e) {
            e.preventDefault();
            const stateId = $(this).data('id');
            
            if (confirm('Are you sure you want to delete this state?')) {
                $.ajax({
                    url: "/admin/state-city/deletestate/" + stateId,
                    type: 'POST',
                    data: { '_token': $('meta[name="csrf-token"]').attr('content') },
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    success: function(response) {
                        if (response.status === 'success') {
                            fetchList({ search: $('#searchInput').val() });
                            $('<div class="alert alert-success alert-dismissible fade show rounded-pill mt-4"><i class="bi bi-check-circle-fill me-2"></i>' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>').insertAfter('.container .row:first').delay(3000).fadeOut();
                        }
                    },
                    error: function() {
                        alert('Error deleting state. Please try again.');
                    }
                });
            }
        });
    });
    </script>
</body>
</html>