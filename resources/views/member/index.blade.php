<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Members</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="bi bi-people me-2"></i>Family Members ({{ $members->count() }})</h3>
                        <a href="{{ route('admin.index') }}" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i>Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Members List -->
        @forelse($members as $member)
            <div class="card border-0 shadow-sm mb-4">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('uploads/images/' . ($member->photo_path ?: 'noimage.png')) }}" 
                             class="img-fluid rounded-start h-100" 
                             style="object-fit: cover; min-height: 300px;" 
                             alt="Member Photo">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h4 class="text-primary fw-bold mb-0">{{ $member->name }}</h4>
                                
                            </div>

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="border rounded p-3 text-center bg-light">
                                        <i class="bi bi-calendar3 text-primary fs-5 mb-2"></i>
                                        <div class="small text-muted">Date of Birth</div>
                                        <div class="fw-bold">{{ date('M d, Y', strtotime($member->birthdate)) }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="border rounded p-3 text-center bg-light">
                                        <i class="bi bi-heart text-danger fs-5 mb-2"></i>
                                        <div class="small text-muted">Marital Status</div>
                                        <div class="fw-bold">{{ $member->marital_status ? 'Married' : 'Single' }}</div>
                                    </div>
                                </div>
                                @if($member->marital_status)
                                    <div class="col-sm-6">
                                        <div class="border rounded p-3 text-center bg-light">
                                            <i class="bi bi-calendar-heart text-success fs-5 mb-2"></i>
                                            <div class="small text-muted">Marriage Date</div>
                                            <div class="fw-bold">{{ date('M d, Y', strtotime($member->mariage_date)) }}</div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-sm-6">
                                    <div class="border rounded p-3 text-center bg-light">
                                        <i class="bi bi-mortarboard text-warning fs-5 mb-2"></i>
                                        <div class="small text-muted">Education</div>
                                        <div class="fw-bold">{{ $member->education ?: 'Not Provided' }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="border rounded p-3 text-center bg-light">
                                        <a href="{{ route('admin-member.edit', $member->id) }}" class="btn btn-success btn-sm mt-1 w-100">
                                            <i class="bi bi-pencil me-1"></i>Edit
                                        </a><br>
                                        <button type="button" class="btn btn-danger btn-sm mt-2 w-100" onclick="deleteMember({{ $member->id }})">
                                            <i class="bi bi-trash me-1"></i>Delete
                                        </button>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('adminFamilySection',$id)  }}" class="btn btn-success btn-sm mt-1 w-100 pt-4 pb-4"><i class="bi bi-plus-circle"></i> Add Member</a>

            
            <form id="deleteForm{{ $member->id }}" action="{{ route('admin-member.destroy', $member->id) }}" method="post" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        @empty
            <div class="text-center py-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body py-5">
                        <i class="bi bi-people display-1 text-muted mb-3"></i>
                        <h5 class="text-muted">No Family Members Added Yet</h5>
                        <p class="text-muted">Start by adding your first family member.</p>
                        <a href="{{ route('adminFamilySection',$id)  }}" class="btn btn-success btn-sm mt-1 w-100 pt-4 pb-4"><i class="bi bi-plus-circle"></i> Add Member</a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deleteMember(memberId) {
            if (confirm('⚠️ WARNING: This will permanently delete the member!\n\nThis action cannot be undone. Are you sure?')) {
                document.getElementById('deleteForm' + memberId).submit();
            }
        }
    </script>
</body>
</html>