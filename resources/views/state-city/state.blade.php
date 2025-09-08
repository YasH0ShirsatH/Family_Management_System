<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>State Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-pill mt-4 mx-5">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<body class="bg-light">
    <div class="container py-4">
        <!-- Header Card -->
        <div class="card shadow mb-4 border-0" style="border-radius: 20px;">
            <div class="card-header bg-gradient bg-primary text-white py-4 border-0"
                style="border-radius: 20px 20px 0 0;">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h3 class="mb-1 fw-bold">
                            <i class="bi bi-map me-2"></i>State Management
                        </h3>
                        <p class="mb-0 opacity-75">Manage all states and their cities</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="/admin" class="btn btn-light rounded-pill px-4 py-2 fw-semibold">
                            <i class="bi bi-arrow-left me-2"></i>Dashboard
                        </a>
                        <a href="{{ route('create.state') }}"
                            class="btn btn-success rounded-pill px-4 py-2 fw-semibold">
                            <i class="bi bi-plus-circle me-2"></i>Add State
                        </a>
                        <a href="/admin/state-city/city" class="btn btn-warning rounded-pill px-4 py-2 fw-semibold">
                            <i class="bi bi-buildings me-2"></i>Cities
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search Bar -->
        <div class="card shadow mb-4 border-0" style="border-radius: 20px;">
            <div class="card-body p-4">
                <form action="{{ route('state.index') }}" method="post">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-primary text-white border-0">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" name="search" class="form-control border-0 shadow-sm"
                                    placeholder="Search states... by ( #Id , Name , Type , Level )" value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-semibold">
                                    <i class="bi bi-search me-2"></i>Search States 
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6 mb-3">
                <div class="card bg-primary text-white border-0 h-100" style="border-radius: 20px;">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-geo-alt display-4 mb-3"></i>
                        <h3 class="fw-bold mb-1">{{ $state_count }}</h3>
                        <p class="mb-0 opacity-75">Total States</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card bg-success text-white border-0 h-100" style="border-radius: 20px;">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-buildings display-4 mb-3"></i>
                        <h3 class="fw-bold mb-1">
                            {{ $city_count}}</h3>
                        <p class="mb-0 opacity-75">Total Cities</p>
                    </div>
                </div>
            </div>

        </div>


        <!-- States List -->
        <div class="row">
            @foreach ($states as $index => $item)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 20px; transition: all 0.3s;"
                    onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow=''">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-gradient bg-primary rounded-circle p-3 me-3">
                                <i class="bi bi-geo-alt text-white fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="mb-1 fw-bold text-dark">{{ $item->name }}</h5>
                                <small class="text-muted">State #{{ $item->id }}</small>
                            </div>
                        </div>

                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-success rounded-pill px-3 py-2 fs-6">
                                    <i class="bi bi-buildings me-1"></i>{{ $item->cities->count() }} Cities
                                </span>
                                @if($item->cities->count() > 0)
                                <small class="text-success fw-semibold"><i
                                        class="bi bi-check-circle me-1"></i>Active</small>
                                @else
                                <small class="text-warning fw-semibold"><i class="bi bi-exclamation-circle me-1"></i>No
                                    Cities</small>
                                @endif
                            </div>

                            <div class="d-grid">
                                <a href="{{ route('show.city', $item->id)  }}"
                                    class="btn btn-outline-primary rounded-pill py-2 fw-semibold">
                                    <i class="bi bi-eye me-2"></i>View Cities
                                </a>
                                <a href="{{ route('state.edit', $item->id)  }}"
                                    class="btn mt-2 btn-outline-info rounded-pill py-2 fw-semibold">
                                    <i class="bi bi-pen me-2"></i>Edit State
                                </a>
                                <form action="{{ route('state.delete', $item->id)   }}" class="w-100" method="post">   
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn mt-2 w-100 btn-outline-danger rounded-pill py-2 fw-semibold">
                                        <i class="bi bi-trash me-2"></i>Delete State
                                    </button>

                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($states->hasPages())
        <div class="card shadow border-0 mt-5" style="border-radius: 20px;">
            <div class="card-body p-4">
                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-pill px-3 py-2 me-3">
                                <i class="bi bi-info-circle text-primary me-1"></i>
                                <small class="fw-semibold">Showing {{ $states->firstItem() }} to
                                    {{ $states->lastItem() }} of {{ $states->total() }} states</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="bg-primary bg-gradient text-white rounded-pill px-3 py-2 d-inline-block">
                            <i class="bi bi-bookmark me-1"></i>
                            <small class="fw-semibold">Page {{ $states->currentPage() }} of
                                {{ $states->lastPage() }}</small>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center flex-wrap gap-2">
                    @if ($states->onFirstPage())
                    <span class="btn btn-light disabled rounded-pill px-4 py-2 fw-semibold">
                        <i class="bi bi-chevron-double-left me-2"></i>Previous
                    </span>
                    @else
                    <a href="{{ $states->previousPageUrl() }}"
                        class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
                        <i class="bi bi-chevron-double-left me-2"></i>Previous
                    </a>
                    @endif

                    <div class="d-flex gap-1 mx-2">
                        @php
                        $start = max(1, $states->currentPage() - 2);
                        $end = min($states->lastPage(), $states->currentPage() + 2);
                        @endphp

                        @if($start > 1)
                        <a href="{{ $states->url(1) }}"
                            class="btn btn-outline-primary rounded-pill px-3 py-2 fw-semibold">1</a>
                        @if($start > 2)
                        <span class="btn btn-light disabled rounded-pill px-2 py-2">•••</span>
                        @endif
                        @endif

                        @for ($i = $start; $i <= $end; $i++) @if ($i==$states->currentPage())
                            <span class="btn btn-primary rounded-pill px-3 py-2 shadow fw-bold">{{ $i }}</span>
                            @else
                            <a href="{{ $states->url($i) }}"
                                class="btn btn-outline-primary rounded-pill px-3 py-2 fw-semibold">{{ $i }}</a>
                            @endif
                            @endfor

                            @if($end < $states->lastPage())
                                @if($end < $states->lastPage() - 1)
                                    <span class="btn btn-light disabled rounded-pill px-2 py-2">•••</span>
                                    @endif
                                    <a href="{{ $states->url($states->lastPage()) }}"
                                        class="btn btn-outline-primary rounded-pill px-3 py-2 fw-semibold">{{ $states->lastPage() }}</a>
                                    @endif
                    </div>

                    @if ($states->hasMorePages())
                    <a href="{{ $states->nextPageUrl() }}"
                        class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
                        Next<i class="bi bi-chevron-double-right ms-2"></i>
                    </a>
                    @else
                    <span class="btn btn-light disabled rounded-pill px-4 py-2 fw-semibold">
                        Next<i class="bi bi-chevron-double-right ms-2"></i>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>