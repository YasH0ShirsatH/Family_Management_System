<div class="card shadow-sm border-0" style="border-radius: 20px;">
    <div class="card-header d-flex justify-content-between align-items-center bg-white" style="border-radius: 20px 20px 0 0;">
        <h4 class="mb-0 text-primary">
            <i class="bi bi-list me-2"></i>{{ $state->name }} : [ Total Cities ({{ count($state->cities) }}) ]
        </h4>
        <a href="{{ route('show.createViaShowCity', $state->id) }}" class="btn btn-primary rounded-pill fw-semibold py-2 px-3">
            <i class="bi bi-plus-circle me-1"></i>
            Add City
        </a>
        <style>
            @media (max-width: 768px) {
            .disable-div {
                display: none;
            }

        }
        </style>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-muted fw-bold"># City Id</th>
                        <th scope="col" class="text-muted fw-bold"><i class="bi bi-buildings me-1"></i>City Name</th>
                        <th scope="col" class="text-muted fw-bold"><i class="bi bi-map me-1"></i>State</th>
                        <th scope="col" class="text-muted fw-bold disable-div"><i class="bi bi-calendar me-1"></i>Added On</th>
                        <th scope="col" class="text-muted fw-bold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($city as $index => $item)
                    <tr>
                        <th scope="row" class="align-middle">{{ $item->id}}</th>
                        <td class="align-middle fw-bold text-dark">{{ $item->name }}</td>
                        <td class="align-middle">{{ $item->state->name ?? 'N/A' }}</td>
                        <td class="align-middle disable-div">{{ $item->created_at->format('M d, Y') }}</td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center flex-wrap gap-2">
                                <a href="{{ route('city.edit', $item->id) }}" class="btn btn-outline-info rounded-pill py-2 fw-semibold btn-sm">
                                    <i class="bi bi-pen me-1"></i>Edit
                                </a>
                                <a href="{{ route('city.delete',$item->id) }}" class="deleteBtn btn btn-outline-danger rounded-pill py-2 fw-semibold btn-sm">
                                    <i class="bi bi-trash me-1"></i>Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <div class="alert alert-warning mb-0">
                                <i class="bi bi-exclamation-triangle me-2"></i>No city found
                            </div>
                        </td>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.getElementsByClassName('deleteBtn');

        for (let i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener('click', function(event) {
                if (!confirm('WARNING: This will permanently delete the "CITY"! This action cannot be undone. Are you sure?')) {
                    event.preventDefault();
                }
            });
        }
    });
</script>
