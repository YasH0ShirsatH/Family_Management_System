<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Members - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">

</head>

<body class="bg-light">
    @include('partials.navbar2',['shouldShowDiv' => true])


    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary text-white py-3 rounded-top-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="text-white mb-1 fw-bold"><i class="bi bi-people-fill me-2"></i>Family Members
                                </h2>
                                <p class="text-white-50 mb-0">{{ $members->count() }}
                                    member{{ $members->count() !== 1 ? 's' : '' }} found</p>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.index') }}" class="btn btn-light rounded-pill">
                                    <i  class="bi bi-arrow-left me-1 mt-1 mb-0"></i>Back to Manage Families
                                </a>
                                <a href="{{ route('adminFamilySection',$id) }}" class="btn btn-success rounded-pill">
                                    <i class="bi bi-plus-circle me-1"></i>Add Member
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-pill">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row">
            @forelse($members as $member)
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100 rounded-4">
                    <div class="row g-0 h-100">
                        <div class="col-5">
                            <img src="{{ asset('uploads/images/' . ($member->photo_path ?: 'noimage.png')) }}"
                                class="img-fluid h-100 rounded-start" style="object-fit: cover;"
                                alt="{{ $member->name }}">
                        </div>
                        <div class="col-7">
                            <div class="card-body p-3 d-flex flex-column h-100">
                                <div class="mb-3">
                                    <h5 class="text-primary fw-bold mb-1">{{ $member->name }}</h5>
                                    <small class="text-muted">Family Member</small>
                                </div>

                                <div class="flex-grow-1">
                                    <div class="mb-2">
                                        <i class="bi bi-calendar3 text-primary me-2"></i>
                                        <small class="text-muted fw-semibold">Born:</small>
                                        <div class="fw-semibold">{{ date('M d, Y', strtotime($member->birthdate)) }}
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <i
                                            class="bi bi-heart{{ $member->marital_status ? '-fill' : '' }} text-{{ $member->marital_status ? 'danger' : 'secondary' }} me-2"></i>
                                        <small class="text-muted fw-semibold">Status:</small>
                                        <div class="fw-semibold">{{ $member->marital_status ? 'Married' : 'Single' }}
                                        </div>
                                    </div>

                                    @if($member->marital_status && $member->mariage_date)
                                    <div class="mb-2">
                                        <i class="bi bi-calendar-heart text-success me-2"></i>
                                        <small class="text-muted fw-semibold">Married:</small>
                                        <div class="fw-semibold">{{ date('M d, Y', strtotime($member->mariage_date)) }}
                                        </div>
                                    </div>
                                    @endif

                                    @if($member->education)
                                    <div class="mb-2">
                                        <i class="bi bi-mortarboard text-warning me-2"></i>
                                        <small class="text-muted fw-semibold">Education:</small>
                                        <div class="fw-semibold">{{ $member->education }}</div>
                                    </div>
                                    @endif
                                </div>

                                <div class="mt-auto">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin-member.edit', $member->id) }}"
                                            class="btn btn-primary btn-sm rounded-pill">
                                            <i class="bi bi-pencil me-1"></i>Edit
                                        </a>
                                        <a href="{{ route('member.delete', $member->id) }}"
                                            class="btn btn-danger btn-sm rounded-pill deleteBtn">
                                            <i class="bi bi-trash me-1 "></i>Delete
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
                        <h4 class="text-muted mb-3 fw-semibold">No Family Members Yet</h4>
                        <p class="text-muted mb-4">Start building your family tree by adding the first member.</p>
                        <a href="{{ route('adminFamilySection',$id) }}" class="btn btn-primary btn-lg rounded-pill">
                            <i class="bi bi-plus-circle me-2"></i>Add First Member
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
        {{ $members->links() }}
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script>
    const deleteButtons = document.getElementsByClassName('deleteBtn');

    for (let i = 0; i < deleteButtons.length; i++) {
        deleteButtons[i].addEventListener('click', function(event) {
            if (!confirm(
                    'WARNING: This will permanently delete the "Family Member" and all included information! This action cannot be undone. Are you sure?'
                )) {
                event.preventDefault();
            }
        });
    }
    </script>

</body>

</html>