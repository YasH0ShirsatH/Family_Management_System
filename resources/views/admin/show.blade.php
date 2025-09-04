<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Details - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    :root {
        --primary-color: #2563eb;
        --secondary-color: #64748b;
        --success-color: #059669;
        --danger-color: #dc2626;
        --warning-color: #d97706;
        --light-bg: #f8fafc;
        --dark-text: #1e293b;
        --border-color: #e2e8f0;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: linear-gradient(135deg, var(--light-bg) 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .main-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border: 1px solid var(--border-color);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .card-header-custom {
        background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
        color: white;
        padding: 2rem;
        text-align: center;
        border: none;
    }

    .card-header-custom h2 {
        font-size: 1.75rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .card-body-custom {
        padding: 3rem;
    }

    .profile-image {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 8px 16px -4px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .family-name {
        color: var(--dark-text);
        font-weight: 600;
        font-size: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        color: var(--secondary-color);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-value {
        color: var(--dark-text);
        font-weight: 600;
        font-size: 15px;
        max-width: 360px;
        text-align: justify;
    }

    .info-card:last-child {
        border-bottom: none;
        grid-column: 1 / 3;
        column-span: 2;
    }

    .member-badge {
        background: var(--success-color);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .back-btn {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .back-btn:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        color: white;
    }

    .members-section {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    .members-header {
        background: linear-gradient(135deg, var(--success-color) 0%, #047857 100%);
        color: white;
        padding: 1.5rem;
        text-align: center;
    }

    .members-body {
        padding: 2rem;
    }

    .member-card {
        background: white;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;

    }

    .member-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .member-img {
        /* height: 180px; */
        min-height: 300px;
        object-fit: cover;
        width: 100%;
    }

    .member-info {
        padding: 1.5rem;
    }

    .member-name {
        color: var(--dark-text);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .member-detail {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        color: var(--secondary-color);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--secondary-color);
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: var(--border-color);
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="text-center mb-4">
            <a href="{{ route('admin.index') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i>Back to Dashboard
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="main-card">
                    <div class="card-header-custom">
                        <h2><i class="bi bi-person-badge"></i> {{ $heads->name }} Family Details</h2>
                    </div>

                    <div class="card-body-custom text-center">
                        <img src="{{ asset('uploads/images/' . $heads->photo_path) }}" class="profile-image"
                            alt="Family Head Photo">

                        <div class="family-name">{{ $heads->name }} {{ $heads->surname }}</div>

                        <div class="info-grid">
                            <div class="info-card">
                                <div class="info-item">
                                    <span class="info-label"><i class="bi bi-calendar3"></i>Date of Birth</span>
                                    <span class="info-value">{{ date('M d, Y', strtotime($heads->birthdate)) }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><i class="bi bi-telephone"></i>Mobile</span>
                                    <span class="info-value">{{ $heads->mobile }}</span>
                                </div>
                                @if($heads->marital_status)
                                <div class="info-item">
                                    <span class="info-label"><i class="bi bi-heart"></i>Marriage Date</span>
                                    <span
                                        class="info-value">{{ date('M d, Y', strtotime($heads->mariage_date)) }}</span>
                                </div>
                                @endif
                            </div>

                            <div class="info-card">

                                <div class="info-item">
                                    <span class="info-label"><i class="bi bi-building"></i>City</span>
                                    <span class="info-value">{{ ucfirst($heads->city) }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><i class="bi bi-map"></i>State</span>
                                    <span class="info-value">{{ ucfirst($heads->state) }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label"><i class="bi bi-mailbox"></i>Pincode</span>
                                    <span class="info-value">{{ $heads->pincode }}</span>
                                </div>

                            </div>
                            <div class="info-card">
                                <div class="info-item">
                                    <span class="info-label"><i class="bi bi-geo-alt"></i>Address</span>
                                    <span class="info-value">{{ $heads->address }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="info-card">
                                <div class="info-item">
                                    <span class="info-label"><i class="bi bi-star"></i>Hobbies</span>
                                    <span class="info-value">
                                        @foreach ($heads->hobbies as $hobby)
                                        {{ ucfirst($hobby->hobby_name) }}@if(!$loop->last), @endif
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="member-badge">
                            <i class="bi bi-people"></i>
                            {{ $heads->members->count() }} Family Members
                        </div>
                        <div class="member-badge">
                            <a href="{{ route('admin.edit', $heads->id) }}"
                                class="mb-0 text-dark text-decoration-none"><i class="bi bi-people-fill me-2"></i>Edit
                                Head</a>
                        </div>


                    </div>
                </div>
            </div>
            @if($heads->members->count() > 0)
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="members-section">
                        <div class="members-header">
                            <h3 class="mb-0"><i class="bi bi-people-fill me-2"></i>Family Members</h3>
                        </div>
                        <div class="members-body">
                            <div class="row">
                                @foreach($heads->members as $member)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="member-card">
                                        @if(empty($member->photo_path))
                                        <img src="{{ asset('uploads/images/noimage.png') }}" class="member-img"
                                            alt="No Image">
                                        @else
                                        <img src="{{ asset('uploads/images/' . $member->photo_path) }}"
                                            class="member-img" alt="Member Photo">
                                        @endif
                                        <div class="member-info">
                                            <h6 class="member-name">{{ $member->name }}</h6>
                                            <div class="member-detail">
                                                <i class="bi bi-calendar3"></i>
                                                {{ date('M d, Y', strtotime($member->birthdate)) }}
                                            </div>
                                            <div class="member-detail">
                                                <i class="bi bi-heart"></i>
                                                {{ $member->marital_status ? 'Married' : 'Single' }}
                                            </div>
                                            @if($member->education)
                                            <div class="member-detail">
                                                <i class="bi bi-mortarboard"></i>
                                                {{ $member->education }}
                                            </div>
                                            @else
                                            <div class="member-detail">
                                                <i class="bi bi-mortarboard"></i>
                                                <span class="text-muted">Education not provided</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="members-section">
                        <div class="members-header">
                            <h3 class="mb-0"><i class="bi bi-people-fill me-2"></i>Family Members</h3>
                        </div>

                        <div class="members-body">
                            <div class="empty-state">
                                <i class="bi bi-people"></i>
                                <h5>No Family Members</h5>
                                <p>This family hasn't added any members yet.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>