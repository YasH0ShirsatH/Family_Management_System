<div class="row">
            @forelse ($states as $index => $item)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 20px; transition: all 0.3s;"
                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow=''">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-gradient bg-primary rounded-circle p-3 me-3">
                                <i class="bi bi-geo-alt text-white fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="mb-1 fw-bold text-dark">{{ $item->name }}</h5>
                                <small class="text-muted">State #{{ $item->id }}</small>
                            </div>
                        </div>

                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-success rounded-pill px-3 py-2 fs-6">
                                    <i class="bi bi-buildings me-1"></i>{{ $item->cities->count() }} Cities
                                </span>
                                @if($item->cities->count() > 0)
                                <small class="text-success fw-semibold"><i
                                        class="bi bi-check-circle me-1"></i>Active</small>
                                @else
                                <small class="text-warning fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>No
                                    Cities</small>
                                @endif
                            </div>

                            <div class="d-grid">
                                <a href="{{ route('show.city', $item->id)  }}"
                                    class="btn btn-outline-primary rounded-pill py-2 fw-semibold">
                                    <i class="bi bi-eye me-2"></i>View Cities
                                </a>
                                <a href="{{ route('state.edit', $item->id)  }}"
                                    class="btn mt-2 btn-outline-info rounded-pill py-2 fw-semibold">
                                    <i class="bi bi-pen me-2"></i>Edit State
                                </a>
                                <form action="{{ route('state.delete', $item->id)   }}" class="w-100" method="post">   
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn mt-2 w-100 btn-outline-danger rounded-pill py-2 fw-semibold">
                                        <i class="bi bi-trash me-2"></i>Delete State
                                    </button>

                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="bi bi-exclamation-triangle me-2"></i> No States Found
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($states->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $states->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
        </div>
        @endif