<div class="row g-4">
    <div class="col-12">
        <style>
            .member-card {
                background: white;
                border-radius: 18px;
                overflow: hidden;
                box-shadow: 0 4px 20px rgba(0,0,0,0.08);
                transition: all 0.3s ease;
                border: none;
            }
            .member-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            }
            .origami-header {
                background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
                color: white;
                padding: 20px 25px;
                margin: 0;
                border-radius: 0;
            }
            .member-card.inactive .origami-header {
                background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
            }
            .pill-section {
                background: #f8f9fa;
                border-radius: 25px;
                padding: 12px 18px;
                margin: 8px 0;
                border: 1px solid #e9ecef;
            }
            .pill-info {
                background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
                border-radius: 20px;
                padding: 15px 20px;
                margin: 8px 0;
                border: 1px solid #e1f5fe;
            }
            .pill-stats {
                background: linear-gradient(135deg, #f1f8e9 0%, #e8f5e8 100%);
                border-radius: 20px;
                padding: 15px 20px;
                margin: 10px 0;
                border: 1px solid #c8e6c9;
            }
            .action-pill {
                background: #fff;
                border-radius: 15px;
                padding: 12px 15px;
                border: 1px solid #dee2e6;
            }
            .btn-pill {
                border-radius: 20px;
                padding: 6px 16px;
                font-size: 0.85rem;
                font-weight: 500;
                border: none;
                transition: all 0.2s ease;
            }
            .disabled-link {
                pointer-events: none;
                cursor: not-allowed;
                opacity: 0.4;
            }
        </style>

        @forelse ($members as $member)
        <div class="member-card mb-4 {{ $member->status == 1 ? 'active' : 'inactive' }}">
            <!-- Origami Header -->
            <div class="origami-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="{{ $member->photo_path ? asset('uploads/images/' . $member->photo_path) : asset('uploads/images/noimage.png') }}"
                             class="rounded-circle me-4"
                             width="60" height="60"
                             style="object-fit: cover; border: 3px solid rgba(255,255,255,0.3);"
                             alt="Member Photo">
                        <div>
                            <h5 class="mb-1 fw-bold">{{ ucfirst($member->name) }}</h5>
                            <small class="opacity-75">
                                <i class="bi bi-house-door me-1"></i>
                                @if($member->head)
                                    {{ ucfirst($member->head->name) }} {{ ucfirst($member->head->surname) }}
                                @else
                                    No Family Head
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="badge bg-light text-dark px-3 py-2 rounded-pill">
                            {{ $member->status == 1 ? 'Active' : 'Inactive' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-5">
                <!-- Member Info Pills -->
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <div class="pill-info text-center">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <i class="bi bi-calendar-heart text-primary me-2"></i>
                                <span class="fw-bold text-primary">{{ \Carbon\Carbon::parse($member->birthdate)->age }} Years</span>
                            </div>
                            <small class="text-muted d-block">
                                Born: {{ date('M d, Y', strtotime($member->birthdate)) }}
                            </small>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4">
                        <div class="pill-info">
                            <div class="text-center mb-2">
                                <i class="bi bi-diagram-3 text-warning me-1"></i>
                                <span class="fw-bold text-warning">
                                    @if($member->relation)
                                        {{ucfirst($member->relation) }}
                                    @else
                                        Family Member
                                    @endif
                                </span>
                            </div>
                            <div class="text-center">
                                <small class="text-muted">
                                    @if($member->head)
                                        <i class="bi bi-arrow-right me-1"></i>{{ $member->head->name }}
                                    @else
                                        No Head Assigned
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4">
                        <div class="pill-info">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <i class="bi bi-mortarboard text-info me-2"></i>
                                        <span class="fw-medium text-info">{{ ucfirst($member->education ?? 'Not specified') }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="bi bi-heart text-danger me-2"></i>
                                        <span class="fw-medium text-danger">
                                            @if($member->marital_status == 1)
                                                Married
                                                @if($member->mariage_date)
                                                    <small class="d-block text-muted">({{ date('M Y', strtotime($member->mariage_date)) }})</small>
                                                @endif
                                            @else
                                                Single
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Pill -->
                <div class="pill-stats mt-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <small class="text-muted">
                            <i class="bi bi-calendar3 me-1"></i>
                            Created: {{ $member->created_at->format('M d, Y') }}
                        </small>
                        @if($member->head)
                            <small class="fw-bold">
                                @if($member->head->status == '1')
                                    <span class="text-success">Family Active</span>
                                @elseif($member->head->status == '0')
                                    <span class="text-danger">Family Inactive</span>
                                @elseif($member->head->status == '9')
                                    <span class="text-secondary">Family Deleted</span>
                                @endif
                            </small>
                        @endif
                    </div>
                </div>

                <!-- Action Pills -->
                @if($member->head)
                <div class="action-pill mt-3">
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-primary btn-pill" data-bs-toggle="modal" data-bs-target="#memberModal{{ $member->id }}">
                            <i class="bi bi-three-dots me-1"></i>Actions
                        </button>
                        <a href="{{ route('admin.viewMemberDetails', $member->id) }}"
                           class="btn btn-info btn-pill {{ $member->status != 1 ? 'disabled-link' : '' }}">
                            <i class="bi bi-person me-1"></i>View Member
                        </a>
                        </a>
                    </div>
                </div>
                @else
                    <div class="action-pill mt-3">
                        <span class="text-muted small">No actions available - No family head assigned</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Member Action Modal -->
        <div class="modal fade" id="memberModal{{ $member->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 18px;">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold">Member Actions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-2">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.show', $member->head->id) }}"
                               class="btn btn-outline-primary rounded-pill {{ $member->status != 1 ? 'disabled-link' : '' }}">
                                <i class="bi bi-eye me-2"></i>View Family
                            </a>
                            <a href="{{ route('admin-member.edit', $member->id) }}"
                               class="btn btn-outline-warning rounded-pill {{ $member->status == 0 ? 'disabled-link' : '' }}">
                                <i class="bi bi-pencil me-2"></i>Edit Member
                            </a>
                            
                            @if($member->status == '0' and $member->head->status == '1')
                                <button data-id="{{ $member->id }}"
                                       class="btn btn-outline-success rounded-pill activation"
                                       data-bs-dismiss="modal">
                                    <i class="bi bi-check-circle me-2"></i>Activate Member
                                </button>
                            @elseif($member->status == '0' and $member->head->status == '0')
                                <a href="/dashboard/admin-profile"
                                   class="btn btn-outline-secondary rounded-pill"
                                   onclick="return confirm('Want to Activate this member? Click OK to go Admin Profile and Activate head {{$member->head->name}} {{$member->head->surname}}')">
                                    <i class="bi bi-exclamation-triangle me-2"></i>Activate Head First
                                </a>
                            @endif

                            @if($member->status == '1')
                                <button data-id="{{ $member->id }}"
                                       class="btn btn-outline-secondary rounded-pill deactivation"
                                       data-bs-dismiss="modal">
                                    <i class="bi bi-pause-circle me-2"></i>Deactivate Member
                                </button>
                            @endif
                            
                            <hr class="my-2">
                            <button data-id="{{ $member->id }}"
                                   class="btn btn-outline-danger rounded-pill delete1"
                                   data-bs-dismiss="modal">
                                <i class="bi bi-trash me-2"></i>Delete Member
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
    $(document).ready(function(){
        console.log('Document ready, jQuery loaded');

        $(document).on('click', '.activation', function(e){
            console.log('Activation button clicked');
            e.preventDefault();

            if(!confirm('Are you sure you want to activate this member?')) {
                return;
            }

            var headId = $(this).data('id');
            console.log('Head ID:', headId);

            $.ajax({
                type: 'POST',
                url: '/dashboard/admin-profile/activatemember2/' + headId,
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response){
                    console.log('Response:', response);
                    if(response.status === 'success'){
                        alert(response.message + ' User: ' + response.name );
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error){
                    console.log('AJAX Error:', xhr.responseText);
                    alert('An error occurred: ' + (xhr.responseJSON?.message || xhr.responseText));
                }
            });
        });

        $(document).on('click', '.deactivation', function(e){
            console.log('deactivation button clicked');
            e.preventDefault();

            if(!confirm('Are you sure you want to deactivate this member?')) {
                return;
            }

            var headId = $(this).data('id');
            console.log('Head ID:', headId);

            $.ajax({
                type: 'POST',
                url: '/dashboard/admin-profile/deactivatemember/' + headId,
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response){
                    console.log('Response:', response);
                    if(response.status === 'success'){
                        alert(response.message + ' User: ' + response.name );
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error){
                    console.log('AJAX Error:', xhr.responseText);
                    alert('An error occurred: ' + (xhr.responseJSON?.message || xhr.responseText));
                }
            });
        });

        $(document).on('click', '.delete1', function(e){
            console.log('delete button clicked');
            e.preventDefault();

            if(!confirm('Are you sure you want to delete this member?')) {
                return;
            }

            var headId = $(this).data('id');
            console.log('Head ID:', headId);

            $.ajax({
                type: 'POST',
                url: '/member/delete/' + headId,
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response){
                    console.log('Response:', response);
                    if(response.status === 'success'){
                        alert(response.message + ' User: ' + response.name );
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error){
                    console.log('AJAX Error:', xhr.responseText);
                    alert('An error occurred: ' + (xhr.responseJSON?.message || xhr.responseText));
                }
            });
        });
    });
</script>
@endif


