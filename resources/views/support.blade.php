<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Support - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }

        .support-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: none;
        }

        .origami-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .form-pill {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            border: 2px solid rgba(0, 0, 0, 0.1);
            padding: 12px 16px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .btn-pill {
            border-radius: 15px;
            padding: 12px 30px;
            font-weight: 500;
        }

        .info-pill {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid #e1f5fe;
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div id="mainContent">
        @if (session()->has('loginId'))
            @include('partials.navbar2', ['shouldShowDiv' => true])
        @else
            @include('partials.navbar2', ['shouldShowDiv' => false])
        @endif

        <div class="container py-4">
            <!-- Back Button -->
            <div class="text-center mb-4">
                <a @if ($admin1) href="/dashboard" @else href="/" @endif
                    class="btn btn-outline-primary rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-pill mb-4">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-pill mb-4">
                    <i class="bi bi-exclamation-triangle me-2"></i>Please fix the following errors:
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Main Support Card -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="support-card">
                        <!-- Header -->
                        <div class="origami-header">
                            @if ($admin1)
                                <i class="bi bi-shield-check mb-3" style="font-size: 3rem;"></i>
                                <h2 class="fw-bold mb-2">Admin Support Request</h2>
                                <p class="mb-0 opacity-90">Administrative database modification request</p>
                            @else
                                <i class="bi bi-headset mb-3" style="font-size: 3rem;"></i>
                                <h2 class="fw-bold mb-2">Support Center</h2>
                                <p class="mb-0 opacity-90">Submit your support request or inquiry</p>
                            @endif
                        </div>

                        <!-- Form Content -->
                        <div class="p-4">
                            <!-- Info Section -->
                            <div class="info-pill">
                                <h5 class="fw-bold text-primary mb-2">
                                    <i class="bi bi-info-circle me-2"></i>Database Change Request
                                </h5>
                                <p class="text-muted mb-0">Use this form to request changes to the database or report
                                    issues that need administrator attention.</p>
                            </div>

                            <!-- Form -->
                            <form method="post" action="{{ route('support.send') }}">
                                @csrf

                                <!-- Personal Information -->
                                <div class="form-pill">
                                    <h6 class="fw-bold mb-3 text-primary">
                                        <i class="bi bi-person me-2"></i>Personal Information
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-medium">Your Name</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Enter your name"
                                                @if ($admin1) value="{{ $admin1->first_name }} {{ $admin1->last_name }}"
                                                readonly @endif
                                                required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-medium">Your Email</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Enter your email" value="{{ $admin1->email ?? '' }}"
                                                @if ($admin1) readonly @endif required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Request Details -->
                                <div class="form-pill">
                                    <h6 class="fw-bold mb-3 text-primary">
                                        <i class="bi bi-clipboard me-2"></i>Request Details
                                    </h6>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Subject</label>
                                        <select name="subject" class="form-select" required>
                                            <option value="">Select Subject</option>
                                            @if ($admin1)
                                                <optgroup label="Family Management">
                                                    <option value="Update Family Information">Update Family Information
                                                    </option>
                                                    <option value="Family Tree Corrections">Family Tree Corrections
                                                    </option>
                                                    <option value="Merge Family Records">Merge Family Records</option>
                                                    <option value="Delete Family Records">Delete Family Records</option>
                                                </optgroup>
                                                <optgroup label="Member Management">
                                                    <option value="Update Member Information">Update Member Information
                                                    </option>
                                                    <option value="Transfer Member">Transfer Member Between Families
                                                    </option>
                                                    <option value="Restore Deleted Member">Restore Deleted Member
                                                    </option>
                                                </optgroup>
                                                <optgroup label="System Issues">
                                                    <option value="Database Inconsistency">Database Inconsistency
                                                    </option>
                                                    <option value="Data Import Issues">Data Import Issues</option>
                                                    <option value="System Error">System Error</option>
                                                </optgroup>
                                            @else
                                                <option value="Account Issues">Account Issues</option>
                                                <option value="Technical Support">Technical Support</option>
                                                <option value="Feature Request">Feature Request</option>
                                                <option value="Bug Report">Bug Report</option>
                                                <option value="General Inquiry">General Inquiry</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Priority Level</label>
                                        <select name="priority" class="form-select" required>
                                            <option value="">Select Priority</option>
                                            <option value="Low">Low - General inquiry</option>
                                            <option value="Medium">Medium - Standard request</option>
                                            <option value="High">High - Urgent issue</option>
                                            <option value="Critical">Critical - System down</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="form-pill">
                                    <h6 class="fw-bold mb-3 text-primary">
                                        <i class="bi bi-chat-text me-2"></i>Detailed Message
                                    </h6>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Describe your request</label>
                                        <textarea name="message" class="form-control" rows="6"
                                            placeholder="Please provide detailed information about your request, including any relevant IDs, names, or specific changes needed..."
                                            required></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="usertype"
                                    value="@if ($admin1) Administrator @else User @endif">
                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-pill px-5">
                                        <i class="bi bi-send me-2"></i>Submit Request
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="support-card text-center p-4">
                                <i class="bi bi-clock text-primary mb-2" style="font-size: 2rem;"></i>
                                <h6 class="fw-bold">Response Time</h6>
                                <p class="text-muted small mb-0">24-48 hours for most requests</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="support-card text-center p-4">
                                <i class="bi bi-shield-check text-success mb-2" style="font-size: 2rem;"></i>
                                <h6 class="fw-bold">Secure</h6>
                                <p class="text-muted small mb-0">All requests are encrypted and secure</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="support-card text-center p-4">
                                <i class="bi bi-people text-info mb-2" style="font-size: 2rem;"></i>
                                <h6 class="fw-bold">Expert Support</h6>
                                <p class="text-muted small mb-0">Handled by experienced administrators</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
