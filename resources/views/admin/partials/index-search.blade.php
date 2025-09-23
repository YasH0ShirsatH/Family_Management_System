<div class="row">
    <div class="col-12">
    <style>
        .disabled-link {
          pointer-events: none;
          cursor: default;
          opacity: 0.6;
        }
        </style>

        @forelse ($heads as $user)
        <div class="card shadow-sm border-0 rounded-3 mb-3">
            <div class="card-body">
                <div class="row align-items-center g-3">
                    <div class="col-12 col-md-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('uploads/images/' . $user->photo_path) }}"
                                 class="rounded-circle me-3 border border-primary" width="60" height="60" style="object-fit: cover;" alt="Family Head Photo">
                            <div>
                                <h6 class="mb-1 fw-bold">{{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}</h6>
                                <small class="text-muted">Created At: {{ $user->created_at->format('l, F jS, Y ') }}</small>
                                                                <br>
                                <small class="text-muted"> Status:
                                    @if($user->status == 1)
                                        <span class="text-success fw-semibold">Active</span>
                                    @else
                                        <span class="text-danger fw-semibold">Inactive</span>
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-5">
                        <div class="row g-2">
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-telephone text-primary me-2"></i>
                                    <span class="text-dark fw-medium small">{{ $user->mobile }}</span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-geo-alt text-primary me-2"></i>
                                    <span class="text-dark fw-medium small">{{ ucfirst($user->city) }}, {{ $user->state }}</span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar3 text-primary me-2"></i>
                                    <span class="text-dark fw-medium small">{{ date('M d, Y', strtotime($user->birthdate)) }}</span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-people text-success me-2"></i>
                                    <span class="text-success fw-bold small">
                                        @if($user->status == '0')
                                            {{ $user->members->whereIn('status',['1','0'])->count() + 1 }}
                                        @elseif($user->status == '1')
                                            {{ $user->members->where('status','1')->count() + 1 }}
                                        @endif
                                        Total Members</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="d-flex flex-column flex-md-row justify-content-md-end  gap-2">
                             @if($user->status == '0')<div class = 'd-flex flex-column'>@endif
                                <a href="{{ route('admin.show', $user->id) }}"
                                @if($user->status == '1')
                                    class="btn btn-primary mb-2  btn-sm"
                                @else
                                 class="disabled-link btn btn-primary mb-2  btn-sm"
                                @endif
                                 >
                                     <i class="bi bi-eye me-1 "></i>View Details
                                </a>
                                <a href="{{ route('admin.fulledit', $user->id) }}"
                                @if($user->status == '1')
                                                                    class="btn btn-warning mb-2  btn-sm"
                                                                @else
                                                                 class="disabled-link btn btn-warning mb-2  btn-sm"
                                                                @endif
                                >
                                     <i class="bi bi-pencil me-1"></i> Edit Head and Members
                                </a>
                             @if($user->status == '0')</div>@endif


                            <div class="d-flex flex-column" >
                                <a href="{{ route('admin-member.show',$user->id) }}"
                                @if($user->status == '1')
                                                                    class="btn btn-outline-info mb-2  btn-sm"
                                                                @else
                                                                 class="disabled-link btn btn-outline-info mb-2  btn-sm"
                                                                @endif
                                >
                                    <i class="bi bi-people me-1"></i>
                                </a>
                                @if($user->status == '0')
                                    <a href="{{ route('delete',$user->id) }}"   class="btn  btn-outline-danger btn-sm" id="deleteBtn">
                                         <i class="bi bi-trash me-1"></i>
                                    </a>
                                @endif
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
