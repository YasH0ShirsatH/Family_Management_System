<div class="card shadow-sm border-0 " style="border-radius: 20px;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center" style="border-radius: 20px 20px 0 0;">
        <h4 class="mb-0 text-primary">
            <i class="bi bi-list me-2"></i>All Cities ({{ $cities->total() }})
        </h4>
        <div class="d-flex justify-content-end align-items-center">
            <a href="{{ route('create.city') }}" class="btn btn-primary rounded-pill py-2 fw-semibold btn-sm">
                <i class="bi bi-plus-circle me-2"></i>Add City
            </a>

        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-muted fw-bold">#</th>
                        <th scope="col" class="text-muted fw-bold"><i class="bi bi-geo-alt me-1"></i>City Name</th>
                        <th scope="col" class="text-muted fw-bold"><i class="bi bi-map me-1"></i>State</th>
                        <th scope="col" class="text-muted fw-bold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cities as $index => $item)
                    <tr>
                        <th scope="row" class="align-middle">{{ $cities->firstItem() + $index }}</th>
                        <td class="align-middle fw-bold text-dark">{{ $item->name }}</td>
                        <td class="align-middle">
                            <a class="statelinks text-primary fw-semibold" href="{{ route('show.city', Crypt::encryptString( $item->state->id)) }}">
                                {{ $item->state->name }}
                            </a>
                        </td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center flex-wrap gap-2">
                                <a href="{{ route('city.edit', Crypt::encryptString( $item->id)) }}" class="btn btn-outline-info rounded-pill py-2 fw-semibold btn-sm">
                                    <i class="bi bi-pen me-1"></i>Edit
                                </a>
                                <a class="deleteBtn btn btn-outline-danger rounded-pill py-2 fw-semibold btn-sm delete" href="{{ route('city.delete', $item->id) }}" data-id="{{ $item->id }}">
                                    <i class="bi bi-trash me-1"></i>Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">
                            <div class="alert alert-warning mb-0">
                                <i class="bi bi-exclamation-triangle me-2"></i>No data found
                            </div>
                        </td>
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




