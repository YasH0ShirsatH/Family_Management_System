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

    <div class="card shadow mb-4 border-0" style="border-radius: 20px;">
            <div class="card-body p-4">
                
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-primary text-white border-0">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" name="search" class="form-control border-0 shadow-sm"
                                    placeholder="Search city... by ( #Id , Name , state_id )" id="searchInput" value="{{ request('search') }}" value="{{ request('search') }}">
                            </div>
                        </div>
                    </div>
            
            </div>
        </div>
        <div class="card shadow" >
            <div class="card-header bg-white">
                <h4 class="mb-0 text-primary">
                    <i class="bi bi-list me-2"></i>All Cities ({{ $cities->total() }})
                </h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" >
                    <table class="table table-hover mb-0"  >
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><i class="bi bi-geo-alt me-1"></i>City Name</th>
                                <th scope="col"><i class="bi bi-map me-1"></i>State</th>
                                <th scope="col"><i class="bi bi-pen me-1"></i>Edit</th>
                                <th scope="col"><i class="bi bi-trash me-1"></i>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="searchResults">
                            @forelse ($cities as $index => $item)
                            <tr>
                                <th scope="row">{{ $cities->firstItem() + $index }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->state->name }}</td>
                                <td><a href="{{ route('city.edit',$item->id) }}">Edit</a></td>
                                <td >
                                    <form action="{{ route('city.delete', $item->id) }}" method="post" >
                                        @csrf
                                        @method('DELETE')
                                        <button style="background-color: transparent; border:none;text-decoration : underline" type='submit'  class="text-danger" href="{{ route('city.delete',$item->id) }}">Delete</button>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-danger">No data found</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if($cities->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $cities->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
    // Live search
    $('#searchInput').on('keyup', function () {
        let query = $(this).val();

        $.ajax({
            url: "{{ route('city.index') }}",
            method: 'GET',
            data: { search: query },
            success: function (response) {
                $('#searchResults').html(response); // Expecting <tr>...</tr>
            }
        });
    });

    // AJAX pagination
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            success: function (response) {
                $('#searchResults').html(response); // Again, just <tr> rows
            }
        });
    });
});

    </script>
   
</body>

</html>