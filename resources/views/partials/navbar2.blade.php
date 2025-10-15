<style>
    @import url('https://fonts.googleapis.com/css2?family=Borel&family=Miniver&family=Pacifico&family=Playwrite+DE+Grund:wght@100..400&display=swap');
    @import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap");


@import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Cookie&family=Exo:ital,wght@0,100..900;1,100..900&family=Playwrite+DE+SAS:wght@100..400&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap');

    body {
        padding-top: 105px;
    }

    .new_font_2{
                    font-family: "graduate", serif;
                    font-weight: 400;
                    font-style: normal;
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
        padding: 27px 10px 27px 23px;
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
        font-size: 0.95rem;
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

    @import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap");

    *,
    *::after,
    *::before {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    :root {
      --gray-100: #f3f4f6;
      --gray-800: #1f2937;
      --gray-900: #111827;
      --emerald-500: #10b981;
      --ff-roboto: "Roboto", sans-serif;
    }


    /* Notification Icon */
    ion-icon[name="notifications-outline"] {
      font-size: 1.85rem;
      color: var(--gray-100);
    }

    /* Profile Dropdown */
    .dropdown-wrapper-2 {
      position: relative;
      margin-left: 0.5rem;
    }

    .dropdown-toggle {
      display: none;
    }

    .dropdown-label {
      height: 2.8rem;
      width: 2.8rem;
      display: block;
      border: 3px solid #ffffff;
      background-color: #007bff;
      cursor: pointer;
      border-radius: 50%;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='white' viewBox='0 0 16 16'%3E%3Cpath d='M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z'/%3E%3C/svg%3E");
      background-position: center;
      background-repeat: no-repeat;
      background-size: 60%;
      transition: all 0.2s ease;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .dropdown-label:hover {

      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .dropdown-menu {
      position: absolute;
      top: 4rem;
      right: 0;
      min-width: 250px;
      padding: 0;
      background: white;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      border: 1px solid #e9ecef;
      z-index: 1050;
    }

    .upper-triangle {
      position: absolute;
      right: 1rem;
      top: -8px;
      width: 0;
      height: 0;
      border-left: 8px solid transparent;
      border-right: 8px solid transparent;
      border-bottom: 8px solid white;
    }

    .dropdown-menu-display {
      display: none;
      animation: fadeInDown 0.5s ease;


    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }



    .dropdown-toggle:checked + .dropdown-label + .dropdown-menu-display {
      display: block;
    }


    .dropdown-header {
      padding: 1rem;
      border-bottom: 1px solid #e9ecef;
      background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
      border-radius: 12px 12px 0 0;
      color: white;
      text-align: center;
    }

    .dropdown-header .admin-avatar {
      width: 50px;
      height: 50px;
      background: rgba(255,255,255,0.2);
      border: 2px solid rgba(255,255,255,0.3);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 0.5rem;
    }

    .dropdown-header .admin-name {
      font-weight: 600;
      font-size: 0.95rem;

      font-family : 'graduate' , serif;
    }
    .rainbow-text{
        background-image: linear-gradient(
                              45deg,
                              #FF3D00,
                              #FF8C00,
                              #FFEE00,
                              #4DE94C,
                              #3A9FFF,
                              #C800FF
                            );
          -webkit-background-clip: text; /* For Safari/Chrome */
          background-clip: text;
          color: transparent;
    }
    .dropdown-header .admin-role {
      font-size: 0.8rem;
        font-weight: 800;
      opacity: 0.8;
    }

    .dropdown-list {
      list-style: none;
      margin: 0;
      padding: 0.5rem 0;
    }

    .dropdown-list a {
      display: flex;
      align-items: center;
      padding: 0.75rem 1rem;
      color: #495057;
      text-decoration: none;
      transition: all 0.2s ease;
      border-left: 4px solid transparent;
    }

    .dropdown-list a:hover {
      border-radius : 7px;
      background-color: #f8f9fa;

      border-left-color: #007bff;
      color: #007bff;
    }
    .dropdown-list a.logout-hov:hover{
           background-color: rgba(245, 0, 0, 0.05);
                 border-left-color: red;
                 color: red;
    }
    .dropdown-list a.login-hov:hover{
           background-color: rgba(25, 135, 84, 0.05).;
                 border-left-color: green;
                 color: green;
    }

    .dropdown-list-icon {
      font-size: 1.1rem;
      margin-right: 0.75rem;
      width: 20px;
      text-align: center;
    }

    .dropdown-list span {
      font-size: 0.9rem;
      font-weight: 500;
    }

    .dropdown-divider {
      height: 1px;
      background: #e9ecef;
      margin: 0.5rem 0;
    }

    .admin-email{
        color  : rgba(255, 255, 255, 0.70);
        font-family: "Cookie", cursive;
    }


    @media (max-width: 800px) {
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

ul p {
    margin  : 5px 0px 0px 0px;
    font-family: "graduate", serif;
}
</style>

<div class="fixed-top" style="padding-bottom: 10px;z-index:100">
    <nav id="mainNavbar" class="navbar navbar-expand-lg mb-3 navbar-dark bg-primary bg-gradient shadow-lg">
        <div class="container mediaclass">
            <a @if($admin1) href="/dashboard" @else href='/' @endif class="navbar-brand d-flex align-items-center flex-grow-1">
                <div class="bg-white rounded-circle p-2 px-3 me-2 me-md-3">
                    <i class="bi bi-house-heart text-primary fs-5"></i>
                </div>
                <div class="flex-grow-1">
                    <span class="fw-bold text1 new_font_2 " id="title-fms"  style=" font-family: graduate, serif;" >Family Management System</span>
                    <div class="small opacity-75 text2 d-none d-sm-block">Database for your family</div>
                </div>
            </a>
            <div class="d-flex align-items-center flex-shrink-0">

                @if ($shouldShowDiv ?? true)
                <button class="btn btn-menu-style btn-outline-light rounded-pill px-3" type="button" id="openSidebarPush">
                    <i class="bi bi-list fs-5 me-1"></i>
                    <span class="d-none d-sm-inline">Menu</span>
                </button>
                @endif
                @if ($shouldShowDiv ?? true)
                                <!-- Profile Dropdown -->
                                <div class="dropdown-wrapper-2" style="margin-right  : 5px">
                                    <input type="checkbox" class="dropdown-toggle" id="dropdown-toggle">
                                    <label for="dropdown-toggle"  style='margin-bottom : 0px' class="dropdown-label" title="Profile Menu"></label>
                                    <div class="dropdown-menu dropdown-menu-display">
                                        <div class="upper-triangle"></div>
                                        <div class="dropdown-header">
                                            <small class="admin-email" style="font-size : 18px">{{$admin1->email}}</small>

                                            <div class="admin-avatar mt-2">
                                                <i class="bi bi-person-fill" style="font-size: 1.5rem;"></i>
                                            </div>
                                            <div class="admin-name">{{ $admin1->first_name . ' ' . $admin1->last_name ?? 'Admin User' }}</div>
                                            @if ($admin1->superuser == '1')
                                            <div class="admin-role rainbow-text ">Super Administrator</div>
                                            @else
                                            <div class="admin-role">System Administrator</div>
                                            @endif

                                        </div>
                                        <ul class="dropdown-list">
                                            <a href="/dashboard/admin-profile">
                                                <i class="bi bi-person dropdown-list-icon"></i>
                                                <span>Your Profile</span>
                                            </a>
                                            <a href="/dashboard">
                                                <i class="bi bi-speedometer2 dropdown-list-icon"></i>
                                                <span>Admin Dashboard</span>
                                            </a>
                                            <a href="/admin">
                                                <i class="bi bi-people dropdown-list-icon"></i>
                                                <span>Manage Families</span>
                                            </a>
                                            <a href="{{ route('admin.members') }}">
                                                <i class="bi bi-person-lines-fill dropdown-list-icon"></i>
                                                <span>Manage Members</span>
                                            </a>
                                            <a href="/state-city">
                                                <i class="bi bi-geo-alt dropdown-list-icon"></i>
                                                <span>Manage Location</span>
                                            </a>
                                            <a href="/support">
                                                <i class="bi bi-headset dropdown-list-icon"></i>
                                                <span>Admin Support</span>
                                            </a>
                                            <a href="/logout" class="logout-hov" >
                                                <i class="bi bi-box-arrow-right dropdown-list-icon "></i>
                                                <span>Logout</span>
                                            </a>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Admin Profile Button -->

                                @endif

                 @if ($shouldShowLoginDiv ?? false)
                                                 <!-- Profile Dropdown -->
                                                 <div class="dropdown-wrapper-2" style="margin-right  : 5px">
                                                     <input type="checkbox" class="dropdown-toggle" id="dropdown-toggle">
                                                     <label for="dropdown-toggle" class="dropdown-label" title="Profile Menu"></label>
                                                     <div class="dropdown-menu dropdown-menu-display">
                                                         <div class="upper-triangle"></div>
                                                            <div class="dropdown-header">
                                                              <div class="admin-avatar mt-2">
                                                                  <i class="bi bi-person-fill" style="font-size: 1.5rem;"></i>
                                                              </div>
                                                              <div class="admin-name">Guest</div>

                                                              <div class="admin-role rainbow-text ">Hello,Guest</div>


                                                          </div>
                                                         <ul class="dropdown-list">
                                                             <a href="/login" class='login-hov' >
                                                                 <i class="bi bi-person dropdown-list-icon"></i>
                                                                 <span>Admin Login</span>
                                                             </a>
                                                            <a href="/" >
                                                                 <i class="bi bi-speedometer2 dropdown-list-icon"></i>
                                                                 <span>User Dashboard</span>
                                                             </a>
                                                            <a href="/family-registration" >
                                                                 <i class="bi bi-plus-circle dropdown-list-icon"></i>
                                                                 <span>Register Family</span>
                                                             </a>
                                                            <a href="/about" >
                                                                 <i class="bi bi-info-circle dropdown-list-icon"></i>
                                                                 <span>About Us</span>
                                                             </a>
                                                            <a href="/support" >
                                                                 <i class="bi bi-headset dropdown-list-icon"></i>
                                                                 <span>Contact Support</span>
                                                             </a>
                                                         </ul>
                                                     </div>
                                                 </div>


                                                 @endif

            </div>

        </div>
    </nav>

    @if ($shouldShowDiv ?? true)
    <div id="sidebarPush" class="sidebar-push bg-primary text-white">
        <div class="sidebar-header">
            <h6 class="fw-bold mb-1" style=" font-family: graduate, serif;" ><i class="bi bi-grid-3x3-gap me-2"></i>Navigation Menu</h5>
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
                        <a href="{{ route('admin.members') }}" class="btn btn-outline-success rounded-pill text-start active-class-31">
                            <i class="bi bi-person-lines-fill me-2"></i>Manage Members
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
                        <a href="/family-registration" class="btn btn-outline-info rounded-pill text-start active-class-12">
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
                    <a href="/support" class="btn btn-outline-danger mb-2 text-start w-100 rounded-pill shadow-sm active-class-11">
                        <i class="bi bi-headset me-2"></i>Admin Support
                    </a>
                    <a href="/logout" class="btn btn-danger w-100 text-start rounded-pill shadow-sm">
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
            const title_fms = document.getElementById('title-fms') ;


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
   function updateTitle() {
       const title_fms = document.getElementById('title-fms');
       if (title_fms) {
           const windowWidth = window.innerWidth;
           if (windowWidth < 480) {
               title_fms.innerText = 'FMS';
               title_fms.style.fontSize = '1em';
           } else {
               title_fms.innerText = 'Family Management System';
               title_fms.style.fontSize = '1.2em';
           }
       }
   }

   document.addEventListener('DOMContentLoaded', updateTitle);
   window.addEventListener('resize', updateTitle);
</script>
