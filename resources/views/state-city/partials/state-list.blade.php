<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0" style="border-radius: 20px; overflow: hidden;">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-muted fw-bold">#</th>
                                <th scope="col" class="text-muted fw-bold">State Name</th>
                                <th scope="col" class="text-muted fw-bold">Cities</th>
                                <th scope="col" class="text-muted fw-bold">Status</th>
                                <th scope="col" class="text-muted fw-bold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($states as $index => $item)
                            <tr>
                                <th scope="row" class="align-middle">{{ $item->id }}</th>
                                <td class="align-middle fw-bold text-dark">{{ $item->name }}</td>
                                <td class="align-middle">
                                    <span class="badge bg-success rounded-pill px-3 py-2 fs-6">
                                        <i class="bi bi-buildings me-1"></i>{{ $item->cities->where('status','1')->count() }} Cities
                                    </span>
                                </td>
                                <td class="align-middle">
                                    @if($item->cities->where('status','1')->count() > 0)
                                    <small class="text-success fw-semibold"><i class="bi bi-check-circle me-1"></i>Active</small>
                                    @else
                                    <small class="text-warning fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>Inactive</small>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex justify-content-center flex-wrap gap-2">
                                        <a href="{{ route('show.city', $item->id) }}" class="btn btn-outline-primary rounded-pill py-2 fw-semibold btn-sm">
                                            <i class="bi bi-eye me-1"></i>View
                                        </a>
                                        <a href="{{ route('state.edit', $item->id) }}" class="btn btn-outline-info rounded-pill py-2 fw-semibold btn-sm">
                                            <i class="bi bi-pen me-1"></i>Edit
                                        </a>
                                        <a href="{{ route('state.delete', $item->id) }}" class="deleteBtn btn btn-outline-danger rounded-pill py-2 fw-semibold btn-sm">
                                            <i class="bi bi-trash me-1"></i>Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="alert alert-warning mb-0">
                                        <i class="bi bi-exclamation-triangle me-2"></i> No States Found
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if($states->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $states->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
</div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.getElementsByClassName('deleteBtn');

        for (let i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener('click', function(event) {
                if (!confirm('WARNING: This will permanently delete the "STATE" and all included "CITIES"! This action cannot be undone. Are you sure?')) {
                    event.preventDefault();
                }
            });
        }
    });
</script>