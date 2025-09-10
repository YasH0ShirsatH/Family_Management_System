 <nav class="navbar navbar-dark bg-primary shadow">
        <div class="container">
                <a class="navbar-brand fs-4 fw-bold">
                    <i class="bi bi-house-heart me-2"></i>Family Management System
                </a>
                <span class="navbar-text text-white d-flex align-items-center justify-content-end " style="width: 24%;">
                    
                
                <span>
                    <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    <i class="navbar-toggler-icon"></i>
                    </a>

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Family Management System</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                        <div>
                            This is a compilation of all the shortcuts we can use to efficiently perform various tasks on a Website
                        </div>
                        <div class="dropdown mt-3">
                            <p class="text-primary fw-bold">Dashboard</p>
                            <li><a class="dropdown-item text-dark" href="/dashboard"><i class="bi bi-speedometer2 text-primary  mb-2 mx-2"></i>Dashboard</a></li>
                        </div>
                        <div class="dropdown mt-3">
                            <p class="text-primary fw-bold">Usefull Links</p>
                            <li><a class="dropdown-item text-dark" href="/admin"><span><i class="bi bi-people  mb-2 mx-2 "></i>Manage Head</a></span></li>
                            <li><a class="dropdown-item text-dark" href="{{ route('state.index') }}"><i class="bi bi-geo-alt  mb-2 mx-2"></i>Manage States</a></li>
                            <li><a class="dropdown-item text-dark" href="{{ route('city.index') }}"><i class="bi bi-buildings  mb-2 mx-2"></i>Manage Cities</a></li>
                            
                            <li><a class="dropdown-item  bg-danger" href="/logout"><i class="bi bi-box-arrow-right  mb-2 mx-2"></i>Logout</a></li>
                        </div>
                        <div class="dropdown mt-3">
                            <p class="text-primary fw-bold">Add Content</p>
                            <li><a class="dropdown-item text-dark" href="/headview"><i class="bi bi-plus-square text-primary  mb-2 mx-2"></i>Create Head</a></li>

                            <li><a class="dropdown-item text-dark" href="{{ route('create.state') }}"><i class="bi bi-plus-square text-primary  mb-2 mx-2"></i>Create State</a></li>
                            <li><a class="dropdown-item  text-dark" href="{{ route('create.city') }}"><i class="bi bi-plus-square text-primary mb-2 mx-2"></i>Create City</a></li>
                            
                        </div>
                    </div>
                    </div>
                </span>
           
            
        </div>
    </nav>