<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Management - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">
    
</head>

<body class="bg-light">
    <!-- Navigation -->
       @include('partials.navbar2',['shouldShowDiv' => true])


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
                                <i class="me-2 bi bi-house-door fs-4 "></i>
                                 <span class="mb-0 fs-4 ">( {{ $heads->total() }}</span>
                                <small class="fs-4"> Total Families )</small> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-success text-white border-0 rounded-4">
                            <div class="card-body text-center py-3">
                                <i class="me-2 bi bi-people-fill fs-4 "></i>
                                 <span class="mb-0 fs-4 ">( {{ $totalMembers }}</span>
                                <small class="fs-4">Total Members )</small> 
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
                                        style="z-index: 234234;">
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