<div class="row">
    <div class="col-12">
        <style>
            .member-card {
                transition: all 0.3s ease;
                border: 2px solid transparent;
            }
            .member-card.active {
                opacity: 1;
                border-color: #198754;
                box-shadow: 0 4px 15px rgba(25, 135, 84, 0.15);
            }
            .member-card.inactive {
                position: relative;
                border-color: #dc3545;
            }
            .member-card.inactive::before {
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
            .member-card.inactive .card-body {
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

        @forelse ($members as $member)
        <div class="card member-card shadow-sm border-0 rounded-3 mb-3 {{ $member->status == 1 ? 'active' : 'inactive' }}">
            <div class="card-body p-4">
                <div class="row align-items-center g-3">
                    <!-- Profile Section -->
                    <div class="col-12 col-lg-4">
                        <div class="d-flex align-items-center">
                            <div class="position-relative me-3">
                                <img src="{{ $member->photo_path ? asset('uploads/images/' . $member->photo_path) : asset('uploads/images/noimage.png') }}"
                                     class="rounded-circle border border-2"
                                     width="70" height="70"
                                     style="object-fit: cover; border-color: {{ $member->status == 1 ? '#198754' : '#dc3545' }} !important;"
                                     alt="Member Photo">
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="mb-2 fw-bold text-dark">{{ ucfirst($member->name) }}</h5>
                                <div class="mb-2">
                                    <span class="status-badge {{ $member->status == 1 ? 'status-active' : 'status-inactive' }}">
                                        {{ $member->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    Created: {{ $member->created_at->format('M d, Y') }}
                                </small>
                                <br>
                                <small class="text-success fw-bold">
                                    <i class="bi bi-house-door me-1"></i>
                                    @if($member->head)
                                        {{ ucfirst($member->head->name) }} {{ ucfirst($member->head->surname) }}
                                        @if($member->head->status == '1')
                                            <span class="text-success">(Active)</span>
                                        @elseif($member->head->status == '0')
                                            <span class="text-danger">(Inactive)</span>
                                        @elseif($member->head->status == '9')
                                            <span class="text-secondary">(Deleted)</span>
                                        @endif
                                    @else
                                        No Family Head
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Details Section -->
                    <div class="col-12 col-lg-4">
                        <div class="row g-2">
                            <div class="col-12">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-calendar3 text-primary me-2"></i>
                                    <span class="fw-medium">{{ date('M d, Y', strtotime($member->birthdate)) }}</span>
                                </div>
                            </div>
                             <span class="mb-2" >
                                   @if($member->relation)
                                        <i class="bi bi-people text-muted me-2"></i> {{ucfirst($member->relation) }} of {{ $member->head->name }}
                                        @else
                                        <i class="bi bi-slash-circle"></i>&nbsp;
                                        Relation not defined yet
                                        @endif
                             </span>
                            <div class="col-12">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-mortarboard-fill text-primary me-2"></i>
                                    <span class="fw-medium">{{ ucfirst($member->education ?? 'Not specified') }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-heart-fill text-primary me-2"></i>
                                    <span class="fw-medium">
                                        @if($member->marital_status == 1)
                                            Married
                                            @if($member->mariage_date)
                                                ({{ date('M Y', strtotime($member->mariage_date)) }})
                                            @endif
                                        @else
                                            Single
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-badge-fill text-success me-2"></i>
                                    <span class="text-success fw-bold">
                                        Age: {{ \Carbon\Carbon::parse($member->birthdate)->age }} years
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions Section -->
                    <div class="col-12 col-lg-4">
                        <div class="d-flex flex-column gap-2">
                            @if($member->head)
                                <!-- Primary Actions -->
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.show', Crypt::encryptString($member->head->id)) }}"
                                       class="btn btn-primary btn-custom btn-sm flex-fill {{ $member->status != 1 ? 'disabled-link' : '' }}">
                                        <i class="bi bi-eye me-1"></i>View Family
                                    </a>
                                    <a href="{{ route('admin.viewMemberDetails', Crypt::encryptString($member->id)) }}"
                                       class="btn btn-info btn-custom btn-sm flex-fill {{ $member->status != 1 ? 'disabled-link' : '' }}">
                                        <i class="bi bi-person me-1"></i>View Member
                                    </a>
                                </div>

                                <!-- Secondary Actions -->
                                <div class="d-flex gap-2">

                                        <a href="{{ route('admin-member.edit', Crypt::encryptString($member->id)) }}"
                                           class="btn btn-warning btn-custom btn-sm flex-fill  {{ $member->status == 0 ? 'disabled-link' : '' }}">
                                            <i class="bi bi-pencil me-1"></i>Edit
                                        </a>

                                    <a href="{{ route('member.delete', $member->id) }}"

                                       class="btn btn-danger btn-custom btn-sm flex-fill delete1"
                                        data-id="{{  $member->id }}"
                                       >
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </a>
                                </div>
                            @if($member->status == '0' and $member->head->status == '1')
                            <div class="d-flex flex-column gap-2">
                               <a  data-id="{{  $member->id }}"
                                   class="btn btn-outline-success btn-custom btn-sm flex-fill {{ $member->status == 1 ? 'disabled-link' : '' }} activation"
                                   >
                                   <i class="bi bi-check-circle me-1"></i>Activate
                               </a>
                           </div>
                            @elseif($member->status == '0' and $member->head->status == '0')
                             <div class="d-flex flex-column gap-2">
                                <a href="/dashboard/admin-profile"
                                   class="btn btn-outline-danger btn-custom btn-sm flex-fill {{ $member->status == 1 ? 'disabled-link' : '' }}"
                                   onclick="return confirm('Want to Activate this member? Click \'OK\' to go Admin Profile and  Activate head {{$member->head->name}} {{$member->head->surname}}')">
                                <i class="bi bi-x-circle me-1"></i>Activate Head to activate member
                                </a>
                                </div>
                            @endif

                            @if($member->status == '1')
                            <div class="d-flex flex-column gap-2">
                                <a  data-id="{{  $member->id }}"
                                   class="btn btn-outline-danger btn-custom btn-sm flex-fill {{ $member->status == 0 ? 'disabled-link' : '' }} deactivation">
                                   <i class="bi bi-x-circle me-1"></i>Deactivate</a>
                                </div>
                            @endif
                            @else
                                <span class="text-muted small">No actions available</span>
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
                <h4 class="text-muted mb-3 fw-semibold">No Members Found</h4>
                <p class="text-muted mb-4">No members match your search criteria.</p>
                <a href="{{ route('admin.index') }}" class="btn btn-primary btn-lg rounded-pill mx-auto" style="width: fit-content;">
                    <i class="bi bi-house-door me-2"></i>Back to Families
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>

@if($members->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $members->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
</div>




@endif
