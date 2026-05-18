@include('layouts.admin.head')

<style>

    .page-header{
        background: linear-gradient(135deg,#4f46e5,#7c3aed);
        padding: 30px;
        border-radius: 18px;
        color: #fff;
        margin-bottom: 25px;
    }

    .table-box{
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .status{
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .pending{ background:#fef3c7; color:#92400e; }
    .accepted{ background:#dcfce7; color:#166534; }
    .rejected{ background:#fee2e2; color:#991b1b; }

</style>

<body>

@include('layouts.admin.sidebar')

<div class="main-wrap" id="mainWrap">

@include('layouts.admin.header')

<main class="content">

    {{-- HEADER --}}
    <div class="page-header">
        <h1>Service Requests</h1>
        <p>All requests from seekers</p>
    </div>

    {{-- TABLE --}}
    <div class="table-box">

        <table class="table table-hover align-middle">

            <thead class="table-dark">

                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Service</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                @forelse($requests as $req)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $req->user->name }}
                        </td>

                        <td>
                            <i class="{{ $req->service->icon }}"></i>
                            {{ $req->service->name }}
                        </td>

                        <td>
                            {{ $req->price_range ?? 'N/A' }}
                        </td>

                        <td>

                            @if($req->status == 'accepted')
                                <span class="status accepted">Accepted</span>

                            @elseif($req->status == 'rejected')
                                <span class="status rejected">Rejected</span>

                            @else
                                <span class="status pending">Pending</span>
                            @endif

                        </td>

                        <td>

                            {{-- VIEW --}}
                            <a href="{{ route('provider.requests.show', $req->id) }}"
                               class="btn btn-sm btn-primary">

                                View

                            </a>

                            {{-- ACCEPT --}}
                            <form action="{{ route('provider.requests.status', $req->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf

                                <input type="hidden" name="status" value="accepted">

                                <button class="btn btn-sm btn-success">
                                    Accept
                                </button>

                            </form>

                            {{-- REJECT --}}
                            <form action="{{ route('provider.requests.status', $req->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf

                                <input type="hidden" name="status" value="rejected">

                                <button class="btn btn-sm btn-danger">
                                    Reject
                                </button>

                            </form>

                        </td>

                    </tr>

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