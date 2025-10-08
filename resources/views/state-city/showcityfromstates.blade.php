<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cities by State</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">
    <style>
        .active-class-3{
            background-color: #198754;
            color : white;
            transform: translateX(5px);
        }
    </style>

</head>

<body class="bg-light">
    <div id="mainContent">

        @include('partials.navbar2', ['shouldShowDiv' => true])
        <div class="text-center mb-4 mt-4">
            <a href="{{ route('state.index') }}" class="btn btn-outline-primary rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Back to Manage States
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-pill mt-4 mx-5">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif


        <div class="container py-4">
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
                                <input type="text" id="searchInput"
                                    class="form-control border-0 rounded-end-pill py-3 px-4 shadow-sm"
                                    placeholder="Search by ID, Name ..." value="{{ request('search') }}">
                                <span id="searchLoading"
                                    class="position-absolute top-50 end-0 translate-middle-y me-4 d-none"
                                    style="z-index: 10;">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </span>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-2 mt-3 mt-md-0">
                            <div class="d-flex gap-2 justify-content-md-end">
                                <button type="button" class="btn btn-outline-secondary rounded-pill px-3"
                                    onclick="$('#searchInput').val('').trigger('keyup')">
                                    <i class="bi bi-x-circle me-1"></i>Clear
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tableResults">
                @include('state-city.partials.show-state-list', ['city' => $city])
            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(function () {
        let debounceTimeout = null;

        // Live search with form submission
        $(document).on('keyup', '#searchInput', function () {
            const query = $(this).val();
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function () {
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('search', query);
                currentUrl.searchParams.delete('page'); // Reset to page 1
                window.location.href = currentUrl.toString();
            }, 1000);
        });
    });
</script>

 <script>
        $(function () {
            const listUrl = "{{ url('admin/state-city/city') }}";
            let debounceTimeout = null;









            // AJAX delete functionality
            $(document).on('click', '.deleteBtn', function (e) {
                e.preventDefault();
                const deleteUrl = $(this).attr('href');
                const cityId = $(this).data('id');

                if (confirm('Are you sure you want to delete this city?')) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            '_method': 'POST'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                 location.reload(true);

                            }
                        },
                        error: function(xhr) {
                            alert('Error deleting city. Please try again.');
                        }
                    });
                }
            });
        });
    </script>

</html>
