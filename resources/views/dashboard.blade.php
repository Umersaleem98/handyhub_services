@include('layouts.admin.head')
<title>Dashboard</title>

<style>
    .service-card {
        transition: 0.3s ease;
        cursor: pointer;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
        background: #1a1a1a;
    }
</style>

<body>
    <div class="container-fluid position-relative d-flex p-0">

        @include('layouts.admin.sidebar')

        <div class="content">
            @include('layouts.admin.header')

            <!-- Stats -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded p-4 d-flex justify-content-between">
                            <i class="fa fa-chart-line fa-3x text-success"></i>
                            <div>
                                <p>Today Sale</p>
                                <h6>$1234</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded p-4 d-flex justify-content-between">
                            <i class="fa fa-chart-bar fa-3x text-warning"></i>
                            <div>
                                <p>Total Sale</p>
                                <h6>$1234</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded p-4 d-flex justify-content-between">
                            <i class="fa fa-chart-area fa-3x text-info"></i>
                            <div>
                                <p>Today Revenue</p>
                                <h6>$1234</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded p-4 d-flex justify-content-between">
                            <i class="fa fa-chart-pie fa-3x text-danger"></i>
                            <div>
                                <p>Total Revenue</p>
                                <h6>$1234</h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Services -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded p-4">
                    <h4 class="mb-4">Handyman Services</h4>

                    <div class="row g-4">

                        <!-- Plumber -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-wrench fa-3x text-primary mb-3"></i>
                                    <h6>Plumber</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- Electrician -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-bolt fa-3x text-primary mb-3"></i>
                                    <h6>Electrician</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- Cleaner -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-broom fa-3x text-primary mb-3"></i>
                                    <h6>Cleaner</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- Carpenter -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-hammer fa-3x text-primary mb-3"></i>
                                    <h6>Carpenter</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- Painter -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-paint-roller fa-3x text-primary mb-3"></i>
                                    <h6>Painter</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- AC Technician -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-snowflake fa-3x text-primary mb-3"></i>
                                    <h6>AC Technician</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- Home Shifting -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-truck fa-3x text-primary mb-3"></i>
                                    <h6>Home Shifting</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- Gardener -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-leaf fa-3x text-primary mb-3"></i>
                                    <h6>Gardener</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- Pest Control -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-bug fa-3x text-primary mb-3"></i>
                                    <h6>Pest Control</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- Appliance Repair
                    <a href="{{ route('booking.index') }}">-->
                        <div class="col-md-3">
                            <div class="bg-dark p-4 text-center rounded service-card">
                                <i class="fa fa-tools fa-3x text-primary mb-3"></i>
                                <h6>Appliance Repair</h6>
                                </a>
                            </div>
                        </div>
                        
                        <!-- CCTV -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-video fa-3x text-primary mb-3"></i>
                                    <h6>CCTV Installation</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- Generator -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-cogs fa-3x text-primary mb-3"></i>
                                    <h6>Generator Repair</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- Laundry -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-tshirt fa-3x text-primary mb-3"></i>
                                    <h6>Laundry Service</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- Water Tank -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-water fa-3x text-primary mb-3"></i>
                                    <h6>Water Tank Cleaning</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- Security -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-shield-alt fa-3x text-primary mb-3"></i>
                                    <h6>Security Services</h6>
                                </div>
                                </a>
                            </div>
                        
                        <!-- Mason -->

                            <div class="col-md-3">
                        <a href="{{ route('booking.index') }}">
                                <div class="bg-dark p-4 text-center rounded service-card">
                                    <i class="fa fa-hard-hat fa-3x text-primary mb-3"></i>
                                    <h6>Mason / Plaster</h6>
                                </div>
                                </a>
                            </div>
                        
                    </div>
                </div>
            </div>

        </div>

        <a href="{{ route('booking.index') }}#" class="btn btn-lg btn-primary back-to-top">
            <i class="bi bi-arrow-up"></i>
        

    </div>

    @include('layouts.admin.script')
