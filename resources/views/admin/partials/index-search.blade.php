
        <div class="row">
            <div class="col-12">
                @forelse ($heads as $user)
                <div class="card shadow-sm mb-3 rounded-4" style="transition: all 0.2s;" onmouseover="this.style.transform='scale(1.01)'" onmouseout="this.style.transform='scale(1)'">
                    <div class="card-body p-4">
                        <div class="row align-items-center g-3">
                            <!-- Profile Image -->
                            <div class="col-md-2 text-center">
                                <img src="{{ asset('uploads/images/' . $user->photo_path) }}"
                                     class="rounded-circle border border-3 border-primary shadow"
                                     style="width: 90px; height: 90px; object-fit: cover;" alt="Family Head Photo">
                            </div>
                            
                            <!-- Family Info -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge rounded-pill" style="background: linear-gradient(45deg, #667eea, #764ba2); padding: 8px 15px;">
                                        <i class="bi bi-house-heart me-2"></i>{{ $user->name }}'s Family
                                    </span>
                                </div>
                                <h5 class="fw-bold mb-3">{{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}</h5>
                                <div class="row g-2">
                                    <div class="col-sm-6">
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="bi bi-calendar3 text-primary me-2"></i>
                                            {{ date('M d, Y', strtotime($user->birthdate)) }}
                                        </small>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="bi bi-telephone text-success me-2"></i>
                                            {{ $user->mobile }}
                                        </small>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="bi bi-geo-alt text-info me-2"></i>
                                            {{ ucfirst($user->city) }}, {{ ucfirst($user->state) }}
                                        </small>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="badge bg-success rounded-pill">
                                            <i class="bi bi-people me-1"></i>{{ $user->members->count() + 1 }} Members
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="col-md-4">
                                <div class="d-grid gap-3">
                                    <a href="{{ route('admin.show', $user->id) }}" class="btn btn-primary" style="border-radius: 25px; padding: 12px 20px;">
                                        <i class="bi bi-eye me-2"></i>View Details
                                    </a>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-outline-warning w-100" style="border-radius: 25px; padding: 10px 15px;">
                                                <i class="bi bi-pencil me-1"></i>Edit Head
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('admin-member.show',$user->id) }}" class="btn btn-outline-info w-100" style="border-radius: 25px; padding: 10px 15px;">
                                                <i class="bi bi-people me-1"></i>Edit Members
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card shadow rounded-4">
                        <div class="card-body text-center py-5">
                            <div class="mb-4">
                                <i class="bi bi-people display-1 text-muted opacity-50"></i>
                            </div>
                            <h4 class="text-muted mb-3 fw-semibold">No Head Available</h4>
                            <p class="text-muted mb-4">Start building your family tree by introducing Head.</p>
                            <a href="/headview" class="btn btn-primary btn-lg rounded-pill">
                                <i class="bi bi-plus-circle me-2"></i>Add Head
                            </a>
                        </div>
                    </div>
                </div>
        
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($heads->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $heads->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
        </div>
        @endif

