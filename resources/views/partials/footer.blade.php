 <footer style="background: rgba(0, 109, 214, 0.09); border-radius: 18px 18px 0 0; box-shadow: 0 -5px 15px rgba(0,0,0,0.05); margin-top: 200px; color: #6c757d;">
        <div class="container py-5">
          <div class="row g-4">
            <div class="col-lg-4">
              <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-house-heart me-2"></i>Family Management System
              </h5>
              <p class="text-muted mb-0">Professional family data management and organization platform for modern families.</p>
            </div>

            <div class="col-lg-4">
              <h6 class="fw-bold mb-3">Quick Links</h6>
              <ul class="list-unstyled">
                <li class="mb-2"><a href="/family-registration" class="text-decoration-none text-muted"><i class="bi bi-people me-2"></i>Family Registration</a></li>
                <li class="mb-2"><a href="/login" class="text-decoration-none text-muted"><i class="bi bi-shield-check me-2"></i>Admin Access</a></li>
                <li class="mb-2"><a href="/about" class="text-decoration-none text-muted"><i class="bi bi-info-circle me-2"></i>About Us</a></li>
              </ul>
            </div>

            <div class="col-lg-4">
              <h6 class="fw-bold mb-3">Need Assistance?</h6>
              <p class="text-muted mb-3">Encountered an issue during registration? Contact our administrator for help.</p>
              @if($admin1)
              <div class="alert alert-warning border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #fff3cd, #ffeaa7); border-left: 4px solid #f39c12 !important; border-radius: 12px;">
                <div class="d-flex align-items-center">
                  <div class="me-3">
                    <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 1.5rem;"></i>
                  </div>
                  <div>
                    <h6 class="alert-heading mb-1 fw-bold text-dark">Administrator Access Detected</h6>
                    <p class="mb-0 text-dark" style="font-size: 0.9rem;">You are currently logged in as an administrator. Please sign out to access user complaint features.</p>
                  </div>
                </div>
              </div>
              @endif
              @if(!$admin1)
              <a href='/support' class="btn btn-outline-primary" style="border-radius: 25px;">
                <i class="bi bi-envelope me-2"></i>Contact Support
              </a>
              @endif
            </div>
          </div>

          <hr class="my-4" style="border-color: rgba(0,0,0,0.1);">

          <div class="row align-items-center">
            <div class="col-md-6">
              <p class="mb-0 text-muted">
                © 2025 <strong>Family Information Management System</strong>
              </p>
            </div>
            <div class="col-md-6 text-md-end">
              <a href="" class="text-primary text-decoration-none fw-bold">fims.com</a>
            </div>
          </div>
        </div>
      </footer>
