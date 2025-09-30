@if($head->status == '0')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Family Inactive - Family Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/heading.css') }}">
        <style>
            .active-class-2 { background-color: #198754; color: white; transform: translateX(5px); }
            .status-icon { font-size: 4rem; color: #ffc107; margin-bottom: 1rem; animation: pulse 2s infinite; }
            @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.1); } 100% { transform: scale(1); } }
        </style>
    </head>
    <body class="bg-light">
        <div id="mainContent">
            @include('partials.navbar2', ['shouldShowDiv' => true])
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card shadow rounded-4">
                            <div class="card-header bg-warning text-dark text-center py-3 rounded-top-4">
                                <h2 class="mb-1 fw-bold"><i class="bi bi-x-circle me-2"></i>Family Inactive</h2>
                                <p class="mb-0 opacity-75">This family is currently inactive</p>
                            </div>
                            <div class="card-body p-5 text-center">
                                <div class="status-icon"><i class="bi bi-x-circle"></i></div>
                                <h4 class="fw-bold text-dark mb-3">Access Restricted</h4>
                                <p class="text-muted mb-4 lead">This family's profile is currently inactive and cannot be viewed.</p>
                                <div class="alert alert-warning border-0 mb-4">
                                    <i class="bi bi-info-circle me-2"></i>Contact administrator to activate this family.
                                </div>
                                <a href="{{ route('admin.index') }}" class="btn btn-primary rounded-pill px-4">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Families
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
 @elseif($head->status == '9')
     <!DOCTYPE html>
     <html lang="en">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Family Deleted - Family Management System</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
         <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
         <link rel="stylesheet" href="{{ asset('css/heading.css') }}">
         <style>
             .active-class-2 { background-color: #198754; color: white; transform: translateX(5px); }
             .status-icon { font-size: 4rem; color: #dc3545; margin-bottom: 1rem; animation: pulse 2s infinite; }
             @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.1); } 100% { transform: scale(1); } }
         </style>
     </head>
     <body class="bg-light">
         <div id="mainContent">
             @include('partials.navbar2', ['shouldShowDiv' => true])
             <div class="container py-4">
                 <div class="row justify-content-center">
                     <div class="col-lg-6">
                         <div class="card shadow rounded-4">
                             <div class="card-header bg-danger text-white text-center py-3 rounded-top-4">
                                 <h2 class="mb-1 fw-bold"><i class="bi bi-trash me-2"></i>Family Deleted</h2>
                                 <p class="mb-0 opacity-75">This family has been deleted</p>
                             </div>
                             <div class="card-body p-5 text-center">
                                 <div class="status-icon"><i class="bi bi-trash"></i></div>
                                 <h4 class="fw-bold text-dark mb-3">No Longer Available</h4>
                                 <p class="text-muted mb-4 lead">This family's profile has been permanently deleted and is no longer accessible.</p>
                                 <div class="alert alert-danger border-0 mb-4">
                                     <i class="bi bi-exclamation-triangle me-2"></i>This family data has been removed from the system.
                                 </div>
                                 <a href="{{ route('admin.index') }}" class="btn btn-primary rounded-pill px-4">
                                     <i class="bi bi-arrow-left me-2"></i>Back to Families
                                 </a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     </body>
     </html>
 @else
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Members - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">
    <style>
        .active-class-2{
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            color : white;
            transform: translateX(5px);
        }
        .inactive-member {
            background: linear-gradient(135deg, #ffe6e6 0%, #ffcccc 100%);
            border: 2px solid #dc3545;
            opacity: 0.85;
            transform: scale(0.98);
        }
        .inactive-member .member-image {
            filter: grayscale(60%) sepia(30%) hue-rotate(320deg) saturate(1.5) brightness(0.8) contrast(1.1);
            position: relative;
        }
        .inactive-member .member-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(220, 53, 69, 0.2) 0%, rgba(220, 53, 69, 0.1) 100%);
            border-radius: inherit;
        }
        .inactive-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            z-index: 10;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: 2px solid #fff;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.4);
            animation: pulse-badge 2s infinite;
        }
        @keyframes pulse-badge {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .inactive-member .card-body {
            background: rgba(248, 249, 250, 0.8);
        }
        .inactive-member h5 {
            color: #dc3545 !important;
            text-shadow: 1px 1px 2px rgba(220, 53, 69, 0.1);
        }
        .inactive-member .text-danger {
            filter: brightness(0.9);
        }
        .inactive-section {
            background: linear-gradient(135deg, #fff5f5 0%, #ffeaea 100%);
            border-radius: 15px;
            padding: 20px;
            margin-top: 30px;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }
        .inactive-section h4 {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>

</head>

<body class="bg-light">

    <div id="mainContent">
        @include('partials.navbar2', ['shouldShowDiv' => true])

        <div class="container py-4" style="z-index : 0">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow rounded-4">
                        <div class="card-header bg-primary text-white py-3 rounded-top-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="text-white mb-1 fw-bold">
                                        <span class="text-white-50">
                                            <i class="bi bi-people-fill me-2"></i>
                                            {{ $head->name . ' ' . $head->surname . '\'s ' }}
                                        </span>
                                        Family Members
                                    </h2>
                                    <p class="text-white-50 mb-0">{{ $head->members->count() }}
                                        member{{ $members->count() !== 1 ? 's' : '' }} found</p>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.index') }}" class="btn btn-light rounded-pill">
                                        <i class="bi bi-arrow-left me-1 mt-1 mb-0"></i>Back to Manage Families
                                    </a>
                                    <a href="{{ route('adminFamilySection', $id) }}"
                                        class="btn btn-success rounded-pill">
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
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-pill">
                    <i class="bi bi-cross-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Active Members Section -->
            @php
                $activeMembers = $members->where('status', '1');
                $inactiveMembers = $head->members()->where('status', '0')->get();
            @endphp

            @if($activeMembers->count() > 0)
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="text-success fw-bold mb-3">
                            <i class="bi bi-check-circle me-2"></i>Active Members ({{ $activeMembers->count() }})
                        </h4>
                    </div>
                </div>
                <div class="row">
                    @foreach($activeMembers as $member)
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
                                                <i class="bi bi-people text-primary me-2"></i>
                                                <small class="text-muted fw-semibold">Relation:</small>
                                                @if($member->relation)
                                                    <div class="fw-semibold">{{ ucfirst($member->relation) }}</div>
                                                @else
                                                        <div  class="fw-semibold" >Relation not defined yet</div>
                                                @endif

                                            </div>

                                            <div class="mb-2">
                                                <i
                                                    class="bi bi-heart{{ $member->marital_status ? '-fill' : '' }} text-{{ $member->marital_status ? 'danger' : 'secondary' }} me-2"></i>
                                                <small class="text-muted fw-semibold">Status:</small>
                                                <div class="fw-semibold">
                                                    {{ $member->marital_status ? 'Married' : 'Single' }}
                                                </div>
                                            </div>

                                            @if($member->marital_status && $member->mariage_date)
                                                <div class="mb-2">
                                                    <i class="bi bi-calendar-heart text-success me-2"></i>
                                                    <small class="text-muted fw-semibold">Married:</small>
                                                    <div class="fw-semibold">
                                                        {{ date('M d, Y', strtotime($member->mariage_date)) }}
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
                                                <a href="{{ route('admin-member.edit', Crypt::encryptString($member->id)) }}"
                                                    class="btn btn-primary btn-sm rounded-pill">
                                                    <i class="bi bi-pencil me-1"></i>Edit
                                                </a>
                                                <form action="{{ route('member.deactivate', $member->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-warning btn-sm rounded-pill w-100">
                                                        <i class="bi bi-pause-circle me-1"></i>Deactivate
                                                    </button>
                                                </form>
                                                <a href="{{ route('member.delete', $member->id) }}"
                                                                                                                    class="btn btn-danger btn-sm rounded-pill delete1"
                                                                                                                      data-id="{{  $member->id }}">
                                                                                                                    <i class="bi bi-trash me-1"></i>Delete
                                                                                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    @endforeach
                </div>
                @if($members->count() > 0)
                    {{ $members->links('pagination::bootstrap-4') }}
                @endif
            @endif



            @if($activeMembers->count() == 0)
                    <div class="col-12">
                        <div class="card shadow rounded-4">
                            <div class="card-body text-center py-5">
                                <div class="mb-4">
                                    <i class="bi bi-people display-1 text-muted opacity-50"></i>
                                </div>
                                <h4 class="text-muted mb-3 fw-semibold">No Family Members Yet</h4>
                                <p class="text-muted mb-4">Start building your family tree by adding the first member.</p>
                                <a href="{{ route('adminFamilySection', $id) }}"
                                    class="btn btn-primary btn-lg rounded-pill">
                                    <i class="bi bi-plus-circle me-2"></i>Add First Member
                                </a>
                            </div>
                        </div>
                    </div>
            @endif

            <!-- Inactive Members Section -->
                        @if($inactiveMembers->count() > 0)
                            <div class="inactive-section">
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h4 class="text-danger fw-bold mb-3">
                                            <i class="bi bi-x-circle me-2"></i>Inactive Members ({{ $inactiveMembers->count() }})
                                        </h4>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach($inactiveMembers as $member)
                                    <div class="col-lg-6 mb-4">
                                        <div class="card shadow h-100 rounded-4 inactive-member border-danger">
                                            <div class="row g-0 h-100 position-relative">

                                                <div class="col-5">
                                                    <img src="{{ asset('uploads/images/' . ($member->photo_path ?: 'noimage.png')) }}"
                                                        class="img-fluid h-100 rounded-start member-image" style="object-fit: cover;"
                                                        alt="{{ $member->name }}">
                                                </div>
                                                <div class="col-7">
                                                    <div class="card-body p-3 d-flex flex-column h-100">
                                                        <div class="mb-3">
                                                            <h5 class="text-danger fw-bold mb-1">{{ $member->name }}</h5>
                                                            <small class="text-muted">Inactive Member</small>
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <div class="mb-2">
                                                                <i class="bi bi-calendar3 text-danger me-2"></i>
                                                                <small class="text-muted fw-semibold">Born:</small>
                                                                <div class="fw-semibold">{{ date('M d, Y', strtotime($member->birthdate)) }}</div>
                                                            </div>

                                                            <div class="mb-2">
                                                                <i class="bi bi-people text-danger me-2"></i>
                                                                <small class="text-muted fw-semibold">Relation:</small>
                                                                @if($member->relation)
                                                                    <div class="fw-semibold">{{ ucfirst($member->relation) }}</div>
                                                                @else
                                                                    <div class="fw-semibold">Relation not defined yet</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="mt-auto">
                                                            <div class="d-grid gap-2">
                                                                <form action="{{ route('member.activate', $member->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit" class="btn btn-success btn-sm rounded-pill w-100">
                                                                        <i class="bi bi-check-circle me-1"></i>Activate
                                                                    </button>
                                                                </form>
                                                                <a href="{{ route('member.delete', $member->id) }}"
                                                                    class="btn btn-danger btn-sm rounded-pill delete1"
                                                                      data-id="{{  $member->id }}">
                                                                    <i class="bi bi-trash me-1"></i>Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif



        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script>
        const deleteButtons = document.getElementsByClassName('deleteBtn');

        for (let i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener('click', function (event) {
                if (!confirm(
                    'WARNING: This will permanently delete the "Family Member" and all included information! This action cannot be undone. Are you sure?'
                )) {
                    event.preventDefault();
                }
            });
        }
    </script>

</body>

<script>
    $(document).ready(function(){
        console.log('Document ready, jQuery loaded');
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

</html>
@endif


