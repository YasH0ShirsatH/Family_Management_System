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
                border: 2px solid #007bff;
            }

            /* Badges and text */
            .family-name-badge {
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
        </style>

        @forelse ($heads as $user)
        <div class="card table-row-card mb-3">
            <div class="card-body p-3">
                <div class="row align-items-center g-3">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('uploads/images/' . $user->photo_path) }}"
                                 class="profile-img-small me-3" alt="Family Head Photo">
                            <div>
                                <h6 class="mb-1 fw-bold">{{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}</h6>
                                <span class="family-name-badge">
                                    <i class="bi bi-house-heart me-1"></i>{{ $user->name }}'s Family
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-5">
                        <div class="row g-2">
                            <div class="col-sm-6 d-flex align-items-center">
                                <i class="bi bi-telephone info-icon"></i>
                                <span class="info-text">{{ $user->mobile }}</span>
                            </div>
                            <div class="col-sm-6 d-flex align-items-center">
                                <i class="bi bi-geo-alt info-icon"></i>
                                <span class="info-text">{{ ucfirst($user->city) }}, {{ ucfirst($user->state) }}</span>
                            </div>
                            <div class="col-sm-6 d-flex align-items-center">
                                <i class="bi bi-calendar3 info-icon"></i>
                                <span class="info-text">{{ date('M d, Y', strtotime($user->birthdate)) }}</span>
                            </div>
                            <div class="col-sm-6 d-flex align-items-center">
                                <i class="bi bi-people info-icon text-success"></i>
                                <span class="text-success fw-bold">{{ $user->members->where('status','1')->count()  }} Members</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 text-md-end">
                        <div class="d-flex flex-column flex-sm-row justify-content-md-end gap-2">
                            <a href="{{ route('admin.show', $user->id) }}" class="btn btn-primary btn-table">
                                <i class="bi bi-eye"></i> View Data
                            </a>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-outline-secondary btn-table"  data-toggle="tooltip" data-placement="left" title="Edit and Delete Head data">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{ route('admin-member.show',$user->id) }}" class="btn btn-outline-secondary btn-table"  data-toggle="tooltip" data-placement="left" title="Edit and delete Members data">
                                    <i class="bi bi-people"></i>
                                </a>
                            </div>
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