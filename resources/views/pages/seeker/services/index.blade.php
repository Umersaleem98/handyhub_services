@include('layouts.admin.head')

<style>

    .dashboard-header{
        background: linear-gradient(135deg,#4f46e5,#7c3aed);
        padding: 30px;
        border-radius: 18px;
        color: #fff;
        margin-bottom: 25px;
    }

    .dashboard-header h1{
        font-size: 32px;
        font-weight: 800;
    }

    .table-card{
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .status-badge{
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
    }

    .pending{
        background: #fef3c7;
        color: #92400e;
    }

    .accepted{
        background: #dcfce7;
        color: #166534;
    }

    .rejected{
        background: #fee2e2;
        color: #991b1b;
    }

    .modal-header{
        background: #4f46e5;
        color: #fff;
    }

</style>

<body>

<div class="overlay" id="overlay" onclick="closeMobileSidebar()"></div>

@include('layouts.admin.sidebar')

<div class="main-wrap" id="mainWrap">

@include('layouts.admin.header')

<main class="content">

    {{-- HEADER --}}
    <div class="dashboard-header">
        <h1>My Service Requests</h1>
        <p>Track all your submitted service requests</p>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="table-card">

        <table class="table table-hover align-middle">

            <thead class="table-dark">

                <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Price Range</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                @forelse($requests as $request)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        {{-- SERVICE --}}
                        <td>
                            <i class="{{ $request->service->icon }}"></i>
                            {{ $request->service->name }}
                        </td>

                        {{-- PRICE --}}
                        <td>
                            {{ $request->price_range ?? 'N/A' }}
                        </td>

                        {{-- STATUS --}}
                        <td>

                            @if($request->status == 'accepted')
                                <span class="status-badge accepted">Accepted</span>

                            @elseif($request->status == 'rejected')
                                <span class="status-badge rejected">Rejected</span>

                            @else
                                <span class="status-badge pending">Pending</span>
                            @endif

                        </td>

                        {{-- LOCATION --}}
                        <td>
                            <a href="{{ $request->location }}" target="_blank">
                                View Map
                            </a>
                        </td>

                        {{-- ACTION --}}
                        <td>

                            <button class="btn btn-sm btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewModal{{ $request->id }}">

                                View Details

                            </button>

                        </td>

                    </tr>

                    {{-- VIEW MODAL --}}
                    <div class="modal fade"
                         id="viewModal{{ $request->id }}"
                         tabindex="-1">

                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">
                                        Request Details
                                    </h5>

                                    <button type="button"
                                            class="btn-close btn-close-white"
                                            data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <div class="modal-body">

                                    <p><strong>Service:</strong> {{ $request->service->name }}</p>

                                    <p><strong>Description:</strong> {{ $request->description }}</p>

                                    <p><strong>Price Range:</strong> {{ $request->price_range }}</p>

                                    <p><strong>Location Link:</strong></p>
                                    <a href="{{ $request->location }}" target="_blank">
                                        Open Map
                                    </a>

                                    <hr>

                                    <p><strong>Latitude:</strong> {{ $request->latitude }}</p>

                                    <p><strong>Longitude:</strong> {{ $request->longitude }}</p>

                                    <hr>

                                    <p><strong>Status:</strong> {{ ucfirst($request->status ?? 'pending') }}</p>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            No Requests Found
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</main>

</div>

@include('layouts.admin.script')

</body>