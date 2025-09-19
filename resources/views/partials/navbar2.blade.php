<style>
    @import url('https://fonts.googleapis.com/css2?family=Borel&family=Miniver&family=Pacifico&family=Playwrite+DE+Grund:wght@100..400&display=swap');

    body {
        padding-top: 105px;
    }

    /* transition for main content when sidebar toggles */
    #mainContent {
        transition: margin-left 0.25s cubic-bezier(0.42, 0, 0.58, 1);
        will-change: margin-left;
    }
    /* pushed state shifts content to the right by sidebar width */
    #mainContent.pushed {
        margin-left: 290px;
    }

    /* overlay that appears on small screens */
    #sidebarOverlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        z-index: 1035;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease, visibility 0.2s ease;
        pointer-events: none;
    }
    #sidebarOverlay.active {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .text1{
        font-size: 20px;
    }
    .text2{
        font-size: 15px;
    }

    #mainNavbar {
        transition: all 0.25s cubic-bezier(0.42, 0, 0.58, 1);
    }

    #mainNavbar.navbar-pushed {
        margin-left: 290px;
    }

    nav::-webkit-scrollbar {
        display: none;
    }

    nav {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    /* keep header visible and let body scroll */
    .sidebar-push {
        position: fixed;
        top: 0;
        left: -350px;
        width: 290px;
        height: 100vh;
        background: #2471e6ff;
        color: #fff;
        z-index: 1040;
        box-shadow: 2px 0 12px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: all 0.25s cubic-bezier(0.42, 0, 0.58, 1);
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .sidebar-push.active {
        left: 0;
    }

    .sidebar-header {
        background: #007bff;
        padding: 23px 10px 22px 23px;
        border-bottom: 1px solid #fff2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        /* keep header stuck to the top of the sidebar */
        position: sticky;
        top: 0;
        z-index: 2;
    }

    .sidebar-body {
        padding: 1.5rem 1rem;
        background-color: #fff;
        scrollbar-width: none;
        -ms-overflow-style: none;
        overflow-y: auto; /* enables internal scrolling */
        flex: 1; /* take remaining height so header stays fixed */
    }

    .sidebar-body::-webkit-scrollbar {
        display: none;
    }

    .sidebar-body .card {
        background: #fff;
        color: #212529;
    }

    .sidebar-body .btn {
        font-size: 1.05rem;
    }

    .btn-close-white {
        filter: invert(1);
    }

    .btn-admin-profile {
        display: inline-flex;
        align-items: center;
        padding: 0.45rem 1.25rem 0.45rem 0.9rem;
        border-radius: 9999px;
        background-color: #2471e6ff;
        box-shadow: 3px 4px 8px rgba(0, 0, 0, 0.3);
        font-family: 'Playwrite DE Grund', cursive;
        color: #e6e6e6;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-admin-profile:hover {
        transform: translateY(-2px);
        box-shadow: 3px 6px 12px rgba(0, 0, 0, 0.4);
        color: #ffffff;
    }

    .btn-menu-style {
        box-shadow: 3px 4px 8px rgba(214, 212, 212, 0.3);
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.2s ease;
    }

    .btn-menu-style:hover {
        transform: translateY(-2px);
        box-shadow: 3px 6px 12px rgba(214, 212, 212, 0.5);
    }

    .name {
        color: aliceblue;
        opacity: 70%;
        transition: all 0.2s ease;
    }

    .name:hover {
        color: whitesmoke;
        opacity: 95%;
    }

    .sidebar-body .btn {
        transition: all 0.2s ease;
    }

    .sidebar-body .btn:hover {
        transform: translateX(5px);
    }

    /* Responsive navbar styles */
    @media (max-width: 768px) {
        .navbar-brand .text1 {
            font-size: 1rem;
        }
        .navbar-brand .text2 {
            font-size: 0.75rem;
        }
        .btn-admin-profile {
            padding: 0.35rem 0.8rem;
            font-size: 0.85rem;
        }
        .btn-admin-profile span {
            display: none;
        }
        .btn-menu-style {
            padding: 0.4rem 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .navbar-brand {
            font-size: 0.9rem;
        }
        .navbar-brand .bg-white {
            padding: 0.5rem 0.7rem;
        }
        .navbar-brand .text1 {
            font-size: 0.9rem;
        }
        .navbar-brand .text2 {
            display: none;
        }
        .btn-admin-profile {
            padding: 0.3rem 0.6rem;
        }
        .btn-menu-style {
            padding: 0.35rem 0.7rem;
        }
        .container.mediaclass {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            padding-bottom: 0.45rem;
        }
    }
</style>

<div class="fixed-top" style="padding-bottom: 10px;z-index:100">
    <nav id="mainNavbar" class="navbar navbar-expand-lg mb-3 navbar-dark bg-primary bg-gradient shadow-lg">
        <div class="container mediaclass">
            <a href="/" class="navbar-brand d-flex align-items-center flex-grow-1">
                <div class="bg-white rounded-circle p-2 px-3 me-2 me-md-3">
                    <i class="bi bi-house-heart text-primary fs-5"></i>
                </div>
                <div class="flex-grow-1">
                    <span class="fw-bold text1">Family Management System</span>
                    <div class="small opacity-75 text2 d-none d-sm-block">Database for your family</div>
                </div>
            </a>
            <div class="d-flex align-items-center flex-shrink-0">
                @if ($shouldShowDiv ?? true)
                <a href="/dashboard/admin-profile" class="btn btn-admin-profile me-2 name">
                    <i class="p-1 px-2 rounded-pill bi bi-person-circle me-1 border border-white"></i>
                    <span class="fw-semibold text-start" style="font-family: Playwrite DE Grund, cursive;">
                        {{ $admin1->first_name . ' ' . $admin1->last_name ?? 'Admin' }}
                    </span>
                </a>
                @endif
                @if ($shouldShowDiv ?? true)
                <button class="btn btn-menu-style btn-outline-light rounded-pill px-3" type="button" id="openSidebarPush">
                    <i class="bi bi-list fs-5 me-1"></i>
                    <span class="d-none d-sm-inline">Menu</span>
                </button>
                @endif
            </div>
        </div>
    </nav>

    @if ($shouldShowDiv ?? true)
    <div id="sidebarPush" class="sidebar-push bg-primary text-white">
        <div class="sidebar-header">
            <h5 class="fw-bold mb-1"><i class="bi bi-grid-3x3-gap me-2"></i>Navigation Menu</h5>
            <button type="button" class="border-0" style="background-color: #007bff" id="closeSidebarPush">
                <i class="bi bi-list text-white fs-5 me-1"></i>
            </button>
        </div>
        <div class="sidebar-body">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    <h6 class="text-warning fw-bold mb-3 d-flex align-items-center">
                        <div class="bg-warning bg-gradient rounded-circle p-2 me-2">
                            <i class="bi bi-speedometer2 text-white"></i>
                        </div>
                        Admin Profile
                    </h6>
                    <div class="d-grid gap-2">
                        <a href="/dashboard/admin-profile" class="btn btn-outline-warning rounded-pill text-start active-class">
                            <i class="bi bi-person-circle me-2 "></i>Admin Profile
                        </a>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    <h6 class="text-success fw-bold mb-3 d-flex align-items-center">
                        <div class="bg-success bg-gradient rounded-circle p-2 me-2">
                            <i class="bi bi-gear text-white"></i>
                        </div>
                        Management
                    </h6>
                    <div class="d-grid gap-2">
                        <a href="/admin" class="btn btn-outline-success rounded-pill text-start active-class-2">
                            <i class="bi bi-people me-2"></i>Manage Families
                        </a>
                        <a href="{{ route('state.index') }}" class="btn btn-outline-success rounded-pill text-start active-class-3">
                            <i class="bi bi-geo-alt me-2"></i>Manage States
                        </a>
                        <a href="{{ route('city.index') }}" class="btn btn-outline-success rounded-pill text-start active-class-4">
                            <i class="bi bi-buildings me-2"></i>Manage Cities
                        </a>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    <h6 class="text-info fw-bold mb-3 d-flex align-items-center">
                        <div class="bg-info bg-gradient rounded-circle p-2 me-2">
                            <i class="bi bi-plus-circle text-white"></i>
                        </div>
                        Create New
                    </h6>
                    <div class="d-grid gap-2">
                        <a href="/headview" class="btn btn-outline-info rounded-pill text-start">
                            <i class="bi bi-person-plus me-2"></i>Create Family Head
                        </a>
                        <a href="{{ route('create.state') }}" class="btn btn-outline-info rounded-pill text-start active-class-5">
                            <i class="bi bi-geo-alt-fill me-2 "></i>Create State
                        </a>
                        <a href="{{ route('create.city') }}" class="btn btn-outline-info rounded-pill text-start active-class-6">
                            <i class="bi bi-building-add me-2  "></i>Create City
                        </a>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    <h6 class="text-primary fw-bold mb-3 d-flex align-items-center">
                        <div class="bg-primary bg-gradient rounded-circle p-2 me-2">
                            <i class="bi bi-speedometer2 text-white"></i>
                        </div>
                        Dashboards
                    </h6>
                    <div class="d-grid gap-2">
                        <a href="/dashboard" class="btn btn-outline-primary rounded-pill text-start active-class-7">
                            <i class="bi bi-house me-2"></i>Admin Dashboard
                        </a>
                        <a href="/" class="btn btn-outline-primary rounded-pill text-start active-class-8">
                            <i class="bi bi-person me-2"></i>User Dashboard
                        </a>
                        <a href="/state-city" class="btn btn-outline-primary rounded-pill text-start active-class-9">
                            <i class="bi bi-geo me-2"></i>State-City Dashboard
                        </a>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    <h6 class="text-danger fw-bold mb-3 d-flex align-items-center">
                        <div class="bg-danger bg-gradient rounded-circle p-2 me-2">
                            <i class="bi bi-person-circle text-white"></i>
                        </div>
                        Account
                    </h6>
                    <a href="/logout" class="btn btn-danger w-100 rounded-pill shadow-sm">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="sidebarOverlay"></div>
    @endif
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(function () {
        @if ($shouldShowDiv ?? true)
            const sidebar = $('#sidebarPush');
            const mainContent = $('#mainContent');
            const mainNavbar = $('#mainNavbar');
            const overlay = $('#sidebarOverlay');
            const breakpoint = 992; 

            
            function applySidebarState() {
                if (sidebar.hasClass('active')) {
                    if ($(window).width() < breakpoint) {
                        overlay.addClass('active');
                        mainContent.removeClass('pushed');
                        mainNavbar.removeClass('navbar-pushed');
                    } else {
                        overlay.removeClass('active');
                        mainContent.addClass('pushed');
                        mainNavbar.addClass('navbar-pushed');
                    }
                } else {
                    overlay.removeClass('active');
                    mainContent.removeClass('pushed');
                    mainNavbar.removeClass('navbar-pushed');
                }
            }

            function toggleSidebar() {
                sidebar.toggleClass('active');

                // **NEW**: Save the state to localStorage
                if (sidebar.hasClass('active')) {
                    localStorage.setItem('sidebarState', 'active');
                } else {
                    localStorage.removeItem('sidebarState');
                }

                applySidebarState();
            }

            // **NEW**: This function runs on page load to check the saved state.
            function initializeSidebar() {
                if (localStorage.getItem('sidebarState') === 'active') {
                    sidebar.addClass('active');
                }
                applySidebarState();
            }

            $('#openSidebarPush, #closeSidebarPush, #sidebarOverlay').on('click', function () {
                toggleSidebar();
            });

            $(window).on('resize', function() {
                applySidebarState();
            });

            initializeSidebar();
        @endif
    });
</script>