<style>
    .head-card {

        border: none;
        background: #fff;
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
        position: relative;
        overflow: hidden;
    }
    .head-card:hover {
        transform: translateY(-2px);
    }
    .head-card.active {
        box-shadow: 0 8px 32px rgba(25, 135, 84, 0.2);
    }
    .head-card.inactive {
        box-shadow: 0 8px 32px rgba(220, 53, 69, 0.2);
    }
    .head-card.inactive::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(220, 53, 69, 0.05);
        z-index: 1;
    }
    .head-card.inactive .card-body {
        position: relative;
        z-index: 2;
    }
    .origami-fold {
        position: relative;
        background: #f8f9fa;
        padding: 15px 20px;
        margin-bottom: 15px;
        border-radius: 5px  5px  0 0;
    }
    .origami-fold.active {
        background: linear-gradient(135deg, #198754 0%, #20c997 100%);
        color: white;
    }
    .origami-fold.inactive {
        background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
        color: white;
    }
    .pill-section {
        background: #f8f9fa;
        border-radius: 25px;
        padding: 15px 20px;
        margin: 10px 0;
    }
    .status-pill {
        background: #e9ecef;
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .status-pill.active {
        background: #198754;
        color: white;
    }
    .status-pill.inactive {
        background: #dc3545;
        color: white;
    }
    .btn-pill {
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .info-row {
        display: flex;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    .info-row:last-child {
        border-bottom: none;
    }
    .disabled-link {
        pointer-events: none;
        opacity: 0.5;
    }
</style>

<div class="row">
    <div class="col-12">
        @forelse ($heads as $user)
        <div class="card head-card mb-4 {{ $user->status == 1 ? 'active' : 'inactive' }}">
            <div class="card-body p-0">
                <!-- Origami Header -->
                <div class="origami-fold {{ $user->status == 1 ? 'active' : 'inactive' }}">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('uploads/images/' . $user->photo_path) }}"
                             class="rounded-circle me-3"
                             width="50" height="50"
                             style="object-fit: cover; border: 2px solid rgba(255,255,255,0.5);"
                             alt="Family Head Photo">
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">{{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}</h6>
                            <span class="status-pill {{ $user->status == 1 ? 'active' : 'inactive' }}">
                                {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <small class="opacity-75">
                            {{ $user->created_at->format('M d, Y') }}
                        </small>
                    </div>
                </div>

                <div class="p-3">
                    <!-- Info Pills -->
                    <div class="pill-section">
                        <div class="info-row">
                            <i class="bi bi-telephone-fill text-primary me-2"></i>
                            <span>{{ $user->mobile }}</span>
                        </div>

                        @if($states->where('status','1')->where('name',$user->state)->count() > 0 && $states->where('status','1')->where('name',$user->state)->first()->cities->where('status','1')->where('name',$user->city)->count() > 0)
                            <div class="info-row">
                                <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                                <span>{{ ucfirst($user->city) }}, {{ $user->state }}</span>
                            </div>
                        @else
                            <div class="info-row">
                                <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                                <span class="text-danger">City/State Deleted</span>
                            </div>
                        @endif

                        <div class="info-row">
                            <i class="bi bi bi-calendar-month text-primary me-2"></i>
                            <span>{{ date('M d, Y', strtotime($user->birthdate)) }}</span>
                        </div>
                    </div>

                    <!-- Member Stats Pill -->
                    <div class="pill-section">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-success fw-bold">
                                <i class="bi bi-people-fill me-1"></i>

                                    {{ $user->members->whereIn('status',['0','1'])->count() }} Total Members


                            </span>

                        </div>
                    </div>

                    <!-- Action Pills -->
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('admin.show', ['admin' => Crypt::encryptString($user->id)]) }}"
                           class="btn btn-primary btn-pill flex-fill {{ $user->status != 1 ? 'disabled-link' : '' }}">
                            <i class="bi bi-eye me-1"></i>View
                        </a>
                        <button type="button" class="btn btn-success btn-pill flex-fill"
                                data-bs-toggle="modal" data-bs-target="#actionsModal{{ $user->id }}">
                            <i class="bi bi-gear me-1"></i>Actions
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Modal -->
        <div class="modal fade" id="actionsModal{{ $user->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Actions for {{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-grid gap-2">
                            @if($states->where('status','1')->where('name',$user->state)->count() > 0 && $states->where('status','1')->where('name',$user->state)->first()->cities->where('status','1')->where('name',$user->city)->count() > 0)
                                <a href="{{ route('admin.fulledit', Crypt::encryptString($user->id)) }}"
                                   class="btn btn-warning {{ $user->status != 1 ? 'disabled-link' : '' }}">
                                    <i class="bi bi-pencil me-2"></i>Edit Head & Members
                                </a>
                            @else
                                <a href="{{ route('admin-member.updateCityState', $user->id) }}"
                                   class="btn btn-warning">
                                    <i class="bi bi-pencil me-2"></i>Edit Address (State/City)
                                </a>
                            @endif

                            <a href="{{ route('admin-member.show',Crypt::encryptString($user->id)) }}"
                               class="btn btn-info {{ $user->status != 1 ? 'disabled-link' : '' }}">
                                <i class="bi bi-people me-2"></i>Manage Members
                            </a>

                            @if($user->status == '0')
                                @if($states->where('status','1')->where('name',$user->state)->count() > 0 && $states->where('status','1')->where('name',$user->state)->first()->cities->where('status','1')->where('name',$user->city)->count() > 0)
                                    <button type="button" data-id="{{ $user->id }}"
                                            class="btn btn-success activation" data-bs-dismiss="modal">
                                        <i class="bi bi-check-circle me-2"></i>Activate Head
                                    </button>
                                @else
                                    <button type="button" class="btn btn-success disabled-link">
                                        <i class="bi bi-check-circle me-2"></i>Activate Head (Fix Address First)
                                    </button>
                                @endif
                            @endif

                            @if($user->status == '1')
                                <button type="button" data-id="{{ $user->id }}"
                                        class="btn btn-outline-danger deactivation" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-2"></i>Deactivate Head
                                </button>
                            @endif

                            <button type="button" data-id="{{ $user->id }}"
                                    class="btn btn-danger delete" data-bs-dismiss="modal">
                                <i class="bi bi-trash me-2"></i>Delete Head
                            </button>
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


