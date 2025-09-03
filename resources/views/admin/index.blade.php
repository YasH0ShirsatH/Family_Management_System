<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Management - Admin Dashboard</title>
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
        }
        
        .navbar {
            background: white !important;
            box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid var(--border-color);
        }
        
        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color) !important;
            font-size: 1.25rem;
        }
        
        .main-content {
            padding: 2rem 0;
        }
        
        .page-header {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border-color);
        }
        
        .page-title {
            color: var(--dark-text);
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .stats-badges {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 1.5rem;
        }
        
        .stat-badge {
            background: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .stat-badge:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            color: white;
        }
        
        .logout-badge {
            background: var(--danger-color);
        }
        
        .logout-badge:hover {
            background: #b91c1c;
        }
        
        .family-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }
        
        .family-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
            color: white;
            padding: 1.5rem;
            text-align: center;
            border: none;
        }
        
        .card-header-custom h5 {
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .card-body-custom {
            padding: 2rem;
            text-align: center;
        }
        
        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--border-color);
            margin-bottom: 1rem;
        }
        
        .family-name {
            color: var(--dark-text);
            font-weight: 600;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        
        .info-list {
            text-align: left;
            margin-bottom: 1.5rem;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            color: var(--secondary-color);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .info-value {
            color: var(--dark-text);
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .card-footer-custom {
            background: #f8fafc;
            border-top: 1px solid var(--border-color);
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .member-badge {
            background: var(--success-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .view-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .view-btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            color: white;
        }
        
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--secondary-color);
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: var(--border-color);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-house-heart me-2"></i>
                Family Management System
            </a>
        </div>
    </nav>

    <div class="main-content">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-people-fill"></i>
                    Family Management Dashboard
                </h1>
                
                <div class="stats-badges">
                    <div class="stat-badge">
                        <i class="bi bi-house"></i>
                        <span>Total Families: {{ $heads->count() }}</span>
                    </div>
                    <div class="stat-badge">
                        <i class="bi bi-people"></i>
                        <span>Total Members: {{ $heads->sum(function($head) { return $head->members->count(); }) }}</span>
                    </div>
                    <a href="logout" class="stat-badge logout-badge">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>

            @if($heads->count() > 0)
                <div class="row">
                    @foreach ($heads as $user)
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="family-card">
                            <div class="card-header-custom">
                                <h5>
                                    <i class="bi bi-person-badge"></i>
                                    {{ $user->name }} Family
                                </h5>
                            </div>
                            
                            <div class="card-body-custom">
                                <img src="{{ asset('uploads/images/' . $user->photo_path) }}"
                                     class="profile-image" alt="Family Head Photo">
                                
                                <div class="family-name">{{ $user->name }} {{ $user->surname }}</div>
                                
                                <div class="info-list">
                                    <div class="info-item">
                                        <span class="info-label">
                                            <i class="bi bi-calendar3"></i>
                                            Birth Date
                                        </span>
                                        <span class="info-value">{{ $user->birthdate }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">
                                            <i class="bi bi-telephone"></i>
                                            Mobile
                                        </span>
                                        <span class="info-value">{{ $user->mobile }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">
                                            <i class="bi bi-geo-alt"></i>
                                            Location
                                        </span>
                                        <span class="info-value">{{ $user->city }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer-custom">
                                <div class="member-badge">
                                    <i class="bi bi-people"></i>
                                    <span>{{ $user->members->count() }} Members</span>
                                </div>
                                <a href="{{ route('admin.show', $user->id) }}" class="view-btn">
                                    <i class="bi bi-eye"></i>
                                    <span>View Details</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="family-card">
                    <div class="empty-state">
                        <i class="bi bi-house-x"></i>
                        <h4>No Families Found</h4>
                        <p>There are currently no families registered in the system.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>