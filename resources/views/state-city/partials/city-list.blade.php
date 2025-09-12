<div class="card shadow">
    <div class="card-header bg-white">
        <h4 class="mb-0 text-primary">
            <i class="bi bi-list me-2"></i>All Cities ({{ $cities->total() }})
        </h4>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><i class="bi bi-geo-alt me-1"></i>City Name</th>
                        <th scope="col"><i class="bi bi-map me-1"></i>State</th>
                        <th scope="col"><i class="bi bi-pen me-1"></i>Edit</th>
                        <th scope="col"><i class="bi bi-trash me-1"></i>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cities as $index => $item)
                        <tr>
                            <th scope="row">{{ $cities->firstItem() + $index }}</th>
                            <td>{{ $item->name }}</td>
                            <td><a class="statelinks"
                                    href="{{ route('show.city', $item->state->id)  }}">{{ $item->state->name }}</a></td>
                            <td><a href="{{ route('city.edit', $item->id) }}">Edit</a></td>
                            <td>
                                <a class="deleteBtn text-danger" href="{{ route('city.delete', $item->id) }}"
                                    style="background-color: transparent; border:none;text-decoration : underline"
                                    >Delete</a>
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

<script>
        document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.getElementsByClassName('deleteBtn');

    for (let i = 0; i < deleteButtons.length; i++) {
        deleteButtons[i].addEventListener('click', function(event) {
        if (!confirm(
            'WARNING: This will permanently delete the "CITY"! This action cannot be undone. Are you sure?'
            )) {
            event.preventDefault();
        }
        });
    }
    });
</script>