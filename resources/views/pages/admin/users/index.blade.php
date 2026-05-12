@include('layouts.admin.head')

<body>

    @include('layouts.admin.sidebar')

    <div class="main-wrap" id="mainWrap">

        @include('layouts.admin.header')

        <main class="content">

            <div class="container-fluid">

                <h2 class="mb-4">User Verification Panel</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif



                <div class="card shadow-sm">

                    <div class="card-body">

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($users as $user)
                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $user->name }}</td>

                                        <td>{{ $user->email }}</td>

                                        <td>{{ ucfirst($user->role) }}</td>

                                        <td>

                                            @if ($user->role == 'seeker')
                                                {{ $user->seekerProfile->is_verified ?? false ? 'Verified' : 'Pending' }}
                                            @else
                                                {{ $user->providerProfile->is_verified ?? false ? 'Verified' : 'Pending' }}
                                            @endif

                                        </td>

                                        <td>

                                            <a href="{{ route('admin.users.show', $user->id) }}"
                                                class="btn btn-sm btn-info">
                                                View
                                            </a>

                                            @if ($user->role == 'seeker')
                                                @if (optional($user->seekerProfile)->is_verified)
                                                    <form action="{{ route('admin.users.unverify', $user->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger">Unverify</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.users.verify', $user->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-sm btn-success">Verify</button>
                                                    </form>
                                                @endif
                                            @else
                                                @if (optional($user->providerProfile)->is_verified)
                                                    <form action="{{ route('admin.users.unverify', $user->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger">Unverify</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.users.verify', $user->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-sm btn-success">Verify</button>
                                                    </form>
                                                @endif
                                            @endif

                                        </td>
                                        <td>

    @if ($user->role == 'seeker')

        @if (optional($user->seekerProfile)->is_verified)
            <span class="badge bg-success">Verified</span>
        @else
            <span class="badge bg-warning text-dark">Pending</span>
        @endif

    @else

        @if (optional($user->providerProfile)->is_verified)
            <span class="badge bg-success">Verified</span>
        @else
            <span class="badge bg-warning text-dark">Pending</span>
        @endif

    @endif

</td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </main>

    </div>

    @include('layouts.admin.script')

</body>
