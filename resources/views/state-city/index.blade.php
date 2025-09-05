
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>State & City Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-white border-0 text-center py-4">
                        <h2 class="text-primary mb-2 fw-bold">
                            <i class="bi bi-geo-alt me-2"></i>State & City Management
                        </h2>
                        <p class="text-muted mb-0">Manage geographical data for the system</p>
                    </div>
                    
                    <div class="card-body p-5">
                        <div class="row text-center mb-4">
                            <div class="col-md-6">
                                <div class="card bg-primary text-white border-0 h-100">
                                    <div class="card-body py-4">
                                        <i class="bi bi-map display-4 mb-3"></i>
                                        <h4 class="fw-bold">{{ $states->count() }}</h4>
                                        <p class="mb-0">Total States</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-success text-white border-0 h-100">
                                    <div class="card-body py-4">
                                       
                                        <i class="bi bi-buildings display-4 mb-3"></i>
                                        <h4 class="fw-bold">{{ $cities->count() }}</h4>
                                        <p class="mb-0">Total Cities</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-3">
                            <a href="admin/state-city/states" class="btn btn-primary btn-lg">
                                <i class="bi bi-map me-2"></i>Manage States
                            </a>
                            <a href="admin/state-city/city" class="btn btn-success btn-lg">
                                <i class="bi bi-buildings me-2"></i>Manage Cities
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>