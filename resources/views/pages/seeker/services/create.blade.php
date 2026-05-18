@include('layouts.admin.head')

<style>

    .service-card{
        border: none;
        border-radius: 18px;
        overflow: hidden;
        transition: all .3s ease;
        background: #fff;
        height: 100%;
        position: relative;
    }

    .service-card:hover{
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    }

    .service-icon{
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg,#4f46e5,#7c3aed);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .service-icon i{
        font-size: 32px;
        color: #fff;
    }

    .service-title{
        font-size: 22px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 12px;
    }

    .service-desc{
        color: #6b7280;
        font-size: 15px;
        line-height: 1.7;
        min-height: 70px;
    }

    .apply-btn{
        border-radius: 12px;
        padding: 10px 25px;
        font-weight: 600;
    }

    .page-top{
        background: linear-gradient(135deg,#4f46e5,#7c3aed);
        border-radius: 20px;
        padding: 35px;
        color: white;
        margin-bottom: 35px;
    }

    .page-top h1{
        font-size: 38px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .page-top p{
        margin: 0;
        opacity: .9;
    }

    .modal-content{
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .modal-header{
        background: linear-gradient(135deg,#4f46e5,#7c3aed);
        color: white;
        border: none;
        padding: 20px 25px;
    }

    .modal-title{
        font-weight: 700;
    }

    .btn-close{
        filter: brightness(0) invert(1);
    }

    .modal-body{
        padding: 25px;
    }

    .modal-footer{
        border: none;
        padding: 20px 25px;
    }

    .form-label{
        font-weight: 600;
        margin-bottom: 8px;
        color: #374151;
    }

    .form-control{
        border-radius: 12px;
        min-height: 48px;
        border: 1px solid #d1d5db;
        box-shadow: none;
    }

    .form-control:focus{
        border-color: #4f46e5;
        box-shadow: 0 0 0 0.15rem rgba(79,70,229,.15);
    }

    textarea.form-control{
        min-height: 120px;
    }

    .location-btn{
        border-radius: 12px;
        font-weight: 600;
    }

    .submit-btn{
        border-radius: 12px;
        padding: 10px 25px;
        font-weight: 700;
    }

</style>

<body>

    {{-- OVERLAY --}}
    <div class="overlay" id="overlay" onclick="closeMobileSidebar()"></div>

    {{-- SIDEBAR --}}
    @include('layouts.admin.sidebar')

    {{-- MAIN WRAP --}}
    <div class="main-wrap" id="mainWrap">

        {{-- HEADER --}}
        @include('layouts.admin.header')

        {{-- CONTENT --}}
        <main class="content">

            {{-- PAGE HEADER --}}
            <div class="page-top">

                <h1>
                    Available Services
                </h1>

                <p>
                    Seeker / Services
                </p>

            </div>

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>

            @endif

            {{-- ERROR MESSAGE --}}
            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- SERVICES --}}
            <div class="row">

                @foreach($services as $service)

                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">

                        <div class="card service-card shadow-sm">

                            <div class="card-body p-4">

                                <div class="service-icon">

                                    <i class="{{ $service->icon }}"></i>

                                </div>

                                <h3 class="service-title">

                                    {{ $service->name }}

                                </h3>

                                <p class="service-desc">

                                    {{ $service->description }}

                                </p>

                                <button class="btn btn-primary apply-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#applyModal{{ $service->id }}">

                                    Apply Now

                                </button>

                            </div>

                        </div>

                    </div>

                    {{-- APPLY MODAL --}}
                    <div class="modal fade"
                         id="applyModal{{ $service->id }}"
                         tabindex="-1">

                        <div class="modal-dialog modal-lg modal-dialog-centered">

                            <div class="modal-content">

                                <form action="{{ route('seeker.services.request') }}"
                                      method="POST">

                                    @csrf

                                    {{-- MODAL HEADER --}}
                                    <div class="modal-header">

                                        <h5 class="modal-title">

                                            Apply For {{ $service->name }}

                                        </h5>

                                        <button type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal">
                                        </button>

                                    </div>

                                    {{-- MODAL BODY --}}
                                    <div class="modal-body">

                                        <input type="hidden"
                                               name="service_id"
                                               value="{{ $service->id }}">

                                        {{-- DESCRIPTION --}}
                                        <div class="mb-4">

                                            <label class="form-label">

                                                Description

                                            </label>

                                            <textarea name="description"
                                                      class="form-control"
                                                      placeholder="Describe your requirements..."></textarea>

                                        </div>

                                        {{-- PRICE --}}
                                        <div class="mb-4">

                                            <label class="form-label">

                                                Price Range

                                            </label>

                                            <input type="text"
                                                   name="price_range"
                                                   class="form-control"
                                                   placeholder="Example: 2000 - 5000">

                                        </div>

                                        {{-- LOCATION --}}
                                        <div class="mb-4">

                                            <label class="form-label">

                                                Current Location

                                            </label>

                                            <input type="text"
                                                   name="location"
                                                   id="location{{ $service->id }}"
                                                   class="form-control"
                                                   placeholder="Your live location">

                                        </div>

                                        {{-- COORDINATES --}}
                                        <div class="row">

                                            <div class="col-md-6 mb-4">

                                                <label class="form-label">

                                                    Latitude

                                                </label>

                                                <input type="text"
                                                       name="latitude"
                                                       id="latitude{{ $service->id }}"
                                                       class="form-control"
                                                       readonly>

                                            </div>

                                            <div class="col-md-6 mb-4">

                                                <label class="form-label">

                                                    Longitude

                                                </label>

                                                <input type="text"
                                                       name="longitude"
                                                       id="longitude{{ $service->id }}"
                                                       class="form-control"
                                                       readonly>

                                            </div>

                                        </div>

                                        {{-- GET LOCATION BUTTON --}}
                                        <button type="button"
                                                class="btn btn-dark location-btn"
                                                onclick="getLocation({{ $service->id }})">

                                            <i class="fas fa-map-marker-alt me-2"></i>

                                            Get Live Location

                                        </button>

                                    </div>

                                    {{-- MODAL FOOTER --}}
                                    <div class="modal-footer">

                                        <button type="button"
                                                class="btn btn-light"
                                                data-bs-dismiss="modal">

                                            Cancel

                                        </button>

                                        <button type="submit"
                                                class="btn btn-success submit-btn">

                                            Submit Request

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </main>

    </div>

    {{-- LOCATION SCRIPT --}}
    <script>

        function getLocation(serviceId)
        {
            if (navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(

                    function(position)
                    {
                        showPosition(position, serviceId);
                    },

                    showError

                );
            }
            else
            {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position, serviceId)
        {
            let latitude = position.coords.latitude;
            let longitude = position.coords.longitude;

            document.getElementById(
                "latitude" + serviceId
            ).value = latitude;

            document.getElementById(
                "longitude" + serviceId
            ).value = longitude;

            document.getElementById(
                "location" + serviceId
            ).value =
                "https://maps.google.com/?q=" +
                latitude + "," + longitude;
        }

        function showError(error)
        {
            switch(error.code)
            {
                case error.PERMISSION_DENIED:

                    alert("User denied the request for Geolocation.");

                    break;

                case error.POSITION_UNAVAILABLE:

                    alert("Location information unavailable.");

                    break;

                case error.TIMEOUT:

                    alert("Location request timed out.");

                    break;

                case error.UNKNOWN_ERROR:

                    alert("An unknown error occurred.");

                    break;
            }
        }

    </script>

    {{-- SCRIPTS --}}
    @include('layouts.admin.script')

</body>