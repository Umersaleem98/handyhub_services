@extends('layouts.app')

@section('title', 'Pending Verifications - HandymanPro')

@section('content')
<div class="d-flex">
    <nav class="sidebar-hp d-none d-lg-block">
        <div class="p-4 border-bottom border-secondary">
            <span class="fw-bold fs-5 text-white">Handyman<span class="text-primary">Pro</span></span>
        </div>
        <div class="nav flex-column py-3">
            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('admin.verifications.pending') }}" class="nav-link active"><i class="bi bi-shield-check"></i> Verifications</a>
            <a href="{{ route('admin.users') }}" class="nav-link"><i class="bi bi-people"></i> Users</a>
        </div>
        <div class="mt-auto p-4 border-top border-secondary position-absolute bottom-0 w-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100">Logout</button>
            </form>
        </div>
    </nav>

    <div class="main-content flex-grow-1">
        <h2 class="fw-bold mb-4">Pending Verifications</h2>
        
        <div class="card-hp p-4">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Provider</th>
                            <th>Document Type</th>
                            <th>Uploaded</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($documents as $doc)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($doc->user->name) }}&background=f97316&color=fff" 
                                         class="rounded-circle" width="32" height="32">
                                    <div>
                                        <div class="fw-semibold">{{ $doc->user->name }}</div>
                                        <div class="small text-secondary">{{ $doc->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-capitalize">{{ str_replace('_', ' ', $doc->document_type) }}</td>
                            <td>{{ $doc->created_at->diffForHumans() }}</td>
                            <td><span class="badge bg-warning bg-opacity-10 text-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-success" onclick="approveDoc({{ $doc->id }})">Approve</button>
                                <button class="btn btn-sm btn-danger" onclick="rejectDoc({{ $doc->id }})">Reject</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-secondary">No pending verifications</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $documents->links() }}
        </div>
    </div>
</div>

<script>
function approveDoc(id) {
    if(confirm('Approve this document?')) {
        fetch(`/admin/documents/${id}/review`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: 'approved' })
        }).then(() => location.reload());
    }
}

function rejectDoc(id) {
    const notes = prompt('Rejection reason:');
    if(notes !== null) {
        fetch(`/admin/documents/${id}/review`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: 'rejected', notes: notes })
        }).then(() => location.reload());
    }
}
</script>
@endsection