<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Header -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="bi bi-people me-2"></i>Family Members ({{ $members->count() }})</h3>
                    </div>
                </div>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <i class="bi bi-check-circle me-2"></i>({{ session('name') }} {{ session('surname') }}) :
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @forelse($members as $member)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if(empty($member->photo_path))
                            <img src="{{ asset('uploads/images/noimage.png') }}" class="img-fluid rounded-start h-100"
                                style="object-fit: cover; min-height: 250px;" alt="No Image">
                            @else
                            <img src="{{ asset('uploads/images/' . $member->photo_path) }}"
                                class="img-fluid rounded-start h-100" style="object-fit: cover; min-height: 250px;"
                                alt="Member Photo">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h4 class="card-title text-primary fw-bold mb-4">{{ $member->name }}</h4>

                                <div class="row g-3">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="border rounded p-3 text-center bg-light">
                                            <i class="bi bi-calendar3 text-primary fs-4 mb-2 d-block"></i>
                                            <small class="text-muted d-block mb-1">Date of Birth</small>
                                            <strong
                                                class="d-block">{{ date('M d, Y', strtotime($member->birthdate)) }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="border rounded p-3 text-center bg-light">
                                            <i class="bi bi-heart text-danger fs-4 mb-2 d-block"></i>
                                            <small class="text-muted d-block mb-1">Marital Status</small>
                                            <strong
                                                class="d-block">{{ $member->marital_status ? 'Married' : 'Single' }}</strong>
                                        </div>
                                    </div>
                                    @if($member->marital_status)
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="border rounded p-3 text-center bg-light">
                                            <i class="bi bi-calendar-heart text-success fs-4 mb-2 d-block"></i>
                                            <small class="text-muted d-block mb-1">Marriage Date</small>
                                            <strong
                                                class="d-block">{{ date('M d, Y', strtotime($member->mariage_date)) }}</strong>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="border rounded p-3 text-center bg-light">
                                            <i class="bi bi-mortarboard text-warning fs-4 mb-2 d-block"></i>
                                            <small class="text-muted d-block mb-1">Education</small>
                                            <strong class="d-block">{{ $member->education ?: 'Not Provided' }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="border rounded p-3 text-center bg-light">
                                            <a href="{{ route("admin-member.edit", $member->id)  }}"
                                                class="btn btn-success btn-sm w-100 mt-1 pt-2 pb-2 ">
                                                <i class="bi bi-pencil-square me-1"></i>Edit Members
                                            </a>
                                            <form action="{{ route("admin-member.destroy", $member->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="deleteBtn"
                                                    class="btn btn-danger  btn-sm w-100 mt-2 pt-2 pb-2 ">
                                                    <i class="bi bi-trash3"></i>Delete Members
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body py-5">
                            <i class="bi bi-people display-1 text-muted mb-3"></i>
                            <h5 class="text-muted">No Family Members Added Yet</h5>
                            <p class="text-muted">Start by adding your first family member using the form above.</p>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const deleteButton = document.getElementById('deleteBtn');

if (deleteButton) {
    deleteButton.addEventListener('click', function(event) {
        if (!confirm(
                ' WARNING: This will permanently delete the member and ALL their data!\n\nThis action cannot be undone. Are you absolutely sure?'
            )) {
            event.preventDefault();
        }
    });
}
</script>

</html>