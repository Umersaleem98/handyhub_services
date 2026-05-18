@include('layouts.admin.head')

<style>

    .page-header{
        background: linear-gradient(135deg,#4f46e5,#7c3aed);
        padding: 30px;
        border-radius: 18px;
        color: #fff;
        margin-bottom: 25px;
    }

    .card-box{
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .info-label{
        font-size: 13px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .info-value{
        font-size: 16px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 15px;
    }

    .status{
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
    }

    .pending{ background:#fef3c7; color:#92400e; }
    .accepted{ background:#dcfce7; color:#166534; }
    .rejected{ background:#fee2e2; color:#991b1b; }

    .map-btn{
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 600;
    }

</style>

<body>

@include('layouts.admin.sidebar')

<div class="main-wrap" id="mainWrap">

@include('layouts.admin.header')

<main class="content">

    {{-- HEADER --}}
    <div class="page-header">

        <h1>Request Details</h1>
        <p>Full service request information</p>

    </div>

    <div class="card-box">

        {{-- STATUS --}}
        <div class="mb-3">

            <span class="status
                @if($request->status == 'accepted') accepted
                @elseif($request->status == 'rejected') rejected
                @else pending
                @endif
            ">

                {{ ucfirst($request->status ?? 'pending') }}

            </span>

        </div>

        {{-- USER INFO --}}
        <div>

            <div class="info-label">Customer Name</div>
            <div class="info-value">{{ $request->user->name }}</div>

            <div class="info-label">Email</div>
            <div class="info-value">{{ $request->user->email }}</div>

        </div>

        <hr>

        {{-- SERVICE INFO --}}
        <div>

            <div class="info-label">Service</div>
            <div class="info-value">
                <i class="{{ $request->service->icon }}"></i>
                {{ $request->service->name }}
            </div>

        </div>

        <hr>

        {{-- REQUEST DETAILS --}}
        <div>

            <div class="info-label">Description</div>
            <div class="info-value">
                {{ $request->description ?? 'No description provided' }}
            </div>

            <div class="info-label">Price Range</div>
            <div class="info-value">
                {{ $request->price_range ?? 'N/A' }}
            </div>

        </div>

        <hr>

        {{-- LOCATION --}}
        <div>

            <div class="info-label">Location</div>

            <div class="info-value">

                @if($request->location)

                    <a href="{{ $request->location }}"
                       target="_blank"
                       class="btn btn-primary map-btn">

                        Open in Google Maps

                    </a>

                @else
                    No location provided
                @endif

            </div>

        </div>

        <hr>

        {{-- COORDINATES --}}
        <div class="row">

            <div class="col-md-6">

                <div class="info-label">Latitude</div>
                <div class="info-value">{{ $request->latitude ?? 'N/A' }}</div>

            </div>

            <div class="col-md-6">

                <div class="info-label">Longitude</div>
                <div class="info-value">{{ $request->longitude ?? 'N/A' }}</div>

            </div>

        </div>

        <hr>

        {{-- BACK BUTTON --}}
        <a href="{{ route('provider.requests') }}"
           class="btn btn-dark">

            ← Back to Requests

        </a>

    </div>

</main>

</div>

@include('layouts.admin.script')

</body>