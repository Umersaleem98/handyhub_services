@extends('layouts.app')

@section('title', 'Users - HandymanPro')

@section('content')
<div class="d-flex">
    <nav class="sidebar-hp d-none d-lg-block">
        <div class="p-4 border-bottom border-secondary">
            <span class="fw-bold fs-5 text-white">Handyman<span class="text-primary">Pro</span></span>
        </div>
        <div class="nav flex-column py-3">
            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('admin.verifications.pending') }}" class="nav-link"><i class="bi bi-shield-check"></i> Verifications</a>
            <a href="{{ route('admin.users') }}" class="nav-link active"><i class="bi bi-people"></i> Users</a>
        </div>
        <div class="mt-auto p-4 border-top border-secondary position-absolute bottom-0 w-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100">Logout</button>
            </form>
        </div>
    </nav>

    <div class="main-content flex-grow-1">
        <h2 class="fw-bold mb-4">All Users</h2>
        
        <div class="card-hp p-4">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff" 
                                         class="rounded-circle" width="32" height="32">
                                    <span class="fw-semibold">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ ucfirst($user->role->value) }}</span></td>
                            <td>
                                <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }} bg-opacity-10 text-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.users.suspend', $user) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-{{ $user->status === 'active' ? 'warning' : 'success' }}">
                                        {{ $user->status === 'active' ? 'Suspend' : 'Activate' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-secondary">No users found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection