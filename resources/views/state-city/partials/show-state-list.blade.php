<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <h4 class="mb-0 text-primary">
            <i class="bi bi-list me-2"></i>{{ $state->name  }} : [ Total Cities ({{ count($state->cities) }}) ]
        </h4>
        <a href="{{ route('show.createViaShowCity', $state->id) }}" style="text-decoration : none"
            class="btn btn-primary rounded-pill fw-semibold">

            <i class="bi bi-plus-circle me-1"></i>
            Add City
        </a>
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
                            <td><a href="{{ route('city.edit', $item->id) }}">Edit</a></td>
                            <td>
                                    <a href="{{ route('city.delete',$item->id) }}"
                                        style="background-color: transparent; border:none;text-decoration : underline"
                                        class="text-danger">Delete</a>
                    

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
        @if($city->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $city->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
</div>