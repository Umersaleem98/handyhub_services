@include('layouts.admin.head')

<body>

    <!-- Overlay -->
    <div class="overlay" id="overlay" onclick="closeMobileSidebar()"></div>

    @include('layouts.admin.sidebar')

    <!-- Main -->
    <div class="main-wrap" id="mainWrap">

        @include('layouts.admin.header')
        @include('layouts.admin.alert')

        <!-- Content -->
        <main class="content">

            <div class="container-fluid">

                <h1 class="page-title">
                    @if (Auth::user()->role == 'admin')
                        Admin Dashboard
                    @elseif(Auth::user()->role == 'seeker')
                        Seeker Dashboard
                    @elseif(Auth::user()->role == 'provider')
                        Provider Dashboard
                    @endif
                </h1>

                <p class="breadcrumb-text">Home / Overview</p>




                {{-- ================= ADMIN ONLY CARDS ================= --}}
                @if (Auth::user()->role == 'admin')
                    <div class="row mt-4">

                        {{-- TOTAL USERS --}}
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6>Total Users</h6>
                                    <h3>{{ $totalUsers }}</h3>
                                </div>
                            </div>
                        </div>

                        {{-- ADMIN USERS --}}
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6>Admins</h6>
                                    <h3>{{ $adminUsers }}</h3>
                                </div>
                            </div>
                        </div>

                        {{-- SEEKERS --}}
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6>Seekers</h6>
                                    <h3>{{ $seekerUsers }}</h3>
                                </div>
                            </div>
                        </div>
                        {{-- PROVIDERS --}}
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6>Providers</h6>
                                    <h3>{{ $providerUsers }}</h3>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-3">

                        {{-- SEEKER VERIFIED --}}
                        <div class="col-md-3 mb-4">
                            <div class="card border-success shadow-sm">
                                <div class="card-body">
                                    <h6>Seeker Verified</h6>
                                    <h3 class="text-success">{{ $seekerVerified }}</h3>
                                </div>
                            </div>
                        </div>
                        {{-- SEEKER UNVERIFIED --}}
                        <div class="col-md-3 mb-4">
                            <div class="card border-warning shadow-sm">
                                <div class="card-body">
                                    <h6>Seeker Pending</h6>
                                    <h3 class="text-warning">{{ $seekerUnverified }}</h3>
                                </div>
                            </div>
                        </div>
                        {{-- PROVIDER VERIFIED --}}
                        <div class="col-md-3 mb-4">
                            <div class="card border-success shadow-sm">
                                <div class="card-body">
                                    <h6>Provider Verified</h6>
                                    <h3 class="text-success">{{ $providerVerified }}</h3>
                                </div>
                            </div>
                        </div>
                        {{-- PROVIDER UNVERIFIED --}}
                        <div class="col-md-3 mb-4">
                            <div class="card border-warning shadow-sm">
                                <div class="card-body">
                                    <h6>Provider Pending</h6>
                                    <h3 class="text-warning">{{ $providerUnverified }}</h3>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
                {{-- ================= END ADMIN ONLY ================= --}}

                {{-- ================= SEEKER CONTENT ================= --}}
                @if (Auth::user()->role == 'seeker')
                    <div class="row mt-4">

                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h4>Welcome Seeker</h4>
                                    <p>
                                        You can browse providers, manage requests,
                                        and update your profile here.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
                {{-- ================= END SEEKER ================= --}}
                {{-- ================= PROVIDER CONTENT ================= --}}
                @if (Auth::user()->role == 'provider')
                    <div class="row mt-4">

                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h4>Welcome Provider</h4>
                                    <p>
                                        You can manage services, requests,
                                        and profile information here.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
                {{-- ================= END PROVIDER ================= --}}

            </div>

        </main>

    </div>

    @include('layouts.admin.script')
