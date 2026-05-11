<!-- Sidebar -->
<aside class="sidebar" id="sidebar">

    <!-- HEADER -->
    <div class="sidebar-header">

        <div class="brand">
            <i class="fas fa-tools me-2"></i>
            FixIt Pro
        </div>

        <button class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>

    </div>

    <!-- NAV -->
    <ul class="nav-menu">

        {{-- COMMON DASHBOARD --}}
        <li class="nav-item">
            <a href="{{ url('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        </li>

        {{-- ================= ADMIN ================= --}}
        @if(auth()->user()->isAdmin())

         @include('layouts.admin.components.adminSidebar')

        @endif

        {{-- ================= SEEKER ================= --}}
        @if(auth()->user()->isSeeker())
        `@include('layouts.admin.components.seekarSidebar')

        @endif

        {{-- ================= PROVIDER ================= --}}
        @if(auth()->user()->isProvider())
        @include('layouts.admin.components.providerSidebar')

        @endif

       

    </ul>

    <!-- FOOTER -->
    <div class="sidebar-footer">

        <div class="admin-mini">

            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                 alt="User">

            <div class="info">
                <div class="name">{{ auth()->user()->name }}</div>
                <div class="role">
                    {{ ucfirst(auth()->user()->role) }}
                </div>
            </div>

        </div>

    </div>

</aside>