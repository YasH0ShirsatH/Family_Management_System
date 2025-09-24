<style>
    .head-card {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .head-card.active {
        opacity: 1;
        border-color: #198754;
        box-shadow: 0 4px 15px rgba(25, 135, 84, 0.15);
    }
    .head-card.inactive {
        position: relative;
        border-color: #dc3545;
    }
    .head-card.inactive::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(220, 53, 69, 0.15);
        border-radius: inherit;
        z-index: 1;
        pointer-events: none;
    }
    .head-card.inactive .card-body {
        position: relative;
        z-index: 2;
    }
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .status-active {
        background-color: #d1e7dd;
        color: #0f5132;
    }
    .status-inactive {
        background-color: #f8d7da;
        color: #842029;
    }
    .btn-group-custom {
        gap: 8px;
    }
    .btn-custom {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .disabled-link {
        pointer-events: none;
        cursor: not-allowed;
        opacity: 0.4;
    }
</style>

<div class="row">
    <div class="col-12">
        @forelse ($heads as $user)
        <div class="card head-card shadow-sm border-0 rounded-3 mb-3 {{ $user->status == 1 ? 'active' : 'inactive' }}">
            <div class="card-body p-4">
                <div class="row align-items-center g-3">
                    <!-- Profile Section -->
                    <div class="col-12 col-lg-4">
                        <div class="d-flex align-items-center">
                            <div class="position-relative me-3">
                                <img src="{{ asset('uploads/images/' . $user->photo_path) }}"
                                     class="rounded-circle border border-2"
                                     width="70" height="70"
                                     style="object-fit: cover; border-color: {{ $user->status == 1 ? '#198754' : '#dc3545' }} !important;"
                                     alt="Family Head Photo">

                            </div>
                            <div class="flex-grow-1">
                                <h5 class="mb-2 fw-bold text-dark">{{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}</h5>
                                <div class="mb-2">
                                    <span class="status-badge {{ $user->status == 1 ? 'status-active' : 'status-inactive' }}">
                                        {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    Created: {{ $user->created_at->format('M d, Y') }}
                                </small>
                            <div>
                                <small class="text-warning">
                                    <i class="bi bi-people me-1"></i>
                                    Inactive Members : {{ $user->members->where('status','0')->count() }}
                                </small>
                            </div>
                        <div>
                                <small class="text-danger">
                                    <i class="bi bi-people me-1"></i>
                                    Deleted Members : {{ $user->members->where('status','9')->count() }}
                                </small>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Details Section -->
                    <div class="col-12 col-lg-4">
                        <div class="row g-2">
                            <div class="col-12">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-telephone-fill text-primary me-2"></i>
                                    <span class="fw-medium">{{ $user->mobile }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                                    <span class="fw-medium">{{ ucfirst($user->city) }}, {{ $user->state }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-cake2-fill text-primary me-2"></i>
                                    <span class="fw-medium">{{ date('M d, Y', strtotime($user->birthdate)) }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-people-fill text-success me-2"></i>
                                    <span class="text-success fw-bold">
                                        @if($user->status == '0' || $user->status == '9')
                                            {{ $user->members->count()  }} Total Members
                                        @elseif($user->status == '1')
                                            {{ $user->members->where('status','1')->count()  }} Active Members
                                        @endif

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions Section -->
                    <div class="col-12 col-lg-4">
                        <div class="d-flex flex-column gap-2">
                            <!-- Primary Actions -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.show', $user->id) }}"
                                   class="btn btn-primary btn-custom btn-sm flex-fill {{ $user->status != 1 ? 'disabled-link' : '' }}">
                                    <i class="bi bi-eye me-1"></i>View
                                </a>
                                <a href="{{ route('admin.fulledit', $user->id) }}"
                                   class="btn btn-warning btn-custom btn-sm flex-fill {{ $user->status != 1 ? 'disabled-link' : '' }}">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                            </div>

                            <!-- Secondary Actions -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin-member.show',$user->id) }}"
                                   class="btn btn-outline-info btn-custom btn-sm flex-fill {{ $user->status != 1 ? 'disabled-link' : '' }}">
                                    <i class="bi bi-people me-1"></i>Members
                                </a>
                                <a href="{{ route('delete',$user->id) }}"
                                    @if($user->status == '0')
                                   class="btn btn-danger btn-custom btn-sm flex-fill"
                                   @else
                                   class="btn btn-outline-danger btn-custom btn-sm flex-fill"
                                   @endif
                                   onclick="return confirm('Are you sure you want to delete this head?')">
                                    <i class="bi bi-trash me-1"></i>Delete
                                </a>
                            </div>

                         @if($user->status == '0')
                             <div class="d-flex flex-column gap-2">
                                <a href="{{ route('admin-member.activateHeadOnView', $user->id) }}"
                                   class="btn btn-outline-success btn-custom btn-sm flex-fill {{ $user->status == 1 ? 'disabled-link' : '' }}"
                                   onclick="return confirm('Are you sure you want to activate this head?')">
                                <i class="bi bi-check-circle me-1"></i>Activate
                                </a>
                            </div>
                         @endif

                         @if($user->status == '1')
                             <div class="d-flex flex-column gap-2">
                             <a href="{{ route('admin-member.deactivateHeadOnView', $user->id) }}"
                                    onclick="return confirm('Are you sure you want to deactivate this member?')"
                                    class="btn btn-outline-danger btn-custom btn-sm flex-fill {{ $user->status == 0 ? 'disabled-link' : '' }}">
                                    <i class="bi bi-x-circle me-1"></i>Deactivate</a>
                             </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card shadow rounded-4 text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-people display-1 text-muted opacity-50"></i>
                </div>
                <h4 class="text-muted mb-3 fw-semibold">No Heads Available</h4>
                <p class="text-muted mb-4">Start building your family tree by adding a Head.</p>
                <a href="/headview" class="btn btn-primary btn-lg rounded-pill mx-auto" style="width: fit-content;">
                    <i class="bi bi-plus-circle me-2"></i>Add Head
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>

@if($heads->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $heads->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
</div>
@endif
