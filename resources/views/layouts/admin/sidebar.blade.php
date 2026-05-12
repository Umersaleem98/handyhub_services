<!-- Sidebar -->
<aside class="sidebar" id="sidebar">

    @php

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | SEEKER PROFILE CHECK
        |--------------------------------------------------------------------------
        */
        $seekerProfile = $user->seekerProfile ?? null;

        $seekerCompleted =
            $seekerProfile &&
            $seekerProfile->profile_completion >= 85;

        /*
        |--------------------------------------------------------------------------
        | PROVIDER PROFILE CHECK
        |--------------------------------------------------------------------------
        */
        $providerProfile = $user->providerProfile ?? null;

        $providerCompleted =
            $providerProfile &&
            $providerProfile->profile_completion >= 85;

    @endphp


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
        @if($user->isAdmin())

            <li class="nav-item">

                <a href="{{ route('admin.users') }}" class="nav-link">

                    <i class="fas fa-users"></i>
                    <span>All Users</span>

                </a>

            </li>

        @endif





        {{-- ================= SEEKER ================= --}}
        @if($user->isSeeker())

            {{-- PROFILE --}}
            <li class="nav-item">

                <a href="{{ route('seeker.profile') }}" class="nav-link">

                    <i class="fas fa-user"></i>
                    <span>My Profile</span>

                </a>

            </li>



            {{-- PRACTICE TAB --}}
            <li class="nav-item">

                <a href="{{ $seekerCompleted ? route('dashboard') : '#' }}"
                   class="nav-link {{ !$seekerCompleted ? 'disabled-link' : '' }}">

                    <i class="fas fa-book"></i>
                    <span>Practice</span>

                </a>

            </li>



            {{-- OTHER TAB --}}
            <li class="nav-item">

                <a href="{{ $seekerCompleted ? route('dashboard') : '#' }}"
                   class="nav-link {{ !$seekerCompleted ? 'disabled-link' : '' }}">

                    <i class="fas fa-briefcase"></i>
                    <span>Opportunities</span>

                </a>

            </li>



            {{-- WARNING --}}
            @if(!$seekerCompleted)

                <div class="alert alert-warning mx-2 mt-3 small">

                    Complete 85% profile to unlock features.

                </div>

            @endif

        @endif





        {{-- ================= PROVIDER ================= --}}
        @if($user->isProvider())

            {{-- PROVIDER PROFILE --}}
            <li class="nav-item">

                <a href="{{ route('provider.profile') }}" class="nav-link">

                    <i class="fas fa-user-check"></i>
                    <span>Provider Profile</span>

                </a>

            </li>



            {{-- PRACTICE TAB --}}
            <li class="nav-item">

                <a href="{{ $providerCompleted ? route('dashboard') : '#' }}"
                   class="nav-link {{ !$providerCompleted ? 'disabled-link' : '' }}">

                    <i class="fas fa-book-open"></i>
                    <span>Practice</span>

                </a>

            </li>



            {{-- SERVICES TAB --}}
            <li class="nav-item">

                <a href="{{ $providerCompleted ? route('dashboard') : '#' }}"
                   class="nav-link {{ !$providerCompleted ? 'disabled-link' : '' }}">

                    <i class="fas fa-tools"></i>
                    <span>Services</span>

                </a>

            </li>



            {{-- REQUESTS TAB --}}
            <li class="nav-item">

                <a href="{{ $providerCompleted ? route('dashboard') : '#' }}"
                   class="nav-link {{ !$providerCompleted ? 'disabled-link' : '' }}">

                    <i class="fas fa-calendar-check"></i>
                    <span>Requests</span>

                </a>

            </li>



            {{-- WARNING --}}
            @if(!$providerCompleted)

                <div class="alert alert-warning mx-2 mt-3 small">

                    Complete 85% profile to unlock features.

                </div>

            @endif

        @endif

    </ul>





    <!-- FOOTER -->
    <div class="sidebar-footer">

        <div class="admin-mini">

            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
                 alt="User">

            <div class="info">

                <div class="name">
                    {{ $user->name }}
                </div>

                <div class="role">
                    {{ ucfirst($user->role) }}
                </div>

            </div>

        </div>

    </div>

</aside>





<style>

.disabled-link{
    pointer-events: none;
    opacity: 0.5;
    cursor: not-allowed;
}

</style>