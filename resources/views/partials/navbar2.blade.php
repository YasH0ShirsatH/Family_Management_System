<nav class="navbar navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand fs-4 fw-bold">
            <i class="bi bi-house-heart me-2"></i>Family Management System
        </a>
        <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
            <i class=" bi-list fs-4 text-white"></i>
        </button>
    </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header bg-primary pb-4 text-white">
        <h5 class="offcanvas-title" id="sidebarMenuLabel"><i class="bi bi-list me-2"></i>Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="mb-4">
            
            <h6 class="text-primary fw-bold mb-3">Dashboard</h6>
            <div class="list-group mb-4">
                <a href="/dashboard" class="list-group-item mb-1 list-group-item-action"><i class="bi bi-speedometer2 text-primary me-2"></i>Admin Dashboard</a>
                <a href="/" class="list-group-item mb-1 list-group-item-action"><i class="bi bi-speedometer2 text-primary me-2"></i>User Dashboard</a>
                <a href="/state-city" class="list-group-item list-group-item-action"><i class="bi bi-speedometer2 text-primary me-2"></i>State-City Dashboard</a>
            </div>



            <h6 class="text-primary fw-bold mb-3">Useful Links</h6>
            <div class="list-group">
                <a href="/admin" class="list-group-item list-group-item-action mb-1"><i class="bi bi-people text-success me-2"></i>Manage Head</a>
                <a href="{{ route('state.index') }}" class="list-group-item list-group-item-action mb-1"><i class="bi text-warning bi-geo-alt me-2"></i>Manage States</a>
                <a href="{{ route('city.index') }}" class="list-group-item list-group-item-action mb-1"><i class="bi text-danger bi-buildings me-2"></i>Manage Cities</a>
                
            </div>
        </div>
        <div>
            <h6 class="text-primary fw-bold mb-3">Add Content</h6>
            <div class="list-group">
                <a href="/headview" class="list-group-item list-group-item-action mb-1"><i class="bi bi-file-earmark-plus text-primary me-2"></i>+ Add Head</a>
                <a href="{{ route('create.state') }}" class="list-group-item list-group-item-action mb-1"><i class="bi bi-file-earmark-plus text-primary me-2"></i>+ Add State</a>
                <a href="{{ route('create.city') }}" class="list-group-item list-group-item-action mb-1"><i class="bi bi-file-earmark-plus text-primary me-2"></i>+ Add City</a>
            </div>
        </div>
        @if ($shouldShowDiv)
        <h6 class="text-primary fw-bold mt-4 mb-3">Logout</h6>
            <div class="list-group">
                <a href="/logout" class="list-group-item list-group-item-action list-group-item-danger"><i class="bi text-danger bi-box-arrow-right me-2"></i>Logout</a>
            </div>
            @endif
        
    </div>
</div>