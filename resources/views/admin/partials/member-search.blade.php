<div class="row">
    <div class="col-12">
        <style>
            /* General body and font styles */
            body {
                font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
                background-color: #f8f9fa;
            }

            /* Card styling for the table-row look */
            .table-row-card {
                border: 1px solid #e9ecef;
                border-radius: 8px;
                box-shadow: none;
                transition: all 0.2s ease;
            }

            .table-row-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            }

            /* Profile image styling */
            .profile-img-small {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                object-fit: cover;
                border: 2px solid #28a745;
            }

            /* Badges and text */
            .member-name-badge {
                background-color: #f0f0f5;
                color: #495057;
                font-weight: 600;
                padding: 4px 12px;
                border-radius: 15px;
            }

            .info-icon {
                color: #6c757d;
                font-size: 1rem;
                margin-right: 8px;
            }

            .info-text {
                color: #343a40;
                font-weight: 500;
            }

            /* Action Buttons */
            .btn-table {
                padding: 8px 15px;
                border-radius: 20px;
                font-size: 0.875rem;
                white-space: nowrap;
            }

            /* Responsive spacing for cards */
            @media (max-width: 768px) {
                .table-row-card {
                    margin-bottom: 1rem;
                }
                .table-row-card .card-body {
                    padding: 1.5rem !important;
                }
                .profile-img-small {
                    width: 50px;
                    height: 50px;
                }
                .btn-sm {
                    padding: 6px 12px;
                    font-size: 0.8rem;
                }
            }

            @media (max-width: 576px) {
                .table-row-card .card-body {
                    padding: 1rem !important;
                }
                .d-flex.gap-2 {
                    flex-direction: column;
                    gap: 0.5rem !important;
                }
                .btn-sm {
                    width: 100%;
                    margin-bottom: 0.25rem;
                }
            }
        </style>

        @forelse ($members as $member)
        <div class="card table-row-card mb-2">
            <div class="card-body p-3">
                <div class="row align-items-center g-3">
                    <div class="col-12 col-md-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ $member->photo_path ? asset('uploads/images/' . $member->photo_path) : asset('uploads/images/noimage.png') }}"
                                 class="profile-img-small me-3" alt="Member Photo">
                            <div>
                                <h6 class="mb-1 fw-bold">{{ ucfirst($member->name) }}</h6>
                                <small class="text-muted">Status :
                                        @if($member->status == '1')
                                            <span class="text-success">Active</span>
                                        @else
                                            <span class="text-danger">Inactive</span>
                                        @endif
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

                    <div class="col-12 col-md-5">
                        <div class="row g-2">
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar3 info-icon"></i>
                                    <span class="info-text small">{{ date('M d, Y', strtotime($member->birthdate)) }}</span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-mortarboard info-icon"></i>
                                    <span class="info-text small">{{ ucfirst($member->education ?? 'Not specified') }}</span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-heart info-icon"></i>
                                    <span class="info-text small">
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
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-badge info-icon text-primary"></i>
                                    <span class="text-primary fw-bold small">
                                        Age: {{ \Carbon\Carbon::parse($member->birthdate)->age }} years
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="d-flex flex-column flex-md-row justify-content-md-end gap-2">
                            @if($member->head)
                                <div class="d-flex gap-2 flex-column">
                                    <a href="{{ route('admin.show', $member->head->id) }}" class="btn btn-outline-primary btn-sm">
                                                                        <i class="bi bi-eye me-1"></i>View Family
                                                                    </a>
                                    <a href="{{ route('admin.viewMemberDetails', $member->id) }}" class="btn btn-outline-primary btn-sm">
                                                                        <i class="bi bi-eye me-1"></i>View Member
                                                                    </a>
                                    </div>
                                <div class="d-flex gap-2 flex-column">
                                    <a href="{{ route('admin-member.edit', $member->id) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-pencil me-1"></i>Edit Member
                                    </a>
                                <a href="{{ route('member.delete', $member->id) }}" class=" delete-btn btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash me-1"></i>Delete Member
                                    </a>
                                 </div>
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

<script>


        const deleteButtons = document.querySelectorAll('.delete-btn');


        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                // Show the confirmation dialog
                if (!confirm('WARNING: This will permanently delete the head and ALL family members! This action cannot be undone. Are you sure?')) {
                    // If the user clicks "Cancel", prevent the link/form from submitting
                    event.preventDefault();
                }
            });
        });
    </script>
@endif
