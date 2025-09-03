<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Family Management System</title>
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
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            border-bottom: 1px solid var(--border-color);
        }
        
        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color) !important;
        }
        
        .main-content {
            padding: 2rem 0;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }
        
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .dashboard-header h1 {
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }
        
        .dashboard-body {
            padding: 2.5rem;
        }
        
        .welcome-text {
            font-size: 1.25rem;
            color: var(--dark-text);
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .user-info {
            background: var(--light-bg);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
        }
        
        .user-info h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            color: var(--secondary-color);
        }
        
        .info-item i {
            color: var(--primary-color);
            width: 20px;
            margin-right: 0.75rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-custom {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary-custom {
            background: var(--primary-color);
            color: white;
            border: 2px solid var(--primary-color);
        }
        
        .btn-primary-custom:hover {
            background: #1d4ed8;
            border-color: #1d4ed8;
            transform: translateY(-1px);
            color: white;
        }
        
        .btn-danger-custom {
            background: var(--danger-color);
            color: white;
            border: 2px solid var(--danger-color);
        }
        
        .btn-danger-custom:hover {
            background: #b91c1c;
            border-color: #b91c1c;
            transform: translateY(-1px);
            color: white;
        }
        
        .alert {
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.2s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
        }
        
        .stat-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-text);
            margin-bottom: 0.25rem;
        }
        
        .stat-label {
            color: var(--secondary-color);
            font-size: 0.9rem;
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
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">
                    <i class="bi bi-person-circle me-1"></i>
                    {{ $user->first_name }} {{ $user->last_name }}
                </span>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="dashboard-card">
                <div class="dashboard-header">
                    <h1><i class="bi bi-speedometer2"></i> Admin Dashboard</h1>
                </div>
                
                <div class="dashboard-body">
                    <div class="welcome-text">
                        <i class="bi bi-hand-thumbs-up me-2"></i>
                        Welcome back, <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>!
                    </div>
                    
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="stat-number">0</div>
                            <div class="stat-label">Total Families</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <div class="stat-number">0</div>
                            <div class="stat-label">Active Members</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <div class="stat-number">0</div>
                            <div class="stat-label">Recent Activities</div>
                        </div>
                    </div>
                    
                    <div class="user-info">
                        <h5><i class="bi bi-person-badge me-2"></i>Account Information</h5>
                        <div class="info-item">
                            <i class="bi bi-person"></i>
                            <span><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-envelope"></i>
                            <span><strong>Email:</strong> {{ $user->email }}</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-shield-check"></i>
                            <span><strong>Role:</strong> Administrator</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-calendar"></i>
                            <span><strong>Last Login:</strong> {{ now()->format('M d, Y - H:i') }}</span>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="#" class="btn-custom btn-primary-custom">
                            <i class="bi bi-plus-circle"></i>
                            Manage Families
                        </a>
                        <a href="#" class="btn-custom btn-primary-custom">
                            <i class="bi bi-gear"></i>
                            Settings
                        </a>
                        <a href="logout" class="btn-custom btn-danger-custom">
                            <i class="bi bi-box-arrow-right"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>