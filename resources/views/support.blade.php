<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Support - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.typekit.net/qbl3xfq.css">


    <style>
        .active-class-11 {
                     background: #dc3545;
                     color: white;
                     transform: translateX(5px);
                     box-shadow: 0 4px 15px rgba(25, 135, 84, 0.3);
                 }
        body {
            background: #f8fafc;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
        }

        .support-header {
            background: #0d6efd;
            color: white;
            padding: 80px 0;
            border-radius: 16px;
            margin-bottom: 50px;
        }

        .contact-form {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .form-section {
            padding: 30px 60px;
        }

        .form-group {
            margin-bottom: 28px;
        }

        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 10px;
            font-size: 15px;
            display: block;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            padding: 16px 18px;
            font-size: 15px;
            background-color: #ffffff;
            width: 100%;
            font-family: inherit;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background-color: #ffffff;
            outline: none;
        }

        .form-control[readonly] {
            background-color: #f9fafb;
            color: #6b7280;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 160px;
        }

        .btn-submit {
            background: #3b82f6;
            border: none;
            border-radius: 8px;
            padding: 16px 40px;
            font-weight: 500;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #2563eb;
            color: #ffffff;
        }

        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 24px;
        }

        .support-info {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 32px;
            border: 1px solid #e2e8f0;
        }
        .new_font_3{
            font-family: "lora", serif;
            font-weight: 400;
            font-style: normal;
            text-transform: uppercase;
        }

        @media (max-width: 768px) {
            .form-section {
                padding: 20px 30px 40px 30px;
            }

            .support-header {
                padding: 60px 0;
            }
        }
    </style>
</head>

<body class="bg-light">
    <div id="mainContent">
            @if(session()->has('loginId'))
                @include('partials.navbar2', ['shouldShowDiv' => true])
            @else
                @include('partials.navbar2', ['shouldShowDiv' => false])
            @endif
    <div class="container py-5">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle me-2"></i>Please fix the following errors:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
            <div class="text-center mb-4">
                            <a @if($admin1) href="/dashboard" @else href="/" @endif class="btn btn-outline-primary rounded-pill">
                                <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                            </a>
                        </div>


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9" style="width: 100%;">


                    <div class="contact-form">
                        <div class="text-center py-4 text-white" style="background: rgba(13, 110, 253, 1); border-radius: 16px 16px 0 0;">
                            @if($admin1)
                                <i class="bi bi-shield-check" style="font-size: 2.5rem; margin-bottom: 15px; display: block;"></i>
                                <h2 class="fw-bold mb-2 new_font_3">Admin Request Form</h2>
                                <p class="mb-0 opacity-75">Administrative database modification request</p>
                            @else
                                <i class="bi bi-person-circle" style="font-size: 2.5rem; margin-bottom: 15px; display: block;"></i>
                                <h2 class="fw-bold mb-2">User Request Form</h2>
                                <p class="mb-0 opacity-75">Submit your support request or inquiry</p>
                            @endif
                        </div>
                        <div class="form-section">
                            <div class="support-info text-center" >
                                                    <h5 class="fw-bold text-primary mb-2"  >
                                                        <i class="bi bi-info-circle me-2"></i>Database Change Request
                                                    </h5>
                                                    <p class="text-muted mb-0">Use this form to request changes to the database or report issues that need administrator attention.</p>
                                                </div>
                            <form method="post" style="margin-top:50px" action="{{ route('support.send') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Your Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Your Name *"
                                            @if($admin1)
                                            value="{{ $admin1->first_name }} {{ $admin1->last_name }}"
                                            @else
                                            value = ""
                                            @endif
                                            @if($admin1) readonly @endif required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Your Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Your Email *" value="{{ $admin1->email ?? '' }}"
                                            @if($admin1) readonly @endif required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" >Subject</label>
                                            <select name="subject" role="button" class="form-control" required>
                                                <option value="">Select Subject *</option>
                                                @if($admin1)

                                                    <optgroup label="Family Management">

                                                        <option value="Update Family Information">Update Family Information (no admin feature available to change)</option>
                                                        <option value="Family Tree Corrections">Family Tree Corrections</option>
                                                        <option value="Merge Family Records">Merge Family Records</option>
                                                    </optgroup>
                                                    <optgroup label="System Administration">
                                                        <option value="Database Backup Request">Database Backup Request</option>
                                                        <option value="System Performance Issues">System Performance Issues</option>
                                                        <option value="Security Concerns">Security Concerns</option>
                                                        <option value="Feature Request">Feature Request</option>
                                                        <option value="Bug Report">Bug Report</option>
                                                    </optgroup>
                                                    <optgroup label="Reports & Analytics">
                                                        <option value="Generate Family Report">Generate Family Report (Active + Inactive + Deleted)</option>
                                                        <option value="Export Data Request">Export Data Request</option>
                                                        <option value="Custom Report Request">Custom Report Request</option>
                                                    </optgroup>
                                                @else
                                                    <optgroup label="Profile & Account">
                                                        <option value="Update My Profile">Update My Profile</option>
                                                        <option value="Delete My Account">Delete My Family</option>
                                                    </optgroup>
                                                    <optgroup label="Family Information">
                                                        <option value="Add Family Member">Add Family Member</option>
                                                        <option value="Update Family Details">Update Family Details</option>
                                                        <option value="Correct Family Information">Correct Family Information</option>
                                                        <option value="Family Tree Issues">Family Tree Issues</option>
                                                    </optgroup>
                                                    <optgroup label="Technical Support">

                                                        <option value="Website Not Working">Website Not Working</option>
                                                        <option value="Feature Not Working">Feature Not Working</option>
                                                        <option value="Data Not Displaying">Data Not Displaying</option>
                                                    </optgroup>
                                                    <optgroup label="General Inquiries">
                                                        <option value="How to Use Feature">How to Use Feature</option>
                                                        <option value="General Question">General Question</option>
                                                        <option value="Feedback">Feedback</option>
                                                        <option value="Suggestion">Suggestion</option>
                                                    </optgroup>
                                                @endif
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                             <label class="form-label">To Email</label>
                                             <input type="email"  class="form-control" placeholder="Your Email *" value="suppportfms@gmail.com"
                                               disabled />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Message</label>
                                            <textarea name="message" class="form-control" style="resize:none;height:175px"  placeholder="Describe the changes needed or issue encountered *" required>{{ old('message') }}</textarea>
                                        </div>
                                    </div>
                             <input type="hidden" name="usertype" value="@if($admin1) Admin @else User @endif"  />

                             <input type="hidden" name="fromName" value="@if($admin1) Request via Admin @else Request via User @endif"  />

                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-submit">
                                            <i class="bi bi-send me-2"></i>Send Request
                                        </button>
                                    </div>
                                </div>
                            </form>
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
