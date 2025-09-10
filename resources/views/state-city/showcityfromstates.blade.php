<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cities by State</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">

</head>
<body class="bg-light">
           @include('partials.navbar2',['shouldShowDiv' => true])




    <div class="container py-4">
        <div class="card-header bg-gradient bg-primary text-white py-3 border-0 rounded-top-4">
                <h5 class="mx-4 mb-0 fw-bold">
                    <i class="bi bi-search me-2"></i>Search Cities
                </h5>
            </div>
        <div class="card shadow mb-4 border-0" style="border-radius: 20px;">
            <div class="card-body p-4 rounded-pill">
                <form action="{{ route('show.city',$state->id) }}" method="post">
                    @csrf
                    <div class="row align-items-center ">
                        <div class="col-md-8">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text rounded-start-pill bg-primary text-white border-0">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" name="search" class="form-control rounded-end-pill border-0 shadow-sm"
                                    placeholder="Search city... by ( #Id , Name , state_id )" value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-semibold">
                                    <i class="bi bi-search me-2"></i>Search City 
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>



















        </div>
        <div class="card shadow">
            <div class="card-header bg-white">
                <h4 class="mb-0 text-primary">
                    <i class="bi bi-list me-2"></i>City List ({{ count($city) }})
                </h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><i class="bi bi-buildings me-1"></i>City Name</th>
                                <th scope="col"><i class="bi bi-map me-1"></i>State</th>
                                <th scope="col"><i class="bi bi-calendar me-1"></i>Added On</th>
                                <th scope="col" class="text-primary"><i class="bi bi-pen me-1"></i>Edit</th>
                                <th scope="col" class="text-danger"><i class="bi bi-trash me-1"></i>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($city as $index => $item)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->state->name ?? 'N/A' }}</td>
                                <td>{{ $item->created_at->format('M d, Y') }}</td>
                                <td><a href="{{ route('city.edit',$item->id) }}">Edit</a></td>
                                <td >
                                    <form action="{{ route('city.delete', $item->id) }}" method="post" >
                                        @csrf
                                        @method('DELETE')
                                        <button type='submit' style="background-color: transparent; border:none;text-decoration : underline"   class="text-danger" href="{{ route('city.delete',$item->id) }}">Delete</button>
                                    </form>

                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-danger">No city found</td>
                            </tr>
                            
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
            {{ $city->links('pagination::bootstrap-4') }}
        </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>