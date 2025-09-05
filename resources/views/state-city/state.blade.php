<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand mb-0 h1">
                <i class="bi bi-map me-2"></i>State Management
            </span>
            <div>
                <a href="/admin" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left me-1"></i>Back
                </a>
                <a href="{{ route('create.state')  }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-plus-circle me-1"></i>Add States
                </a>
                <a href="/admin/state-city/city" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-right me-1"></i>Go to Cities
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-white">
                <h4 class="mb-0 text-primary">
                    <i class="bi bi-list me-2"></i>All States ({{ $states->total() }})
                </h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><i class="bi bi-geo-alt me-1"></i>State Name</th>
                                <th scope="col"><i class="bi bi-buildings me-1"></i>Total cities </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($states as $index => $item)
                            <tr>
                                <th scope="row">{{ $states->firstItem() + $index }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->cities->count()  }}</td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if($states->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $states->links('pagination::bootstrap-4') }}
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>